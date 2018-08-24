# Interview Cheat Sheet

### Key Definition
A key is a single or combination of multiple fields in a table. Its is used to fetch or retrieve records/data-rows from data table, also used to create relationship among different database tables or views.

Also the key is usually a synonym for `INDEX`. You use the key when you want to create an index for a column or a set of columns that is not the part of a `primary key` or `unique key`.

### Key Types
* Super Key
* Candidate Key
* Primary Key
* Composite/Compound Key
* Unique Key
* Foreign Key
* Alternate key

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
