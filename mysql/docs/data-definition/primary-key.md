# Create a Table

* [Defining a PRIMARY KEY](#defining-a-primary-key)
* [ALTER TABLE with PRIMARY KEY](#alter-table-with-primary-key)

A `primary key` is a column or a set of columns that uniquely identifies each row in the table. You must follow the rules below when you define a primary key for a table:

* A `primary key` must contain unique values. If the `primary key` consists of multiple columns, the combination of values in these columns must be unique.
* A `primary key` column cannot contain NULL values. It means that you have to declare the primary key column with the `NOT NULL` attribute. If you don’t, MySQL will force the primary key column as `NOT NULL`  implicitly.
* A table has only one primary key.

Please check this [summary](../data-modeling/database-keys.md)

### Defining a PRIMARY KEY
You can define the `PRIMARY KEY` with column.
```sql
CREATE TABLE users(
   user_id INT AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(40),
   password VARCHAR(255),
   email VARCHAR(255)
);
```
Or with table.
```sql
CREATE TABLE user_roles(
   user_id INT NOT NULL,
   role_id INT NOT NULL,
   PRIMARY KEY(user_id,role_id),
   FOREIGN KEY(user_id) REFERENCES users(user_id),
   FOREIGN KEY(role_id) REFERENCES roles(role_id)
);
```

### ALTER TABLE with PRIMARY KEY
```sql
ALTER TABLE table_name
ADD PRIMARY KEY(primary_key_column);
```
