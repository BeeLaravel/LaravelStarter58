## LVS
基于IP的数据请求负载均衡调度方案

### 运行模式

#### NAT Network Address Translation 网络地址转换 网络层 路由器 请求响应高度依赖中心服务器
修改请求的目标地址端口
修改响应的源地址端口
RS 使用私有地址 网关指向 DIP

#### TUN Tunnel 隧道
原请求继续封装新的包头

#### DR Direct Route 直接路由 链路层 网关
共享 VIP
修改请求的目标 MAC 地址 通过网关到目标真实服务器

### -s 调度算法

#### 静态调度 fixed scheduling
轮叫 round-robin (RR)
加权轮叫 weithted round-robin (WRR)
目标地址散列 destination hashing (DH)
源地址散列 source hash (SH)

#### 动态调度 dynamic scheduling 活动链接数 x 256 + 非活动链接数
最少链接 least-connect (LC) 维护服务器已建立连接数
加权最少链接 weighted least-connection (WLC) (Default)
最短期望连接 shortest expected delay (SED) WLC+1
从不排队 never quene (NQ) SED 不排队 连接数等于0直接分配不需要运算
基于局部性的最少链接 locality-based least-connection (LBLC) 维护目标IP到一台服务器的映射
带复制的基于局部性最少链接 locality-based least-connection with replication (LBLCR) 维护目标IP到一组服务器的映射


### 配置

#### 虚拟机配置 NAT
##### 141 lvs 负载均衡服务器
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.141
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8
	/etc/sysconfig/network-scripts/ifcfg-ens37
		BOOTPROTO=static
		IPADDR=192.168.81.141
		NETMASK=255.255.255.0
		GATEWAY=192.168.81.1
		DNS1=192.168.81.1
		DNS2=8.8.8.8
	service network restart # 重启网络
	systemctl stop firewalld.service # 关闭防火墙
	systemctl disable firewalld.service # 禁用防火墙
	yum install ipvsadm # 安装 ipvsadm

###### 系统级虚拟网卡
	ifconfig eth0:0 192.168.81.141 broadcast 192.168.81.141 netmask 255.255.255.255 up # 添加 VIP
	route add -host 192.168.81.141 dev eth0:0 # 指定路由
	ifconfig lo:0 192.168.81.141 broadcast 192.168.81.141 netmask 255.255.255.255 up
	route add -host 192.168.81.141 dev lo:0

###### 开启路由转发
	echo 1 > /proc/sys/net/ipv4/ip_forward # 临时修改
	cat /proc/sys/net/ipv4/ip_forward # 查看配置
	/etc/sysctl.conf # 永久修改
		net.ipv4.ip_forward = 1
	sysctl -p # 查看配置

###### 关闭 ICMP 重定向
	echo 0 > /proc/sys/net/ipv4/conf/all/send_redirects
	echo 0 > /proc/sys/net/ipv4/conf/default/send_redirects
	echo 0 > /proc/sys/net/ipv4/conf/ens33/send_redirects
	echo 0 > /proc/sys/net/ipv4/conf/ens37/send_redirects

###### 禁用 ARP
	echo "1" > /proc/sys/net/ipv4/conf/lo/arp_ignore
	echo "1" > /proc/sys/net/ipv4/conf/all/arp_ignore
	echo "2" > /proc/sys/net/ipv4/conf/lo/arp_announce
	echo "2" > /proc/sys/net/ipv4/conf/all/arp_announce

###### nat 防火墙
	iptables -t nat -F # 清空
	iptables -t nat -X # 删除链(所有)
	iptables -t nat -A POSTROUTING -s 192.168.81.0/24 -j MASQUERADE # 伪装

	iptables -t nat -A POSTROUTING -s 192.168.81.0/24 -o ens33 -j SNAT --to-source 192.168.91.141 # 发送内网消息到外网

###### 服务配置
	modprobe ip_vs # 加载 ip_vs
	cat /proc/net/ip_vs # 查看加载
	ipvsadm --save > /etc/sysconfig/ipvsadm # 配置保存
	systemctl start ipvsadm.service # 开启服务

###### ipvsadm
	ipvsadm -C
	ipvsadm -A -t 192.168.91.141:80 -s wrr -p 120 # 持续服务时间 120s
	ipvsadm -a -t 192.168.91.141:80 -r 192.168.81.142:80 -m -w 1 -g
	ipvsadm -a -t 192.168.91.141:80 -r 192.168.81.143:80 -m -w 1 -g
	ipvsadm # 查看配置

/usr/local/sbin/lvs_nat.sh
	#!/bin/bash
	
	echo 1 > /proc/sys/net/ipv4/ip_forward

	iptables -t nat -A POSTROUTING -s 192.168.81.0/24 -o ens33 -j SNAT --to-source 192.168.91.141

	# ipvsadm
	IPVSADM='/usr/sbin/ipvsadm'
	$IPVSADM -C
	$IPVSADM -A -t 192.168.91.141:80 -s wrr
	$IPVSADM -a -t 192.168.91.141:80 -r 192.168.91.142:80 -m -w 1
	$IPVSADM -a -t 192.168.91.141:80 -r 192.168.91.143:80 -m -w 1

##### 142 web 服务器
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.142
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8

		BOOTPROTO=static
		IPADDR=192.168.81.142
		NETMASK=255.255.255.0
		GATEWAY=192.168.81.141
		DNS1=192.168.81.141
		DNS2=8.8.8.8
	service network restart # 重启网络
	systemctl stop firewalld.service # 关闭防火墙
	systemctl disable firewalld.service # 禁用防火墙
	yum install nginx # 安装 nginx
	systemctl start nginx.service # 启动 nginx
	systemctl enable nginx.service # 启用 nginx
	echo "server 192.168.91.142" > /usr/share/nginx/html/index.html # 替换首页
	echo "server 192.168.81.142" > /usr/share/nginx/html/index.html # 替换首页

##### 143 web 服务器
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.143
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8

		BOOTPROTO=static
		IPADDR=192.168.81.143
		NETMASK=255.255.255.0
		GATEWAY=192.168.81.141
		DNS1=192.168.81.141
		DNS2=8.8.8.8
	service network restart
	systemctl stop firewalld.service
	systemctl disable firewalld.service
	yum install nginx
	systemctl start nginx.service
	systemctl enable nginx.service
	echo "server 192.168.91.143" > /usr/share/nginx/html/index.html
	echo "server 192.168.81.143" > /usr/share/nginx/html/index.html

##### 144 nfs 服务器
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.144
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8
	service network restart # 重启网络
	systemctl stop firewalld.service # 关闭防火墙
	systemctl disable firewalld.service # 禁用防火墙
	yum install nfs-utils rpcbind # 安装 nfs 和 rpcbind
	systemctl start rpcbind.service # 开启 rpcbind 服务
	systemctl enable rpcbind.service # 启用 rpcbind 服务
	systemctl start nfs.service # 开启 nfs 服务
	systemctl enable nfs.service # 启用 nfs 服务
	/etc/exports
		/usr/share *(ro,sync)
		/soft 192.168.91.0/24(rw,sync)
		/program 192.168.91.0/24(rw,sync)
		/data 192.168.91.0/24(rw,sync)
	exportfs -rv # 发布共享

#### 虚拟机配置 DR

##### 145
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.145
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8
	service network restart # 重启网络
	systemctl stop firewalld.service # 关闭防火墙
	systemctl disable firewalld.service # 禁用防火墙
	yum install ipvsadm net-tools # 安装 ipvsadm net-tools

	/etc/sysctl.conf # 永久修改
		net.ipv4.ip_forward = 1

	ifconfig ens33:0 192.168.91.148 broadcast 192.168.91.148 netmask 255.255.255.255 up # 添加 VIP

	route add -host 192.168.91.148 dev ens33:0

	ipvsadm -C
	ipvsadm -A -t 192.168.91.148:80 -s wrr
	ipvsadm -a -t 192.168.91.148:80 -r 192.168.91.146:80 -g -w 1
	ipvsadm -a -t 192.168.91.148:80 -r 192.168.91.147:80 -g -w 1

/usr/local/sbin/lvs_dr.sh
	#!/bin/bash

	echo 1 > /proc/sys/net/ipv4/ip_forward

	ipv=/usr/sbin/ipvsadm
	vip=192.168.91.148
	rs1=192.168.91.146
	rs2=192.168.91.147

	ifconfig ens33:0 down
	ifconfig ens33:0 $vip broadcast $vip netmask 255.255.255.255 up
	route add -host $vip dev ens33:0

	$ipv -C
	$ipv -A -t $vip:80 -s wrr 
	$ipv -a -t $vip:80 -r $rs1:80 -g -w 1
	$ipv -a -t $vip:80 -r $rs2:80 -g -w 1

##### 146
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.146
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8
	service network restart
	systemctl stop firewalld.service
	systemctl disable firewalld.service
	yum install nginx net-tools
	systemctl start nginx.service
	systemctl enable nginx.service
	echo "server 192.168.91.146" > /usr/share/nginx/html/index.html

	ifconfig lo:0 192.168.91.148 broadcast 192.168.91.148 netmask 255.255.255.255 up # 添加 VIP
	route add -host 192.168.91.148 lo:0

/usr/local/sbin/lvs_dr_rs.sh
	#!/bin/bash

	vip=192.168.91.148

	ifconfig lo:0 $vip broadcast $vip netmask 255.255.255.255 up
	route add -host $vip lo:0

	echo "1" > /proc/sys/net/ipv4/conf/lo/arp_ignore
	echo "2" > /proc/sys/net/ipv4/conf/lo/arp_announce
	echo "1" > /proc/sys/net/ipv4/conf/all/arp_ignore
	echo "2" > /proc/sys/net/ipv4/conf/all/arp_announce

##### 147
	/etc/sysconfig/network-scripts/ifcfg-ens33
		BOOTPROTO=static
		IPADDR=192.168.91.147
		NETMASK=255.255.255.0
		GATEWAY=192.168.91.2
		DNS1=192.168.91.2
		DNS2=8.8.8.8
	service network restart
	systemctl stop firewalld.service
	systemctl disable firewalld.service
	yum install nginx net-tools
	systemctl start nginx.service
	systemctl enable nginx.service
	echo "server 192.168.91.147" > /usr/share/nginx/html/index.html

	ifconfig lo:0 192.168.91.148 broadcast 192.168.91.148 netmask 255.255.255.255 up # 添加 VIP

#### keepavlied
/etc/keepalived/keepalived.conf
	vrrp_instance VI_1 {
	    state MASTER
	    interface ens33
	    virtual_router_id 51
	    priority 100
	    advert_int 1

	    authentication {
	        auth_type PASS
	        auth_pass 1111
	    }
	    virtual_ipaddress {
	        192.168.91.148
	    }
	}
	virtual_server 192.168.91.148 80 {
	    delay_loop 6
	    lb_algo rr
	    lb_kind DR
	    persistence_timeout 0
	    protocol TCP

	    real_server 192.168.91.146 80 {
	        weight 1

	        TCP_CHECK {
	            connect_timeout 10
	            nb_get_retry 3
	            delay_before_retry 3
	            connect_port 80
	        }
	    }
	    real_server 192.168.91.147 80 {
	        weight 1

	        TCP_CHECK {
	            connect_timeout 10
	            nb_get_retry 3
	            delay_before_retry 3
	            connect_port 80
	        }
	    }
	}

/etc/keepalived/keepalived.conf
	vrrp_instance VI_1 {
	    state BACKUP
	    interface ens33
	    virtual_router_id 51
	    priority 90
	    advert_int 1

	    authentication {
	        auth_type PASS
	        auth_pass 1111
	    }
	    virtual_ipaddress {
	        192.168.91.148
	    }
	}
	virtual_server 192.168.91.148 80 {
	    delay_loop 6
	    lb_algo rr
	    lb_kind DR
	    persistence_timeout 0
	    protocol TCP

	    real_server 192.168.91.146 80 {
	        weight 1

	        TCP_CHECK {
	            connect_timeout 10
	            nb_get_retry 3
	            delay_before_retry 3
	            connect_port 80
	        }
	    }
	    real_server 192.168.91.147 80 {
	        weight 1

	        TCP_CHECK {
	            connect_timeout 10
	            nb_get_retry 3
	            delay_before_retry 3
	            connect_port 80
	        }
	    }
	}
