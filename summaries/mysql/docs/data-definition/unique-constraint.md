# Unique Constraint

* [Add a Unique Constraint](#add-a-unique-constraint)
* [ALTER TABLE And Unique Constraint](#alter-table-and-unique-constraint)

The `UNIQUE` constraint is either column constraint or table constraint that defines a rule that constrains values in a column or a group of columns to be unique.

### Add a Unique Constraint
```sql
CREATE TABLE table_1(
    column_name_1  data_type UNIQUE,
);
```
Or you can define the UNIQUE constraint as the table constraint as follows:
```sql
CREATE TABLE table_1(
   ...
   column_name_1 data_type,
   ...
   UNIQUE [INDEX/KEY] (column_name_1)
);
```
If you insert or update a value that causes a duplicate value in the column_name_1 column, MySQL will issue an error message and reject the change.

In case you want to enforce unique values across columns:
```sql
CREATE TABLE table_1(
   ...
   column_name_1 data_type,
   column_name_2 data type,
   ...
   UNIQUE [INDEX/KEY] (column_name_1,column_name_2)
);
```

If you want to assign a specific name to a `UNIQUE` constraint, you use the `CONSTRAINT` clause as follows:
```sql
CREATE TABLE table_1(
   ...
   column_name_1 data_type,
   column_name_2 data type,
   ...
   CONSTRAINT constraint_name UNIQUE [INDEX/KEY] (column_name_1,column_name_2)
);
```
Example
```sql
CREATE TABLE IF NOT EXISTS suppliers (
    supplier_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(12) NOT NULL UNIQUE,
    address VARCHAR(255) NOT NULL,
    CONSTRAINT uc_name_address UNIQUE (name , address)
);
```

`UNIQUE`, `UNIQUE INDEX`, `UNIQUE KEY` and `CONSTRAINT constraint_name UNIQUE` are synonyms.

### ALTER TABLE And Unique Constraint
The following `SHOW INDEX` statement displays all indexes created on the `suppliers` table.
```sql
SHOW INDEX FROM classicmodels.suppliers;
```

To add a `UNIQUE` constraint:
```sql
ALTER TABLE suppliers
ADD UNIQUE INDEX constraint_name (username ASC) ;

# Or
ALTER TABLE table_name
ADD CONSTRAINT constraint_name UNIQUE (column_list);
```

To remove a `UNIQUE` constraint:
```sql
ALTER TABLE table_name
DROP INDEX index_name;

# Or
DROP INDEX uc_name_address ON suppliers;
```
