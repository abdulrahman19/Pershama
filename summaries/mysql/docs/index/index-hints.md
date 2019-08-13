# Index Hints

* [USE INDEX](#force-index)
* [FORCE INDEX](#force-index)

### USE INDEX
MySQL provides a way that allows you to recommend the indexes that the query optimizer should use by using an index hint called `USE INDEX`.

The `USE INDEX` is useful in case the `EXPLAIN` shows that the Query Optimizer uses the wrong index from the list of possible indexes.

The following illustrates syntax of the MySQL `USE INDEX` hint:
```sql
SELECT select_list
FROM table_name
USE INDEX(index_list)
WHERE condition;
```
In this syntax, the `USE INDEX` instructs the query optimizer to use one of the named indexes to find rows in the table.

Notice that when you recommend the indexes to use, the query optimizer may either decide to use them or not depending on the query plan that it comes up with.

### FORCE INDEX
In the other hand, Sometimes the query optimizer can decide to ignores some indexes, may be because it sees that the full table scan is the most efficient way to execute the query.

In case the query optimizer ignores the index, you can use the `FORCE INDEX` hint to instruct it to use the index instead.

The following illustrates the `FORCE INDEX` hint syntax:
```sql
SELECT select_list
FROM table_name
FORCE INDEX(index_list)
WHERE condition;
```

