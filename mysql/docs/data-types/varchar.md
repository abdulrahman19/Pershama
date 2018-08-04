# VARCHAR

* [Declare VARCHAR Value](#declare-varchar-value)
* [INSERT And SELECT VARCHAR Value](#insert-and-select-varchar-value)

### Declare VARCHAR Value
MySQL `VARCHAR` is the variable-length string whose length can be up to **65,535**. MySQL stores a `VARCHAR` value as a **1-byte** or **2-byte** length prefix plus actual data.

The length prefix specifies the number of bytes in the value. If a column requires **less than 255 bytes**, the length prefix is **1 byte**. In case the column requires **more than 255 bytes**, the length prefix is **two length bytes**.

**The maximum length**, is subject to maximum row size (65,535 bytes) and the character set used. It means that **the total length of all columns should be less than 65,535 bytes**.

```sql
CREATE TABLE IF NOT EXISTS varchar_test (
    s1 VARCHAR(32765) NOT NULL,
    s2 VARCHAR(32766) NOT NULL
)  CHARACTER SET 'latin1' COLLATE LATIN1_DANISH_CI;
```

If we increase the length of the `s1` column by 1. MySQL will issue the error message.

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

MySQL will truncate the trailing spaces when inserting a `VARCHAR` value that contains trailing spaces which cause the column length exceeded.

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

MySQL will issues a warning.
