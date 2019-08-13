# CHAR

* [Declare CHAR Value](#declare-char-value)
* [INSERT And SELECT CHAR Value](#insert-and-select-char-value)

### Declare CHAR Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
0 | 255 | The `compact` family of `InnoDB` row formats optimize storage for variable-length character sets such as `utf8mb3` and `utf8mb4` [See Here](https://dev.mysql.com/doc/refman/8.0/en/innodb-physical-record.html#innodb-compact-row-format-characteristics). Otherwise, `M × w` bytes, `0 >= M <= 255`, where `w` is the number of bytes required for the maximum-length character in the character set. | bytes | CHAR(M)

The `CHAR` data type is a fixed-length character type in MySQL. `CHAR(20)` can hold up to 20 characters. The length of the `CHAR` data type can be any value from **0 to 255**.

When you store a `CHAR` value, MySQL **pads its value with spaces to the length that you declared**. Also **When you query the `CHAR` value MySQL removes the trailing spaces**. Note that MySQL will not remove the trailing spaces if you enable the `PAD_CHAR_TO_FULL_LENGTH` SQL mode.

If a `CHAR` column is indexed, comparisons ignore space-padded at the end. This means that, if the index requires unique values, duplicate-key errors will occur for values **that differ only in the number of trailing spaces**. For example, if a table contains 'a', an attempt to store 'a ' causes a **duplicate-key error**.

If strict SQL mode is not enabled when you assign a value to a `CHAR` column that exceeds the column's maximum length, the value is truncated to fit and a warning is generated. Otherwise, you can cause an error to occur. Truncation of excess *trailing spaces* from inserted values is performed silently, regardless of the SQL mode.

```sql
CREATE TABLE mysql_char_test (
    status CHAR(3)
);
```
Whatever the value stored on `status` column, even empty string it'll take **3 bytes**. In `single-byte character set` such as `latin1`.

The value | Value stored in the database ( . = space ) | Storage Required (bytes)
---|---|---|
'' | '...'|3
'a' | 'a..'| 3
'ab' | 'ab.' | 3
'abc' | 'abc' | 3

If the data that you want to store is a **fixed size**, you should use the `CHAR` data type. You’ll get a better performance in comparison with `VARCHAR` in this case.

### INSERT And SELECT CHAR Value
```sql
INSERT INTO mysql_char_test(status)
VALUES('Yes'),('No');
# then
SELECT
    status, LENGTH(status) As length
FROM
    mysql_char_test;
```

<pre>
+--------+--------+
| status | length |
+--------+--------+
| Yes    | 3      |
+--------+--------+
| No     | 2      |
+--------+--------+
</pre>

When you insert value like this

```sql
INSERT INTO mysql_char_test(status)
VALUES(' Y ');
```

MySQL will **removes the trailing space**.

```sql
SELECT
    status, LENGTH(status) As length
FROM
    mysql_char_test;
```

<pre>
+--------+--------+
| status | length |
+--------+--------+
| Yes    | 3      |
+--------+--------+
| No     | 2      |
+--------+--------+
|  y     | 2      |
+--------+--------+
</pre>
