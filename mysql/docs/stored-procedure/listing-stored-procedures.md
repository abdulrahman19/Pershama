# Listing Stored Procedures

* [Displaying Characteristics Of Stored Procedures](#displaying-characteristics-of-stored-procedures)
* [Displaying Stored Procedure’s Source Code](#displaying-stored-procedure-s-source-code)

Now we will show you how to list all stored procedures in a MySQL database, and introduce you to a very useful statement that displays the stored procedure’s source code.

### Displaying Characteristics Of Stored Procedures
To display characteristics of a stored procedure like stored procedure name, type, creator, etc. you use the `SHOW PROCEDURE STATUS` statement as follows:
```sql
SHOW PROCEDURE STATUS [LIKE 'pattern' | WHERE expr];
```

### Displaying Stored Procedure’s Source Code
To display source code of a particular stored procedure, you use the  SHOW CREATE PROCEDURE statement as follows:
```sql
SHOW CREATE PROCEDURE stored_procedure_name;
```
