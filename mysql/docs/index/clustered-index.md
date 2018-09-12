# Clustered Index

**What is a clustered index?**

A clustered index is an index that enforces the ordering on the rows of the table physically. Once a clustered index is created, all rows in the table will be stored according to the key columns used to create the clustered index. each table have only one clustered index.

**How MySQL add clustered indexes on InnoDB tables?**
* When you define a primary key for an `InnoDB` table, MySQL uses the primary key as the clustered index.
* If you do not have a primary key for a table, MySQL will search for the first `UNIQUE` index where all the key columns are `NOT NULL` and use this `UNIQUE` index as the clustered index.
* In case the `InnoDB` table has no primary key or suitable `UNIQUE` index, MySQL internally generates a hidden clustered index named `GEN_CLUST_INDEX` on a synthetic column which contains the row `ID` values.
