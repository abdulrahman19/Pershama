# Composite Index

A composite index is an index on multiple columns. MySQL allows you to create a composite index that consists of up to 16 columns.
```sql
INDEX index_name (c2,c3,c4)
```
Or you can add a composite index to an existing table.
```sql
CREATE INDEX index_name
ON table_name(c2,c3,c4);
```

The query optimizer uses the composite indexes for queries that test all columns in the index, or queries that test the first columns, the first two columns, and so on. **The query optimizer cannot use the index to perform lookups if the columns do not form a leftmost prefix of the index**.

**For Example:**
```sql
CREATE TABLE table_name (
    c1 data_type PRIMARY KEY,
    c2 data_type,
    c3 data_type,
    c4 data_type,
    INDEX index_name (c2,c3,c4)
);
```
The query optimizer will work with any of following queries.
```sql
SELECT
    *
FROM
    table_name
WHERE
    c1 = v1;
# 2
SELECT
    *
FROM
    table_name
WHERE
    c1 = v1 AND
    c2 = v2;
# 3
SELECT
    *
FROM
    table_name
WHERE
    c1 = v1 AND
    c2 = v2 AND
    c3 = v3;
```
But not with this.
```sql
SELECT
    *
FROM
    table_name
WHERE
    c1 = v1 AND
    c3 = v3;
```
Because the `c3` column don't form a leftmost prefix of the index.
