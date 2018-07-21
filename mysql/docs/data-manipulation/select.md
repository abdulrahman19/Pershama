# SELECT

* [SELECT Query Syntax](#select-query-syntax) <br>
* [SELECT DISTINCT](#select-distinct) <br>
    * DISTINCT vs GROUP BY
    * MySQL DISTINCT and aggregate functions

### SELECT Query Syntax
```sql
SELECT
    column_1, column_2, ...
FROM
    table_1
[INNER | LEFT |RIGHT] JOIN table_2 ON conditions
WHERE
    conditions
GROUP BY column_1
HAVING group_conditions
ORDER BY column_1
LIMIT offset, length;
```
You should use the asterisk (*) for testing only. In practical, you  should list the columns that you want to get data explicitly because of the following reasons:

* The asterisk (*) returns data from the columns that you may not use. It produces unnecessary I/O disk and network traffic between the MySQL database server and application.
* If you explicit specify the columns, the result set is more predictable and easier to manage. Imagine when you use the asterisk(*) and someone changes the table by adding more columns, you will end up with a result set that is different from what you expected.
* Using asterisk (*) may expose sensitive information to unauthorized users.

### SELECT DISTINCT
```sql
SELECT DISTINCT
    columns
FROM
    table_name
WHERE
    where_conditions;
```
* If a column has <code>NULL</code> values, <code>DISTINCT</code> will keep one. To remove <code>NUll</code> values you can use <code>WHERE bla IS NOT NUll</code>.
* If you use the <code>GROUP BY</code> clause in the <code>SELECT</code> statement without using aggregate functions, the <code>GROUP BY</code> clause behaves like the <code>DISTINCT</code> clause.

**DISTINCT vs GROUP BY** <br>
Generally speaking, the <code>DISTINCT</code> clause is a special case of the <code>GROUP BY</code> clause. The difference between <code>DISTINCT</code> clause and <code>GROUP BY</code> clause is that the <code>GROUP BY</code> clause sorts the result set whereas the <code>DISTINCT</code> clause does not.
```sql
SELECT
    state
FROM
    customers
GROUP BY state;
```
It's equal to
```sql
SELECT DISTINCT
    state
FROM
    customers
ORDER BY state;
```

**MySQL DISTINCT and aggregate functions** <br>
```sql
SELECT
    COUNT(DISTINCT state)
FROM
    customers
WHERE
    country = 'USA';
```
