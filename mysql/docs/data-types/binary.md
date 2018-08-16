# BINARY

* [Declare BINARY Value](#declare-binary-value)
* [INSERT And SELECT BINARY Value](#insert-and-select-binary-value)

### Declare BINARY Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
0 | 255 | M bytes, 0 <= M <= 255 | bytes | BINARY(M)

The `BINARY` type are similar to [CHAR](./char.md), except that they contain binary strings rather than nonbinary strings. This means they have the binary character set and collation, and comparison and sorting are based on the **numeric values** of the bytes in the values.

If strict SQL mode is not enabled and you assign a value to a `BINARY` column that exceeds the column's maximum length, the value is truncated to fit and a warning is generated.

When `BINARY` values are stored, they are right-padded with the pad value to the specified length. The pad value is 0x00 (the zero byte). Values are right-padded with 0x00 on insert, **and no trailing bytes are removed on select**. All bytes are significant in comparisons, including ORDER BY and DISTINCT operations. 0x00 bytes and spaces are different in comparisons, with 0x00 < space.

Example: For a `BINARY(3)` column, 'a ' becomes 'a \0' when inserted. 'a\0' becomes 'a\0\0' when inserted. Both inserted values remain unchanged when selected.

For those cases where trailing pad bytes are stripped or comparisons ignore them, like if a column has an index that requires unique values, inserting into the column values that differ only in number of trailing pad bytes will result in a duplicate-key error. For example, if a table contains 'a', an attempt to store 'a\0' causes a duplicate-key error.

**Create a table:**

```sql
CREATE TABLE mysql_binary_test (
    c BINARY(3)
);
```

### INSERT And SELECT BINARY Value
```sql
INSERT INTO mysql_binary_test(`c`)
VALUES('a');

SELECT c, HEX(c), c = 'a', c = 'a\0\0' from mysql_binary_test;
```

<pre>
+----------+--------+---------+-------------+
| c        | HEX(c) | c = 'a' | c = 'a\0\0' |
+----------+--------+---------+-------------+
| 0x610000 | 610000 | 0       | 1           |
+----------+--------+---------+-------------+
</pre>
