# UPDATE

* [UPDATE Rows](#update-rows) <br>
* [UPDATE From SELECT Clause](#update-from-select-clause) <br>
* [UPDATE Multiple Tables](#update-multiple-tables) <br>

### UPDATE Rows
`UPDATE` statement use to update existing data in a table. We can use the `UPDATE` statement to change column values of a single row, a group of rows, or all rows in a table.

```sql
UPDATE [LOW_PRIORITY] [IGNORE] table_name
SET
    column_name1 = expr1,
    column_name2 = expr2,
    ...
WHERE
    condition;
```

The `SET` clause specifies which column that you want to modify and the new values. To update multiple columns, you use a list comma-separated assignments. You supply the value in each column’s assignment in the form of a `literal value`, an `expression`, or a `subquery`.

MySQL supports two modifiers in the UPDATE statement.

* The `LOW_PRIORITY` modifier instructs the `UPDATE` statement to delay the update until there is no connection reading data from the table. The `LOW_PRIORITY` takes effect for the storage engines that use **table-level locking only**, for example, `MyISAM`, `MERGE`, `MEMORY`.
* The `IGNORE` modifier enables the `UPDATE` statement to continue updating rows even if errors occurred. The rows that cause errors such as duplicate-key conflicts are not updated.

```sql
UPDATE
    employees
SET
    email = 'mary.patterson@classicmodelcars.com'
WHERE
    employeeNumber = 1056;
```
Remove `WHERE` clause to update all rows.

**UPDATE multiple columns**

```sql
UPDATE
    employees
SET
    lastname = 'Hill',
    email = 'mary.hill@classicmodelcars.com'
WHERE
    employeeNumber = 1056;
```

### UPDATE From SELECT Clause
```sql
UPDATE customers
SET
    salesRepEmployeeNumber = (SELECT
                                  employeeNumber
                              FROM
                                  employees
                              WHERE
                                  jobtitle = 'Sales Rep'
                              LIMIT 1)
WHERE
    salesRepEmployeeNumber IS NULL;
```

### UPDATE Multiple Tables
```sql
UPDATE
    T1,
    T2
SET
    T1.c2 = T2.c2,
    T2.c3 = expr
WHERE
    T1.c1 = T2.c1
    AND condition
```

This `UPDATE` statement works the same as `UPDATE JOIN`  with **implicit** `INNER JOIN` clause. It means you can rewrite the above statement as follows:

```sql
UPDATE
    T1,
    T2
INNER JOIN T2 ON T1.C1 = T2.C1
SET
    T1.C2 = T2.C2,
    T2.C3 = expr
WHERE condition
```

**UPDATE JOIN**

```sql
UPDATE T1, T2,
[INNER JOIN | LEFT JOIN] T1 ON T1.C1 = T2. C1
SET T1.C2 = T2.C2,
    T2.C3 = expr
WHERE condition
```

Example with `INNER JOIN`

```sql
UPDATE
    employees
INNER JOIN
    merits ON employees.performance = merits.performance
SET
    salary = salary + salary * percentage;
```

Example with `LEFT JOIN`

```sql
UPDATE
    employees
LEFT JOIN
    merits ON employees.performance = merits.performance
SET
    salary = salary + salary * 0.015
WHERE
    merits.percentage IS NULL;
```
