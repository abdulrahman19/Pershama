# CHAR

* [Declare CHAR Value](#declare-char-value)
* [INSERT And SELECT CHAR Value](#insert-and-select-char-value)

### Declare CHAR Value
The `CHAR` data type is a fixed-length character type in MySQL. `CHAR(20)` can hold up to 20 characters. The length of the `CHAR` data type can be any value from **0 to 255**.

When you store a `CHAR` value, MySQL pads its value with spaces to the length that you declared. Also When you query the `CHAR` value MySQL **removes the trailing spaces**.

If the data that you want to store is a **fixed size**, you should use the `CHAR` data type. You’ll get a better performance in comparison with `VARCHAR` in this case.

```sql
CREATE TABLE mysql_char_test (
    status CHAR(3)
);
```

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
