# Rename Tables

Because business requirements change, we need to rename the current table to a new one to better reflect the new situation. MySQL provides us with a very useful statement that changes the name of one or more tables.

To change one or more tables, we use the `RENAME TABLE` statement as follows:
```sql
RENAME TABLE old_table_name TO new_table_name
             [old_table_name_2 TO new_table_name_2 ...];
```
In addition to the tables, we can use the `RENAME TABLE` statement to rename `views`.

Before we execute the `RENAME TABLE` statement, we must ensure that there is no active `transactions` or `locked tables`.

Note that you cannot use the `RENAME TABLE` statement to rename a temporary table, but you can use the `ALTER TABLE` statement to rename a `temporary table`.

If we rename a parent table, all the foreign keys that point to that parent table will not be automatically updated. In such cases, we must drop and recreate the foreign keys manually.

### We can rename a table using the `ALTER TABLE` statement as follows:
```sql
ALTER TABLE old_table_name
RENAME TO new_table_name;
```
The `ALTER TABLE` statement can rename a `temporary table` while the `RENAME TABLE` statement cannot.
