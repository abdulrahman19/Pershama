# Managing Triggers

* [Display Triggers](#display-triggers)
* [Removing a Trigger](#removing-a-trigger)
* [Modify a Trigger](#modify-a-trigger)

### Display Triggers
you can display its definition in the data folder:
```bash
/data_folder/database_name/table_name.trg
```
MySQL provides you with an alternative way to display the trigger.
```sql
SELECT
    *
FROM
    information_schema.triggers
WHERE
    trigger_schema = 'database_name'
    AND trigger_name = 'trigger_name';
```
If you want to retrieve all triggers in a particular database.
```sql
SELECT
    *
FROM
    information_schema.triggers
WHERE
    trigger_schema = 'database_name';
```
To find all triggers associated with a particular table.
```sql
SELECT
    *
FROM
    information_schema.triggers
WHERE
    trigger_schema = 'database_name'
    AND event_object_table = 'table_name';
```

**SHOW TRIGGERS Statement**

Another quick way to display triggers in a particular database is to use `SHOW TRIGGERS` statement as follows:
```sql
SHOW TRIGGERS [FROM|IN] database_name
[LIKE expr | WHERE expr];
```
Notice that to execute the `SHOW TRIGGERS` statement, you must have the `SUPER` privilege.

### Removing a Trigger
o remove an existing trigger, you use DROP TRIGGER statement as follows:
```sql
DROP TRIGGER table_name.trigger_name;
```

### Modify a Trigger
To modify a trigger, you have to delete it first and recreate it with the new code. There is no such `ALTER TRIGGER` statement available in MySQL, therefore, you cannot modify an existing trigger like modifying other database objects such as `tables`, `views`, and `stored procedures`.
