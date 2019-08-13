# Emulate CHECK Constraint

* [What The CHECK Constraint?](#what-the-check-constraint)
* [Emulate CHECK With Triggers](#emulate-check-with-triggers)
* [Emulate CHECK With Views](#emulate-check-with-views)

### What The CHECK Constraint?
Standard SQL provides `CHECK` constraints that specify a value in a certain column must satisfy a Boolean expression. For example, you can add a `CHECK` constraint to enforce the cost of a part to be positive as follows:
```sql
CREATE TABLE IF NOT EXISTS parts_data (
    part_no VARCHAR(18) PRIMARY KEY,
    description VARCHAR(40),
    cost DECIMAL(10 , 2 ) NOT NULL CHECK(cost > 0),
    price DECIMAL (10,2) NOT NULL
);
```

### Emulate CHECK With Triggers
The first way to  simulate the `CHECK` constraint in MySQL, we use two triggers: `BEFORE INSERT` and `BEFORE UPDATE`.

1- Create a `stored procedure` to check the values in the cost and price columns.
```sql
DELIMITER $$
CREATE PROCEDURE `check_parts`(IN cost DECIMAL(10,2), IN price DECIMAL(10,2))
    BEGIN
        IF cost < 0 THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'check constraint on parts.cost failed';
        END IF;

        IF price < 0 THEN
            SIGNAL SQLSTATE '45001'
                SET MESSAGE_TEXT = 'check constraint on parts.price failed';
        END IF;

        IF price < cost THEN
            SIGNAL SQLSTATE '45002'
                SET MESSAGE_TEXT = 'check constraint on parts.price & parts.cost failed';
        END IF;
    END $$
DELIMITER ;
```
2- Create `BEFORE INSERT` and `BEFORE UPDATE` triggers. Inside the triggers, call the `check_parts()` stored procedure.
```sql
-- before insert
DELIMITER $$
CREATE TRIGGER `parts_before_insert` BEFORE INSERT ON `parts_data`
FOR EACH ROW
    BEGIN
        CALL check_parts(new.cost,new.price);
    END $$
DELIMITER ;
-- before update
DELIMITER $$
CREATE TRIGGER `parts_before_update` BEFORE UPDATE ON `parts_data`
FOR EACH ROW
    BEGIN
        CALL check_parts(new.cost,new.price);
    END $$
DELIMITER ;
```

### Emulate CHECK With Views
The idea is to create a filter layer by creating a view between the applications and the base table.
```sql
-- before insert
CREATE VIEW parts AS
    SELECT
        part_no, description, cost, price
    FROM
        parts_data
    WHERE
        cost > 0 AND price > 0 AND price >= cost
WITH CHECK OPTION;
```
Form this point, we need to make all the `INSERT` operations are done from the view `parts` not from the base table `parts_data` to be sure from satisfy the conditions.
