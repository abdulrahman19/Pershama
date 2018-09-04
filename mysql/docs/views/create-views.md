# Create Views

* [Show Views](#show-views)
* [View Example](#view-example)
* [Creating a View Based on Another View](#creating-a-view-based-on-another-view)
* [Creating a View With Join](#creating-a-view-with-join)
* [Creating a View With SubQuery](#creating-a-view-with-subquery)

To create a new view in MySql, you use the `CREATE VIEW` statement. The syntax of creating a view in MySql is as follows:
```sql
CREATE
    [ALGORITHM = {MERGE  | TEMPTABLE | UNDEFINED}]
VIEW [database_name].[view_name]
AS
[SELECT  statement]
```

**View Processing Algorithms**
* `MERGE algorithm`, MySql first combines the input query with the `SELECT` statement, which defines the view, into a single query. And then MySql executes the combined query to return the result set. The `MERGE algorithm` is not allowed if the `SELECT` statement contains aggregate functions such as `MIN`, `MAX`, `SUM`, `COUNT`, `AVG `or `DISTINCT`, `GROUP BY`, `HAVING`, `LIMIT`, `UNION`, `UNION ALL`, `subquery`. In case the `SELECT` statement refers to no table, the `MERGE algorithm` is also not allowed. If the `MERGE algorithm` is not allowed, MySql changes the algorithm to `UNDEFINED`. Note that the combination of input query and the query in the view definition into one query is referred to as `view resolution`.
* `TEMPTABLE algorithm`, MySql first creates a temporary table based on the `SELECT` statement that defines the view, and then it executes the input query against this temporary table. Because MySql has to create a temporary table to store the result set and moves the data from the base tables to the temporary table, the `TEMPTABLE algorithm` is less efficient than the `MERGE algorithm`. In addition, a view that uses `TEMPTABLE algorithm` is not updatable.
* `UNDEFINED` is the default algorithm when you create a view without specifying an explicit algorithm. The `UNDEFINED algorithm` lets MySql make a choice of using `MERGE` or `TEMPTABLE` algorithm. MySql prefers `MERGE algorithm` to `TEMPTABLE algorithm` because the `MERGE algorithm` is much more efficient.

Feature | MERGE Algorithm | TEMPTABLE Algorithm
---|---|---|
Mechanism | Combines the incoming query with the query defined the view into one query. | Creates a temporary table based on the view definition.
Efficient | More efficient | Less efficient
Indexing | Yes | No
Viwe can be updatable | Yes | No
Work with aggregate functions, Unions and LIMIT | No | Yes
Work with no refers to tables | No | Yes

**SELECT statement**

In the `SELECT` statement, you can query data from any table or view that exists in the database. There are several rules that the `SELECT` statement must follow:
* The `SELECT` statement can contain a `subquery` in `WHERE` clause but not in the `FROM` clause.
* The `SELECT` statement cannot refer to any variables including local variables, user variables, and session variables.
* The `SELECT` statement cannot refer to the parameters of prepared statements.

### Show Views
```sql
SHOW FULL TABLE;
```
The `table_type` column in the result set specifies which object is view and which object is a table.

### View Example
```sql
CREATE VIEW SalePerOrder AS
    SELECT
        orderNumber, SUM(quantityOrdered * priceEach) total
    FROM
        orderDetails
    GROUP by orderNumber
    ORDER BY total DESC;
```
Then you can select form view.
```sql
SELECT
    *
FROM
    SalePerOrder;
```

### Creating a View Based on Another View
We can use `SalePerOrder` view from the last example.
```sql
CREATE VIEW BigSalesOrder AS
    SELECT
        orderNumber, ROUND(total,2) as total
    FROM
        SalePerOrder
    WHERE
        total > 60000;
```

### Creating a View With Join
```sql
CREATE VIEW customerOrders AS
    SELECT
        d.orderNumber,
        customerName,
        SUM(quantityOrdered * priceEach) total
    FROM
        orderDetails d
    INNER JOIN
        orders o ON o.orderNumber = d.orderNumber
    INNER JOIN
        customers c ON c.customerNumber = c.customerNumber
    GROUP BY d.orderNumber
    ORDER BY total DESC;
```

### Creating a View With SubQuery
```sql
CREATE VIEW aboveAvgProducts AS
    SELECT
        productCode, productName, buyPrice
    FROM
        products
    WHERE
        buyPrice > (SELECT
                        AVG(buyPrice)
                    FROM
                        products)
    ORDER BY buyPrice DESC;
```
