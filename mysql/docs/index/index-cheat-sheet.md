# MySQL Index Cheat Sheet

* [Show Indexes](#show-indexes)
* [Create Index](#create-index)
* [EXPLAIN Clause](#explain-clause)

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
