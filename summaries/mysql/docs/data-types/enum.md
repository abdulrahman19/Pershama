# ENUM

* [Declare ENUM Value](#declare-enum-value)
* [INSERT And SELECT ENUM Value](#insert-and-select-enum-value)

### Declare ENUM Value
Min | Max | Length | Unit | Note
---|---|---|---|---|
1 | 2 | 1 or 2 bytes, depending on the number of enumeration values (65,535 maximum distinct elements) <br> <br> The maximum supported length of an individual `ENUM` element (The string itself) is `M <= 255` and `(M x w) <= 1020`, where `M` is the element literal length and `w` is the number of bytes required for the maximum-length character in the character set. | Bytes | -

An `ENUM` is a string object with a value chosen from a list of permitted values that are enumerated explicitly in the column specification at table creation time.

#### The `ENUM` data type provides the following advantages:

* Compact data storage in situations where a column has a limited set of possible values. **The strings you specify as input values are automatically encoded as numbers**. Inserting 1 million rows into this table with a value of 'medium' would require 1 million bytes of storage, as opposed to 6 million bytes if you stored the actual string 'medium' in a `VARCHAR` column.
* Readable queries and output.

#### MySQL `ENUM` disadvantages

* If you make enumeration values that look like numbers, it is easy to mix up the literal values with their internal index numbers.
* Changing enumeration members requires rebuilding the entire table using the `ALTER TABLE` statement, which is expensive in terms of resources and time.
* Getting the complete enumeration list is complex because you need to access the `information_schema` database.
* Porting to other RDBMS could be an issue because `ENUM` is not SQL-standard and not many database system support it.
* Adding more attributes to the enumeration list is impossible. Suppose you want to add a service agreement for each priority e.g., High (24h), Medium (1-2 days), Low (1 week), it is not possible with `ENUM`. In this case, you need to have a separate table for storing priority list e.g., `priorities(id, name, sort_order, description)` and replace the priority field in the tickets table by `priority_id` that references to the id field of the priorities table.

#### Index Values for Enumeration Literals
* The elements listed in the column specification are assigned index numbers, beginning with `1`.
* The index value of the **empty string** error value is `0`.
* The index of the `NULL` value is `NULL`.

For example, a column specified as `ENUM('Mercury', 'Venus', 'Earth')` can have any of the values shown here. The index of each value is also shown.

Value | Index
---|---|
'' | 0
'Mercury' | 1
'Venus' | 2
'Earth' | 3

#### Sorting MySQL `ENUM` values

MySQL sorts `ENUM` values based on their index numbers. Therefore, the order of member depends on how they were defined in the enumeration list. So:

* Specify the `ENUM` list in alphabetic order.
* Make sure that the column is sorted lexically rather than by index number by coding `ORDER BY CAST(col AS CHAR)` or `ORDER BY CONCAT(col)`.

**Create a table:**

```sql
CREATE TABLE tickets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    priority ENUM('Low', 'Medium', 'High') NOT NULL
);
```

### INSERT And SELECT ENUM Value

```sql
INSERT INTO tickets(title, priority)
VALUES('Scan virus for computer A', 'High');
# or
INSERT INTO tickets(title, priority)
VALUES('Upgrade Windows OS for all computers', 1);

SELECT
    *
FROM
    tickets
WHERE
    priority = 'High';
```

<pre>
+----+---------------------------+----------+
| id | title                     | priority |
+----+---------------------------+----------+
| 1  | Scan virus for computer A | High     |
+----+---------------------------+----------+
</pre>
