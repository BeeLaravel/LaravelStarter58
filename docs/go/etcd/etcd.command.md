   etcd --config-file # 配置文件
   etcd gateway 网关
   etcd grpc-proxy 代理
member 成员
    --name 'default'
    --data-dir '${name}.etcd'
            path to the data directory.
    --wal-dir ''
            path to the dedicated wal directory.
    --snapshot-count '100000'
            number of committed transactions to trigger a snapshot to disk.
    --heartbeat-interval '100'
            time (in milliseconds) of a heartbeat interval.
    --election-timeout '1000'
            time (in milliseconds) for an election to timeout. See tuning documentation for details.
    --initial-election-tick-advance 'true'
            whether to fast-forward initial election ticks on boot for faster election.
    --listen-peer-urls 'http://localhost:2380'
            list of URLs to listen on for peer traffic.
    --listen-client-urls 'http://localhost:2379'
            list of URLs to listen on for client traffic.
    --max-snapshots '5'
            maximum number of snapshot files to retain (0 is unlimited).
    --max-wals '5'
            maximum number of wal files to retain (0 is unlimited).
    --cors ''
            comma-separated whitelist of origins for CORS (cross-origin resource sharing).
    --quota-backend-bytes '0'
            raise alarms when backend size exceeds the given quota (0 defaults to low space quota).
    --max-txn-ops '128'
            maximum number of operations permitted in a transaction.
    --max-request-bytes '1572864'
            maximum client request size in bytes the server will accept.
    --grpc-keepalive-min-time '5s'
            minimum duration interval that a client should wait before pinging server.
    --grpc-keepalive-interval '2h'
            frequency duration of server-to-client ping to check if a connection is alive (0 to disable).
    --grpc-keepalive-timeout '20s'
            additional duration of wait before closing a non-responsive connection (0 to disable).

clustering 集群
    --initial-advertise-peer-urls 'http://localhost:2380'
            list of this member's peer URLs to advertise to the rest of the cluster.
    --initial-cluster 'default=http://localhost:2380'
            initial cluster configuration for bootstrapping.
    --initial-cluster-state 'new'
            initial cluster state ('new' or 'existing').
    --initial-cluster-token 'etcd-cluster'
            initial cluster token for the etcd cluster during bootstrap.
            Specifying this can protect you from unintended cross-cluster interaction when running multiple clusters.
    --advertise-client-urls 'http://localhost:2379'
            list of this member's client URLs to advertise to the public.
            The client URLs advertised should be accessible to machines that talk to etcd cluster. etcd client libraries parse these URLs to connect to the cluster.
    --discovery ''
            discovery URL used to bootstrap the cluster.
    --discovery-fallback 'proxy'
            expected behavior ('exit' or 'proxy') when discovery services fails.
            "proxy" supports v2 API only.
    --discovery-proxy ''
            HTTP proxy to use for traffic to discovery service.
    --discovery-srv ''
            dns srv domain used to bootstrap the cluster.
    --strict-reconfig-check 'true'
            reject reconfiguration requests that would cause quorum loss.
    --auto-compaction-retention '0'
            auto compaction retention length. 0 means disable auto compaction.
    --auto-compaction-mode 'periodic'
            interpret 'auto-compaction-retention' one of: periodic|revision. 'periodic' for duration based retention, defaulting to hours if no time unit is provided (e.g. '5m'). 'revision' for revision number based retention.
    --enable-v2 'true'
            Accept etcd V2 client requests.
-proxy 代理 - 仅 v2
    --proxy 模式 off[default]|readonly|on
    --proxy-failure-wait 5000(milliseconds) 失败超时
    --proxy-refresh-interval 30000(milliseconds) 刷新时间间隔
    --proxy-dial-timeout 1000(milliseconds) 连接超时
    --proxy-write-timeout 5000(milliseconds) 读超时
    --proxy-read-timeout 0(milliseconds) 写超时
security 安全
    --ca-file '' [DEPRECATED]
        path to the client server TLS CA file. '-ca-file ca.crt' could be replaced by '-trusted-ca-file ca.crt -client-cert-auth' and etcd will perform the same.
    --cert-file ''
        path to the client server TLS cert file.
    --key-file ''
        path to the client server TLS key file.
    --client-cert-auth 'false'
        enable client cert authentication.
    --client-crl-file ''
        path to the client certificate revocation list file.
    --trusted-ca-file ''
        path to the client server TLS trusted CA cert file.
    --auto-tls 'false'
        client TLS using generated certificates.
    --peer-ca-file '' [DEPRECATED]
        path to the peer server TLS CA file. '-peer-ca-file ca.crt' could be replaced by '-peer-trusted-ca-file ca.crt -peer-client-cert-auth' and etcd will perform the same.
    --peer-cert-file ''
        path to the peer server TLS cert file.
    --peer-key-file ''
        path to the peer server TLS key file.
    --peer-client-cert-auth 'false'
        enable peer client cert authentication.
    --peer-trusted-ca-file ''
        path to the peer server TLS trusted CA file.
    --peer-cert-allowed-cn ''
        Required CN for client certs connecting to the peer endpoint.
    --peer-auto-tls 'false'
        peer TLS using self-generated certificates if --peer-key-file and --peer-cert-file are not provided.
    --peer-crl-file ''
        path to the peer certificate revocation list file.
    --cipher-suites ''
        comma-separated list of supported TLS cipher suites between client/server and peers (empty will be auto-populated by Go).
logging 日志
    --debug 'false' 调式日志
    --log-package-levels '' etcdmain=CRITICAL,etcdserver=DEBUG 包日志级别
    --log-output default|stdout|stderr 输出位置
unsafe 非安全
    --force-new-cluster 'false'
        force to create a new one-member cluster.
profiling 
    --enable-pprof 'false'
        Enable runtime profiling data via HTTP server. Address is at client URL + "/debug/pprof/"
    --metrics 'basic'
        Set level of detail for exported metrics, specify 'extensive' to include histogram metrics.
    --listen-metrics-urls ''
        List of URLs to listen on for metrics.
auth 认证
    --auth-token 'simple'
        Specify a v3 authentication token type and its options ('simple' or 'jwt').
experimental 
    --experimental-initial-corrupt-check 'false'
        enable to check data corruption before serving any client/peer traffic.
    --experimental-corrupt-check-time '0s'
        duration of time between cluster corruption check passes.
    --experimental-enable-v2v3 ''
        serve v2 requests through the v3 backend under a given prefix.

### v2
#### 命令
    mk          
    mkdir 
    set             set the value of a key
    setdir          create a new directory or update an existing directory TTL
    update          update an existing key with a given value
    updatedir       update an existing directory
    rm              remove a key or a directory
    rmdir           removes the key if it is an empty directory or a key-value pair
    get             retrieve the value of a key

    backup          backup an etcd directory
    cluster-health  check the health of the etcd cluster
    ls              retrieve a directory
    watch 监听
    exec-watch      watch a key for changes and exec an executable

    auth 认证
    member 成员
    user 用户
    role 角色
    help h 帮助
#### 全局选项
    --debug # 调式信息 curl命令 可重新生成结果
    --no-sync 发送请求前不同步集群信息
    --output -o 输出响应格式 simple(default)|extended|json
    --discovery-srv value, -D value  domain name to query for SRV records describing cluster endpoints
    --insecure-discovery             accept insecure SRV records describing cluster endpoints
    --peers value, -C value          DEPRECATED - "--endpoints" should be used instead
    --endpoint value                 DEPRECATED - "--endpoints" should be used instead
    --endpoints value                a comma-delimited list of machine addresses in the cluster (default: "http://127.0.0.1:2379,http://127.0.0.1:4001")
    --cert-file value                identify HTTPS client using this SSL certificate file
    --key-file value                 identify HTTPS client using this SSL key file
    --ca-file value                  verify certificates of HTTPS-enabled servers using this CA bundle
    --username value, -u value       provide username[:password] and prompt if password is not supplied.
    --timeout value                  connection timeout per request (default: 2s)
    --total-timeout value            timeout for the command execution (except watch) (default: 5s)
    --help, -h 帮助
    --version, -v  版本

### v3
#### 命令
    get 获取
    put 推送
    del 删除

    txn 原子操作
    defrag          Defragments the storage of the etcd members with given endpoints
    endpoint health     Checks the healthiness of endpoints specified in `--endpoints` flag
    endpoint status     Prints out the status of endpoints specified in `--endpoints` flag
    endpoint hashkv     Prints the KV history hash for each endpoint in --endpoints
    move-leader     Transfers leadership to another etcd cluster member.
    watch           Watches events stream on keys or prefixes
    lease 租契
        list 列表
        timetolive 详情
        grant 创建
        revoke 回收
        keep-alive renew
    
    member 成员
        list 列表
        add 添加
        update 更新
        remove 删除
    snapshot 快照
        save 保存
        restore 恢复
        status 状态

    auth 认证
        enable 启用
        disable 禁用
    role 角色
        list 列表
        get 详情
        add 添加
        delete 删除
        grant-permission 分配权限
        revoke-permission 回收权限
    user 用户
        list 列表
        get 详细
        add 添加
        delete 删除
        passwd 修改密码
        grant-role 分配角色
        revoke-role 回收角色

    check 检查
        perf 性能
    alarm 警告
        list 列表
        disarm 解除
    make-mirror 制作镜像
    compaction 压缩 事件历史
    migrate 迁移 v2 => mvcc
    lock 锁
    elect 选举
    help 帮助
    version 版本

#### 选项
    --cacert=""             verify certificates of TLS-enabled secure servers using this CA bundle
    --cert=""                   identify secure client using this TLS certificate file
    --command-timeout=5s            timeout for short running command (excluding dial timeout)
    --debug[=false]             enable client-side debug logging
    --dial-timeout=2s               dial timeout for client connections
    -d, --discovery-srv=""          domain name to query for SRV records describing cluster endpoints
    --endpoints=[127.0.0.1:2379]        gRPC endpoints
    --hex[=false]               print byte strings as hex encoded strings
    --insecure-discovery[=true]     accept insecure SRV records describing cluster endpoints
    --insecure-skip-tls-verify[=false]  skip server certificate verification
    --insecure-transport[=true]     disable transport security for client connections
    --keepalive-time=2s         keepalive time for client connections
    --keepalive-timeout=6s          keepalive timeout for client connections
    --key=""                    identify secure client using this TLS key file
    --user=""                   username[:password] for authentication (prompt if password is not supplied)
    -w, --write-out="simple"            set the output format (fields, json, protobuf, simple, table)

