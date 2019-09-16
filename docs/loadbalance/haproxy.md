## HAProxy

### 算法
roundrobin # 轮询
static-rr # 基于权重的轮询
leastconn # 最少连接优先
source # 请求源地址
uri # 根据请求的URI
url_param，# 根据请求的URl参数'balance url_param' requires an URL parameter name
hdr(name) # 根据HTTP请求头来锁定每一次HTTP请求
rdp-cookie(name) # 根据据cookie(name)来锁定并哈希每一次TCP请求