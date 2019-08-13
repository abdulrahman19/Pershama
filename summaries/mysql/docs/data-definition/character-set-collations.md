# Character Set Collations

* [Setting character sets and collations](#setting-character-sets-and-collations)

A MySQL collation is a set of rules used to compare characters in a particular character set. Each character set in MySQL can have more than one collation, and has, at least, one default collation. Two character sets cannot have the same collation.

The values of the default collation column specify the default collations for the character sets.

By convention, a collation for a character set begins with the character set name and ends with `_ci` (case insensitive) `_cs` (case sensitive) or `_bin` (binary).

To get all collations for a given character set, you use the `SHOW COLLATION` statement as follows:
```sql
SHOW COLLATION LIKE 'latin1%';
```

### Setting character sets and collations
MySQL allows you to specify character sets and collations at four levels: `server`, `database`, `table`, and `column`.

**server**

Notice MySQL uses `latin1` as the default character set, therefore, its default collation is `latin1_swedish_ci`. You can change these settings at server startup.
```bash
mysqld --character-set-server=utf8 --collation-server=utf8_unicode_ci
```

**database**

When you create a database, if you do not specify its character set and collation, MySQL will use the default character set and collation of the server for the database.

You can override the default settings at database level by using `CREATE DATABASE` or `ALTER DATABASE` statement as follows:
```sql
CREATE DATABASE database_name
CHARACTER SET character_set_name
COLLATE collation_name
```
Or
```sql
ALTER  DATABASE database_name
CHARACTER SET character_set_name
COLLATE collation_name
```
**table**

You can specify the default character set and collation for a table when you create the table by using the `CREATE TABLE` statement or when you alter the table’s structure by using the `ALTER TABLE` statement.
```sql
CREATE TABLE table_name(
)
CHARACTER SET character_set_name
COLLATE collation_name
```
Or
```sql
ALTER TABLE table_name(
)
CHARACTER SET character_set_name
COLLATE collation_name
```

**column**

You can specify a character set and a collation for the column in the column’s definition of either CREATE TABLE or ALTER TABLE  statement as follows:
```sql
column_name [CHAR | VARCHAR | TEXT] (length)
CHARACTER SET character_set_name
COLLATE collation_name
```
