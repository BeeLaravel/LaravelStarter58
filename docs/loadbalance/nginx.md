## Nginx

### 算法
roundrobin 每个请求按时间顺序逐一分配到不同的后端服务器;
ip_hash 每个请求按访问IP的hash结果分配，同一个IP客户端固定访问一个后端服务器;
url_hash 按访问url的hash结果来分配请求，使每个url定向到同一个后端服务器;
fair 

upstream roundrobin {
    server 192.168.31.33 weight=1;
    server 192.168.31.237 weight=1;
}
location / {
    proxy_set_header X-Real-IP $remote_addr;
    proxy_pass http://roundrobin;
}

upstream roundrobin {
	ip_hash; // 添加参数支持哈希
	server 192.168.31.33 weight=1;
	server 192.168.31.237 weight=1;
}
upstream roundrobin {
	server 192.168.31.33 weight=1;
	server 192.168.31.35 weight=1;
	server 192.168.31.237 backup; // 设置备份机器
}