## docker

### 基本配置
apt-get install docker-io docker-compose # 安装 
sudo usermod -aG docker beesoft # 当前用户加入 docker 用户组，执行 docker 不需要 sudo

### docker-machine
docker-machine create -d virtualbox manager1
