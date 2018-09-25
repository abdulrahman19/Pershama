# Data Modeling Cheat Sheet

### Key Definition
A key is a single or combination of multiple fields in a table. Its is used to fetch or retrieve records/data-rows from data table, also used to create relationship among different database tables or views.

Also the key is usually a synonym for `INDEX`. You use the key when you want to create an index for a column or a set of columns that is not the part of a `primary key` or `unique key`.

### Key Types
* **Super Key**

Super key is a set of one or more than one keys that can be used to identify a record uniquely in a table.

* **Candidate Key**

A Candidate Key is a set of one or more fields/columns that can identify a record uniquely in a table. There can be multiple Candidate Keys in one table. Each Candidate Key can work as Primary Key.

* **Primary Key**

Primary key is a set of one or more fields/columns of a table that uniquely identify a record in database table. It can *not accept* **null**, *duplicate values*. **Only one Candidate Key can be Primary Key**.

* **Composite/Compound Key**

Composite Key is a combination of more than one fields/columns of a table. It can be a Candidate key, Primary key.

* **Unique Key**

Uniquekey is a set of one or more fields/columns of a table that uniquely identify a record in database table. It is like Primary key but it can **accept only one null value** and it can not have duplicate values.

* **Foreign Key**

Foreign Key is a field in database table that is Primary key in another table. It can accept multiple null, duplicate values.

* **Alternate key**

A Alternate key is a key that can be work as a primary key. Basically it is a candidate key that currently is not primary key.

### Functional Dependencies
Functional dependency is a relationship that exists when one attribute uniquely determines another attribute.
<pre>
    SSN -> first name, last name, date_of_birth, address, phone_number
</pre>

### Trivial FD
A functional dependency `FD: X → Y` is called trivial if `Y` is a subset of `X`.
<pre>
    student, semester -> student
    student -> student
</pre>

### Database Normalization
Database normalization is process used to organize a database into tables and columns. Which minimize data redundancy.

**Reasons for Normalization**

There are three main reasons to normalize a database.
* The first is to minimize `duplicate data`.
* The second is to minimize or avoid data `modification anomalies`.
* And the third is to `simplify queries`.

### Normalization Types
* `First Normal Form` – The information is stored in a relational table and each column contains **atomic values**, and there are **not repeating groups of columns**.
* `Second Normal Form` – The table is in first normal form and **all the columns depend on the table’s primary key** -No partial dependency-.
* `Third Normal Form` – the table is in second normal form and **all of its columns are not transitively dependent on the primary key** -No transitive dependency-.
* `Boyce-Codd Normal Form` - the table is in third normal form and It **contains only columns that are dependent on the primary key even the primary keys itself**.
