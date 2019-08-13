# Stored Procedure Variables

* [Declaring Variables](#declaring-variables)
* [Assigning Variables](#assigning-variables)
* [Variables Scope](#variables-scope)

A variable is a named data object whose value can change during the stored procedure execution. And you must declare a variable before using it.

### Declaring Variables
```sql
DECLARE variable_name datatype(size) DEFAULT default_value;

DECLARE total_sale INT DEFAULT 0;
DECLARE x, y INT DEFAULT 0;
```

### Assigning Variables
```sql
DECLARE total_count INT DEFAULT 0;

SET total_count = 10;
# or by using select into
SELECT
   COUNT(*) INTO total_count
FROM
   products;
```

### Variables Scope
* If you declare a variable inside `BEGIN END` block, it will be out of scope if the `END` is reached.
* A variable whose name begins with the `@` sign is a session variable. It is available and accessible until the session ends.

```sql
CREATE PROCEDURE prc_test ()
BEGIN
    DECLARE var2 INT DEFAULT 1;
    SET var2 = var2 + 1;
    SET @var2 = @var2 + 1;
    SELECT  var2, @var2;
END;

# test it by calling prc_test() every time.
SET @var2 = 1;
CALL prc_test();
# var2 | @var2
# 2 | 2
# 2 | 3
# 2 | 4
# ...
```
