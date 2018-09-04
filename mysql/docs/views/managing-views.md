# Managing Views

* [Showing View Definition](#showing-view-definition)
* [Modifying Views](#modifying-views)
* [Removing Views](#removing-views)

### Showing View Definition
MySQL provides the `SHOW CREATE VIEW` statement that displays the view’s definition.
```sql
SHOW CREATE VIEW [database_name].[view_ name];
```
Also from following path: `\data\classicmodels\xxx.frm`, `xxx` is the view name.

### Modifying Views
**ALTER VIEW**

Once a view is created, you can modify it using the ALTER VIEW statement.
```sql
ALTER
    [ALGORITHM =  {MERGE | TEMPTABLE | UNDEFINED}]
VIEW [database_name].[view_name]
AS
[SELECT  statement]
```

**CREATE OR REPLACE VIEW**

If a view already exists, MySQL simply modifies the view. In case the view does not exist, MySQL creates a new view.
```sql
CREATE OR REPLACE VIEW contacts AS
    SELECT
        firstName, lastName, extension, email
    FROM
        employees;
```

### Removing Views
Once a view created, you can remove it using the `DROP VIEW` statement. The following illustrates the syntax of the `DROP VIEW` statement:
```sql
DROP VIEW [IF EXISTS] [database_name].[view_name];
```
