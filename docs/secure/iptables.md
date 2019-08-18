## iptables
 /etc/sysconfig/iptables
 service iptables save
 
### 命令参数
    -L # 策略列表
    -A # 策略添加
    	INPUT # 入
    -D # 策略删除
    -F # 策略清空
    -I # 策略插入
    -R # 策略修改
    -P # 策略修改默认

    -N # 增加链
    -X # 删除链
    -E # 修改链名称

    -t # 表
    -n # 不做解析
	-i # 接口 lo eth0
	-o # output
    -p # 网络协议
    -s # 数据来源 主机
    –dport # 端口
    -j # 动作
		ACCEPT # 允许
		REJECT # 拒绝
		DROP # 丢弃
	
	--state 数据包状态
		NEW 信息包已经或将启动新的连接 它与尚未用于发送和接收信息包的连接相关联
		RELATED 信息包正在启动新连接 它与已建立的连接相关联
		ESTABLISHED 信息包已建立连接 该连接一直用于发送和接收信息包并且完全有效
		INVALID 不可用

### 示例
iptables -nL # 策略列表
iptables -F # 策略清空
iptables -A INPUT -i lo -j ACCEPT # 允许 lo 
iptables -A INPUT -p tcp –dport 22 -j ACCEPT # 允许 22 端口 
iptables -A INPUT -s 192.168.91.144 -j ACCEPT # 允许 192.168.91.144 主机 
iptables -A INPUT -j REJECT # 拒绝所有
iptables -A INPUT -m state –state RELATED,ESTABLISHED -j ACCEPT # 允许 RELATED 与 ESTABLISHED 包
iptables -A INPUT -i lo -m state –state NEW -j ACCEPT # 允许 NEW 包
iptables -A INPUT -p tcp –dport 22 -m state –state NEW -j ACCEPT ##允许NEW包通过22端口
iptables -A INPUT -p tcp –dport 80 -m state –state NEW -j ACCEPT ##允许NEW包通过80端口
iptables -A INPUT -p tcp –dport 443 -m state –state NEW -j ACCEPT ##允许NEW包通过443端口

iptables -D INPUT 3 # 删除 INPUT 第 3 条
iptables -I INPUT -s 192.168.91.144 -j ACCEPT # 插入到 INPUT 第 1 条
iptables -R INPUT 4 -p tcp –dport 80 -j ACCEPT # 修改 INPUT 第 4 条
iptables -P INPUT DROP # 把 INPUT 默认策略改为 DROP 

iptables -N redhat # 增加链 redhat
iptables -E redhat westos # 修改链名称
iptables -X westos # 删除链 westos

iptables -t filter --list # filter 表 内容

service iptables save # 策略保存

### sysctl
sysctl -a # 查看内部网卡 IP 转发功能是否开启
echo "net.ipv4.ip_forward = 1" >> /etc/sysctl.conf # 允许双网卡内部通信
sysctl -p # 重新加载

iptables -t nat -A PREROUTING -i eth0 -j DNAT –to-dest 192.168.91.2 # PREROUTING 链 外网发往内网
iptables -t nat -A POSTROUTING -o eth0 -j SNAT –to-source 192.168.81.1 # POSTROUTING 链 内网发往外网
route -n # 查看路由

### centos7 安装 iptables 相关服务
yum install iptables-services # 安装
systemctl start iptables 开启
systemctl enable iptables # 启用
