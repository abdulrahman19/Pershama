# BIT

* [Declare BIT Value](#declare-bit-value)
* [INSERT And SELECT BIT Value](#insert-and-select-bit-value)

### Declare BIT Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1 | 64 | 64 | bit | -

MySQL provides the `BIT` type that allows you to store bit values. The `BIT(m)` can store up to m-bit values, which m can range from **1 to 64**.

```sql
column_name BIT(1);
```

To specify a bit value literal, you use `b'val'` or `0b'val'` notation, which val is a binary value that contains only `0` and `1`.
The leading `0b` is **case-sensitive**.

```sql
b`10`
B`10`
# or
0b'10'
```

**Example**

```sql
CREATE TABLE working_calendar(
    y INT
    w INT,
    days BIT(7),
    PRIMARY KEY(y,w)
);
```

### INSERT And SELECT BIT Value
Suppose the Saturday and Friday of the first week of 2017 are not the working days, you can insert a row into the `working_calendar` table as follows:

```sql
INSERT INTO working_calendar(y,w,days)
VALUES(2017,1,B'1111100');
```

If you select like that:

```sql
SELECT
    y, w , days
FROM
    working_calendar;
```

The result will convert into an integer.

<pre>
+------+---+---------+
|   y  | w |   days  |
+------+---+---------+
| 2017 | 1 |   124   |
+------+---+---------+
</pre>

To represent it as bit values, you use the `BIN` function:

```sql
SELECT
    y, w , bin(days) AS days
FROM
    working_calendar;
```

<pre>
+------+---+---------+
|   y  | w |   days  |
+------+---+---------+
| 2017 | 1 | 1111100 |
+------+---+---------+
</pre>

If you insert a value to a `BIT(m)` column that is less than `m bits` long, MySQL will **pad zeros on the left** of the bit value.

```sql
INSERT INTO working_calendar(y,w,days)
VALUES(2017,1,B'111100');
# then
SELECT
    y, w , bin(days) AS days
FROM
    working_calendar;
```

<pre>
+------+---+---------+
|   y  | w |   days  |
+------+---+---------+
| 2017 | 1 |  111100 |
+------+---+---------+
</pre>

To display The zero on the left, you can use the `LPAD` function:

```sql
SELECT
    y, w , lpad(bin(days),7,'0') AS days
FROM
    working_calendar;
```

<pre>
+------+---+---------+
|   y  | w |   days  |
+------+---+---------+
| 2017 | 1 | 0111100 |
+------+---+---------+
</pre>
