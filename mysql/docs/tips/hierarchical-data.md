# Hierarchical Data

* [Before MySQL 8](#before-mysql-8)
* [After MySQL 8](#after-mysql-8)
* [Resources](#resources)

Hierarchical data is everywhere. It can be blog categories, product hierarchies, or organizational structures. Here I'll try to collect a popular approaches to deal with hierarchical data.

## Before MySQL 8
[Adjacency List](./adjacency-list.md)

Because of `Adjacency List` has a problem to get all tree nodes and because MySQL lacked support for recursive queries, so workarounds were needed.

These are all denormalized designs, most don't have referential integrity.
* [Path Enumeration](./path-enumeration.md)
* [Nested Sets](./nested-sets.md)
* [Closure Table](./closure-table.md)

## After MySQL 8
Now we can use recursive queries with `Recursive CTE` the new concept delivered with MySQL 8, So we can use `Adjacency List` very easy.

[Recursive CTE](./recursive-cte.md)

### Resources
* [Percona - Recursive Query Video](https://www.youtube.com/watch?v=M4O0YQGTxjM)
* [Percona - Models for Hierarchical Data in SQL and PHP Video](https://www.youtube.com/watch?v=wuH5OoPC3hA)
* [Waiting For Code - MySQL Articles](http://www.waitingforcode.com/mysql)
