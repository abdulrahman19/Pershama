# Raising Error Conditions

* [SIGNAL Statement](#signal-statement)
* [RESIGNAL Statement](#resignal-statement)

### SIGNAL Statement
`SIGNAL` is the way to “return” an error. `SIGNAL` provides error or warning information to a handler, to an outer portion of the application, or to the client. Also, it provides control over the error's characteristics (`error number`, `SQLSTATE value`, `message`).

You can use it with `stored procedure`, `stored function`, `trigger` or `event`.
```sql
SIGNAL SQLSTATE | condition_name
SET condition_information_item_name_1 = value_1,
    condition_information_item_name_1 = value_2, etc;
```

Following the `SIGNAL` keyword is a `SQLSTATE` value or a `condition_name` that declared by the `DECLARE CONDITION` statement. <br>
Notice that the `SIGNAL` statement must always specify a `SQLSTATE` value or a named condition that defined with an `SQLSTATE` value.

The `condition_information_item_name` can be any of the following:
* CLASS_ORIGIN
* SUBCLASS_ORIGIN
* MESSAGE_TEXT
* MYSQL_ERRNO
* CONSTRAINT_CATALOG
* CONSTRAINT_SCHEMA
* CONSTRAINT_NAME
* CATALOG_NAME
* SCHEMA_NAME
* TABLE_NAME
* COLUMN_NAME
* CURSOR_NAME

Example
```sql
DELIMITER $$
CREATE PROCEDURE AddOrderItem(
    IN orderNo int,
    IN productCode varchar(45),
    IN qty int,
    IN price double,
    IN lineNo int
)
    BEGIN
        DECLARE C INT;

        SELECT COUNT(orderNumber) INTO C
        FROM orders
        WHERE orderNumber = orderNo;

        -- check if orderNumber exists
        IF(C != 1) THEN
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Order No not found in orders table';
        END IF;
     -- more code below
     -- ...
    END
DELIMITER ;
```
Notice that:
* `45000` is a generic `SQLSTATE` value that illustrates an `unhandled user-defined exception`.
* `01000` is a generic `SQLSTATE` value that illustrates an `unhandled user-defined warning`.

### RESIGNAL Statement
`RESIGNAL` is so useful if you will use the same message in many places inside the procedure. instead of write them many times by `SIGNAL` you can put them in one place with `RESIGNAL`.

The `RESIGNAL` statement is similar to `SIGNAL` statement in term of functionality and syntax, except that:
* You must use the `RESIGNAL` statement within an error or warning handler, otherwise, you will get an error message saying that `RESIGNAL when handler is not active`. Notice that you can use `SIGNAL` statement anywhere inside a stored procedure.
* You can omit all attributes of the `RESIGNAL` statement, even the `SQLSTATE` value.

`RESIGNAL` may change some or all information before passing it on.

If you use the `RESIGNAL` statement alone, all attributes are the same as the ones passed to the condition handler.
```sql
SIGNAL [SQLSTATE | condition_name]
[SET condition_information_item_name_1 = value_1,
    condition_information_item_name_1 = value_2, etc;]
```
Example
```sql
DELIMITER $$
CREATE PROCEDURE Divide(
    IN numerator INT,
    IN denominator INT,
    OUT result double
)
    BEGIN
        DECLARE division_by_zero CONDITION FOR SQLSTATE '22012';

        DECLARE CONTINUE HANDLER FOR division_by_zero
                RESIGNAL SET MESSAGE_TEXT = 'Division by zero / Denominator cannot be zero';
        --
        IF denominator = 0 THEN
            SIGNAL division_by_zero;
        ELSE
            SET result := numerator / denominator;
        END IF;
    END
DELIMITER ;
```
Output
```sql
Error Code: 1644. Division by zero / Denominator cannot be zero
```

Use the `RESIGNAL` statement alone.
```sql
DELIMITER $$
CREATE PROCEDURE Divide(
    IN numerator INT,
    IN denominator INT,
    OUT result double
)
    BEGIN
        DECLARE division_by_zero CONDITION FOR SQLSTATE '22012';

        DECLARE CONTINUE HANDLER FOR division_by_zero
                RESIGNAL;
        --
        IF denominator = 0 THEN
            SIGNAL division_by_zero
            SET MESSAGE_TEXT = 'SIGNAL Division by zero / Denominator cannot be zero';
        ELSE
            SET result := numerator / denominator;
        END IF;
    END
DELIMITER ;
```
Output
```sql
Error Code: 1644. SIGNAL Division by zero / Denominator cannot be zero
```

If you declared both `SIGNAL` and `RESIGNAL` message, `RESIGNAL` message will override `SIGNAL` message.

**Note**
```sql
 DECLARE CONTINUE HANDLER FOR division_by_zero
                RESIGNAL SET MESSAGE_TEXT = 'Division by zero / Denominator cannot be zero';
```
Unlike the Error handling with `DECLARE HANDLER` [here](error-handling.md#error-handler-example-in-stored-procedures) ,The `CONTINUE` statement here will not let the procedure execute other statements, because `RESIGNAL` here play like `return` statement in `PHP`, it'll end the procedure.
