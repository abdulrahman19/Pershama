# CASE Statement

Besides the `IF` statement, MySQL provides an alternative conditional statement called the `CASE` statement. The `CASE` statement makes the code more readable and efficient.

The `ELSE` clause is optional. If you omit the `ELSE` clause and no match found, MySQL will raise an error.

There are two forms of the `CASE` statements:
* simple : check the value of an expression against a set of unique values.
* searched : In order to perform more complex matches such as ranges.

### Simple CASE
```sql
CASE case_expression
   WHEN when_expression_1 THEN commands
   WHEN when_expression_2 THEN commands
   ...
   ELSE commands
END CASE;
```
Example
```sql
DELIMITER $$
CREATE PROCEDURE GetCustomerShipping(
    in  p_customerNumber int(11),
    out p_shiping        varchar(50)
)
    BEGIN
        DECLARE customerCountry varchar(50);

        SELECT country INTO customerCountry
        FROM customers
        WHERE customerNumber = p_customerNumber;

        CASE customerCountry
            WHEN  'USA' THEN
                SET p_shiping = '2-day Shipping';
            WHEN 'Canada' THEN
                SET p_shiping = '3-day Shipping';
            ELSE
                SET p_shiping = '5-day Shipping';
        END CASE;
    END $$
DELIMITER ;
```

### searched CASE
```sql
CASE
    WHEN condition_1 THEN commands
    WHEN condition_2 THEN commands
   ...
   ELSE commands
END CASE;
```
Example
```sql
DELIMITER $$
CREATE PROCEDURE GetCustomerLevel(
    in  p_customerNumber int(11),
    out p_customerLevel  varchar(10)
)
    BEGIN
        DECLARE creditlim double;

        SELECT creditlimit INTO creditlim
        FROM customers
        WHERE customerNumber = p_customerNumber;

        CASE
            WHEN creditlim > 50000 THEN
                SET p_customerLevel = 'PLATINUM';
            WHEN (creditlim <= 50000 AND creditlim >= 10000) THEN
                SET p_customerLevel = 'GOLD';
            WHEN creditlim < 10000 THEN
                SET p_customerLevel = 'SILVER';
        END CASE;
    END$$
DELIMITER ;
```
