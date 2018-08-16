# VARCHAR

* [Declare VARCHAR Value](#declare-varchar-value)
* [INSERT And SELECT VARCHAR Value](#insert-and-select-varchar-value)

### Declare VARCHAR Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
0 | 255 | L + 1 bytes if column values require 0 − 255 bytes | bytes | VARCHAR(L)
0 | - | L + 2 bytes if values may require more than 255 bytes | bytes | >= 5.0.3 and what the character set used.

MySQL `VARCHAR` is the variable-length string whose length can be up to **255** or **65,535**. MySQL stores a `VARCHAR` value as a **1-byte** or **2-byte** length prefix plus actual data.

The length prefix specifies the number of bytes in the value. If a column requires **less than 255 bytes**, the length prefix is **1 byte**. In case the column requires **more than 255 bytes**, the length prefix is **two length bytes**.

**The maximum length**, is subject to maximum row size (65,535 bytes) and **the character set used**. It means that **the total length of all columns should be less than 65,535 bytes**.

```sql
CREATE TABLE IF NOT EXISTS varchar_test (
    s1 VARCHAR(32765) NOT NULL,
    s2 VARCHAR(32766) NOT NULL
)  CHARACTER SET 'latin1' COLLATE LATIN1_DANISH_CI;
```

If we increase the length of the `s1` column by 1. MySQL will issue the error message.

If You declared `VARCHAR(3)` In `single-byte character set` such as `latin1`, the data will store like:

VARCHAR(3) | Storage Required (bytes)
---|---|
'' | 1
'a' | 2
'ab' | 3
'abc' | 4

Truncation of excess trailing spaces from values to be inserted into `VARCHAR` columns always generates a warning, regardless of the SQL mode.

For `VARCHAR` column, there is no padding on insert and no bytes are stripped on select.

If a `VARCHAR` column is indexed, comparisons ignore space-padded at the end. This means that, if the index requires unique values, duplicate-key errors will occur for values **that differ only in the number of trailing spaces**. For example, if a table contains 'a', an attempt to store 'a ' causes a **duplicate-key error**.

### INSERT And SELECT VARCHAR Value
```sql
INSERT INTO items(title)
VALUES('AB ');
# then
SELECT
    id, title, length(title) AS length
FROM
    items;
```

<pre>
+----+--------+--------+
| id | title  | length |
+----+--------+--------+
| 1  | AB     | 3      |
+----+--------+--------+
</pre>

In case like following, MySQL will issues a warning.

```sql
INSERT INTO items(title)
VALUES('ABC ');
# then
SELECT
    id, title, length(title) AS length
FROM
    items;
```

<pre>
+----+--------+--------+
| id | title  | length |
+----+--------+--------+
| 1  | AB     | 3      |
+----+--------+--------+
| 1  | ABC    | 3      |
+----+--------+--------+
</pre>
