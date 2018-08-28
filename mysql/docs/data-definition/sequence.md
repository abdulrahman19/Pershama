# Sequence

A sequence is a list of integers generated in the ascending order i.e., 1,2,3… Many applications need sequences to generate unique numbers mainly for identification.

To create a sequence in MySQL automatically, you set the `AUTO_INCREMENT` attribute to a column, which typically is a primary key column.

The following rules are applied when you use the `AUTO_INCREMENT` attribute:
* Each table has only one `AUTO_INCREMENT` column whose data type is typically the integer.
* The `AUTO_INCREMENT` column must be indexed, which means it can be either `PRIMARY KEY` or `UNIQUE` index.
* The `AUTO_INCREMENT` column must have a `NOT NULL` constraint. When you set the `AUTO_INCREMENT` attribute to a column, MySQL automatically adds the `NOT NULL` constraint to the column implicitly.

```sql
CREATE TABLE employees (
    emp_no INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50)
);
```

### How MySQL sequence works !
* The starting value of an `AUTO_INCREMENT` column is 1 and it is increased by 1 when you insert a `NULL` value into the column or when you omit its value in the `INSERT` statement.
* To obtain the last generated sequence number, you use the `LAST_INSERT_ID()` function. For more details [check here](../data-manipulation/insert.md#last_insert_id-function).
* If you insert a new value that is greater than the next sequence number, MySQL will use the new value as the starting sequence number and generate a unique sequence number greater than the current one for the next usage. This creates gaps in the sequence.
* If you update an `AUTO_INCREMENT` column to a value that is greater than the existing values in the column, MySQL will use the next number of the last insert sequence number for the next row. For example, if the last insert sequence number is 3, you update it to 10, the sequence number for the new row is 4.
* If you use the `DELETE` statement to delete the last inserted row, MySQL may or may not reuse the deleted sequence number depending on the storage engine of the table. `MyISAM` and `InnoDB` tables do not reuse sequence number when rows are deleted. Example, If the last insert id in the table is 10, and you remove it, MySQL still generates the next sequence number which is 11 for the new row.
