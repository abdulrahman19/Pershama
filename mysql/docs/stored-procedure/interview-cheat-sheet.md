# Stored Procedure Cheat Sheet

* [Introduction](#introduction)
* [Variables](#variables)
* [Parameters](#parameters)
* [IF Statement](#if-statement)
* [CASE Statement](#case-statement)
* [Loops Statements](#loops-statements)
* [Cursor](#cursor)
* [Listing Stored Procedures](#listing-stored-procedures)
* [Error Handling](#error-handling)
* [Raising Error Conditions](#raising-error-conditions)

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

### Loops Statements
**WHILE loop**
```sql
WHILE expression DO
   statements
END WHILE
```
**REPEAT loop**
```sql
REPEAT
    statements;
UNTIL expression
END REPEAT
```
**LOOP With LEAVE And ITERATE**
* `LEAVE` = break
* `ITERATE` = continue
```sql
loop_label:  LOOP
    expression
      [LEAVE loop_label / ITERATE loop_label / statements ]
END LOOP
```

### Cursor
A cursor allows you to iterate a set of rows returned by a query and process each row accordingly. It's like `foreach` functionality in PHP.

MySQL cursor is read-only, non-scrollable and asensitive.

* **Read-only**: you cannot update data in the underlying table through the cursor.
* **Non-scrollable**: you can only fetch rows in the order determined by the `SELECT` statement.
* **Asensitive**: An asensitive cursor points to the actual data, whereas an insensitive cursor uses a temporary copy of the data. any change that made to the data from other connections will affect the data that is being used by an asensitive cursor.

**How To Create Cursor**

1- Declare the cursor after any variable declaration.
```sql
DECLARE cursor_name CURSOR FOR SELECT_statement;
```
2- declare a `NOT FOUND` handler.
```sql
DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
```
3- You open the cursor by using the `OPEN` statement.
```sql
OPEN cursor_name;
```
4- you use the `FETCH` statement to retrieve the next row pointed by the cursor and move the cursor to the next row in the result.
```sql
FETCH cursor_name INTO variables list;
```
5- `CLOSE` statement to deactivate the cursor and release the memory associated with it.
```sql
CLOSE cursor_name;
```

### Listing Stored Procedures
**Displaying Characteristics Of Stored Procedures**
```sql
SHOW PROCEDURE STATUS [LIKE 'pattern' | WHERE expr];
```
**Displaying Stored Procedure’s Source Code**
```sql
SHOW CREATE PROCEDURE stored_procedure_name;
```

### Error Handling
To declare a handler, you use the `DECLARE HANDLER` statement as follows:
```sql
DECLARE action HANDLER FOR condition_value statement;
```
The `action` accepts one of the following values:
* **CONTINUE** :  the execution of the enclosing code block ( `BEGIN … END` ) continues.
* **EXIT** : the execution of the enclosing code block, where the handler is declared, terminates.

The `condition_value` accepts one of the following values:
* A MySQL error code.
* A standard `SQLSTATE` value. Or it can be an `SQLWARNING` , `NOTFOUND` or `SQLEXCEPTION` condition, which is shorthand for the class of `SQLSTATE` values. The `NOTFOUND` condition is used for a `cursor` or `SELECT INTO variable_list` statement.
* A named condition associated with either a MySQL error code or `SQLSTATE` value.

**Error Handler Precedence**

Based on the handler precedence’s rules, this is the order for calling:
* MySQL error code handler
* `SQLSTATE` handler
* `SQLEXCEPTION` handler

**Named Error Condition**

Fortunately, MySQL provides us with the `DECLARE CONDITION` statement that declares a named error condition, which associates with a condition.
```sql
DECLARE condition_name CONDITION FOR condition_value;
```
Notice that the condition declaration must appear before handler or cursor declarations.

Example
```sql
DELIMITER $$
CREATE PROCEDURE insert_article_tags(IN article_id INT, IN tag_id INT)
    BEGIN
        DECLARE duplicate_keys CONDITION for 1062;
        DECLARE CONTINUE HANDLER FOR duplicate_keys
                SELECT CONCAT('duplicate keys (',article_id,',',tag_id,') found') AS msg;

        -- insert a new record into article_tags
        INSERT INTO article_tags(article_id,tag_id)
        VALUES(article_id,tag_id);

        -- return tag count for the article
        SELECT COUNT(*) FROM article_tags;
    END
DELIMITER ;
```

### Raising Error Conditions
With `SIGNAL` and `RESIGNAL` you can handle your own errors and warnings. To raise a condition, use the `SIGNAL` statement. To modify condition information within a condition handler, use `RESIGNAL`.

**SIGNAL**

`SIGNAL` is the way to “return” an error. `SIGNAL` provides error or warning information to a handler, to an outer portion of the application, or to the client. Also, it provides control over the error's characteristics (`error number`, `SQLSTATE value`, `message`).
```sql
SIGNAL SQLSTATE | condition_name
SET condition_information_item_name_1 = value_1,
    condition_information_item_name_1 = value_2, etc;
```
Notice that the `SIGNAL` statement must always specify a `SQLSTAT` value or a named condition that defined with an `SQLSTATE` value.

**RESIGNAL**

`RESIGNAL` is so useful if you will use the same message in many places inside the procedure. instead of write them many times by `SIGNAL` you can put them in one place with `RESIGNAL`.

The `RESIGNAL` statement is similar to `SIGNAL` statement in term of functionality and syntax, except that:
* You must use the `RESIGNAL` statement within an error or warning handler, otherwise, you will get an error message saying that `RESIGNAL` when handler is not active. Notice that you can use `SIGNAL` statement anywhere inside a stored procedure.
* You can omit all attributes of the `RESIGNAL` statement, even the `SQLSTATE` value.
```sql
SIGNAL [SQLSTATE | condition_name]
[SET condition_information_item_name_1 = value_1,
    condition_information_item_name_1 = value_2, etc;]
```
