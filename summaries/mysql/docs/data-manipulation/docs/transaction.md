# Transaction

* [Transaction Statements](#transaction-statements)
* [Transaction Example](#transaction-example)

MySQL transaction allows you to execute a set of MySQL operations to ensure that the database never contains the result of partial operations. In a set of operations, if one of them fails, the rollback occurs to restore the database to its original state. If no error occurs, the entire set of statements is committed to the database.

And you need to ensure the database engine support the transaction. Please check [here](../data-definition/table-types.md).

### Transaction Statements
MySQL provides us with the following important statement to control transactions:
* To start a transaction, you use the `START TRANSACTION` statement. The `BEGIN` or `BEGIN WORK` are the aliases of the `START TRANSACTION`.
* To commit the current transaction and make its changes permanent,  you use the `COMMIT` statement.
* To roll back the current transaction and cancel its changes, you use the `ROLLBACK` statement.
* To disable or enable the auto-commit mode for the current transaction, you use the `SET autocommit` statement.
```sql
SET autocommit = 0;
# or
SET autocommit = OFF;
```

### Transaction Example
In order to use a transaction, you first have to break the SQL statements into logical portions and determine when data should be committed or rolled back.

The following illustrates the step of creating a new sales order:
* First, start a transaction by using the `START TRANSACTION` statement.
* Next, select the latest sales order number from the `orders` table and use the next sales order number as the new sales order number.
* Then, insert a new sales order into the `orders` table.
* After that, insert sales order items into the `orderdetails` table.
* Finally, commit the transaction using the `COMMIT` statement.

```sql
-- 1. start a new transaction
START TRANSACTION;

-- 2. Get the latest order number
SELECT
    @orderNumber:=MAX(orderNUmber)+1
FROM
    orders;

-- 3. insert a new order for customer 145
INSERT INTO orders(orderNumber,
                   orderDate,
                   requiredDate,
                   shippedDate,
                   status,
                   customerNumber)
VALUES(@orderNumber,
       '2005-05-31',
       '2005-06-10',
       '2005-06-11',
       'In Process',
        145);

-- 4. Insert order line items
INSERT INTO orderdetails(orderNumber,
                         productCode,
                         quantityOrdered,
                         priceEach,
                         orderLineNumber)
VALUES(@orderNumber,'S18_1749', 30, '136', 1),
      (@orderNumber,'S18_2248', 50, '55.09', 2);

-- 5. commit changes
COMMIT;
```

What happen if you only want to test things, you can use `ROLLBACK` statement instead of `COMMIT` statement to return everything back.

```sql
...
...
      (@orderNumber,'S18_2248', 50, '55.09', 2);

-- 5. ROLLBACK changes
ROLLBACK;
```

Please note, if you didn't `COMMIT` your changes, the changes will effect only the current session but other sessions will not effect at all.
