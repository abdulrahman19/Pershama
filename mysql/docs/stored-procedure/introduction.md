# Introduction to Stored Procedure

* [Stored Procedures Advantages](#stored-procedures-advantages)
* [Stored Procedures Disadvantages](#stored-procedures-disadvantages)
* [Create Stored Procedures](#create-stored-procedures)
* [Call Stored Procedures](#call-stored-procedures)

A stored procedure is a segment of declarative SQL statements stored inside the database catalog. A stored procedure can be invoked by `triggers`, other stored procedures, and applications such as `Java`, `Python`, `PHP`.

A stored procedure that calls itself is known as a `recursive stored procedure`. Most database management systems support recursive stored procedures.

### Stored Procedures Advantages
* Stored procedures help increase the performance of the applications. Once created, stored procedures are compiled and stored in the database. MySQL stored procedures are compiled on demand. After compiling a stored procedure, MySQL puts it into a cache and maintains its own stored procedure cache for every single connection. If an application uses a stored procedure multiple times in a single connection, the compiled version is used, otherwise, the stored procedure works like a query.
* Stored procedures help reduce the traffic between application and database server because instead of sending multiple lengthy SQL statements, the application has to send only the name and parameters of the stored procedure.
* Stored procedures are reusable and transparent to any applications.
* Stored procedures are secure. The database administrator can grant appropriate permissions to applications that access stored procedures in the database without giving any permissions on the underlying database tables.

### Stored Procedures Disadvantages
* If you use many stored procedures, the memory usage of every connection that is using those stored procedures will increase substantially. In addition, if you overuse a large number of logical operations inside stored procedures, the CPU usage will increase because the database server is not well-designed for logical operations.
* Stored procedure’s constructs are not designed for developing complex and flexible business logic.
* MySQL does not provide facilities for debugging stored procedures.
* It is not easy to develop and maintain stored procedures.

### Create Stored Procedures
We are going to develop a simple stored procedure named GetAllProducts()  to help you get familiar with the syntax.
```sql
DELIMITER $$
    CREATE PROCEDURE GetAllProducts()
        BEGIN
            SELECT *  FROM products;
        END $$
 DELIMITER ;
```
The first command is `DELIMITER $$` , which is not related to the stored procedure syntax. The `DELIMITER` statement changes the standard delimiter which is semicolon ( `;` ) to another. In this case, the delimiter is changed from the semicolon( `;` ) to double dollar sign `$$`.

Why do we have to change the delimiter?

Because we want to pass the stored procedure to the server as a whole rather than letting MySql tool interpret each statement at a time. which will cause error on `SELECT *  FROM products;`. Following the `END` keyword, we use the delimiter `$$` to indicate the end of the stored procedure. The last command ( `DELIMITER ;` ) changes the delimiter back to the semicolon ( `;` ).

### Call Stored Procedures
In order to call a stored procedure, you use the following SQL command:
```sql
CALL GetAllProducts();
```
