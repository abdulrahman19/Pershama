# REPLACE

* [REPLACE Statement](#replace-statement) <br>
* [REPLACE And INSERT](#replace-and-insert) <br>
* [REPLACE And UPDATE](#replace-and-update) <br>
* [REPLACE INTO And SELECT](#replace-into-and-select) <br>
* [REPLACE Statement Usages](#replace-statement-usages) <br>

### REPLACE Statement
The MySQL `REPLACE` statement is a MySQL extension to the standard SQL. The MySQL `REPLACE` statement works as follows:

* If the new row already does not exist, the MySQL `REPLACE`  statement **inserts** a new row.
* If the new row already exist, the `REPLACE` statement **deletes the old row first and then inserts a new row**. In some cases, the `REPLACE` statement **updates** the existing row only.

To determine whether the new row already exists in the table, MySQL uses `PRIMARY KEY` or `UNIQUE KEY` index. If the table does not have one of these indexes, **the `REPLACE` statement is equivalent to the `INSERT` statement**.

```sql
REPLACE INTO cities(id,population)
VALUES(2,3696820);
```

### REPLACE And INSERT
The `REPLACE` statement is similar to the `INSERT` statement as follows:

```sql
REPLACE INTO cities(name,population)
VALUES('Phoenix',1321523);
```

In case the column that has the `NOT NULL` attribute and does not have a `default value`, and you don’t specify the value in the `REPLACE` statement, MySQL will raise an error.

### REPLACE And UPDATE
The second form of `REPLACE` statement is similar to the `UPDATE` statement as follows:

```sql
REPLACE INTO
    cities
SET id = 4,
    name = 'Phoenix',
    population = 1768980;
```

Unlike the `UPDATE` statement, if you don’t specify the value for the column in the `SET` clause, the `REPLACE` statement **will use the default value of that column**.

### REPLACE INTO And SELECT
The third form of `REPLACE` statement is similar to `INSERT INTO SELECT` statement:

```sql
REPLACE INTO cities(name,population)
SELECT
    name,population
FROM
    cities
WHERE id = 1;
```

### REPLACE Statement Usages
There are several important points you need to know when you use the `REPLACE` statement:

* If you develop an application that supports not only MySQL database but also other relational database management systems (RDBMS), you should avoid using the `REPLACE` statement because other `RDBMS` may not support it. Instead, you can use the combination of the `DELETE` and `INSERT` statements within a `transaction`.
* If you are using the `REPLACE` statement in the table that has `triggers` and the `deletion` of duplicate-key error occurs, the `triggers` will be fired in the following sequence:`BEFORE INSERT` `BEFORE DELETE` , `AFTER DELETE` , `AFTER INSERT`  in case the `REPLACE` statement deletes current row and inserts the new row. In case the `REPLACE` statement `updates` the current row, the `BEFORE UPDATE` and `AFTER UPDATE` triggers are fired.
