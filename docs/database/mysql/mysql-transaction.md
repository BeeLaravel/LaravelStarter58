## 事务

### 特征
原子性 Atomicity
一致性 Consistency
隔离性 Isolation
持续性 Durability

### 隔离级别
Read Uncommitted 读取未提交内容
Read Committed 读取提交内容 一般
Repeatable Read 可重读 MySQL MVCC
Serializable 可串行化

### 隔离级别操作
set session transaction isolation level read uncommitted; # 更改隔离级别
select @@transaction_isolation # mysql > 8.0 查询隔离级别
select @@tx_isolation # mysql < 8.0
