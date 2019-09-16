## binlog
SQL Server 完整恢复模式 事务日志文件

### 参数
-log_bin ON|OFF|/var/lib/mysql/mysql-bin # 开启|关闭|指定 log_bin_basename
-log_bin_basename /var/lib/mysql/mysql-bin # 前缀
-log_bin_index /var/lib/mysql/mysql-bin.index # 管理二进制日志
-sql_log_bin ON|OFF # 在主库执行操作不复制到从库 先关闭 执行语句 再插入
log_bin_trust_function_creators OFF # 
log_bin_use_v1_row_events=OFF # 

-binlog_format # STATEMENT 语句 基于时间的操作难以把控|ROW 行 会导致大量日志|MIXED 混合
-sync_binlog 0|1 # 记录时机 1 同步 事物提交之后写入 最高安全级别写入 影响性能|0 异步 磁盘缓存写入
-max_binlog_size 1073741824 # 日志单个文件大小 1024*1024*1024=1G
-binlog_cache_size 32768 # 会话级别 binlog_cache_disk_use binlog_cache_use
-binlog_stmt_cache_size 32768 # 会话级别 非事务
-max_binlog_cache_size 18446744073709547520 # 实例级别
-max_binlog_stmt_cache_size 18446744073709547520 # 实例级别 非事务
-binlog_checksum NONE # 复制的主从校验

binlog_annotate_row_events OFF
binlog_direct_non_transactional_updates OFF
binlog_optimize_thread_scheduling ON
innodb_locks_unsafe_for_binlog OFF

binlog_do_db 设置 master-slave 时使用
binlog-ignore-db # 不记录日志数据库

### 命令
show binary|master logs # 查看二进制日志文件个数
flush logs # 手动滚动
purge binary logs to 'mysql-bin.000015' # 删除指定 fileName 之前的文件
purge binary logs before '2017-03-10 10:10:00' # 删除指定时间之前的文件
purge binary|master logs before date_sub(now(), interval 7 day) # 删除指定日志

mysqlbinlog mysqld-bin.000001 # 查看 二进制日志内容
mysqlbinlog               mysql-bin.000030 -d db_name > db_name_binlog.sql
mysqlbinlog --no-defaults mysql-bin.000030 -d db_name > db_name_binlog.sql # 转换 binlog 为 sql

--disable-log-bin -D # 禁用二进制日志 恢复数据
mysqlbinlog --disable-log-bin mysqld-bin.000001
--base64-output # never|always|decode-rows|auto(默认)
mysqlbinlog --base64-output=never mysqld-bin.000001
--debug-check # 调试信息
mysqlbinlog --debug-check mysqld-bin.000001
-o # 偏移
mysqlbinlog -o 10 mysqld-bin.000001
-r # 结果文件
mysqlbinlog -r output.log mysqld-bin.000001
-j # 指定位置号
mysqlbinlog -j 15028 mysqld-bin.000001 > from-15028.out
-H 十六进制存储
mysqlbinlog -H mysqld-bin.000001 > binlog-hex-dump.out
--stop-position # 截止到特定位置
mysqlbinlog --stop-position=15028 mysqld-bin.000001 > upto-15028.out
--short-form -s # 只显示语句
mysqlbinlog --short-form mysqld-bin.000001
--start-datetime
mysqlbinlog --start-datetime="2017-08-16 10:00:00" mysqld-bin.000001
--stop-datetime
mysqlbinlog --stop-datetime="2017-08-16 15:00:00" mysqld-bin.000001
--read-from-remote-server -R # 从远程服务器获取二进制日志
mysqlbinlog -R -h 192.168.101.2 -p mysqld-bin.000001

### 新日志生成策略
满 自动滚动 后缀名+1
重启自动滚动 无论是否满
手动滚动 flush logs

### 工具
https://github.com/danfengcao/binlog2sql
cd binlog2sql
pip install -r requirements.txt

python binlog2sql.py -h 192.168.91.131 -P 3306 -uroot -proot -d laravel_starter_58 -t test --start-file=mysql-bin.000390 --start-datetime="2018-08-22 11:00:00"
python binlog2sql.py -h 192.168.91.131 -P 3306 -uroot -proot -d laravel_starter_58 -t test --start-file=mysql-bin.000390 --start-pos=508967141 --end-pos=508967393 -B
