## etcd docker

### 配置
docker run -d --name etcd \
    -p 2379:2379 \
    -p 2380:2380 \
    --volume=etcd-data:/etcd-data \
    192.168.99.1:5000/quay.io/coreos/etcd \
    /usr/local/bin/etcd \
    --data-dir=/etcd-data --name node1 \
    --initial-advertise-peer-urls http://172.17.0.4:2380 --listen-peer-urls http://0.0.0.0:2380 \
    --advertise-client-urls http://172.17.0.4:2379 --listen-client-urls http://0.0.0.0:2379 \
    --initial-cluster-state new \
    --initial-cluster-token docker-etcd \
    --initial-cluster node1=http://172.17.0.4:2380,node2=http://172.17.0.5:2380,node3=http://172.17.0.6:2380

docker run -d --name etcd \
    -p 12379:2379 \
    -p 12380:2380 \
    --volume=etcd-data:/etcd-data \
    192.168.99.1:5000/quay.io/coreos/etcd \
    /usr/local/bin/etcd \
    --data-dir=/etcd-data --name node2 \
    --initial-advertise-peer-urls http://172.17.0.5:2380 --listen-peer-urls http://0.0.0.0:2380 \
    --advertise-client-urls http://172.17.0.5:2379 --listen-client-urls http://0.0.0.0:2379 \
    --initial-cluster-state new \
    --initial-cluster-token docker-etcd \
    --initial-cluster node1=http://172.17.0.4:2380,node2=http://172.17.0.5:2380,node3=http://172.17.0.6:2380

docker run -d --name etcd \
    -p 222379:2379 \
    -p 22380:2380 \
    --volume=etcd-data:/etcd-data \
    192.168.99.1:5000/quay.io/coreos/etcd \
    /usr/local/bin/etcd \
    --data-dir=/etcd-data --name node3 \
    --initial-advertise-peer-urls http://172.17.0.6:2380 --listen-peer-urls http://0.0.0.0:2380 \
    --advertise-client-urls http://172.17.0.6:2379 --listen-client-urls http://0.0.0.0:2379 \
    --initial-cluster-state existing \
    --initial-cluster-token docker-etcd \
    --initial-cluster node1=http://172.17.0.4:2380,node2=http://172.17.0.5:2380,node3=http://172.17.0.6:2380

### docker etcd 选项
    –name # 名称 default[default]
    –data-dir # 数据路径 ${name}.etcd[default]
    –snapshot-count # 多少事务被提交时，触发截取快照保存到磁盘
    –heartbeat-interval # 心跳间隔 100ms[default]
    –eletion-timeout # 重新投票超时时间 1000ms

    –listen-peer-urls # 同伴通信的地址 http://ip:2380
    –initial-advertise-peer-urls # 该节点同伴监听地址
    –listen-client-urls # 对外提供服务地址 http://ip:2379
    –advertise-client-urls # 对外公告的该节点客户端监听地址

    –initial-cluster # 集群中所有节点的信息
    –initial-cluster-state # 新建集群 new 已经存在的集群 existing
    –initial-cluster-token # 创建集群 token

### 常用操作
etc/etcd/etcd.conf # docker 配置

export ETCDCTL_API=3 # 设置 API 版本

### etcdctl
etcdctl member list # 查看成员
etcdctl member remove 773d30c9fc6640b4 # 删除成员(主)
etcdctl member add node2 --peer-urls="http://172.17.0.6:2380" # 添加成员

### RestFul
curl http://127.0.0.1:2379/v2/keys/hello -XPUT -d value="hello world" # 设置
curl http://127.0.0.1:2379/v2/keys/hello # 获取
curl http://127.0.0.1:2379/v2/keys/hello -XDELETE # 删除

curl http://127.0.0.1:2379/v2/members # 集群成员
curl http://127.0.0.1:2379/v2/stats/leader # 集群主节点信息
curl http://127.0.0.1:2379/v2/stats/self # 节点信息
curl http://127.0.0.1:2379/v2/stats/store # 集群信息

### docker 常用操作
docker exec -it etcd bin/sh # 进入 docker 虚拟环境

docker volume ls # 查看 docker 卷
docker volume rm etcd-data # 删除 docker 卷

