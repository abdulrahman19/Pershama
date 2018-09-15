# MySQL Index Cheat Sheet

* [Show Indexes](#show-indexes)
* [Create Index](#create-index)
* [EXPLAIN Clause](#explain-clause)
* [Drop Index](#drop-index)
* [Unique Index](#unique-index)
* [Clustered Index](#clustered-index)
* [Index Cardinality](#index-cardinality)
* [Prefix Index](#prefix-index)
* [Composite Index](#composite-index)
* [Descending Index](#descending-index)
* [Invisible Index](#invisible-index)

An index is a data structure such as `B-Tree` that improves the speed of data retrieval on a table at the cost of additional writes and storage to maintain it.

### Show Indexes
```sql
SHOW INDEXES FROM table_name [IN database_name];
#or
SHOW INDEXES FROM database_name.table_name;
```
Note that `INDEX` and `KEY` are the synonyms of the `INDEXES`, also `IN` is the synonym of the `FROM`.
```sql
SHOW INDEX IN table_name FROM database_name;

SHOW KEY FROM tablename IN databasename;
```

**Filter Index Information**
```sql
SHOW INDEXES FROM table_name
WHERE VISIBLE = 'NO';
```

### Create Index
```sql
CREATE TABLE table_name(
   ...
   INDEX (column_list)
);
```
But you can add an index for a column or a set of columns, you use the `CREATE INDEX` statement as follows:
```sql
CREATE INDEX index_name ON table_name (column_list)
```

### EXPLAIN Clause
To see how MySQL internally performed this query, you add the `EXPLAIN` clause at the beginning of the `SELECT` statement as follows:
```sql
EXPLAIN SELECT
            column_1,
            column_2
        FROM
            table_name
        WHERE
            condition = something
```

### Drop Index
To remove an existing index from a table, you use the `DROP INDEX` statement as follows:
```sql
DROP INDEX index_name ON table_name
[algorithm_option | lock_option];
```

**Algorithm**

The `algorithm_option` allows you to specify a specific algorithm used for the index removal. The following shows the syntax of the `algorithm_option` clause:
```sql
ALGORITHM [=] {DEFAULT|INSTANT|INPLACE|COPY}
```

<br> Function <img width=250/>| INSTANT | INPLACE | COPY
---|---|---|---|
Mechanism | Operations only modify metadata in the data dictionary. | The table is rebuilt in place instead of copied to the new one. | The table is copied to new table row by row.
Allow DML Statements | Yes | Yes | No
Allow DDL Statements | Yes | No | No
Note | version 8 | - | - | -

**Lock**

The `lock_option` controls the level of concurrent reads and writes on the table while the index is being removed.
```sql
LOCK [=] {DEFAULT|NONE|SHARED|EXCLUSIVE}
```
* `DEFAULT`: First, it allows concurrent reads and writes if supported. If not, allow concurrent reads if supported. If not, enforce exclusive access.
* `NONE`: if supported, you can have concurrent reads and writes. Otherwise, MySQL issues an error.
* `SHARED`: if supported, you can have concurrent reads, but not writes. MySQL issues an error if the concurrent reads are not supported.
* `EXCLUSIVE`: this enforces exclusive access.

### Unique Index
To create a `UNIQUE` index, you use the `CREATE UNIQUE INDEX` statement as follows:
```sql
CREATE UNIQUE INDEX index_name
ON table_name(index_column_1,index_column_2,...);
```
Another way to enforce the uniqueness of value in one or more columns is to use the `UNIQUE` constraint. MySQL creates a `UNIQUE` index behind the scenes.
```sql
CREATE TABLE table_name(
...
   UNIQUE KEY(index_column_,index_column_2,...)
);
```
If you want to add a unique constraint to an existing table.
```sql
ALTER TABLE table_name
ADD CONSTRAINT constraint_name UNIQUE KEY(column_1,column_2,...);
```

Unlike other database systems, MySQL considers `NULL` values as distinct values. Therefore, you can have multiple `NULL` values in the `UNIQUE` index.

### Clustered Index

**What is a clustered index?**

A clustered index is an index that enforces the ordering on the rows of the table physically. Once a clustered index is created, all rows in the table will be stored according to the key columns used to create the clustered index. each table have only one clustered index.

**How MySQL add clustered indexes on InnoDB tables?**
* When you define a primary key for an `InnoDB` table, MySQL uses the primary key as the clustered index.
* If you do not have a primary key for a table, MySQL will search for the first `UNIQUE` index where all the key columns are `NOT NULL` and use this `UNIQUE` index as the clustered index.
* In case the `InnoDB` table has no primary key or suitable `UNIQUE` index, MySQL internally generates a hidden clustered index named `GEN_CLUST_INDEX` on a synthetic column which contains the row `ID` values.

### Index Cardinality
Index cardinality refers to the uniqueness of values stored in a specified column within an index.

The query optimizer uses the index cardinality to generate an optimal query plan for a given query. It also uses the index cardinality to decide whether to use the index or not in the join operations.

The low cardinality indexes negatively impact the performance.

To view the index cardinality, you use the `SHOW INDEXES` command.

### Prefix Index
Prefix Index is a index used to not consume a lot of disk space and speed operations when use `INSERT` statement, also increase the performance when use `SELECT` statement by decreasing the number of rows it searches on.

MySQL allows you to optionally create column prefix key parts for `CHAR`, `VARCHAR`, `BINARY`, and `VARBINARY` columns. If you create indexes for `BLOB` and `TEXT` columns, you must specify the column prefix key parts.

**Notice that**: the prefix support and the length of prefix is dependent on storage engine.

```sql
CREATE TABLE table_name(
    column_list,
    INDEX(column_name(length))
);
```
Or add an index to an existing table:
```sql
CREATE INDEX index_name
ON table_name(column_name(length));
```

**Evaluate Prefix Index Length**

you can investigate the existing data. The goal is to maximize the uniqueness of the values in the column when you use the prefix.

Step 1. Find the number of rows in the table:
```sql
SELECT
   COUNT(*)
FROM
   products;
```
Step2. Evaluate different prefix length until you can achieve the reasonable uniqueness of rows near to previous number:
```sql
SELECT
   COUNT(DISTINCT LEFT(productName, 20)) unique_rows
FROM
   products;
```

### Composite Index
A composite index is an index on multiple columns. MySQL allows you to create a composite index that consists of up to 16 columns.
```sql
INDEX index_name (c2,c3,c4)
```
Or you can add a composite index to an existing table.
```sql
CREATE INDEX index_name
ON table_name(c2,c3,c4);
```

The query optimizer uses the composite indexes for queries that test all columns in the index, or queries that test the first columns, the first two columns, and so on. **The query optimizer cannot use the index to perform lookups if the columns do not form a leftmost prefix of the index**.

### Descending Index
A descending index is an index that stores key values in the descending order.

Before MySQL 8.0, you can specify the `DESC` in an index definition but MySQL will ignored it. In the meantime, MySQL could scan the index in reverse order but it comes at a high cost.

```sql
CREATE TABLE t(
    a INT NOT NULL,
    b INT NOT NULL,
    INDEX a_asc_b_desc (a ASC, b DESC)
);
```

### Invisible Index
The invisible indexes allow you to mark indexes as unavailable for the query optimizer.

By default, indexes are visible. To make them invisible, you have to explicitly declare its visibility at the time of creation.
```sql
CREATE INDEX index_name
ON table_name( c1, c2, ...) INVISIBLE;
```
Or by using the `ALTER TABLE` command.
```sql
ALTER TABLE table_name
ALTER INDEX index_name [VISIBLE | INVISIBLE];
```

**Invisible Index and Primary Key**

The index on the primary key column cannot be invisible. Also an implicit primary key index also cannot be invisible. Like when you defines a `UNIQUE` index on a `NOT NULL` column of a table that does not have a primary key.

**Invisible Index System Variables**

To control visible indexes used by the query optimizer, MySQL uses the `use_invisible_indexes` flag of the `optimizer_switch` system variable. By default, the `use_invisible_indexes` is off:
```sql
SELECT @@optimizer_switch;
```
