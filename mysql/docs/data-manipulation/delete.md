# DELETE

* [DELETE Rows](#delete-rows) <br>
* [DELETE And LIMIT](#delete-and-limit) <br>
* [ON DELETE CASCADE](#on-delete-cascade) <br>
* [Find Tables Affected By ON DELETE CASCADE](#find-tables-affected-by-on-delete-cascade) <br>
* [DELETE JOIN](#delete-join) <br>


### DELETE Rows
```sql
DELETE FROM table_name
WHERE condition;
```

In this statement:
* First, specify the table from which you delete data.
* Second, use a condition to specify which rows to delete in the `WHERE` clause. If the row matches the condition, it will be deleted.

```sql
DELETE FROM
    employees
WHERE
    officeCode = 4;
```
To delete all rows from the employees table, you use the `DELETE` statement without the `WHERE` clause.

### DELETE And LIMIT
If you want to limit the number of rows to be deleted, you use the `LIMIT` clause.

```sql
DELETE FROM
    customers
WHERE
    customerCountry = 'France'
ORDER BY
    customerName
LIMIT 10;
```

Note that the order of rows in a table is unspecified, therefore, when you use the `LIMIT` clause, you should always use the `ORDER BY` clause.

### ON DELETE CASCADE
MySQL provides a more effective way called `ON DELETE CASCADE` referential action for a `foreign key` that allows you to delete data from child tables automatically when you delete the data from the parent table.

```sql
CREATE TABLE rooms (
    room_no INT PRIMARY KEY AUTO_INCREMENT,
    room_name VARCHAR(255) NOT NULL,
    building_no INT NOT NULL,
    FOREIGN KEY (building_no)
        REFERENCES buildings (building_no)
        ON DELETE CASCADE
);
```

Notice that we add the `ON DELETE CASCADE` clause at the end of the `foreign key` constraint definition.

```sql
DELETE FROM
    buildings
WHERE
    building_no = 2;
```

All the rooms that reference to building_no 2 were deleted.

Notice that `ON DELETE CASCADE` works only with tables with the storage engines support foreign keys e.g., `InnoDB`.

### Find Tables Affected By ON DELETE CASCADE
```sql
USE information_schema;

SELECT
    table_name
FROM
    referential_constraints
WHERE
    constraint_schema = 'database_name' # <= change this
    AND referenced_table_name = 'parent_table' # <= change this
    AND delete_rule = 'CASCADE'
```

### DELETE JOIN
MySQL also allows you to use the `[INNER / LEFT] JOIN` clause in the `DELETE` statement to delete rows from a table and the matching rows in another table.

```sql
DELETE t1, t2
FROM
    t1
INNER JOIN
    t2 ON t2.ref = t1.id
WHERE
    t1.id = 1;
```
Notice that you put table names `T1` and `T2` between the `DELETE` and `FROM` keywords. If you omit `T1` table, the `DELETE` statement only deletes rows in `T2` table. Similarly, if you omit `T2` table, the `DELETE` statement will delete only rows in `T1` table.

With `LEFT JOIN`

```sql
DELETE
    customers
FROM
    customers
LEFT JOIN
    orders ON customers.customerNumber = orders.customerNumber
WHERE
    orderNumber IS NULL;
```
