# Stored Procedure Parameters

* [IN Parameter Example](#in-parameter-example)
* [OUT Parameter Example](#out-parameter-example)
* [INOUT Parameter Example](#inout-parameter-example)

The parameters make the stored procedure more flexible and useful. In MySQL, a parameter has one of three modes: `IN`,`OUT`, or `INOUT`.
* `IN` – is the default mode. When you define an `IN` parameter in a stored procedure, the calling program has to pass an argument to the stored procedure. In addition, the stored procedure only works on the copy of the `IN` parameter. That's mean its original value is retained after the stored procedure ends.
* `OUT` [return] – the value of an `OUT` parameter can be changed inside the stored procedure and its new value is passed back to the calling program. Notice that the stored procedure cannot access the initial value of the `OUT` parameter when it starts.
* `INOUT` – an `INOUT` parameter is a combination of `IN` and `OUT` parameters. It means that the calling program may pass the argument, and the stored procedure can modify the `INOUT` parameter, and pass the new value back to the calling program.

### IN Parameter Example
```sql
DELIMITER $$
CREATE PROCEDURE GetOfficeByCountry(IN countryName VARCHAR(255))
    BEGIN
        SELECT *
        FROM offices
        WHERE country = countryName;
    END $$
DELIMITER ;

CALL GetOfficeByCountry('USA');
```

### OUT Parameter Example
```sql
DELIMITER $$
CREATE PROCEDURE CountOrderByStatus(
    IN orderStatus VARCHAR(25),
    OUT total INT
)
    BEGIN
        SELECT count(orderNumber)
        INTO total
        FROM orders
        WHERE status = orderStatus;
    END $$
DELIMITER ;

CALL CountOrderByStatus('Shipped',@total);
SELECT @total;
```

### INOUT Parameter Example
```sql
DELIMITER $$
CREATE PROCEDURE set_counter(
    INOUT count INT(4),
    IN inc INT(4)
)
    BEGIN
        SET count = count + inc;
    END $$
DELIMITER ;

SET @counter = 1;
CALL set_counter(@counter,1); -- 2
CALL set_counter(@counter,1); -- 3
CALL set_counter(@counter,5); -- 8
SELECT @counter; -- 8
```
