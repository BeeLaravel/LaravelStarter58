## route

### 参数
add 添加
del 删除

netmask 网络掩码
gw 路由数据包通过网关
metric 路由跳数

-net 网络
-host 主机

-c 更多信息
-n 不解析名字
-v 详细
-F 发送信息
-C 路由缓存
-f 清除
-p 永久记录

### Flag
U Up 启用
H Host 主机
G Gateway 路由器
R Reinstate Route 使用动态路由重新初始化的路由
D Dynamically 动态写入
M Modified 由路由守护程序或导向器动态修改

### 示例
route # 列表
route add -net 10.0.0.0 netmask 255.255.255.0 dev eth0 # 添加网络
route add -host 192.168.40.1 dev eth0 # 添加主机
route add -net 10.10.10.128 netmask 255.255.255.128 reject # 拒绝网络
route del -net 10.10.10.128 netmask 255.255.255.128 reject # 删除网络
route add default gw  192.168.40.2 # 添加默认网关
route del default gw 192.168.40.2 # 删除默认网关
