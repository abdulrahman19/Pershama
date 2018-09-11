# Unique Index

MySQL provides another kind of index called `UNIQUE` index that allows you to enforce the uniqueness of values in one or more columns.

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
