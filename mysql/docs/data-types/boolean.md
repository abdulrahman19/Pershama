# BOOLEAN

* [Declare BOOLEAN Value](#declare-boolean-value)
* [INSERT And SELECT BOOLEAN Value](#insert-and-select-boolean-value)
    * BOOLEAN Operators


### Declare BIT Value
MySQL does not have built-in `BOOLEAN` type. However, it uses `TINYINT(1)` instead. To make it more convenient, MySQL provides `BOOLEAN` or `BOOL` **as the synonym of** `TINYINT(1)`.

In MySQL, zero is considered as `FALSE`, and non-zero value is considered as `TRUE`. To use Boolean literals, you use the constants `TRUE` and `FALSE` that evaluate to `1` and `0` respectively.

```sql
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    completed BOOLEAN
    # or
    completed TINYINT(1)
);
```

### INSERT And SELECT BOOLEAN Value

```sql
INSERT INTO tasks(title,completed)
VALUES('Master MySQL Boolean type',TRUE),
      ('Design database table',1);
      ('PHP',2);
      ('DP',0);
      ('JS',FALSE);
# Then
SELECT
    id, title, completed
FROM
    tasks;
```

<pre>
+----+---------------------------+-----------+
| id |          title            | completed |
+----+---------------------------+-----------+
| 1  | Master MySQL Boolean type | 1         |
+----+---------------------------+-----------+
| 2  | Design database table     | 1         |
+----+---------------------------+-----------+
| 3  | PHP                       | 2         |
+----+---------------------------+-----------+
| 4  | DP                        | 0         |
+----+---------------------------+-----------+
| 5  | JS                        | 0         |
+----+---------------------------+-----------+
</pre>

If you want to output the result as `TRUE` and `FALSE`, you can use the `IF` function as follows:

```sql
SELECT
    id,
    title,
    IF(completed, 'true', 'false') AS completed
FROM
    tasks;
```

<pre>
+----+---------------------------+-----------+
| id |          title            | completed |
+----+---------------------------+-----------+
| 1  | Master MySQL Boolean type | true      |
+----+---------------------------+-----------+
| 2  | Design database table     | true      |
+----+---------------------------+-----------+
| 3  | PHP                       | true      |
+----+---------------------------+-----------+
| 4  | DP                        | false     |
+----+---------------------------+-----------+
| 5  | JS                        | false     |
+----+---------------------------+-----------+
</pre>

**BOOLEAN Operators**

To get all completed tasks in the tasks table, you might come up with the following query

```sql
SELECT
    id, title, completed
FROM
    tasks
WHERE
    completed = TRUE;
```

<pre>
+----+---------------------------+-----------+
| id |          title            | completed |
+----+---------------------------+-----------+
| 1  | Master MySQL Boolean type | 1         |
+----+---------------------------+-----------+
| 2  | Design database table     | 1         |
+----+---------------------------+-----------+
</pre>

As you see, it only returned the task with completed value 1. To fix it, you must use `IS` operator:

```sql
SELECT
    id, title, completed
FROM
    tasks
WHERE
    completed IS TRUE;
```

<pre>
+----+---------------------------+-----------+
| id |          title            | completed |
+----+---------------------------+-----------+
| 1  | Master MySQL Boolean type | 1         |
+----+---------------------------+-----------+
| 2  | Design database table     | 1         |
+----+---------------------------+-----------+
| 3  | PHP                       | 2         |
+----+---------------------------+-----------+
</pre>

And for not completed use `IS NOT TRUE`;
