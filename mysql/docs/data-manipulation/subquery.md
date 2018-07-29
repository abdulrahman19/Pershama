# SubQuery

* [SubQuery With SELECT](#subquery-with-select) <br>
* [SubQuery With FROM](#subquery-with-from) <br>
* [SubQuery With WHERE/HAVING](#subquery-with-where-having) <br>
* [SubQuery With IN](#subquery-with-in) <br>
* [SubQuery With EXISTS](#subquery-with-exists) <br>
* [Correlated SubQuery](#correlated-subquery) <br>

A MySQL `subquery` is a query nested within another query such as `SELECT`, `INSERT`, `UPDATE` or `DELETE`. In addition, a MySQL `subquery` can be nested inside another `subquery`.

A MySQL `subquery` is called an `inner query` while the query that contains the `subquery` is called an `outer query`. A `subquery` can be used anywhere that expression is used and must be closed in parentheses.

### SubQuery With SELECT
The `subquery` with `SELECT` must returns only one value.
```sql
SELECT
    SalesOrderID,
    LineTotal,
    (SELECT AVG(LineTotal)
     FROM SalesOrderDetail) AS AverageLineTotal
FROM SalesOrderDetail;
```

### SubQuery With FROM
```sql
SELECT
    MAX(items), MIN(items), FLOOR(AVG(items))
FROM
    (SELECT
        orderNumber, COUNT(orderNumber) AS items
    FROM
        orderdetails
    GROUP BY orderNumber) AS lineitems;
```

### SubQuery In WHERE/HAVING
```sql
SELECT
    customerNumber, checkNumber, amount
FROM
    payments
WHERE
    amount = (SELECT
                  MAX(amount)
               FROM
                  payments);
```

With `HAVING`

```sql
SELECT
    JobTitle,
    AVG(VacationHours) AS AverageVacationHours
FROM
    Employee
GROUP BY
    JobTitle
HAVING
    AVG(VacationHours) > (SELECT
                             AVG(VacationHours)
                          FROM
                             Employee)
```

### SubQuery With IN
```sql
SELECT
    lastName, firstName
FROM
    employees
WHERE
    officeCode IN (SELECT
                      officeCode
                   FROM
                      offices
                    WHERE
                      country = 'USA');
```
Also you can use it with `NOT IN`.

### SubQuery With EXISTS
When a `subquery` is used with the `EXISTS` or `NOT EXISTS` operator, a `subquery` returns a `Boolean` value of TRUE or FALSE.

```sql
SELECT
    *
FROM
    table_name
WHERE
    EXISTS( subquery );
```

> Use `EXISTS` when the subquery results is very large, and `IN` when the subquery results is very small.

### Correlated SubQuery
In the previous examples, you notice that a `subquery` is independent. Unlike a standalone `subquery`, a `correlated subquery` is a `subquery` that uses the data from the `outer query`.

```sql
SELECT
    productname,
    buyprice
FROM
    products p1
WHERE
    buyprice > (SELECT
                    AVG(buyprice)
                FROM
                    products
                WHERE
                    productline = p1.productline)
```
