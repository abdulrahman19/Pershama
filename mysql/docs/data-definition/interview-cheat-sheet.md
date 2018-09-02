# Interview Cheat Sheet

* [Manage Databases](#manage-databases) <br>
* [InnoDB vs MyISAM](#innodb-vs-myisam) <br>
* [Manage Tables](#manage-tables) <br>
* [Primary Key](#primary-key) <br>
* [Foreign Key](#foreign-key) <br>
* [Unique Constraint](#unique-constraint) <br>
* [Not Null Constraint](#not-null-constraint) <br>
* [Alter Table](#alter-table) <br>
* [Character Set](#character-set) <br>
* [Character Set Collations](#character-set-collations) <br>

### Manage Databases
```sql
CREATE DATABASE [IF NOT EXISTS] database_name;

SHOW DATABASES;

USE database_name;

DROP DATABASE [IF EXISTS] database_name;
```

### InnoDB vs MyISAM

Feature | InnoDB | MyISAM
---|---|---|
Clustered indexes | Yes | No
Data caches | Yes | No
Foreign key support | Yes | No
Transactions | Yes | No
Locking granularity | Row | Table
Storage limits | 64TB | 256TB

### Manage Tables

**Create Tables** <br>
```sql
CREATE TABLE [IF NOT EXISTS] table_name(
    column_list
) ENGINE=storage_engine
```

**Define Columns**<br>
```sql
column_name data_type(length) [NOT NULL] [DEFAULT value] [AUTO_INCREMENT]
```

**Sequence**<br>
The following rules are applied when you use the `AUTO_INCREMENT` attribute:
* Each table has only one `AUTO_INCREMENT` column whose data type is typically the integer.
* The `AUTO_INCREMENT` column must be indexed, which means it can be either `PRIMARY KEY` or `UNIQUE` index.
* The `AUTO_INCREMENT` column must have a `NOT NULL` constraint. When you set the `AUTO_INCREMENT` attribute to a column, MySQL automatically adds the `NOT NULL` constraint to the column implicitly.

How MySQL sequence works !
* The starting value of an `AUTO_INCREMENT` column is 1 and it is increased by 1.
* If you insert a new value that is greater than the next sequence number, MySQL will use the new value as the starting sequence number.
* If you update an `AUTO_INCREMENT` column to a value that is greater than the existing values in the column, MySQL will use the next number of the last insert sequence number for the next row.
* If you use the `DELETE` statement to delete the last inserted row, MySQL may or may not reuse the deleted sequence number depending on the storage engine of the table. `ISAM` and `InnoDB` tables do not reuse sequence number.

**Temporary Tables**<br>
Temporary Tables, or temp tables for short, allow you to create a short-term storage place within the database for a set of data that you need to use several times in a single series of operations. Temp tables come into play when it isn’t possible to retrieve all the data that you require using one `SELECT` statement or when you want to work with subsets of the same, larger result set over several successive operations.
```sql
CREATE TEMPORARY TABLE [IF NOT EXISTS] table_name(
    column_list
) ENGINE=storage_engine

# or
CREATE TEMPORARY TABLE table_name
SELECT ...
```

**Rename Tables**<br>
```sql
RENAME TABLE old_table_name TO new_table_name
             [old_table_name_2 TO new_table_name_2 ...];

# or [work with Temporary Tables]
ALTER TABLE old_table_name RENAME TO new_table_name;
```

**Truncate Tables**<br>
`TRUNCATE TABLE` statement allows you to delete all data in a table.
```sql
TRUNCATE [TABLE] table_name;
```

**Drop Tables**<br>
```sql
DROP [TEMPORARY] TABLE [IF EXISTS] table_name [, table_name] ...
[RESTRICT | CASCADE]
```
The `RESTRICT` and `CASCADE` flags are reserved for the future versions of MySQL.

### Primary Key
* A primary key must contain unique values.
* A primary key column cannot contain `NULL` values.
* A table has only one primary key.
```sql
# with column
user_id INT AUTO_INCREMENT PRIMARY KEY

# with table
PRIMARY KEY(user_id,role_id),

# with Alter
ADD PRIMARY KEY(primary_key_column);
```

### Foreign Key
A foreign key can be a column or a set of columns. The columns in the child table often refer to the primary key columns in the parent table.

Foreign keys enforce referential integrity that helps you maintain the consistency and integrity of the data automatically. For example, you cannot create an order for a non-existent customer.

Sometimes, the child and parent tables are the same. The foreign key refers back to the primary key of the table.

Foreign Key Options:

Option | Description
---|---|
`NO ACTION` | `InnoDB` rejects the delete or update operation for the parent table.
`RESTRICT` | `RESTRICT` is synonymous to `NO ACTION` and those are default behavior.
`SET NULL` | Delete or update the row from the parent table and set the foreign key column or columns in the child table to `NULL`.
`CASCADE` | Delete or update the row from the parent table and automatically delete or update the matching rows in the child table.
`SET DEFAULT` | This action is recognized by the parser, but `InnoDB` rejects table definitions containing `ON [DELETE/UPDATE] SET DEFAULT` clauses.

```sql
# with table
FOREIGN KEY fk_cat(cat_id)
REFERENCES categories(cat_id)
ON UPDATE CASCADE
ON DELETE RESTRICT

# with Alter
ADD FOREIGN KEY fk_vendor(vdr_id)
REFERENCES vendors(vdr_id)
ON DELETE NO ACTION
ON UPDATE CASCADE;

# Dropping Foreign Key
ALTER TABLE table_name
DROP FOREIGN KEY constraint_name;
```

Disabling Foreign Key Checks:
```sql
# Show Foreign Keys
SHOW CREATE TABLE table_name;

# Disabling Foreign Key Checks
SET foreign_key_checks = 0;
```

### Unique Constraint
The UNIQUE constraint is either column constraint or table constraint that defines a rule that constrains values in a column or a group of columns to be unique.

```sql
# with column
column_name_1  data_type UNIQUE,

# with table
UNIQUE [INDEX/KEY] (column_name_1,[column_name_2 ...])
CONSTRAINT constraint_name UNIQUE [INDEX/KEY] (column_name_1,column_name_2)

# with Alter
ADD UNIQUE INDEX constraint_name (username ASC);
ADD CONSTRAINT constraint_name UNIQUE (column_list);

# dropping UNIQUE
DROP INDEX index_name;
```
`UNIQUE`, `UNIQUE INDEX`, `UNIQUE KEY` and `CONSTRAINT constraint_name UNIQUE` are synonyms.

### Not Null Constraint
The NOT NULL constraint is a column constraint that forces the values of a column to non-NULL values only.

```sql
column_name data_type NOT NULL;
```

**Add Not Null to an existing column** <br>
* Check the current values of the column.
* Update the `NULL` values to non-null values.
* Add the `NOT NULL` constraint.

```sql
ALTER TABLE table_name
CHANGE end_date end_date DATE NOT NULL;
```

### Alter Table
You use the `ALTER TABLE` statement to change the structure of existing tables. The `ALTER TABLE` statement allows you to add a column, drop a column, change the data type of column, add primary key, rename table, and many more.
```sql
ALTER TABLE table_name action1[,action2,…]
```

**Add a New Column**
```sql
ALTER TABLE tasks
ADD COLUMN complete DECIMAL(2,1) NULL
AFTER description;
```

**Changing Columns**
```sql
ALTER TABLE tasks
CHANGE COLUMN task_id task_id INT(11) NOT NULL AUTO_INCREMENT;
```

**Drop a Column**
```sql
ALTER TABLE tasks
DROP COLUMN description;
```
### Character Set
A MySQL character set is a set of characters that are legal in a string. For example, we have an alphabet with letters from `a` to `z`.We assign each letter a number, for example, `a = 1, b = 2` etc. The letter `a` is a symbol, and the number `1` that associates with the letter `a` is the encoding. The combination of all letters from `a` to `z` and their corresponding encodings is `a` character set.
```sql
SHOW CHARACTER SET;

# Converting between different character sets
CONVERT('MySQL Character Set' USING utf8)

CAST(_latin1'MySQL character set' AS CHAR CHARACTER SET utf8)
```
### Character Set Collations
A MySQL collation is a set of rules used to compare characters in a particular character set. Each character set in MySQL can have more than one collation, and has, at least, one default collation. Two character sets cannot have the same collation.

By convention, a collation for a character set begins with the character set name and ends with `_ci` (case insensitive) `_cs` (case sensitive) or `_bin` (binary).

```sql
SHOW COLLATION LIKE 'latin1%';
```

**Setting character sets and collations**
```sql
# server [different with each application]
mysqld --character-set-server=utf8 --collation-server=utf8_unicode_ci

# database [Also can use with alter]
CREATE DATABASE database_name
CHARACTER SET character_set_name
COLLATE collation_name

# table [Also can use with alter]
CREATE TABLE table_name(
)
CHARACTER SET character_set_name
COLLATE collation_name

# column [Also can use with alter]
column_name [CHAR | VARCHAR | TEXT] (length)
CHARACTER SET character_set_name
COLLATE collation_name
```
