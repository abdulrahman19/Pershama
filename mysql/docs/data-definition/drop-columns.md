# Drop Columns

In some situations, you want to remove one or more columns from a table. In such cases, you use the `ALTER TABLE DROP COLUMN` statement as follows:
```sql
ALTER TABLE table
DROP [COLUMN] column;
```

To remove multiple columns from a table at the same time, you use the following syntax:
```sql
ALTER TABLE table
DROP COLUMN column_1,
DROP COLUMN column_2,
…;
```

There are some important points you should remember before you remove a column from a table:
* Removing a column from a table makes all database objects such as `stored procedures`, `views`, `triggers`, etc., that depend on the column invalid. For example, you may have a `stored procedure` that references to a column. When you remove the column, the stored procedure will become invalid. To fix it, you have to manually change the stored procedure’s code manually.
* If you remove the column that is a foreign key, To avoid this error, you must remove the foreign key constraint before dropping the column.
* The code from other applications that depends on the removed column must be also changed, which takes time and efforts.
* Removing a column from a large table can impact the performance of the database.
