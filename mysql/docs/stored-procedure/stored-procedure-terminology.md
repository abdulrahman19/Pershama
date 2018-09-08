# Stored Procedure Chapter Terminologies

<br>Term<img width=520/> | Meaning
---|---|
Stored Procedure | A stored procedure is a segment of declarative SQL statements stored inside the database catalog. A stored procedure can be invoked by `triggers`, other `stored procedures`, and applications such as `Java`, `Python`, `PHP`.
Recursive Stored Procedure | A stored procedure that calls itself.
Delimiter | A delimiter is a sequence of one or more characters used to specify the boundary between separate, independent regions in plain text or other data streams. An example of a delimiter is the semicolon `;` in programming languages.
Stored Procedure Cursor | A cursor allows you to iterate a set of rows returned by a query and process each row accordingly. It's like `foreach` functionality in `PHP`.
Non-scrollable Cursor | That's means the cursor can be traversed only in one direction and cannot skip rows. in other words, you can only fetch rows in the order determined by the `SELECT` statement.
Asensitive Cursor | The server may or may not make a copy of its result table.
Insensitive Cursor | The server make a temporary copy of its result table.
Error Handler Precedence | The order (priority) for calling Error Handlers.
Raising Error Conditions | That's means the user defined his own error conditions.
Stored Function | A stored function is a special kind stored program that defined by users and returns a single value.
Deterministic | Is a flag to tell MySQL the stored function will Returns same result for same input. It used for replication operations.
Non-Deterministic | Is a flag to tell MySQL the stored function will Returns different result for same input.
Database Replication | Database replication is the frequent electronic copying of data from a database in one computer or server to a database in another so that all users share the same level of information.
UDF | is abbreviation to user-defined functions.
DML | is abbreviation of Data Manipulation Language. It is used to retrieve, store, modify, delete, insert and update data in database.
