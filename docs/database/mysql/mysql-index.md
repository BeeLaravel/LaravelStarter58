## MySQL Index

### 作用
大大减少存储引擎需要扫描的数据量
排序避免使用临时表
把随机 IO 变为顺序 IO

### 类型
主键索引
唯一索引
普通索引
全文索引
空间索引

### 
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_cid_INX` (`name`,`cid`),
  KEY `name_INX` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create INDEX name_cid_INX ON student(name,cid);
create INDEX name_INX ON student(name);

EXPLAIN SELECT * FROM student WHERE name='小红'; -- 两个索引都匹配上 快速查找
1	SIMPLE	student	ref	name_cid_INX,name_INX	name_cid_INX	768	const	1	Using where; Using index

EXPLAIN SELECT * FROM student WHERE cid=1; -- 匹配上复合索引 遍历索引
1	SIMPLE	student	index		name_cid_INX	773		1	Using where; Using index

EXPLAIN SELECT * FROM student WHERE cid=1 AND name='小红'; -- 匹配上复合索引 快速查找
1	SIMPLE	student	ref	name_cid_INX,name_INX	name_cid_INX	773	const,const	1	Using where; Using index