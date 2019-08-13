# INT

* [Declare INT Value](#declare-int-value)
* [INSERT And SELECT INT Value](#insert-and-select-int-value)
* [Width Attribute And ZEROFILL Attribute](#width-attribute-and-zerofill-attribute)

### Declare INT Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
-2,147,483,648 | 2,147,483,647 | 4 |  Bytes | -
0 | 4,294,967,295 | 4 |  Bytes | -

10^9 = Billion : )

`INT` stands for the integer that is a whole number. An integer can be written without a fractional component. An integer can be zero, positive (unsigned), and negative (signed).

Because integer type represents exact numbers, you usually use it as the `primary key` of a table. In addition, the `INT` column can have an `AUTO_INCREMENT` attribute.

**AUTO_INCREMENT**

When you insert a `NULL` value or `0` into the `INT AUTO_INCREMENT` column, the value of the column is set to the next `sequence` value. Notice that the `sequence` value starts with `1`.

When you insert a value, which is **not** `NULL` or `zero`, into the `AUTO_INCREMENT` column, the column accepts the value. In addition, the `sequence` **is reset to next value of the inserted value**.

**Note** that since MySQL 5.1, the `AUTO_INCREMENT` column only accepts positive values. Negative values are not supported for the `AUTO_INCREMENT` column.

```sql
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255)
);
```

### INSERT And SELECT INT Value
```sql
INSERT INTO items(title)
VALUES('laptop'), ('mouse'),('headphone');
# then
SELECT
    *
FROM
    items;
```
<pre>
+----+-----------+
| id | title     |
+----+-----------+
| 1  | laptop    |
+----+-----------+
| 2  | mouse     |
+----+-----------+
| 3  | headphone |
+----+-----------+
</pre>

### Width Attribute And ZEROFILL Attribute
MySQL provides an extension that allows you to specify the `display width` along with the `INT` data type. It is important to note that the `display width` attribute **does not control the value ranges that the column can store**.

**ZEROFILL**

In addition to the `display width`, MySQL provides a non-standard `ZEROFILL` attribute. In this case, MySQL replaces the spaces with zero.

Note that if you use `ZEROFILL` attribute for an integer column, MySQL will automatically add an `UNSIGNED` attribute to the column.

```sql
CREATE TABLE zerofill_tests(
    id INT AUTO_INCREMENT PRIMARY KEY,
    v1 INT(2) ZEROFILL,
    v2 INT(3) ZEROFILL,
    v3 INT(5) ZEROFILL
);
```

```sql
INSERT into zerofill_tests(v1,v2,v3)
VALUES(1,6,9);
# then
SELECT
    v1, v2, v3
FROM
    zerofill_tests;
```

<pre>
+----+------+-------+
| v1 | v2   | v3    |
+----+------+-------+
| 01  | 006 | 00009 |
+----+------+-------+
</pre>
