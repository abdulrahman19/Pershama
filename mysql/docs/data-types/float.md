# FLOAT

* [Declare FLOAT Value](#declare-float-value)
* [INSERT And SELECT FLOAT Value](#insert-and-select-float-value)
* [Last Advice](#last-advice)

**To well understand how MySQL deal with Floating-Point numbers check this resources:**
* [Youtube - IEEE 754 Floating Point series](https://www.youtube.com/playlist?list=PLKK11Ligqithrgou1e6_kl9HJr1jI_LcT)
* [Wikipedia - IEEE 754](https://en.wikipedia.org/wiki/IEEE_754)
* [Wikipedia - Single-precision floating-point](https://en.wikipedia.org/wiki/Single-precision_floating-point_format)
* [Wikipedia - Double-precision floating-point](https://en.wikipedia.org/wiki/Double-precision_floating-point_format)

### Declare FLOAT Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
-3.402823466E+38 | -1.175494351E-38 | 4 |  Bytes | Signed
1.175494351E-38 | 3.402823466E+38 | 4 |  Bytes | Unsigned

The MySQL `FLOAT` data type is **Floating-Point Types** represent **approximate numeric data values** and used to store **Scientific Notation** form in the database.

A precision from 0 to 23 ([Mantissa / Significand bits](https://en.wikipedia.org/wiki/Significand)) results in a 4-byte single-precision `FLOAT` column.

<pre>
S  EEEEEEEE FFFFFFFFFFFFFFFFFFFFFFF
31 30    23 22                    0

S = Sign = 1 bit
E = Exponent = 8 bits
F = Fraction = 24 bits (23 explicitly stored)
</pre>

```sql
column_name FLOAT;
# MySQL allows a nonstandard syntax, so you can write it like.
column_name FLOAT(P,D);
```

**Scientific Notations**

Scientific Notations is a pattern like X.xxxxxx Ex , Ex = 10^x.

For example: 1234567890000000 number will represent like that in scientific notation **1.23456789E^15**.

But MySQL `FLOAT` type will represent it like **1.23457e15**.

You may ask why? That's a good question : )

`FLOAT` data type represent 6 digits before approximate the value and 15 digits before convert the value to scientific notation **- by default\***. So, the number **1234567890000000** is 16 digits so MySQL will convert it to scientific notation it should be like **1.23456789e15** but because `FLOAT` data type only represent 6 digits, so it'll approximate the value **6789** to **7**, and the last number will be **1.23457e15**.

If you want to represent more then 6 digits you can use [DOUBLE](./double.md)

**\*By default**

For **maximum portability**, code requiring storage of approximate numeric data values should use `FLOAT` or `DOUBLE` PRECISION with **no specification of precision or number of digits**.

However, if you do specify length, then MySQL **will round** the float to the number of decimals specified.

For example, a column defined as `FLOAT(7,4)` will look like **-999.9999** when displayed. MySQL performs rounding when storing values, so if you insert 999.00009 into a `FLOAT(7,4)` column, the approximate result is **999.0001**.

**From testing**, maximum number you should use with `FLOAT` type is 9 digits `float(9,1)`, after that it'll give you **not understandable result**.

**Create a table:**

```sql
CREATE TABLE numbers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    number_name VARCHAR(255),
    value FLOAT NOT NULL
);
```

### INSERT And SELECT DOUBLE Value
```sql
INSERT INTO numbers(number_name,value)
VALUES('Billion', 1000000000),
      ('Trillion', 1000000000000),
      ('Quadrillion', 1000000000000000);
      ('Quintillion', 1000000000000000000);
# Then
SELECT
    *
FROM
    numbers;
```

<pre>
+----+-----------------+---------------+
| id | number_name     | value         |
+----+-----------------+---------------+
| 1  | Billion         | 1000000000    |
+----+-----------------+---------------+
| 1  | Trillion        | 1000000000000 |
+----+-----------------+---------------+
| 1  | Quadrillion     | 1e15          |
+----+-----------------+---------------+
| 1  | Quintillion     | 1e18          |
+----+-----------------+---------------+
</pre>


### Last Advice
If you work with very big or very small **Floating-Point Numbers**, like a scientific equations or similar things use `FLOAT` or `DOUBLE`, but if you work with **Fixed-Point Numbers** like currency or other similar things use [DECIMAL](./decimal.md) it'll be understandable, predictable and readable.
