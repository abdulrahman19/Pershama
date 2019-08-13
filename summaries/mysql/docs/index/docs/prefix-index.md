# Prefix Index

* [Evaluate Prefix Index Length](#evaluate-prefix-index-length)

When you create a secondary index for a column, MySQL stores the values of the columns in a separate data structure e.g., `B-Tree` and `Hash`.

In case the columns are the string / binary columns, the index will consume a lot of disk space and potentially slow down the `INSERT` operations.

To address this issue, MySQL allows you to create an index for the leading part of the column values of the string columns using the following syntax:
```sql
column_name(length)
```
Or add an index to an existing table:
```sql
CREATE INDEX index_name
ON table_name(column_name(length));
```
Example
```sql
CREATE TABLE table_name(
    column_list,
    INDEX(column_name(length))
);
```
MySQL allows you to optionally create column prefix key parts for `CHAR`, `VARCHAR`, `BINARY`, and `VARBINARY` columns. If you create indexes for `BLOB` and `TEXT` columns, you must specify the column prefix key parts.

The length for the non-binary string types is the number of `characters` such as `CHAR`..etc and the number of `bytes` for binary string types such as `BINARY`..etc.

**Notice that**: the prefix support and the length of prefix is dependent on storage engine.

### Evaluate Prefix Index Length
The question is how do you choose the length of the prefix?

you can investigate the existing data. The goal is to maximize the uniqueness of the values in the column when you use the prefix.

Step 1. Find the number of rows in the table:
```sql
SELECT
   COUNT(*)
FROM
   products;
```
Step2. Evaluate different prefix length until you can achieve the reasonable uniqueness of rows near to previous number:
```sql
SELECT
   COUNT(DISTINCT LEFT(productName, 20)) unique_rows
FROM
   products;
```
