# Create Index

* [Create Index](#create-index)

An index is a data structure such as `B-Tree` that improves the speed of data retrieval on a table at the cost of additional writes and storage to maintain it. <br>
The query optimizer may use indexes to quickly locate data without having to scan every row in a table for a given query.

### Create Index
By default, MySQL creates the `B-Tree` index if you don’t specify the index type.

Typically, you create indexes for a table at the time of creation.
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
