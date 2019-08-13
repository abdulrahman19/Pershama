# WHERE

* [MySQL WHERE](#mysql-where) <br>
* [AND](#and) <br>
* [OR](#or) <br>
    * Operator precedence
* [IN](#in) <br>
* [BETWEEN](#between) <br>
* [LIKE](#like) <br>
    * MySQL LIKE with ESCAPE clause
* [IS NULL / IS NOT NULL](#is-null--is-not-null) <br>

### MySQL WHERE
We use MySQL `WHERE` clause with `SELECT`, `UPDATE` and `DELETE` statements to filter rows in the result set.
```sql
SELECT
    lastname, firstname, jobtitle
FROM
    employees
WHERE
    jobtitle = 'Sales Rep';
```

Operator | Description
--- | --- |
`=` | Equal to. You can use it with almost any data types.
`<>` or `!=` | Not equal to.
`<` | Less than. You typically use it with numeric and date/time data types.
`>` | Greater than.
`<=` | Less than or equal to
`>=` | Greater than or equal to

### AND
The `AND` operator is a logical operator that combines two or more Boolean expressions and returns true only if both expressions evaluate to true.

`AND` use with `WHERE` and `JOIN` statements.
```sql
WHERE boolean_expression_1 AND boolean_expression_2

JOIN bla ON boolean_expression_1 AND boolean_expression_2
```
When evaluating an expression that has the `AND` operator, MySQL evaluates the remaining parts of the expression until it can determine the result. This function is called `short-circuit evaluation`.

### OR
The MySQL `OR` operator combines two Boolean expressions and returns true when either condition is true.

`OR` use with `WHERE` and `JOIN` statements.
```sql
WHERE boolean_expression_1 OR boolean_expression_2

JOIN bla ON boolean_expression_1 OR boolean_expression_2
```
MySQL uses `short-circuit evaluation` for the `OR` operator.

**Operator precedence**

When you use more than one logical operator in an expression, MySQL evaluates the `OR` operators after the `AND` operators. <br>
To change the order of evaluation, you use the parentheses.
```sql
SELECT (true OR false) AND false;
```

### IN
The `IN` operator allows you to determine if a specified value matches any one of a list or a `subquery`.
```sql
SELECT
    column1,column2,...
FROM
    table_name
WHERE
    (expr|column_1) IN ('value1','value2',...);
```
* You can use a column or an expression ( expr ) with the `IN` operator in the `WHERE` clause.
* The values in the list must be separated by a comma (,).
* The `IN` operator can also be used in the `WHERE` clause of other statements such as `INSERT`, `UPDATE`, `DELETE`, etc.

When the values in the list are all constants:

* First, MySQL evaluates the values based on the type of the `column_1` or result of the `expr` expression.
* Second, MySQL sorts the values.
* Third, MySQL searches for values using `binary search` algorithm. Therefore, a query that uses the `IN` operator with a list of constants will perform very fast.
```sql
SELECT
    officeCode, city, phone, country
FROM
    offices
WHERE
    country IN ('USA' , 'France');
    # or use NOT IN
```
Or `subquery`.
```sql
SELECT
    orderNumber, customerNumber, status, shippedDate
FROM
    orders
WHERE
    orderNumber IN (SELECT
                        orderNumber
                    FROM
                        orderDetails
                    GROUP BY orderNumber
                    HAVING SUM(quantityOrdered * priceEach) > 60000);
```
When the comparison list only contains the `NULL` value, then any value compared to that list returns `FALSE`.

> Use `IN` with static list and `EXITS` with `subquery`, for more information check `subquery` section.

### BETWEEN
The `BETWEEN` operator allows you to specify a range to test. We often use the `BETWEEN` operator in the `WHERE` clause of the `SELECT`, `INSERT`, `UPDATE`, and `DELETE` statements.
```sql
expr [NOT] BETWEEN begin_expr AND end_expr;
```
All three expressions: expr, begin_expr, and end_expr must have the same data type.
```sql
SELECT
    productCode, productName, buyPrice
FROM
    products
WHERE
    buyPrice BETWEEN 90 AND 100;
```
When you use the `BETWEEN` operator with date values, to get the best result, you should use the type cast to explicitly convert the type of column or expression to the `DATE` type.
```sql
SELECT orderNumber,
         requiredDate,
         status
FROM orders
WHERE requireddate
    BETWEEN CAST('2003-01-01' AS DATE)
        AND CAST('2003-01-31' AS DATE);
```

### LIKE
The `LIKE` operator is commonly used to select data based on patterns.

MySQL provides two wildcard characters for using with the LIKE operator, the percentage % and underscore _ .
* The percentage ( % ) wildcard allows you to match any string of zero or more characters.
* The underscore ( _ ) wildcard allows you to match any single character.
```sql
SELECT
    employeeNumber, lastName, firstName
FROM
    employees
WHERE
    lastname LIKE '%o_n%';
    # bla 'own' bla bla
```
**MySQL LIKE with ESCAPE clause**
```sql
SELECT
    productCode, productName
FROM
    products
WHERE
    productCode LIKE '%\_20%';
```
Or you can specify a different escape character e.g., $ by using the `ESCAPE` clause:
```sql
SELECT
    productCode, productName
FROM
    products
WHERE
    productCode LIKE '%$_20%' ESCAPE '$';
```

### IS NULL / IS NOT NULL
```sql
SELECT
    c.customerNumber,
    c.customerName,
    orderNumber,
    o.status
FROM
    customers c
        LEFT JOIN
    orders o ON c.customerNumber = o.customerNumber
WHERE
    orderNumber IS NULL;
    # or
    orderNumber IS NOT NULL;

```
