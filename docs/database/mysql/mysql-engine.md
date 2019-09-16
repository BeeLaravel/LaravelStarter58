## 

### innodb myisam
事务
行级锁
MVCC https://blog.csdn.net/w2064004678/article/details/83012387
外键
不支持全文索引

### innodb 特性
插入缓冲 insert buffer
二次写 double write
自适应哈希索引 ahi
预读 read ahead

### 2者 select count(*) 哪个快
myisam内部维护了一个计数器