# Loops Statements

* [WHILE loop](#while-loop)
* [REPEAT loop](#repeat-loop)
* [LOOP With LEAVE And ITERATE](#loop-with-leave-and-iterate)

MySQL provides loop statements that allow you to execute a block of SQL code repeatedly based on a condition. There are three loop statements in MySQL: `WHILE`, `REPEAT` and `LOOP`.

### WHILE loop
```sql
WHILE expression DO
   statements
END WHILE
```
Example
```sql
DELIMITER $$
DROP PROCEDURE IF EXISTS test_mysql_while_loop $$
CREATE PROCEDURE test_mysql_while_loop()
    BEGIN
        DECLARE x  INT;
        DECLARE str  VARCHAR(255);

        SET x = 1;
        SET str =  '';

        WHILE x  <= 5 DO
            SET  str = CONCAT(str,x,',');
            SET  x = x + 1;
        END WHILE;

        SELECT str;
    END $$
DELIMITER ;
```

### REPEAT loop
```sql
REPEAT
    statements;
UNTIL expression
END REPEAT
```
Example
```sql
DELIMITER $$
DROP PROCEDURE IF EXISTS mysql_test_repeat_loop$$
CREATE PROCEDURE mysql_test_repeat_loop()
    BEGIN
        DECLARE x INT;
        DECLARE str VARCHAR(255);

        SET x = 1;
        SET str =  '';

        REPEAT
            SET  str = CONCAT(str,x,',');
            SET  x = x + 1;
        UNTIL x  > 5
        END REPEAT;

        SELECT str;
    END$$
DELIMITER ;
```

### LOOP With LEAVE And ITERATE
* `LEAVE` = break
* `ITERATE` = continue

```sql
DELIMITER $$
CREATE PROCEDURE test_mysql_loop()
    BEGIN
        DECLARE x  INT;
        DECLARE str  VARCHAR(255);

        SET x = 1;
        SET str =  '';

        loop_label:  LOOP
            IF  x > 10 THEN
                LEAVE  loop_label;
            END  IF;

            SET  x = x + 1;

            IF  (x mod 2) THEN
                ITERATE  loop_label;
            ELSE
                SET  str = CONCAT(str,x,',');
            END  IF;
         END LOOP;

         SELECT str;
    END;
DELIMITER ;
```
