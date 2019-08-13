# Create Triggers

* [Trigger Example](#trigger-example)
* [Create Multiple Triggers For Same Event And Action](#create-multiple-triggers-for-same-event-and-action)

In order to create a new trigger, you use the `CREATE TRIGGER` statement.
```sql
CREATE TRIGGER trigger_name
    [BEFORE|AFTER] [INSERT|UPDATE|DELETE] ON table_name
    FOR EACH ROW
    BEGIN
        ...
    END;
```

### Trigger Example
```sql
DELIMITER $$
CREATE TRIGGER before_employee_update
    BEFORE UPDATE ON employees
    FOR EACH ROW
    BEGIN
        INSERT INTO employees_audit
        SET action = 'update',
            employeeNumber = OLD.employeeNumber,
            lastname = OLD.lastname,
            changedat = NOW();
    END $$
DELIMITER ;
```
Inside the body of the trigger, we used the `OLD` keyword to access `employeeNumber` and `lastname` column of the row affected by the trigger. Notice that in a trigger defined for `INSERT`, you can use `NEW` keyword only. You cannot use the `OLD` keyword. However, in the trigger defined for `DELETE`, there is no new row so you can use the `OLD` keyword only. In the `UPDATE` trigger, `OLD` refers to the row before it is updated and `NEW` refers to the row after it is updated.

### Create Multiple Triggers For Same Event And Action
After MySQL 5.7.2+ you allow to create multiple triggers for the same event and action time in a table. The triggers will activate sequentially when the event occurs.

The following is the syntax of creating a new additional trigger with explicit order:
```sql
DELIMITER $$
CREATE TRIGGER  trigger_name
    [BEFORE|AFTER] [INSERT|UPDATE|DELETE] ON table_name
    FOR EACH ROW [FOLLOWS|PRECEDES] existing_trigger_name
    BEGIN
        …
    END $$
DELIMITER ;
```
* The `FOLLOWS` option allows the new trigger to activate after the existing trigger.
* The `PRECEDES` option allows the new trigger to activate before the existing trigger.

**Multiple Triggers Example**
```sql
DELIMITER $$
CREATE TRIGGER before_products_update
    BEFORE UPDATE ON products
    FOR EACH ROW
    BEGIN
        INSERT INTO price_logs(product_code,price)
        VALUES(old.productCode,old.msrp);
    END $$
DELIMITER ;
```
Second trigger
```sql
DELIMITER $$
CREATE TRIGGER before_products_update_2
    BEFORE UPDATE ON products
    FOR EACH ROW FOLLOWS before_products_update
    BEGIN
        INSERT INTO user_change_logs(product_code,updated_by)
        VALUES(old.productCode,user());
    END $$
DELIMITER ;
```

**Information On Triggers Order**

To find this information, you need to query the action_order column in the triggers table of the information_schema database as follows:
```sql
SELECT
    trigger_name, action_order
FROM
    information_schema.triggers
WHERE
    trigger_schema = 'classicmodels'
ORDER BY
    event_object_table ,
    action_timing ,
    event_manipulation;
```
