# Alter Table

* [Define ALTER TABLE](#define-alter-table)
* [Renaming a Table](#renaming-a-table)
* [Add a New Column](#add-a-new-column)
* [Changing Columns](#changing-columns)
* [Drop a Column](#drop-a-column)

### Define ALTER TABLE
You use the `ALTER TABLE` statement to change the structure of existing tables. The `ALTER TABLE` statement allows you to add a column, drop a column, change the data type of column, add primary key, rename table, and many more.

```sql
ALTER TABLE table_name action1[,action2,…]
```

To change the structure an existing table:
* First, you specify the table name, which you want to change, after the `ALTER TABLE`  clause.
* Second, you list a set of actions that you want to apply to the table. An action can be anything such as adding a new column, adding primary key, renaming table, etc. The `ALTER TABLE` statement allows you to apply multiple actions in a single `ALTER TABLE` statement, each action is separated by a comma (`,`).

### Renaming a Table
```sql
ALTER TABLE tasks
RENAME TO work_items;
```

### Add a New Column
```sql
ALTER TABLE tasks
ADD COLUMN complete DECIMAL(2,1) NULL
AFTER description;
```
More information [here](./add-columns.md)

### Changing Columns
```sql
ALTER TABLE tasks
CHANGE COLUMN task_id task_id INT(11) NOT NULL AUTO_INCREMENT;
```

### Drop a Column
```sql
ALTER TABLE tasks
DROP COLUMN description;
```
More information [here](./drop-columns.md)
