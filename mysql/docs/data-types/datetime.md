# DATETIME

* [Declare DATETIME Value](#declare-datetime-value)
* [INSERT And SELECT DATETIME Value](#insert-and-select-datetime-value)
* [DATETIME vs. TIMESTAMP](#datetime-vs-timestamp)

### Declare DATETIME Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1000-01-01 00:00:00 | 9999-12-31 23:59:59 | 5 |  bytes | -

MySQL `DATETIME` to store a value that contains both `date` and `time`. MySQL displays the `DATETIME` value in the following format:

```sql
YYYY-MM-DD HH:MM:SS
```

a `DATETIME` value can include a trailing fractional second up to microseconds with the format `YYYY-MM-DD HH:MM:SS[.fraction]`. When including the fractional second precision,` DATETIME` values require more storage as illustrated in the following table:

Fractional Seconds Precision | Storage (Bytes)
---|---|
0 | 0
1,2 | 1
3,4 | 2
5,6 | 3

```sql
CREATE TABLE timestamp_n_datetime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dt DATETIME
);
```

### INSERT And SELECT DATETIME Value
```sql
INSERT INTO timestamp_n_datetime(dt)
VALUES(NOW());
# then
SELECT
    dt
FROM
    timestamp_n_datetime;
```

<pre>
+----------------------+
| dt                   |
+----------------------+
| 2018-08-12 08:52:19  |
+----------------------+
</pre>

### DATETIME vs. TIMESTAMP

The `TIMESTAMP` requires **4 bytes** while `DATETIME` requires **5 bytes**. Both `TIMESTAMP` and `DATETIME` require additional bytes for fractional seconds precision.

MySQL stores `TIMESTAMP` in **UTC value**. However, MySQL stores the `DATETIME` value as is **without timezone**. Let’s see the following example.

```sql
SET time_zone = '+00:00';

CREATE TABLE timestamp_n_datetime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ts TIMESTAMP,
    dt DATETIME
);

INSERT INTO timestamp_n_datetime(ts,dt)
VALUES(NOW(),NOW());

SELECT
    ts,
    dt
FROM
    timestamp_n_datetime;
```

<pre>
+----------------------+----------------------+
| ts                   | dt                   |
+----------------------+----------------------+
| 2018-08-12 08:52:19  | 2018-08-12 08:52:19  |
+----------------------+----------------------+
</pre>

Now, set the connection’s time zone to `+03:00` and query data from the `timestamp_n_datetime` table again.

```sql
SET time_zone = '+03:00';

SELECT
    ts,
    dt
FROM
    timestamp_n_datetime;
```

<pre>
+----------------------+----------------------+
| ts                   | dt                   |
+----------------------+----------------------+
| 2018-08-12 11:52:19  | 2018-08-12 08:52:19  |
+----------------------+----------------------+
</pre>

the value of the `TIMESTAMP` column is adjusted according to the new time zone.

It means that if you use the `TIMESTAMP` data to store date and time values, you should take a serious consideration when you move your database to a server located in a different time zone.

You can use with `DATETIME` a lot of functions to help you when`SELECT` or `INSERT`, check them form [here](../functions)
