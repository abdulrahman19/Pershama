# Stored Procedure Cheat Sheet

* [Introduction](#introduction)
* [Variables](#variables)
* [Parameters](#parameters)
* [IF Statement](#if-statement)
* [CASE Statement](#case-statement)

### Introduction
A stored procedure is a segment of declarative SQL statements stored inside the database catalog. <br>
A stored procedure that calls itself is known as a `recursive stored procedure`.

**Stored Procedures Advantages**

* Stored procedures help increase the performance of the applications. Once created, stored procedures are compiled and stored in the database. MySQL stored procedures are compiled on demand. After compiling a stored procedure, MySQL puts it into a cache and maintains its own stored procedure cache for every single connection. If an application uses a stored procedure multiple times in a single connection, the compiled version is used, otherwise, the stored procedure works like a query.
* Stored procedures help reduce the traffic between application and database server.
* Stored procedures are reusable and transparent to any applications.
* Stored procedures are secure.

**Stored Procedures Disadvantages**

* If you use many stored procedures, the memory usage of every connection that is using those stored procedures will increase substantially. In addition, if you overuse a large number of logical operations inside stored procedures, the CPU usage will increase because the database server is not well-designed for logical operations.
* Stored procedure’s constructs are not designed for developing complex and flexible business logic.
* MySQL does not provide facilities for debugging stored procedures.
* It is not easy to develop and maintain stored procedures.

**Create Stored Procedure**
```sql
DELIMITER $$
    CREATE PROCEDURE GetAllProducts()
        BEGIN
            SELECT *  FROM products;
        END $$
 DELIMITER ;
```

**Call Stored Procedure**
```sql
CALL GetAllProducts();
```

### Variables
**Declaring Variables**
```sql
DECLARE variable_name[, variable_name2 ..] datatype(size) DEFAULT default_value;
```

**Assigning Variables**
```sql
DECLARE total_count INT DEFAULT 0;

SET total_count = 10;
# or by using select into
SELECT
   COUNT(*) INTO total_count
FROM
   products;
```

**Variables Scope**
* If you declare a variable inside `BEGIN END` block, it will be out of scope if the `END` is reached.
* A variable whose name begins with the `@` sign is a session variable. It is available and accessible until the session ends.

### Parameters
The parameters make the stored procedure more flexible and useful. In MySQL, a parameter has one of three modes: `IN`,`OUT`, or `INOUT`.
* `IN` – is the default mode. When you define an `IN` parameter in a stored procedure, the calling program has to pass an argument to the stored procedure. In addition, the stored procedure only works on the copy of the `IN` parameter. That's mean its original value is retained after the stored procedure ends.
* `OUT` [return] – the value of an `OUT` parameter can be changed inside the stored procedure and its new value is passed back to the calling program. Notice that the stored procedure cannot access the initial value of the `OUT` parameter when it starts.
* `INOUT` – an `INOUT` parameter is a combination of `IN` and `OUT` parameters. It means that the calling program may pass the argument, and the stored procedure can modify the `INOUT` parameter, and pass the new value back to the calling program.

```sql
MODE param_name param_type(param_size)

IN countryName VARCHAR(255)
```

### IF Statement
```sql
IF expression THEN
   statements;
[
ELSEIF elseif-expression THEN
   elseif-statements;
...
ELSE
   else-statements;
]
END IF;
```

### CASE Statement
There are two forms of the `CASE` statements:
* simple : check the value of an expression against a set of unique values.
```sql
CASE case_expression
   WHEN when_expression_1 THEN commands
   WHEN when_expression_2 THEN commands
   ...
   [ELSE commands]
END CASE;
```
* searched : In order to perform more complex matches such as ranges.
```sql
CASE
    WHEN condition_1 THEN commands
    WHEN condition_2 THEN commands
   ...
   [ELSE commands]
END CASE;
```

