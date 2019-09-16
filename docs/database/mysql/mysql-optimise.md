## MySQL 优化

### 表结构
数据类型
数据长度
存储引擎
其他
单条表记录不要超过 8K
### SQL
索引
### 大事务
运行时间长 主从延迟
锁定数据多 阻塞 超时 无效处理增多

移除不必要在事务中的select操作
### 分表
大表查询
大表 DDL
### 分库
### 分区
### 主从
MySQL 主从
Percona
MySQL Cluster

### 数据库配置
最大连接数
数据库占用内存

硬件
应用程序特性
### 操作系统配置
### 硬件
CPU
内存
磁盘 IO
带宽
### 缓存层
减少数据库连接

redis memcache mongodb
elasticsearch sphinx
