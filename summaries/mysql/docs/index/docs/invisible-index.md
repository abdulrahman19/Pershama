# Invisible Index

* [Show Invisible Index](#show-invisible-index)
* [Invisible Index and Primary Key](#invisible-index-and-primary-key)
* [Invisible Index System Variables](#invisible-index-system-variables)

The invisible indexes allow you to mark indexes as unavailable for the query optimizer. For example you can make an index invisible to see if it has an impact to the performance and mark the index visible again if it does.

By default, indexes are visible. To make them invisible, you have to explicitly declare its visibility at the time of creation.
```sql
CREATE INDEX index_name
ON table_name( c1, c2, ...) INVISIBLE;
```
Or by using the `ALTER TABLE` command.
```sql
ALTER TABLE table_name
ALTER INDEX index_name [VISIBLE | INVISIBLE];
```

### Show Invisible Index
You can find the indexes and their visibility by querying the statistics table in the `information_schema` database:
```sql
SELECT
    index_name,
    is_visible
FROM
    information_schema.statistics
WHERE
    table_schema = 'classicmodels'
        AND table_name = 'employees';
```
Or you can use the `SHOW INDEXES` command to display all indexes of a table.
```sql
SHOW INDEXES FROM employees;
```

### Invisible Index and Primary Key
The index on the primary key column cannot be invisible. If you try to do so, MySQL will issue an error.

In addition, an implicit primary key index also cannot be invisible. When you defines a `UNIQUE` index on a `NOT NULL` column of a table that does not have a primary key, MySQL implicitly understands that this column is the primary key column and does not allow you to make the index invisible.

### Invisible Index System Variables
To control visible indexes used by the query optimizer, MySQL uses the `use_invisible_indexes` flag of the `optimizer_switch` system variable. By default, the `use_invisible_indexes` is off:
```sql
SELECT @@optimizer_switch;
```
