# DATE

* [Declare DATE Value](#declare-date-value)
* [INSERT And SELECT DATE Value](#insert-and-select-date-value)

### Declare DATE Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1000-01-01 | 9999-12-31 | 3 |  bytes | -

MySQL `DATE` is one of  the five temporal data types used for managing date values. MySQL uses `yyyy-mm-dd` format for storing a date value. This format is **fixed and it is not possible to change it**.

If you want to store a date value that is out of this range, you need to use a non-temporal data type like `integer` e.g., use three columns to save year, month, day.

When strict mode is disabled, MySQL converts any invalid date e.g., `2015-02-30` to the zero date value `0000-00-00`.

**Date values with two-digit years**

* Year values in the range 00-69 are converted to 2000-2069.
* Year values in the range 70-99 are converted to 1970 – 1999.

```sql
CREATE TABLE people (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    birth_date DATE NOT NULL
);
```

### INSERT And SELECT DATE Value

```sql
INSERT INTO people(first_name,last_name,birth_date)
VALUES('John','Doe','1990-09-01');
# then
SELECT
    first_name,
    last_name,
    birth_date
FROM
    people;
```

<pre>
+------------+-----------+------------+
| first_name | last_name | birth_date |
+------------+-----------+------------+
| John       | Doe       | 1990-09-01 |
+------------+-----------+------------+
</pre>


You can use with `DATE` a lot of functions to help you when`SELECT` or `INSERT`, check them form [here](../functions)
