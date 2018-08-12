# YEAR

* [Declare YEAR Value](#declare-year-value)
* [INSERT And SELECT YEAR Value](#insert-and-select-year-value)

### Declare YEAR Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1901 | 2155 | 1 |  byte | -

The `YEAR` type is a 1-byte type used to represent year values. It can be declared as `YEAR` or `YEAR(4)` and has a display width of four characters.

```sql
column_name YEAR;
```

**Create a table:**

```sql
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    project VARCHAR(255) NOT NULL,
    start_at YEAR,
    end_at YEAR
);
```


### INSERT And SELECT YEAR Value

```sql
INSERT INTO projects(name,start_at,end_at)
VALUES('project 1', '2000', 2015);

SELECT
    name, start_at, end_at
FROM
    tests;
```

<pre>
+-----------+----------+--------+
| name      | start_at | end_at |
+-----------+----------+--------+
| project 1 | 2000     | 2015   |
+-----------+----------+--------+
</pre>
