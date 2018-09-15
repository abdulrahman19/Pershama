# Descending Index

A descending index is an index that stores key values in the descending order.

Before MySQL 8.0, you can specify the `DESC` in an index definition but MySQL will ignored it. In the meantime, MySQL could scan the index in reverse order but it comes at a high cost.

```sql
CREATE TABLE t(
    a INT NOT NULL,
    b INT NOT NULL,
    INDEX a_asc_b_desc (a ASC, b DESC)
);
```

Before MySQL 8.0
```sql
mysql> SHOW CREATE TABLE t\G;
*************************** 1. row ***************************
       Table: t
Create Table: CREATE TABLE `t` (
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  KEY `a_asc_b_desc` (`a`,`b`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
1 row in set (0.00 sec)
```
With MySQL 8.0
```sql
mysql> SHOW CREATE TABLE t\G;
*************************** 1. row ***************************
       Table: t
Create Table: CREATE TABLE `t` (
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  KEY `a_asc_b_desc` (`a`,`b` DESC)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
1 row in set (0.00 sec)
```
