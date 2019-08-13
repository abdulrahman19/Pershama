# IF Statement

* [IF Statement](#if-statement)
* [IF-ELSE Statement](#if-else-statement)
* [IF-ELSEIF-ELSE Statement](#if-elseif-else-statement)
* [Example](#example)

The MySQL IF statement allows you to execute a set of SQL statements based on a certain condition or value of an expression. To form an expression in MySQL, you can combine literals, variables, operators, and even functions. An expression can return `TRUE` `FALSE`, or `NULL`.

### IF Statement
```sql
IF expression THEN
   statements;
END IF;
```

### IF-ELSE Statement
```sql
IF expression THEN
   statements;
ELSE
   else-statements;
END IF;
```

### IF-ELSEIF-ELSE Statement
```sql
IF expression THEN
   statements;
ELSEIF elseif-expression THEN
   elseif-statements;
...
ELSE
   else-statements;
END IF;
```

### Example
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

        IF creditlim > 50000 THEN
            SET p_customerLevel = 'PLATINUM';
        ELSEIF (creditlim <= 50000 AND creditlim >= 10000) THEN
            SET p_customerLevel = 'GOLD';
        ELSEIF creditlim < 10000 THEN
            SET p_customerLevel = 'SILVER';
        END IF;
    END $$
DELIMITER ;
```
