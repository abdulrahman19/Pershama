# DECIMAL

* [Declare DECIMAL Value](#declare-decimal-value)
* [INSERT And SELECT DECIMAL Value](#insert-and-select-decimal-value)

### Declare DECIMAL Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1 | 65 | - |  - | DECIMAL(P,D), P can hold to 65 digits.
0 | 30 | - |  - | DECIMAL(P,D), D can be up to 30 decimal numbers.

The MySQL `DECIMAL` data type is **Fixed-Point Types** and used to store **exact numeric values** in the database.

```sql
column_name DECIMAL(P,D);
```

In the syntax above:

* `P` is the precision that represents the number of significant digits. The range of `P` is 1 to 65.
* `D` is the scale that that represents the number of digits after the decimal point. The range of `D` is 0 and 30. MySQL requires that `D` is less than or equal to (<=) `P`.

```sql
column_name DECIMAL(P);
# is equivalent
column_name DECIMAL(P,0);
```

In this case, the column contains **no fractional part or decimal point**, so it'll approximate the value.

```sql
column_name DECIMAL;
# is equivalent
column_name DECIMAL(10,0);
```

**MySQL DECIMAL storage**

MySQL assigns the storage for integer and fractional parts separately. MySQL uses binary format to store the `DECIMAL` values. It packs **9 digits into 4 bytes**. The storage required for **leftover digits** is illustrated in the following table:

Leftover Digits | Bytes
---|---|
0 | 0
1-2 | 1
3-4 | 2
5-6 | 3
7-9 | 4

For example, `DECIMAL(19,9)` has 9 digits for the fractional part so The fractional part requires 4 bytes. <br> The integer part requires 4 bytes for the first 9 digits, for 1 leftover digit, it requires 1 more byte. <br> In total, the `DECIMAL(19,9)` column requires **9 bytes**.


**UNSIGNED And ZEROFILL**

Like the `INT` data type, the `DECIMAL` type also has `UNSIGNED` and `ZEROFILL` attributes.

**Create a table:**

```sql
CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255),
    cost DECIMAL(19 , 4 ) NOT NULL
);
```

### INSERT And SELECT DECIMAL Value
```sql
INSERT INTO materials(description,cost)
VALUES('Bicycle', 500.34),('Seat',10.23),('Break',5.21);
# Then
SELECT
    *
FROM
    materials;
```

<pre>
+----+-------------+----------+
| id | description | cost     |
+----+-------------+----------+
| 1  | Bicycle     | 500.3400 |
+----+-------------+----------+
| 2  | Seat        | 10.2300  |
+----+-------------+----------+
| 3  | Break       | 5.2100   |
+----+-------------+----------+
</pre>

With `ZEROFILL`

<pre>
+----+-------------+----------------------+
| id | description | cost                 |
+----+-------------+----------------------+
| 1  | Bicycle     | 000000000000500.3400 |
+----+-------------+----------------------+
</pre>
