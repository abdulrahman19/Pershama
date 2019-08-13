# TIME

* [Declare TIME Value](#declare-time-value)
* [INSERT And SELECT TIME Value](#insert-and-select-time-value)

### Declare TIME Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
-838:59:59 | 838:59:59 | 3 |  bytes | -

MySQL uses the `'HH:MM:SS'` format for querying and displaying a time value that represents a time of day, which is within 24 hours. **To represent a time interval** between two events, MySQL uses the `'D HH:MM:SS'` or `HHHMMSS` format, which is larger than 24 hours.

```sql
column_name TIME;
```

A `TIME` value can have fractional seconds part that is up to microseconds precision (6 digits).

```sql
column_name TIME(N);
```

Fractional Seconds Precision | Storage (Bytes)
---|---|
0 | 0
1,2 | 1
3,4 | 2
5,6 | 3

**Create a table:**

```sql
CREATE TABLE tests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    start_at TIME,
    end_at TIME
);
```

### INSERT And SELECT TIME Value

```sql
INSERT INTO tests(name,start_at,end_at)
VALUES('Test 1', '08:00:00',100000);

SELECT
    name, start_at, end_at
FROM
    tests;
```

<pre>
+--------+----------+----------+
| name   | start_at | end_at   |
+--------+----------+----------+
| Test 1 | 08:00:00 | 10:00:00 |
+--------+----------+----------+
</pre>

**Valid Time Form**

```sql
# as string
'D HH:MM:SS'
'D HH:MM'
'D HH'

'HH:MM:SS'
'H:M:S'
'HH:MM'
'SS'

'HHMMSS'
'MMSS'
'SS'
# as number
HHHMMSS
HHMMSS
MMSS
SS
```

For the **time interval**, you can use the `'D HH:MM:SS'` format where `D` represents days with a range from **0 to 34**.

```sql
INSERT INTO tests(name,start_at,end_at)
VALUES('Test 1', '2 09:15:00','10:00:00');
```

<pre>
+--------+----------+----------+
| name   | start_at | end_at   |
+--------+----------+----------+
| Test 1 | 57:15:00 | 10:00:00 |
+--------+----------+----------+
</pre>

You can use with `TIME` a lot of functions to help you when`SELECT` or `INSERT`, check them form [here](../functions)
