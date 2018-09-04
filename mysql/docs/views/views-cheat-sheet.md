# Views Cheat Sheet

* [Introduction](#introduction)

### Introduction
A database view is a virtual table or logical table which is defined as a SQL `SELECT` query with `joins`. MySQL allow you to update data in the underlying tables through the database view with some prerequisites. And when the data of the tables changes, the view reflects that changes as well.

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

**MySQL View’s Restrictions**
* You cannot create an index on a view.
* If you `drop` or `rename` tables to which a view references, MySQL does not issue any error. You can use the `CHECK TABLE` statement to check whether the view is valid or not.
* A simple view can be updatable. but the complex one like `SELECT` statement with `join`, `subquery`, etc., cannot be updatable.
* MySQL does not support materialized view.
