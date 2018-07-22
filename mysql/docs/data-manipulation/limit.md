# LIMIT

* [Introduction](#introduction) <br>
    * Using MySQL LIMIT to get the first N rows
    * Using MySQL LIMIT to get the nth highest value

### Introduction
```sql
SELECT
    column1,column2,...
FROM
    table
LIMIT offset , count;
```
Let’s examine the LIMIT clause parameters:
* The offset specifies the offset of the first row to return. The offset of the first row is 0, not 1.
* The count specifies the maximum number of rows to return.

**Using MySQL LIMIT to get the first N rows**
```sql
SELECT
    customernumber,
    customername,
    creditlimit
FROM
    customers
LIMIT 10;
```

**Using MySQL LIMIT to get the nth highest value**
```sql
SELECT
    customernumber,
    customername,
    creditlimit
FROM
    customers
LIMIT 2, 10;
```
