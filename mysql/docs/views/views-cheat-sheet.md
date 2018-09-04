# Views Cheat Sheet

* [Introduction](#introduction)
* [Create Views](#create-views)
* [WITH CHECK OPTION Clause](#with-check-option-clause)

### Introduction
A database view is a virtual table or logical table which is defined as a SQL `SELECT` query with `joins`. MySql allow you to update data in the underlying tables through the database view with some prerequisites. And when the data of the tables changes, the view reflects that changes as well.

**Views Advantages**
* A database view allows you to simplify complex queries.
* A database view helps limit data access to specific users.
* A database view provides extra security layer by create read-only views.
* A database view enables computed columns.
* A database view enables backward compatibility. It can behave like a Adapter Design Pattern.

**Views Disadvantages**
* Performance. The view can be slow especially if the view is created based on other views.
* Tables dependency. Whenever you change the structure of these tables that view associated with, you have to change the view as well.

**How MySql Implements Views?**

MySql processes query against the views in two ways:
* In a first way, MySql creates a temporary table based on the view definition statement and executes the incoming query on this temporary table.
* In a second way, MySql combines the incoming query with the query defined the view into one query and executes the combined query.

MySql supports versioning system for views, that means MySql takes a back up in `arc` (archive) directory. Also MySql allows you to create a view based on other views.

**MySql View’s Restrictions**
* You cannot create an index on a view.
* If you `drop` or `rename` tables to which a view references, MySql does not issue any error. You can use the `CHECK TABLE` statement to check whether the view is valid or not.
* A simple view can be updatable. but the complex one like `SELECT` statement with `join`, `subquery`, etc., cannot be updatable.
* MySql does not support materialized view.

### Create Views
To create a new view in MySql, you use the `CREATE VIEW` statement. The syntax of creating a view in MySql is as follows:
```sql
CREATE
    [ALGORITHM = {MERGE  | TEMPTABLE | UNDEFINED}]
VIEW [database_name].[view_name]
AS
[SELECT  statement]
```

**View Processing Algorithms**

Feature | MERGE Algorithm | TEMPTABLE Algorithm
---|---|---|
Mechanism | Combines the incoming query with the query defined the view into one query. | Creates a temporary table based on the view definition.
Efficient | More efficient | Less efficient
Indexing | Yes | No
Viwe can be updatable | Yes | No
Work with aggregate functions, Unions and LIMIT | No | Yes
Work with no refers to tables | No | Yes

**SELECT statement**

In the `SELECT` statement, you can query data from any table or view that exists in the database. There are several rules that the `SELECT` statement must follow:
* The `SELECT` statement can contain a `subquery` in `WHERE` clause but not in the `FROM` clause.
* The `SELECT` statement cannot refer to any variables including local variables, user variables, and session variables.
* The `SELECT` statement cannot refer to the parameters of prepared statements.

**Show Views**
```sql
SHOW FULL TABLE;
```
The `table_type` column in the result set specifies which object is view and which object is a table.

### Creating Updatable Views
Views are not only query-able but also updatable. It means that you can use the `INSERT`, `UPDATE` or `DELETE` statement to effect rows of the base table.

A simple view can be updatable. but the complex one like `SELECT` statement with `join`, `Aggregate functions`, or `subquery`, etc., cannot be updatable.

Also if you create a view with the `TEMPTABLE algorithm`, you cannot update the view.

**Checking Updatable View Information**

You can check if a view in a database in updatable by querying the `is_updatable` column from the views table in the `information_schema` database.
```sql
SELECT
    table_name,
    is_updatable
FROM
    information_schema.views
WHERE
    table_schema = 'classicmodels';
```

### WITH CHECK OPTION Clause
`WITH CHECK OPTION` clause use to ensure consistency of the views. Consistency of the view means prevents user from updating or inserting rows that are not visible through the view.

The following illustrates the syntax of the `WITH CHECK OPTION` clause.
```sql
CREATE OR REPLACE VIEW view_name
AS
    select_statement
    WITH CHECK OPTION;
```

To determine the scope of check, MySQL provides two options: `LOCAL` and `CASCADED`. If you don’t specify the keyword explicitly in the `WITH CHECK OPTION` clause, MySQL uses `CASCADED` by default.

**WITH CASCADED CHECK OPTION**

When a view uses a `WITH CASCADED CHECK OPTION`, MySQL checks the rules of the view and also the rules of the underlying views recursively.

**WITH LOCAL CHECK OPTION**

When a view uses a `WITH LOCAL CHECK OPTION`, MySQL only checks the rules of the current view and it does not check the rules of the underlying views.
