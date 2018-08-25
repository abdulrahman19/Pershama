# Foreign Key

* [Create Foreign Keys](#create-foreign-keys)
* [Adding a Foreign Key To a Table](#adding-a-foreign-key-to-a-table)
* [Dropping Foreign Key](#dropping-foreign-key)
* [Disabling Foreign Key Checks](#disabling-foreign-key-checks)

A `foreign key` can be a column or a set of columns. The columns in the child table often refer to the `primary key` columns in the parent table.

A table may have more than one `foreign key`, and each `foreign key` in the child table may refer to a different parent table.

Sometimes, the child and parent tables are the same. The `foreign key` refers back to the `primary key` of the table. Please check [self join](../data-manipulation/join.md#self-join).

`Foreign keys` enforce referential integrity that helps you maintain the consistency and integrity of the data automatically. For example, you cannot create an order for a non-existent customer.

In addition, you can set up a `cascade on delete` action for the `foreign key` column so that when you delete a parent column in the parent table, all the child column associated with the parent column are also deleted. This saves you time and efforts of using multiple `DELETE` statements or a `DELETE JOIN` statement.

The same as deletion, you can also define a `cascade on update` action for the `foreign key` column to perform the cross-table update without using multiple` UPDATE` statements or an `UPDATE JOIN` statement.

Please check also this [summary](../data-modeling/database-keys.md)

### Create Foreign Keys
You can define the `FOREIGN KEYS` with column as a following syntax illustrates:
```sql
CONSTRAINT constraint_name
FOREIGN KEY foreign_key_name (columns)
REFERENCES parent_table(columns)
ON DELETE action
ON UPDATE action
```
Example:
```sql
CREATE DATABASE IF NOT EXISTS dbdemo;

USE dbdemo;

CREATE TABLE categories(
   cat_id int not null auto_increment primary key,
   cat_name varchar(255) not null,
   cat_description text
) ENGINE=InnoDB;

CREATE TABLE products(
   prd_id int not null auto_increment primary key,
   prd_name varchar(355) not null,
   prd_price decimal,
   cat_id int not null,
   FOREIGN KEY fk_cat(cat_id)
   REFERENCES categories(cat_id)
   ON UPDATE CASCADE
   ON DELETE RESTRICT
)ENGINE=InnoDB;
```

### Adding a Foreign Key To a Table
You can `ALTER` the `FOREIGN KEYS` with column as a following syntax illustrates:
```sql
ALTER table_name
ADD CONSTRAINT constraint_name
FOREIGN KEY foreign_key_name(columns)
REFERENCES parent_table(columns)
ON DELETE action
ON UPDATE action;
```
Example:
```sql
USE dbdemo;

CREATE TABLE vendors(
    vdr_id int not null auto_increment primary key,
    vdr_name varchar(255)
)ENGINE=InnoDB;

ALTER TABLE products
ADD COLUMN vdr_id int not null AFTER cat_id;

# or
ALTER TABLE products
ADD FOREIGN KEY fk_vendor(vdr_id)
REFERENCES vendors(vdr_id)
ON DELETE NO ACTION
ON UPDATE CASCADE;
```

### Dropping Foreign Key
```sql
ALTER TABLE table_name
DROP FOREIGN KEY constraint_name;
```

### Disabling Foreign Key Checks
To see the `foreign keys` of a table
```sql
SHOW CREATE TABLE table_name;
```
To Disabling `foreign key` checks
```sql
SET foreign_key_checks = 0;

# To re-enable it
SET foreign_key_checks = 1;
```
