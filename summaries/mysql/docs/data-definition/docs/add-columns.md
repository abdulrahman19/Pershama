# Add Columns

To add a new column to an existing table, you use the ALTER TABLE ADD COLUMN statement as follows:
```sql
ALTER TABLE table
ADD [COLUMN] column_name column_definition [FIRST|AFTER existing_column];
```

Let’s examine the statement in more detail.
* First, you specify the table name after the `ALTER TABLE` clause.
* Second, you put the new column and its definition after the `ADD COLUMN` clause. Note that `COLUMN` keyword is optional so you can omit it.
* Third, MySQL allows you to add the new column as the first column of the table by specifying the `FIRST` keyword. It also allows you to add the new column after an existing column using the `AFTER existing_column` clause. If you don’t explicitly specify the position of the new column, MySQL will add it as the last column.

To add two or more columns to a table at the same time, you use the following syntax:
```sql
ALTER TABLE table
ADD [COLUMN] column_name_1 column_1_definition [FIRST|AFTER existing_column],
ADD [COLUMN] column_name_2 column_2_definition [FIRST|AFTER existing_column],
...;
```

In some situations, you want to check whether a column already exists in a table before adding it. However, there is no statement like `ADD COLUMN IF NOT EXISTS` available. Fortunately, you can get this information from the columns table of the `information_schema` database as the following query:

```sql
SELECT
    IF(count(*) = 1, 'Exist','Not Exist') AS result
FROM
    information_schema.columns
WHERE
    table_schema = 'classicmodels'
    AND table_name = 'vendors'
    AND column_name = 'phone';
```
