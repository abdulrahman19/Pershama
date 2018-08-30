# Temporary Table

* [Create Temporary Tables](#create-temporary-tables)
* [Drop Temporary Tables](#drop-temporary-tables)

### Create Temporary Tables
Temporary table is a special type of table that allows you to store a temporary result set, which you can reuse several times in a single session.

Temporary Tables, or temp tables for short, allow you to create a short-term storage place within the database for a set of data that you need to use several times in a single series of operations. Temp tables come into play when it isn’t possible to retrieve all the data that you require using one `SELECT` statement or when you want to work with subsets of the same, larger resultset over several successive operations.

A MySQL temporary table has the following specialized features:
* A temporary table is created by using `CREATE TEMPORARY TABLE` statement. Notice that the `TEMPORARY` keyword is added between the `CREATE` and `TABLE` keywords.
* MySQL removes the temporary table automatically when the session ends or the connection is terminated. Of course, you can use the `DROP TABLE` statement to remove a temporary table explicitly when you are no longer use it.
* A temporary table is only available and accessible to the client that creates it. Different clients can create temporary tables with the same name without causing errors because only the client that creates the temporary table can see it. However, in the same session, two temporary tables cannot share the same name.
* A temporary table can have the same name as a normal table in a database. For example, if you create a temporary table named `employees` in the sample database, the existing `employees` table becomes inaccessible. Every query you issue against the `employees` table is now referring to the temporary `employees` table. When you drop the `employees` temporary table, the permanent `employees` table is available and accessible again.

```sql
CREATE TEMPORARY TABLE top10customers
SELECT p.customerNumber,
       c.customerName,
       ROUND(SUM(p.amount),2) sales
FROM payments p
INNER JOIN customers c ON c.customerNumber = p.customerNumber
GROUP BY p.customerNumber
ORDER BY sales DESC
LIMIT 10;
```
you can query data from the `top10customers` temporary table like querying from a permanent table:
```sql
SELECT
    customerNumber,
    customerName,
    sales
FROM
    top10customers
ORDER BY sales;
```

### Drop Temporary Tables
You can use the `DROP TABLE` statement to remove temporary tables however it is good practice to add the `TEMPORARY` keyword as follows:
```sql
DROP TEMPORARY TABLE top10customers;
```
If you develop an application that uses a connection pooling or persistent connections, it is not guaranteed that the temporary tables are removed automatically when your application is terminated.

Because the database connection that the application uses may be still open and placed in a connection pool for other clients to use. Therefore, it is a good practice to always remove the temporary tables whenever you are no longer use them.
