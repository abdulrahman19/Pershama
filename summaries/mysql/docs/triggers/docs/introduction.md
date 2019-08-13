# Introduction To Triggers

* [Triggers Advantages](#triggers-advantages)
* [Triggers Disadvantages](#triggers-disadvantages)
* [Triggers Implementation](#triggers-implementation)

A SQL trigger is a set of SQL statements stored in the database catalog. A SQL trigger is executed or fired automatically whenever an event associated with a table occurs e.g., `insert`, `update` or `delete`.

A SQL trigger is a special type of stored procedure. It is special because it is not called directly like a stored procedure. The main difference between a trigger and a stored procedure is that a trigger is called automatically when a data modification event is made against a table whereas a stored procedure must be called explicitly.

### Triggers Advantages
* SQL triggers provide an alternative way to check the integrity of data.
* SQL triggers can catch errors in business logic in the database layer.
* SQL triggers provide an alternative way to run scheduled tasks. By using SQL triggers, you don’t have to wait to run the scheduled tasks because the triggers are invoked automatically before or after a change is made to the data in the tables.
* SQL triggers are very useful to audit the changes of data in tables.

### Triggers Disadvantages
* SQL triggers only can provide an extended validation and they cannot replace all the validations. Some simple validations have to be done in the application layer like `PHP`.
* SQL triggers are invoked and executed invisible from the client applications, therefore, it is difficult to figure out what happens in the database layer.
* SQL triggers may increase the overhead of the database server.

### Triggers Implementation
When you use a statement that does not use `INSERT`, `DELETE` or `UPDATE` statement to change data in a table, the triggers associated with the table are not invoked. For example, the `TRUNCATE` statement.

There are some statements that use the `INSERT` statement behind the scenes such as `REPLACE` statement or `LOAD DATA` statement. If you use these statements, the corresponding triggers associated with the table are invoked.

You should name the triggers using the following naming convention:
```sql
(BEFORE | AFTER)_tableName_(INSERT| UPDATE | DELETE)
# or
tablename_(BEFORE | AFTER)_(INSERT| UPDATE | DELETE)
```

MySQL stores triggers in a data directory e.g., `/data/classicmodels/` with the files named `tablename.TRG` and `triggername.TRN` :
* The `tablename.TRG` file maps the trigger to the corresponding table.
* the `triggername.TRN` file contains the trigger definition.

MySQL triggers cover all features defined in the standard SQL. However, there are some limitations that you should know before using them in your applications.

MySQL triggers cannot:
* Use `SHOW`, `LOAD DATA`, `LOAD TABLE`, `BACKUP DATABASE`, `RESTORE`, `FLUSH` and `RETURN` statements.
* Use statements that commit or rollback implicitly or explicitly such as `COMMIT` , `ROLLBACK` , `START TRANSACTION` , `LOCK/UNLOCK TABLES` , `ALTER` , `CREATE` , `DROP` , `RENAME`.
* Use prepared statements such as `PREPARE` and `EXECUTE`.
* Use dynamic SQL statements.
