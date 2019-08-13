# Error Handling in Stored Procedures

* [Declaring a Handler](#declaring-a-handler)
* [Error Handling Examples](#error-handling-examples)
* [Error Handler Example In Stored Procedures](#error-handler-example-in-stored-procedures)
* [Error Handler Precedence](#error-handler-precedence)
* [Named Error Condition](#named-error-condition)


When an error occurs inside a stored procedure, it is important to handle it appropriately, such as continuing or exiting the current code block’s execution, and issuing a meaningful error message.

### Declaring a Handler
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

### Error Handling Examples
One of examples what we used in a [cursor](./cursor.md) `NOT FOUND` handler.
```sql
DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
```

Another handler which means that in case an error occurs, rollback the previous operation, issue an error message, and exit the current code block. If you declare it inside the `BEGIN END` block of a stored procedure, it will terminate stored procedure immediately.
```sql
DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
    ROLLBACK;
    SELECT 'An error has occurred, operation rollbacked and the stored procedure was terminated';
END;
```

### Error Handler Example In Stored Procedures
Imagine that we have `article_tags` table stores the relationships many-to-many between articles and tags. Each article may have many tags and vice versa.

Then we need if a duplicate key error occurs, MySQL error `1062` is issued. It issues an error message and continues execution.

```sql
DELIMITER $$
CREATE PROCEDURE insert_article_tags(IN article_id INT, IN tag_id INT)
    BEGIN
        DECLARE CONTINUE HANDLER FOR 1062
                SELECT CONCAT('duplicate keys (',article_id,',',tag_id,') found') AS msg;

        -- insert a new record into article_tags
        INSERT INTO article_tags(article_id,tag_id)
        VALUES(article_id,tag_id);

        -- return tag count for the article
        SELECT COUNT(*) FROM article_tags;
    END
DELIMITER ;
```
Then let's call it
```sql
CALL insert_article_tags(1,1);
CALL insert_article_tags(1,2);
CALL insert_article_tags(1,3);

CALL insert_article_tags(1,3);
```

When the duplicate key error occurs, It'll show two messages, because we declared the handler as a `CONTINUE` handler, the stored procedure continued the execution. As the result, we got the tag count for the article as well.

If we declared the handler as a `EXIT` handler, It'll shows only the error message.

### Error Handler Precedence
Based on the handler precedence’s rules, this is the order for calling:
* MySQL error code handler
* `SQLSTATE` handler
* `SQLEXCEPTION` handler

Example
```sql
DELIMITER $$
CREATE PROCEDURE insert_article_tags(IN article_id INT, IN tag_id INT)
    BEGIN
        DECLARE EXIT HANDLER FOR 1062 SELECT 'Duplicate keys error encountered';
        DECLARE EXIT HANDLER FOR SQLEXCEPTION SELECT 'SQLException encountered';
        DECLARE EXIT HANDLER FOR SQLSTATE '23000' SELECT 'SQLSTATE 23000';

        -- insert a new record into article_tags
        INSERT INTO article_tags(article_id,tag_id)
        VALUES(article_id,tag_id);

        -- return tag count for the article
        SELECT COUNT(*) FROM article_tags;
    END
DELIMITER ;
```
When the duplicate key error occurs, the `Duplicate keys error encountered` error message will appears.

### Named Error Condition
Imagine that we have this error handler declaration.
```sql
DECLARE EXIT HANDLER FOR 1051 SELECT 'Please create table abc first';
SELECT * FROM abc;
```
Now, What does the number `1051` really mean?

Imagine you have a big stored procedure polluted with those numbers all over places; it will become a nightmare to maintain the code.

Fortunately, MySQL provides us with the `DECLARE CONDITION` statement that declares a named error condition, which associates with a condition.

```sql
DECLARE condition_name CONDITION FOR condition_value;

# example
DECLARE table_not_found CONDITION for 1051;
DECLARE EXIT HANDLER FOR table_not_found SELECT 'Please create table abc first';
SELECT * FROM abc;
```
Notice that the condition declaration must appear before handler or cursor declarations.
