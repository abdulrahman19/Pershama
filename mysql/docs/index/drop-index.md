# Drop Index

To remove an existing index from a table, you use the `DROP INDEX` statement as follows:
```sql
DROP INDEX index_name ON table_name
[algorithm_option | lock_option];
```

**Algorithm**

The `algorithm_option` allows you to specify a specific algorithm used for the index removal. The following shows the syntax of the `algorithm_option` clause:
```sql
ALGORITHM [=] {DEFAULT|INSTANT|INPLACE|COPY}
```
* `COPY`: The table is copied to the new table row by row, the `DROP INDEX` is then performed on the copy of the original table. The concurrent data manipulation statements such as `INSERT` and `UPDATE` are not permitted.
* `INPLACE`: The table is rebuilt in place instead of copied to the new one. MySQL issues an exclusive metadata lock on the table during the preparation and execution phases of the index removal operation. This algorithm allows concurrent data manipulation statements.
* `INSTANT`: Operations only modify metadata in the data dictionary. No exclusive metadata locks are taken on the table during preparation and execution, and table data is unaffected, making operations instantaneous. Concurrent DML is permitted. **(Introduced in MySQL 8.0.12)**
* `DEFAULT` has the same effect as omitting the ALGORITHM clause.

Note that the ALGORITHM clause is optional. If you skip it, MySQL uses `INPLACE`. In case the `INPLACE` is not supported, MySQL uses `COPY`.

**Lock**

The `lock_option` controls the level of concurrent reads and writes on the table while the index is being removed.
```sql
LOCK [=] {DEFAULT|NONE|SHARED|EXCLUSIVE}
```
* `DEFAULT`: this allows you to have the maximum level of concurrency for a given algorithm. First, it allows concurrent reads and writes if supported. If not, allow concurrent reads if supported. If not, enforce exclusive access.
* `NONE`: if the `NONE` is supported, you can have concurrent reads and writes. Otherwise, MySQL issues an error.
* `SHARED`: if the `SHARED` is supported, you can have concurrent reads, but not writes. MySQL issues an error if the concurrent reads are not supported.
* `EXCLUSIVE`: this enforces exclusive access.
