## firewalld
	/usr/lib/firewalld/
	/etc/firewalld/

	firewall-config
	system-config-firewall
	firewall-cmd

### 网络区与默认配置
	trusted(信任)  接受所有
	home(家庭)     ssh、dhcpv6-client、ipp-client、mdns、samba-client
	internal(内部) ssh、dhcpv6-client、ipp-client、mdns、samba-client
	work(工作)     ssh、dhcpv6-client、ipp-client 
	public(公共)   ssh、dhcpv6-client[default] 
	external(外部) 出去的ipv4网络连接通过此区域伪装和转发 ssh 
	dmz(非军事区)  ssh
	block(限制)    拒绝所有 
	drop(丢弃)     没有回复

### 命令
	--state # 查看状态

	--reload # 重载 不会中断已建连接
	--complete-reload # 重载 中断已建连接

	--permanent # 永久修改|临时修改[default] 

	--get-zones # 查看所有区域
	--get-active-zones # 查看活动区域
	--get-default-zone # 查看默认区域
	--set-default-zone=trusted # 设置默认区域
	--zone=public # 指定区域
	--list-all # 列表

	--get-services # 服务列表
	--add-service=http # 服务添加
	--remove-service=http # 服务删除

	--add-interface=eth0 # 添加网络接口 eth0
	--remove-interface=eth1 # 删除网络接口 eth1
	--change-interface=eth1 # 修改网络接口为 eth1

	--add-source=192.168.91.145 # 源添加
	--remove-source=192.168.91.145 # 源删除

	--list-ports # 端口列表
	--add-port=53/tcp # 添加 53 端口(tcp 协议)
	--remove-port=53/tcp # 删除 53 端口(tcp 协议)

### 示例
	firewall-cmd --set-default-zone=trusted

	firewall-cmd --permanent --add-source=192.168.91.145 # 添加源
	firewall-cmd --permanent --zone=trusted --remove-source=192.168.91.145 # 删除源

	firewall-cmd --zone=public --add-service=http # 添加服务
	firewall-cmd --zone=public --remove-service=http # 删除服务

	firewall-cmd --zone=public --list-ports # 端口列表
	firewall-cmd --zone=public --add-port=53/tcp # 添加 53 端口(tcp 协议)
	firewall-cmd --zone=public --remove-port=53/tcp # 删除 53 端口(tcp 协议)

	firewall-cmd --direct --get-all-rules # 列表
	firewall-cmd --direct --add-rule ipv4 filter INPUT 0 -s 172.25.254.60 -p tcp –dport 22 -j ACCEPT # 添加
	firewall-cmd --direct --remove-rule ipv4 filter INPUT 0 -s 172.25.254.60 -p tcp –dport 22 -j ACCEPT # 删除

### Rich Rules
	source address 源
	destination # 目的
	service # 服务
	port # 端口
	protocol # 协议
	icmp-block # 
	masquerade # 伪装端口
	forward-port # 来源端口
	to-port # 目的端口
	log # 日志
	audit # 审核

### 伪装
	firewall-cmd --add-masquerade # 开启伪装功能
	firewall-cmd --zone=public --add-rich-rule='rule family=ipv4 source address=172.25.254.100 masquerade' # 入站伪装
	firewall-cmd --zone=public --add-forward-port=port=22:proto=tcp:toport=22:toaddr=172.25.60.11 # 连接本机时会转连接到 172.25.60.11 主机