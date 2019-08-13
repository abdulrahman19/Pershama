# Fast Reading Topics

* [CTE](#cte)
* [Find Duplicate Values](#find-duplicate-values)
* [Delete Duplicate Rows](#delete-duplicate-rows)
* [Copy Table](#copy-table)

**In this File I'll collect summaries of articles I had read, It just a (summary) no details here, I'll back to read more about them later.**

### CTE
`CTE` in short since version 8.0.

**C**ommon **T**able **E**xpression or `CTE`, `CTE` is a named temporary result set that exists within the scope of a single statement e.g.,`SELECT`, `INSERT` and that can be referred to later within that statement, possibly multiple times.

It's Similar to a `Derived Table`. Different from a `derived table`, a `CTE` can be self-referencing (a `Recursive CTE`) or can be referenced multiple times in the same query. In addition, a `CTE` provides better readability and performance in comparison with a `derived table`.
```sql
WITH cte_name (column_list) AS (
    query
)
SELECT * FROM cte_name;
```

### Find Duplicate Values
The find duplicate values in a table based on one column, you use the following statement:
```sql
SELECT
    col,
    COUNT(col)
FROM
    table_name
GROUP BY col
HAVING COUNT(col) > 1;
```

### Delete Duplicate Rows
* Using `DELETE JOIN` statement.
```sql
DELETE
    t1
FROM
    contacts t1
INNER JOIN
    contacts t2
WHERE
    t1.id < t2.id AND t1.email = t2.email;
```
* Using an intermediate table.
    * Create a new table with the structure the same as the original table which you want to delete duplicate rows.
    * Insert distinct rows from the original table to the immediate table.
    * Drop the original table and rename the immediate table to the original table.
* Using `ROW_NUMBER()` function (MySQL 8).
```sql
DELETE FROM
    contacts
WHERE
    id IN (
            SELECT
                id
            FROM (
                SELECT
                    id,
                    ROW_NUMBER() OVER ( PARTITION BY email ORDER BY email) AS row_num
                FROM
                    contacts
            ) t
            WHERE row_num > 1
        );
```

### Copy Table
* To copy data from a table to a new table.
```sql
CREATE TABLE [IF NOT EXIST] new_table
SELECT col, col2, col3
FROM
    existing_table;
```
* To copy partial data from an existing table to the new one.
```sql
CREATE TABLE [IF NOT EXIST] new_table
SELECT col, col2, col3
FROM
    existing_table
WHERE
    conditions;
```
* To copy data from one table and also all the dependent objects (`indexes`, `primary key constraint` ..etc) of the table.
```sql
CREATE TABLE IF NOT EXISTS new_table LIKE existing_table;

INSERT new_table
SELECT * FROM existing_table;
```
