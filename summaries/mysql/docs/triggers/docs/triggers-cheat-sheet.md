# Triggers Cheat Sheet

* [Introduction](#introduction)
* [Create Triggers](#create-triggers)
* [Managing Triggers](#managing-triggers)
* [Scheduled Events](#scheduled-events)

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
* Use dynamic SQL statements (work with variables).

### Create Triggers
In order to create a new trigger, you use the `CREATE TRIGGER` statement.
```sql
CREATE TRIGGER trigger_name
    [BEFORE|AFTER] [INSERT|UPDATE|DELETE] ON table_name
    FOR EACH ROW
    BEGIN
        ...
    END;
```
When we want to get the data that changes on update or insert or delete operation, we have two keywords:
* `OLD` which refers to the row before it is updated.
* `NEW` which refers to the row after it is updated.

The cases for every operation like:
* `INSERT` we can use `NEW` only.
* `DELETE` we can use `OLD` only.
* `UPDATE` we can use both.

**Create Multiple Triggers For Same Event And Action**
```sql
DELIMITER $$
CREATE TRIGGER  trigger_name
    [BEFORE|AFTER] [INSERT|UPDATE|DELETE] ON table_name
    FOR EACH ROW [FOLLOWS|PRECEDES] existing_trigger_name
    BEGIN
        …
    END $$
DELIMITER ;
```
* The `FOLLOWS` option allows the new trigger to activate after the existing trigger.
* The `PRECEDES` option allows the new trigger to activate before the existing trigger.

### Managing Triggers
**Display Triggers**

This query will show all the triggers in a particular database.
```sql
SELECT
    *
FROM
    information_schema.triggers
WHERE
    trigger_schema = 'database_name'
```
we can show specific trigger by add one of the following in `WHERE` clause.
* `trigger_name = 'trigger_name'` To display specific trigger.
* `event_object_table = 'table_name'` To find all triggers associated with a particular table.

**Information On Triggers Order**
```sql
SELECT
    trigger_name, action_order
FROM
    information_schema.triggers
WHERE
    trigger_schema = 'database_name'
ORDER BY
    event_object_table ,
    action_timing ,
    event_manipulation;
```

**SHOW TRIGGERS Statement**

Another quick way to display triggers in a particular database is to use `SHOW TRIGGERS` statement as follows:
```sql
SHOW TRIGGERS [FROM|IN] database_name
[LIKE expr | WHERE expr];
```
Notice that to execute the `SHOW TRIGGERS` statement, you must have the `SUPER` privilege.

**Removing a Trigger**
```sql
DROP TRIGGER table_name.trigger_name;
```

**Modify a Trigger**

To modify a trigger, you have to delete it first and recreate it with the new code.

### Scheduled Events
You can see the status of event scheduler thread.
```sql
SHOW PROCESSLIST;
```
To enable and start the event scheduler thread.
```sql
SET GLOBAL event_scheduler = ON;
```

**Show Events**
```sql
SHOW EVENTS FROM database_name;
```

**Creating New Events**
```sql
CREATE EVENT [IF NOT EXIST]  event_name
ON SCHEDULE schedule
DO
event_body
```
* `schedule` for once `AT timestamp [+ INTERVAL]`.
* `schedule` for recurring event `EVERY interval STARTS timestamp [+INTERVAL] ENDS timestamp [+INTERVAL]`.

MySql automatically drop the event when it is expired, To keep the event after finished use the `ON COMPLETION PRESERVE` clause.
```sql
CREATE EVENT test_event_02
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 MINUTE
ON COMPLETION PRESERVE
DO
...
```
It is important to notice that you can call a `stored procedure` inside the body of the event. In case you have compound SQL statements, you can wrap them in a `BEGIN END` block.

**Modify Events**

you use the `ALTER EVENT` statement as follows:
```sql
ALTER EVENT event_name
ON SCHEDULE schedule
ON COMPLETION [NOT] PRESERVE
RENAME TO new_event_name
ENABLE | DISABLE
DO
    event_body
```
You can use any part to change what you want, you don't need to use the complete syntax.
* `ENABLE | DISABLE` use to enable a disabled event.
* `RENAME` can use to rename the event or move it to another database.
```sql
ALTER EVENT oldDb.test_event_05
RENAME TO newDb.test_event_05
```

**Drop Events**
```sql
DROP EVENT [IF EXIST] event_name;
```
