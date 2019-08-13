# TIMESTAMP

* [Declare TIMESTAMP Value](#declare-timestamp-value)
* [INSERT And SELECT TIMESTAMP Value](#insert-and-select-timestamp-value)

### Declare TIMESTAMP Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1970-01-01 00:00:01 UTC | 2038-01-19 03:14:07 UTC | 4 |  bytes | -

MySQL `TIMESTAMP` is a temporal data type that holds the combination of `date` and `time`. MySQL displays the `TIMESTAMP` value in the following format:

```sql
YYYY-MM-DD HH:MM:SS
```

a `TIMESTAMP` value can include a trailing fractional second up to microseconds with the format `YYYY-MM-DD HH:MM:SS[.fraction]`. When including the fractional second precision,` TIMESTAMP` values require more storage as illustrated in the following table:

Fractional Seconds Precision | Storage (Bytes)
---|---|
0 | 0
1,2 | 1
3,4 | 2
5,6 | 3

```sql
# with up to microseconds (6 digits) precision.
t1  TIMESTAMP(2)
# formate
YYYY-MM-DD HH:MM:SS.FFFFFF
```

When you insert a `TIMESTAMP` value into a table, MySQL converts it from your connection’s time zone to UTC for storage. When you query a `TIMESTAMP` value, MySQL converts the UTC value back to your connection’s time zone.

When you retrieve a `TIMESTAMP` value that was inserted by a client in a different time zone, you will get a value that is not the same as the value stored in the database. As long as you don’t change the time zone, you can get the same `TIMESTAMP` value that you stored.

**Create a table:**

```sql
CREATE TABLE test_timestamp (
    t1  TIMESTAMP
);
```

### INSERT And SELECT TIMESTAMP Value
```sql
SET time_zone='+00:00';

INSERT INTO test_timestamp
VALUES('2008-01-01 00:00:01');

SELECT
    t1
FROM
    test_timestamp;
```

<pre>
+----------------------+
| t1                   |
+----------------------+
| 2008-01-01 00:00:01  |
+----------------------+
</pre>

```sql
SET time_zone='+03:00';

SELECT
    t1
FROM
    test_timestamp;
```

<pre>
+----------------------+
| t1                   |
+----------------------+
| 2008-01-01 03:00:01  |
+----------------------+
</pre>

**Automatic initialization and updating for TIMESTAMP columns**

```sql
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```
