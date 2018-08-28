# Not Null Constraint

* [Define a Not Null](#define-a-not-null)
* [Add Not Null to an existing column](#add-not-null-to-an-existing-column)

### Define a Not Null
The `NOT NULL` constraint is a column constraint that forces the values of a column to non-NULL values only.

The syntax of the `NOT NULL` constraint is as follows:
```sql
column_name data_type NOT NULL;
```

For Example:
```sql
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE
);
```

It’s a best practice to have the `NOT NULL` constraint in every column of a table unless you have a good reason not to do so.

Generally, the `NULL` value makes your queries more complicated.

### Add Not Null to an existing column
Typically, you add a `NOT NULL` constraints to columns when you create the table. However, sometimes, you want to add a `NOT NULL` constraint to NULL-able column of an existing table. In this case, you use the following steps:

* Check the current values of the column.
* Update the `NULL` values to non-null values.
* Add the `NOT NULL` constraint

For Example:

* Check the current values of the column.
```sql
SELECT
    *
FROM
    tasks
WHERE
    end_date IS NULL;
```

* Update the `NULL` values to non-null values.
```sql
UPDATE tasks
SET
    end_date = start_date + 7
WHERE
    end_date IS NULL;
```

* Add the `NOT NULL` constraint

To do it, you use the following `ALTER TABLE` statement:
```sql
ALTER TABLE table_name
CHANGE old_column_name new_column_name new_column_definition;
```
Like
```sql
ALTER TABLE tasks
CHANGE end_date end_date DATE NOT NULL;
```
