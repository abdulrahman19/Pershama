# Triggers Cheat Sheet

* [Introduction](#introduction)

### Introduction
A SQL trigger is a set of SQL statements stored in the database catalog. A SQL trigger is executed or fired automatically whenever an event associated with a table occurs e.g., `insert`, `update` or `delete`.

**Triggers Advantages**
* SQL triggers provide an alternative way to check the integrity of data.
* SQL triggers can catch errors in business logic in the database layer.
* SQL triggers provide an alternative way to run scheduled tasks. By using SQL triggers, you don’t have to wait to run the scheduled tasks because the triggers are invoked automatically before or after a change is made to the data in the tables.
* SQL triggers are very useful to audit the changes of data in tables.

**Triggers Disadvantages**
* SQL triggers only can provide an extended validation and they cannot replace all the validations. Some simple validations have to be done in the application layer like `PHP`.
* SQL triggers are invoked and executed invisible from the client applications, therefore, it is difficult to figure out what happens in the database layer.
* SQL triggers may increase the overhead of the database server.

When you use a statement that does not use `INSERT`, `DELETE` or `UPDATE` statement, the triggers associated with the table are not invoked. The opposite is true, there are some other statements that use previous statements behind the scenes, If you use these statements, the corresponding triggers associated with the table are invoked like `REPLACE`.

You should name the triggers using the following naming convention:
```sql
(BEFORE | AFTER)_tableName_(INSERT| UPDATE | DELETE)
# or
tablename_(BEFORE | AFTER)_(INSERT| UPDATE | DELETE)
```

MySQL triggers cannot:
* Use `SHOW`, `LOAD DATA`, `LOAD TABLE`, `BACKUP DATABASE`, `RESTORE`, `FLUSH` and `RETURN` statements.
* Use statements that commit or rollback implicitly or explicitly such as `COMMIT` , `ROLLBACK` , `START TRANSACTION` , `LOCK/UNLOCK TABLES` , `ALTER` , `CREATE` , `DROP` , `RENAME`.
* Use prepared statements such as `PREPARE` and `EXECUTE`.
* Use dynamic SQL statements.
