# Truncate Table
The MySQL `TRUNCATE TABLE` statement allows you to delete all data in a table. Therefore, in terms of functionality, The `TRUNCATE TABLE` statement is like a `DELETE` statement without a `WHERE` clause. However, in some cases, the MySQL `TRUNCATE TABLE` statement is more efficient than the `DELETE` statement.

If you are using `InnoDB` tables, MySQL will check if there are any foreign key constraints available in the tables before deleting data. The following are cases:
* If the table has any foreign key constraints, the `TRUNCATE TABLE` statement deletes rows one by one. If the foreign key constraint has `DELETE CASCADE` action, the corresponding rows in the child tables are also deleted.
* If the foreign key constraint does not specify the `DELETE CASCADE` action, the `TRUNCATE TABLE` deletes rows one by one, and it will stop and issue an error when it encounters a row that is referenced by a row in a child table.
* If the table does not have any foreign key constraint, the `TRUNCATE TABLE` statement drops the table and recreates a new empty one with the same structure, which is faster and more efficient than using the `DELETE` statement especially for big tables.

If you are using other storage engines, the `TRUNCATE TABLE` statement just drops and recreates a new table.

Notice that the `TRUNCATE TABLE` statement resets auto increment value to zero if the table has an `AUTO_INCREMENT` column.

In addition, the `TRUNCATE TABLE` statement does not use the `DELETE` statement, therefore, the `DELETE` triggers associated with the table will not be invoked.

```sql
TRUNCATE [TABLE] books;
```
