# WITH CHECK OPTION Clause

* [WITH CHECK OPTION Clause Example](#with-check-option-clause-example)

`WITH CHECK OPTION` clause use to ensure consistency of the views. Consistency of the view means prevents user from updating or inserting rows that are not visible through the view.

The following illustrates the syntax of the `WITH CHECK OPTION` clause.
```sql
CREATE OR REPLACE VIEW view_name
AS
    select_statement
    WITH CHECK OPTION;
```
Notice that you put the semicolon (`;`) at the end of the `WITH CHECK OPTION` clause, not at the end of the `SELECT` statement defined the view.


### WITH CHECK OPTION Clause Example
```sql
CREATE OR REPLACE VIEW vps AS
    SELECT
        employeeNumber,
        lastname,
        firstname,
        jobtitle,
        extension,
        email,
        officeCode,
        reportsTo
    FROM
        employees
    WHERE
        jobTitle LIKE '%VP%'
WITH CHECK OPTION;
```

Now if the user try to update or insert any data that's not match the `WHERE` clause condition it'll give it error message.
```sql
Error Code: 1369. CHECK OPTION failed 'classicmodels.vps'
```
