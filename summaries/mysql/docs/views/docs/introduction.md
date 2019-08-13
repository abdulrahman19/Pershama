# Introduction to MySql Views

* [Views Advantages](#views-advantages)
* [Views Disadvantages](#views-disadvantages)
* [How MySql Implements Views?](#how-mysql-implements-views)
* [MySQL View’s Restrictions](#mysql-views-restrictions)

A database view is a virtual table or logical table which is defined as a SQL `SELECT` query with `joins`. MySQL allow you to update data in the underlying tables through the database view with some prerequisites.

A database view is dynamic because it is not related to the physical schema. The database system stores views as a SQL `SELECT` statement with `joins`. When the data of the tables changes, the view reflects that changes as well.

### Views Advantages
* A database view allows you to simplify complex queries. You can use database view to hide the complexity of underlying tables to the end-users and external applications.
* A database view helps limit data access to specific users.
* A database view provides extra security layer. The database view allows you to create the read-only view to expose read-only data to specific users.
* A database view enables computed columns. Suppose in the `orderDetails` table you have `quantityOrder` (the number of ordered products) and `priceEach` (price per product item) columns. However, the `orderDetails` table does not have a computed column to store total sales for each line item of the order. If it has, the database schema would not be a good design. In this case, you can create a computed column named `total`, which is a product of `quantityOrder` and `priceEach` to represent the calculated result. When you query data from the database view, the data of the computed column is calculated on the fly.
* A database view enables backward compatibility. Suppose you have a central database, which many applications are using it. One day, you decide to redesign the database to adapt to the new business requirements. You remove some tables and create new tables, and you don’t want the changes to affect other applications. In this scenario, you can create database views with the same schema as the legacy tables that you will remove. It act here like a Adapter Design Pattern.

### Views Disadvantages
* Performance: querying data from a database view can be slow especially if the view is created based on other views.
* Tables dependency: you create a view based on underlying tables of the database. Whenever you change the structure of these tables that view associated with, you have to change the view as well.

### How MySql Implements Views?
MySql processes query against the views in two ways:
* In a first way, MySql creates a temporary table based on the view definition statement and executes the incoming query on this temporary table.
* In a second way, MySql combines the incoming query with the query defined the view into one query and executes the combined query.

MySql supports versioning system for views. Each time when a view is `altered` or `replaced`, a copy of the view is back up in `arc` (archive) directory that resides in a specific database folder.

MySql allows you to create a view based on other views.

### MySql View’s Restrictions
* You cannot create an index on a view. MySql uses indexes of the underlying tables when you query data against the views that use the `merge algorithm`. For the views that use the `temptable algorithm`, indexes are not utilized when you query data against the views.
* If you `drop` or `rename` tables to which a view references, MySql does not issue any error. You can use the `CHECK TABLE` statement to check whether the view is valid or not.
* A simple view can be updatable. A view created based on a complex `SELECT` statement with `join`, `subquery`, etc., cannot be updatable.
* MySql does not support materialized view.
