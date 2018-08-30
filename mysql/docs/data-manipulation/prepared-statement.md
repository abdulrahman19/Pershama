# Prepared Statement

Prior MySQL version 4.1, the query that sent to the MySQL server or receive from MySQL server is in the textual format. And the textual protocol has serious performance implication.

The prepared statement takes advantage of **client/server binary protocol**. It passes query that contains placeholders (`?`) to the MySQL server as the following example:
```sql
SELECT *
FROM products
WHERE productCode = ?;
```
When MySQL executes this query with different `productcode` values, it does not have to parse the query fully. As a result, this helps MySQL execute the query faster, especially when MySQL executes the query multiple times. Because the prepared statement uses placeholders (`?`), this helps avoid many variants of SQL injection hence make your application more secure.

In order to use MySQL prepared statement, you need to use other three MySQL statements as follows:
* `PREPARE` – Prepares statement for execution.
* `EXECUTE` – Executes a prepared statement preparing by a `PREPARE` statement.
* `DEALLOCATE` PREPARE – Releases a prepared statement.
```sql
PREPARE stmt1 FROM 'SELECT productCode, productName
                    FROM products
                    WHERE productCode = ?';

SET @pc = 'S10_1678';
EXECUTE stmt1 USING @pc;

DEALLOCATE PREPARE stmt1;
```
