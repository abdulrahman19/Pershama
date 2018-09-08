# Stored Function

* [Stored Function Example](#stored-function-example)
* [Function vs Procedure](#function-vs-procedure)

A stored function is a special kind stored program that **returns a single value**. You use stored functions to encapsulate common formulas or business rules that are reusable among SQL statements or stored programs.
```sql
CREATE FUNCTION function_name(param1,param2,…) RETURNS datatype
    [NOT] DETERMINISTIC
    statements
    ...
```
You must specify the data type of the return value in the `RETURNS` statement. It can be any valid MySQL data types.

Unlike SQL standard, You can call stored procedure inside stored function and use DML statements.

**DETERMINISTIC**

The main purpose of the `DETERMINISTIC` flag is to tell MySQL the stored function will Returns same result for same input.

Consider a situation where you have replication set up between two databases. The master database keeps a log of all the stored routines that were executed including their input parameters, and ships this log to the the slave. The slave executes the same stored routines in the same order with the same input parameters. Will the slave database now contain identical data to the master database? If the stored routines create GUIDs (globally unique identifiers) and store these in the database then no, the master and slave databases will be different and replication will be broken.

When deciding if the `DETERMINISTIC` flag is appropriate for a stored routine think of it like this: If I start with two identical databases and I execute my routine on both databases with the same input parameters will my databases still be identical? If they are then my routine is deterministic.

If you declare your routine is deterministic when it is not, then replicas of your main database might not be identical to the original because MySQL will only add the procedure call to the replication log, and executing the procedure on the slave does not produce identical results.

If your routine is non-deterministic then MySQL must include the affected rows in the replication log instead. If you declare your routine as non-deterministic when it is not this will not break anything, but the replication log will contain all of the affected rows when just the procedure call would have been enough and this could impact performance.

DETERMINISTIC | NON-DETERMINISTIC
---|---|
Returns same result for same input. | Returns different result for same input.
deterministic giving significant time for execution if it is giving same result. | Executing method definition again and again for same input. Take more execution time compare than deterministic.
When using nondeterministic for deterministic type of functions will take unwanted execution time. <br> Because unwantly executing again and again for the same output. | When using deterministic for nondeterministic methods might return wrong results. <br> Because not executing for getting different outside at all time for the same input.

### Stored Function Example
The following example is a function that returns the level of a customer based on credit limit. We use the IF statement to determine the credit limit.
```sql
DELIMITER $$
CREATE FUNCTION CustomerLevel(p_creditLimit double) RETURNS VARCHAR(10)
    DETERMINISTIC
    BEGIN
        DECLARE lvl varchar(10);

        IF p_creditLimit > 50000 THEN
            SET lvl = 'PLATINUM';
        ELSEIF (p_creditLimit <= 50000 AND p_creditLimit >= 10000) THEN
            SET lvl = 'GOLD';
        ELSEIF p_creditLimit < 10000 THEN
            SET lvl = 'SILVER';
        END IF;

        RETURN (lvl);
    END
DELIMITER ;
```
Now, we can call the `CustomerLevel()` in a `SELECT` statement as follows:
```sql
SELECT
    customerName,
    CustomerLevel(creditLimit)
FROM
    customers
ORDER BY
    customerName;
```

### Function vs Procedure
Function | Procedure
---|---|
Normally used for computations | normally used for executing business logic.
Must returns one value using the return statement | May return zero, one or more values through parameters (max 1024).
Doesn't have pre-compiled execution plan. | Has a pre-compiled execution plan.
Can be called directly by SQL statement | cannot
