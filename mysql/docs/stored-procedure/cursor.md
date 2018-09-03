# Stored Procedure Cursor

To handle a result set inside a stored procedure, you use a cursor. A cursor allows you to iterate a set of rows returned by a query and process each row accordingly. It's like `foreach` functionality in PHP.

MySQL cursor is read-only, non-scrollable and asensitive.

* **Read-only**: you cannot update data in the underlying table through the cursor.
* **Non-scrollable**: you can only fetch rows in the order determined by the `SELECT` statement. You cannot fetch rows in the reversed order. In addition, you cannot skip rows or jump to a specific row in the result set.
* **Asensitive**: there are two kinds of cursors: asensitive cursor and insensitive cursor. An asensitive cursor points to the actual data, whereas an insensitive cursor uses a temporary copy of the data. An asensitive cursor performs faster than an insensitive cursor because it does not have to make a temporary copy of data. However, any change that made to the data from other connections will affect the data that is being used by an asensitive cursor, therefore, it is safer if you do not update the data that is being used by an asensitive cursor. **MySQL cursor is asensitive**.

You can use MySQL cursors in `stored procedures`, `stored functions`, and `triggers`.

### How To Create Cursor
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

### Cursor Example
We are going to develop a stored procedure that builds an email list of all employees.

```sql
DELIMITER $$
CREATE PROCEDURE build_email_list (INOUT email_list varchar(4000))
    BEGIN
        DECLARE v_finished INTEGER DEFAULT 0;
        DECLARE v_email varchar(100) DEFAULT "";

        -- declare cursor for employee email
        DEClARE email_cursor CURSOR FOR
                SELECT email FROM employees;

        -- declare NOT FOUND handler
        DECLARE CONTINUE HANDLER
                FOR NOT FOUND SET v_finished = 1;

        -- OPEN the cursor
        OPEN email_cursor;
            -- LOOP to get all employee emails
            get_email: LOOP
                FETCH email_cursor INTO v_email;

                -- leave when finished
                IF v_finished = 1 THEN
                    LEAVE get_email;
                END IF;

                -- build email list
                SET email_list = CONCAT(v_email,";",email_list);

            END LOOP get_email;
        CLOSE email_cursor;
    END $$
DELIMITER ;
```
Call the procedure
```sql
SET @email_list = "";
CALL build_email_list(@email_list);
SELECT @email_list;
```
