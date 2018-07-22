# ORDER BY

* [Sort a Result Set](#sort-a-result-set) <br>
* [Sort By an Expression](#sort-by-an-expression) <br>
* [Custom Sort Order](#custom-sort-order) <br>

### Sort a Result Set
The `ORDER BY` clause allows you to:
* Sort a result set by a single column or multiple columns.
* Sort a result set by different columns in ascending or descending order.
```sql
SELECT column1, column2,...
FROM tbl
ORDER BY column1 [ASC|DESC], column2 [ASC|DESC],...
```
For example
```sql
SELECT
    contactLastname,
    contactFirstname
FROM
    customers
ORDER BY
    contactLastname DESC,
    contactFirstname ASC;
```

### Sort By an Expression
```sql
SELECT
    ordernumber,
    orderlinenumber,
    quantityOrdered * priceEach
    # or
    quantityOrdered * priceEach AS subtotal
FROM
    orderdetails
ORDER BY
    ordernumber,
    orderLineNumber,
    quantityOrdered * priceEach;
    # or
    subtotal
```

### Custom Sort Order
By using `FIELD` function.
```sql
SELECT
    orderNumber, status
FROM
    orders
ORDER BY FIELD(status,
        'In Process',
        'On Hold',
        'Cancelled',
        'Resolved',
        'Disputed',
        'Shipped');
```
