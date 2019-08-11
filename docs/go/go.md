## Go

### Go 资源
#### 门户
	https://golang.google.cn Go 谷歌中国
	https://studygolang.com Go 学习
	https://www.golangtc.com Go 中国
	https://gocn.vip Go
#### 教程
	https://www.runoob.com/go/go-tutorial.html
	http://c.biancheng.net/golang/
	https://blog.51cto.com/9291927/2138691 Go 开发
	https://blog.51cto.com/9291927/2304828 区块链开发

### Go 环境变量
GOPATH Go 语言命令查找路径 Go 程序包安装目录

### Go 命令
export ETCDCTL_API=3 # api 版本
go env Go 语言环境变量

### Goremann - Go 多进程管理工具
#### 安装
go get github.com/mattn/goreman

## Etcd

### 安装
#### 本地运行单实例
下载 Etcd
https://github.com/etcd-io/etcd/releases
	windows 免安装 etcd-v3.3.13-windows-amd64.zip
启动 ./etcd

#### 读写
./etcdctl set foo bar
./etcdctl get foo

#### 本地运行模拟集群
下载 Golang
安装 goreman
下载 Procfile - Etcd 多进程配置文件 https://github.com/etcd-io/etcd/blob/master/Procfile
启动集群 goreman -f Procfile start

ETCDCTL_API=3 ./etcdctl endpoint --endpoints=127.0.0.1:2379,127.0.0.1:22379,127.0.0.1:32379,127.0.0.1:42379,127.0.0.1:52379 status -w table # 集群检查
./etcdctl cluster-health
ETCDCTL_API=3 ./etcdctl check perf load="l" --endpoints=127.0.0.1:2379,127.0.0.1:22379,127.0.0.1:32379,127.0.0.1:42379,127.0.0.1:52379 # 集群性能检测

./etcdctl --write-out=table --endpoints=$ENDPOINTS endpoint status # 查看集群状态
./etcdctl --endpoints=$ENDPOINTS member list # 查看集群成员
MEMBER_ID=fa6333c794b010d8
./etcdctl --endpoints=${HOST_1}:2379,${HOST_2}:2379,${HOST_3}:2379 member remove ${MEMBER_ID} # 删除集群成员

#### 选项
	--name 名字
	--listen-client-urls 监听地址
	--listen-peer-urls 集群内部成员监听地址
	--advertise-client-urls 集群内成员对外发布信息的地址
	--initial-advertise-peer-urls 对集群内发布信息的地址
	--initial-cluster-state 初始状态
	--initial-cluster-token 集群标识
	--initial-cluster 初始化集群 'infra1=http://127.0.0.1:12380,infra2=http://127.0.0.1:22380,infra3=http://127.0.0.1:32380'
	--enable-pprof
	--logger=zap 日志
	--log-outputs=stderr 日志输出位置

#### 开发
	go get go.etcd.io/etcd

NAME_1=node1
NAME_2=node2
NAME_3=node3
HOST_1=172.16.80.201
HOST_2=172.16.80.202
HOST_3=172.16.80.203
etcdctl --endpoints=${HOST_1}:2379,${HOST_2}:2379 member add ${NAME_3} --peer-urls=http://${HOST_3}:2380
启动新添加的节点，这里使用--initial-cluster-state existing
NAME_1=node1
NAME_2=node2
NAME_3=node3
HOST_1=172.16.80.201
HOST_2=172.16.80.202
HOST_3=172.16.80.203
TOKEN=token-01
CLUSTER_STATE=existing
CLUSTER=${NAME_1}=http://${HOST_1}:2380,${NAME_2}=http://${HOST_2}:2380,${NAME_3}=http://${HOST_3}:2380
THIS_NAME=${NAME_3}
THIS_IP=${HOST_3}
etcd --data-dir=data.etcd --name ${THIS_NAME} \

--initial-advertise-peer-urls http://${THIS_IP}:2380 \
--listen-peer-urls http://${THIS_IP}:2380 \
--advertise-client-urls http://${THIS_IP}:2379 \
--listen-client-urls http://${THIS_IP}:2379 \
--initial-cluster ${CLUSTER} \
--initial-cluster-state ${CLUSTER_STATE} \
--initial-cluster-token ${TOKEN}
我们做一个测试，是否主节点写入或删除，其余两个节点也会写入或删除，结果如下（表示正确）
[root@node2 ~]# etcdctl --endpoints=${HOST_1}:2379,${HOST_2}:2379,${HOST_3}:2379 put foo "a" 
OK
[root@node2 ~]# etcdctl --endpoints=${HOST_1}:2379,${HOST_2}:2379,${HOST_3}:2379 get foo
foo
a

[root@node3 ~]# etcdctl --endpoints=${HOST_1}:2379,${HOST_2}:2379,${HOST_3}:2379 get foo
foo
a

[root@node2 ~]# etcdctl --endpoints=${HOST_1}:2379,${HOST_2}:2379,${HOST_3}:2379 del foo
1
etcd第二篇etcdctl详解
创建snapshot
etcdctl --endpoints=$ENDPOINTS snapshot save my.db
etcdctl --write-out=table --endpoints=$ENDPOINTS snapshot status my.db
etcd第二篇etcdctl详解
数据迁移：（一般不用，因为etcd是集群，可以添加节点的方式来实现数据迁移，然后删除原有的节点）
etcdctl --endpoints=$ENDPOINT migrate --data-dir="default.etcd" --wal-dir="default.etcd/member/wal"
权限
etcdctl --endpoints=${ENDPOINTS} role add root
etcdctl --endpoints=${ENDPOINTS} role grant-permission root readwrite foo
etcdctl --endpoints=${ENDPOINTS} role get root

etcdctl --endpoints=${ENDPOINTS} user add root
etcdctl --endpoints=${ENDPOINTS} user grant-role root root
etcdctl --endpoints=${ENDPOINTS} user get root

etcdctl --endpoints=${ENDPOINTS} auth enable
#now all client requests go through auth

etcdctl --endpoints=${ENDPOINTS} --user=root:123 put foo bar
etcdctl --endpoints=${ENDPOINTS} get foo
etcdctl --endpoints=${ENDPOINTS} --user=root:123 get foo
etcdctl --endpoints=${ENDPOINTS} --user=root:123 get foo1