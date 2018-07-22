# Aliases

* [MySQL alias for columns](#mysql-alias-for-columns) <br>
* [MySQL alias for tables](#mysql-alias-for-tables) <br>

### MySQL alias for columns
```sql
SELECT
    [column_1 | expression] AS descriptive_name
FROM table_name;
# or
SELECT
    [column_1 | expression] AS `descriptive name`
FROM table_name;
```
For example
```sql
SELECT
    CONCAT_WS(', ', lastName, firstname) `Full name`
FROM
    employees
ORDER BY
    `Full name`;
```
We can use aliases with `JOIN`, `ORDER BY`, `GROUP BY` and `HAVING`.

### MySQL alias for tables
```sql
SELECT
    [column_1 | expression] AS descriptive_name
FROM table_name AS table_alias;
```
Table alias is very important in `JOIN` operation.
```sql
SELECT
    customerName,
    COUNT(o.orderNumber) total
FROM
    customers c
INNER JOIN orders o ON c.customerNumber = o.customerNumber
GROUP BY
    customerName
ORDER BY
    total DESC;
```
