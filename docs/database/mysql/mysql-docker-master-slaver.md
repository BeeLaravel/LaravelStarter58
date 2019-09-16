## MariaDB
### 主服务器
docker run --name mariadb01 \
	-p 13306:3306 \
	-v /home/wonders/docker_mdb1_data:/var/lib/mysql \
	-e MYSQL_ROOT_PASSWORD=root \
	-e MYSQL_USER=beesoft \
	-e MYSQL_PASSWORD=beesoft \
	-e MYSQL_DATABASE=laravel_starter_58 \
	-e TERM=linux \
	-d mariadb

docker run --name mariadb01 -p 13306:3306 -v /home/wonders/docker_mdb1_data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root -e MYSQL_USER=beesoft -e MYSQL_PASSWORD=beesoft -e MYSQL_DATABASE=laravel_starter_58 -e TERM=linux -d mariadb
docker exec -it mariadb01 /bin/bash

apt-get update
apt-get install vim
vi /etc/mysql/my.cnf
	server-id=1
	logbin
	log_bin_index

docker restart mariadb01

grant replication slave on *.* to 'sync'@'%' identified by 'sync';
flush privileges;

show master status; // File Position

### 从服务器
docker run --name mariadb02 -p 23306:3306 -v /home/wonders/docker_mdb2_data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root -e MYSQL_USER=beesoft -e MYSQL_PASSWORD=beesoft -e MYSQL_DATABASE=laravel_starter_58 -e TERM=linux --link mariadb01:master_db -d mariadb
docker exec -it mariadb02 /bin/bash

apt-get update
apt-get install vim
vi /etc/mysql/my.cnf
	server-id=2
	logbin
	log_bin_index

docker restart mariadb02

stop slave;

change master to
master_host='master_db',
master_user='sync',
master_password='sync',
master_port=3306,
master_log_file='mariadb-bin.000001',
master_log_pos=330;

start slave;

### 复制原理
主：binlog 线程 记录下所有改变了数据库数据的语句 到 master binlog
从：io 线程 拉取 master binlog 到 relay log
从：sql 执行线程 执行 relay log 语句