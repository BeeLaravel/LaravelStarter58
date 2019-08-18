## network

### 命令
nmcli con show|list # 查看网卡 UUID
nmcli dev show|list # 查看网卡 MAC 地址

### 文件
/etc/sysconfig/network-scripts/ifcfg-ens33 # 网络配置
/etc/udev/rules.d/70-persistent-net.rules # UUID MAC
