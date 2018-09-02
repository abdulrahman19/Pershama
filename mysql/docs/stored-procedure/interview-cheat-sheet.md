# Stored Procedure Cheat Sheet

* [Introduction](#introduction)

### Introduction
A stored procedure is a segment of declarative SQL statements stored inside the database catalog. <br>
A stored procedure that calls itself is known as a `recursive stored procedure`.

**Stored Procedures Advantages**

* Stored procedures help increase the performance of the applications. Once created, stored procedures are compiled and stored in the database. MySQL stored procedures are compiled on demand. After compiling a stored procedure, MySQL puts it into a cache and maintains its own stored procedure cache for every single connection. If an application uses a stored procedure multiple times in a single connection, the compiled version is used, otherwise, the stored procedure works like a query.
* Stored procedures help reduce the traffic between application and database server.
* Stored procedures are reusable and transparent to any applications.
* Stored procedures are secure.

**Stored Procedures Disadvantages**

* If you use many stored procedures, the memory usage of every connection that is using those stored procedures will increase substantially. In addition, if you overuse a large number of logical operations inside stored procedures, the CPU usage will increase because the database server is not well-designed for logical operations.
* Stored procedure’s constructs are not designed for developing complex and flexible business logic.
* MySQL does not provide facilities for debugging stored procedures.
* It is not easy to develop and maintain stored procedures.

**Create Stored Procedure**
```sql
DELIMITER $$
    CREATE PROCEDURE GetAllProducts()
        BEGIN
            SELECT *  FROM products;
        END $$
 DELIMITER ;
```

**Call Stored Procedure**
```sql
CALL GetAllProducts();
```
