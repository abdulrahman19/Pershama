# Data Modeling Chapter Terminologies

<br>Term<img width=470/> | Meaning
---|---|
Data Modeling | is a process used to define and analyze data requirements needed to support the business  processes.
Database | is an organized collection of data, stored and accessed electronically.
Relational Database | A relational database is a collection of data items with pre-defined relationships between them. These items are organized as a set of `tables` with `columns` and `rows`. <br> Each `column` in a table holds a certain  kind of data and a field stores the actual value of an attribute. <br> Each `rows` in the table represent a collection of related values of one object or entity. Also each `row` in a table could be marked  with a unique identifier called a `primary key`, and rows among multiple tables can be made related using `foreign keys`. <br> This data can be accessed in many different ways without reorganizing the database tables themselves.
DBMS | is abbreviation for Database Management System. <br> DBMS is the software that interacts with end users, applications, and the database itself to definition, creation, querying, update, and administration of databases.
SQL | is abbreviation for Structured Query Language. <br> SQL is a domain-specific language used in programming, designed and managing data held in a relational database management system.
FD | is abbreviation for Functional Dependency. <br> FD is a relationship that exists when one attribute uniquely determines another attribute.
Trivial FD | We call a relationship trivial FD if some attribute/s is subset from the relationship.
Database Normalization | is process used to organize a database into tables and columns. Which minimize data redundancy.
DDL | is abbreviation of **D**ata **D**efinition **L**anguage. Like `CREATE`, `ALTER` and `DROP` statements
DML | is abbreviation of **D**ata **M**anipulation **L**anguage. It is used to retrieve `SELECT`, store `INSERT`, modify `UPDATE`, delete `DELETE` in database, and so many other.
DQL | is abbreviation of **D**ata **Q**uery **L**anguage. Like `SELECT`, `SHOW` and `HELP` statements.
DCL | is abbreviation of **D**ata **C**ontrol **L**anguage. Like `GRANT` and `REVOKE` statements.
DTL | is abbreviation of **D**ata **T**ransaction **L**anguage. Like START `TRANSACTION` and `COMMIT` statements.
