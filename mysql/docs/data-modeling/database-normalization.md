# Database Normalization

* [Reasons for normalization](#reasons-for-normalization)
* [Reasons in details](#reasons-in-details)
    * Data Duplication
    * Modification Anomalies
    * Search and Sort Issues
* [Definition of Normalization](#definition-of-normalization)

`Database normalization` is process used to organize a database into tables and columns. Which minimize data redundancy.

### Reasons for Normalization
There are three main reasons to normalize a database.
* The first is to minimize `duplicate data`.
* The second is to minimize or avoid `data modification anomalies`.
* And the third is to `simplify queries`.

![Table Not Normalized](./images/Intro-Table-Not-Normalized.png)

### Reasons in details
**1- Data Duplication**

Duplicated information presents two problems:
* It increases storage and decrease performance.
* It becomes more difficult to maintain data changes.

**2- Modification Anomalies**

* **Insert Anomaly** <br>
There are facts we cannot record until we know information for the entire row.
![Insert Anomaly](./images/Intro-Insert-Anomaly.png)*

* **Update Anomaly** <br>
The same information is recorded in multiple rows. Then there are multiple updates that need to be made. If these updates are not successfully completed across all rows, then an inconsistency occurs.
![Update Anomaly](./images/Intro-Update-Anomaly.png)

* **Deletion Anomaly** <br>
Deletion of a row can cause more than one set of facts to be removed.
![Deletion Anomaly](./images/Intro-Deletion-Anomaly.png)

**3- Search and Sort Issues**

The last reason we’ll consider is making it easier to search and sort your data.
```sql
SELECT SalesOffice
FROM SalesStaff
WHERE Customer1 = ‘Ford’ OR
      Customer2 = ‘Ford’ OR
      Customer3 = ‘Ford’
```
The way the table is currently defined, this isn’t possible to sort, unless you use three separate queries with a `UNION`.

### Definition of Normalization
* **First Normal Form** – The information is stored in a relational table and each column contains atomic values, and there are not repeating groups of columns.
* **Second Normal Form** – The table is in first normal form and all the columns depend on the table’s primary key.
* **Third Normal Form** – the table is in second normal form and all of its columns are not transitively dependent on the primary key
