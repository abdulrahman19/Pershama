# VARBINARY

* [Declare VARBINARY Value](#declare-varbinary-value)
* [INSERT And SELECT VARBINARY Value](#insert-and-select-varbinary-value)

### Declare VARBINARY Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
0 | 255 | L + 1 bytes if column values require 0 − 255 bytes | bytes | VARBINARY(L)
0 | - | L + 2 bytes if values may require more than 255 bytes | bytes | VARBINARY(L)

The `VARBINARY` types are similar to [VARCHAR](./varchar.md), except that they contain binary strings rather than nonbinary strings. This means they have the binary character set and collation, and comparison and sorting are based on the **numeric values** of the bytes in the values.

If strict SQL mode is not enabled and you assign a value to a `VARBINARY` column that exceeds the column's maximum length, the value is truncated to fit and a warning is generated.

`VARBINARY` there is no padding on insert and no bytes are stripped on select.

If a `VARBINARY` column is indexed, **comparisons not ignore padded at the end**. This means that, if a table contains 'a', an attempt to store 'a\0' it will be valid.

**Create a table:**

```sql
CREATE TABLE mysql_varbinary_test (
    c VARBINARY(3)
);
```

### INSERT And SELECT VARBINARY Value
```sql
INSERT INTO mysql_varbinary_test(`c`)
VALUES('a');

SELECT c, HEX(c), c = 'a', c = 'a\0\0' from mysql_varbinary_test;
```

<pre>
+----------+--------+---------+-------------+
| c        | HEX(c) | c = 'a' | c = 'a\0\0' |
+----------+--------+---------+-------------+
| a        | 61     | 1       | 0           |
+----------+--------+---------+-------------+
</pre>
