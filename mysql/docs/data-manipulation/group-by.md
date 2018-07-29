# GROUP BY

* [GROUP BY](#group-by) <br>
* [GROUP BY with HAVING clause](#group-by-with-having-clause) <br>

### GROUP BY
Use MySQL `GROUP BY` to group rows into subgroups based on values of columns or expressions.

```sql
SELECT
    c1, c2,..., cn, aggregate_function(ci)
FROM
    table
WHERE
    where_conditions
GROUP BY c1 , c2,...,cn;
```

**Example**

```sql
SELECT
    orderNumber,
    SUM(quantityOrdered * priceEach) AS total
FROM
    orderdetails
GROUP BY orderNumber;
```

`GROUP BY` with expression example

```sql
SELECT
    YEAR(orderDate) AS year,
    SUM(quantityOrdered * priceEach) AS total
FROM
    orders
        INNER JOIN
    orderdetails USING (orderNumber)
WHERE
    status = 'Shipped'
GROUP BY YEAR(orderDate);
```

Standard SQL does not allow you to use an `alias` in the `GROUP BY` clause, however, MySQL supports this.

So you can edit previous query to

```sql
SELECT
    YEAR(orderDate) AS year,
    SUM(quantityOrdered * priceEach) AS total
FROM
    orders
        INNER JOIN
    orderdetails USING (orderNumber)
WHERE
    status = 'Shipped'
GROUP BY year;
```

MySQL also allows you to sort the groups in ascending or descending orders while the standard SQL does not.

```sql
SELECT
    status, COUNT(*)
FROM
    orders
GROUP BY status DESC;
```

### GROUP BY with HAVING clause
The `HAVING` clause is used in the `SELECT` statement to specify filter conditions for a group of rows or aggregates.

The `HAVING` clause is often used with the `GROUP BY` clause to filter groups based on a specified condition. If the `GROUP BY` clause is omitted, the `HAVING` clause behaves like the `WHERE` clause.

```sql
SELECT
    a.ordernumber,
    status,
    SUM(priceeach*quantityOrdered) total
FROM
    orderdetails a
INNER JOIN
    orders b ON b.ordernumber = a.ordernumber
GROUP BY ordernumber, status
HAVING status = 'Shipped' AND total > 1500;
```

