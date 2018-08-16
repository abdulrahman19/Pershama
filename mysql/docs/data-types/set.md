# SET

* [Declare SET Value](#declare-set-value)
* [INSERT And SELECT SET Value](#insert-and-select-set-value)

### Declare SET Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1 | 8 | 1, 2, 3, 4, or 8 bytes, depending on the number of set members (64 distinct members maximum) <br> <br> The maximum supported length of an individual `ENUM` element (The string itself) is `M <= 255` and `(M x w) <= 1020`, where `M` is the element literal length and `w` is the number of bytes required for the maximum-length character in the character set. | Bytes | -

A `SET` is a string object that can have zero or more values, each of which must be chosen from a list of permitted values specified when the table is created.`SET` column values that consist of multiple set members are specified with members separated by commas (,). **A consequence of this is that `SET` member values should not themselves contain commas**.

* Duplicate values in the definition cause a warning, or an error if strict SQL mode is enabled.
* If a number is stored into a `SET` column, the bits that are set in the binary representation of the number determine the set members in the column value. For a column specified as `SET('a','b','c','d')`, the members have the following decimal and binary values.

SET Member | Decimal Value | Binary Value
---|---|---|
'a' | 1 | 0001
'b' | 2 | 0010
'c' | 4 | 0100
'd' | 8 | 1000

If you assign a value of `9` to this column, that is 1001 in binary, so the first and fourth `SET` value members `'a' and 'd'` are selected and the resulting value is `'a,d'`.
* For a value containing more than one `SET` element, it does not matter what order the elements are listed in when you insert the value. It also does not matter how many times a given element is listed in the value. When the value is retrieved later, each element in the value appears once.

**Create a table:**

```sql
CREATE TABLE myset (
    col SET('a', 'b', 'c', 'd')
);
```

### INSERT And SELECT SET Value

```sql
INSERT INTO myset(col)
VALUES ('a,d'), ('d,a'), ('a,d,a'), ('a,d,d'), ('d,a,d');

SELECT
    col
FROM
    myset
```

<pre>
+------+
| col  |
+------+
| a,d  |
| a,d  |
| a,d  |
| a,d  |
| a,d  |
+------+
</pre>
