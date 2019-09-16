## network

### 命令
nmcli con show|list # 查看网卡 UUID
nmcli dev show|list # 查看网卡 MAC 地址

### 文件
/etc/sysconfig/network-scripts/ifcfg-ens33 # 网络配置
/etc/udev/rules.d/70-persistent-net.rules # UUID MAC

### curl
	-o 输出文件

	-L --location 跟踪重定向 302 重定向 页面重定向
	--location-trusted 跟踪重定向 302 重定向 页面重定向 发送认证信息

	-I, --head 头

	-s, --silent 静默模式
	-f, --fail 错误静默模式

### wget
centos 需要安装
