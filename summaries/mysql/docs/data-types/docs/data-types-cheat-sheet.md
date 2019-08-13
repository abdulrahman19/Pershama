# Data Types Cheat Sheet
* [Numeric Data](#numeric-data)
* [Date And Time](#date-and-time)
* [String Data](#string-data)
* [JSON Data](#json-data)

### Numeric Data
Numeric types can use **Width Attribute**, **ZEROFILL Attribute** and **UNSIGNED Attribute**.

**1- Integer**

Integers are stands for the integer that is a whole number. An integer can be written without a fractional component. An integer can be zero, positive (unsigned), and negative (signed).

Type | Length | Unit
---|---|---|
TINYINT | 1 | Byte
SMALLINT | 2 | Bytes
MEDIUMINT | 3 | Bytes
INT | 4 | Bytes
BIGINT | 8 | Bytes

**2- Point Types**

`DECIMAL` data type is **Fixed-Point** Types and used to store **exact numeric values** in the database, like currency.

`DECIMAL(P,D)` => `P` (precision) up to 65 and `D` (decimal) up to 30. MySQL requires that `D` is less than or equal to (<=) `P`.

```sql
column_name DECIMAL(P);
# is equivalent
column_name DECIMAL(P,0);
```

`DECIMAL` Table storage:


Leftover Digits | Bytes
---|---|
0 | 0
1-2 | 1
3-4 | 2
5-6 | 3
7-9 | 4

`DECIMAL(19,9)` will be like (9+1) + 9, (4+1) + 4 = 9 bytes.

`FLOAT` and `DOUBLE` data types are **Floating-Point** Types represent **approximate numeric data values** and used to store Scientific Notation form in the database.

And you should use `FLOAT` or `DOUBLE` precision with no specification of precision or number of digits for maximum portability.

Type | Length | Unit
---|---|---|
FLOAT | 4 or when format like `FLOAT(P)` it be **4 bytes if 0 <= p <= 24**, **8 bytes if 25 <= p <= 53** | bytes
DOUBLE | 8 | bytes


`REAL`  is a synonym for `DOUBLE` precision.

**3- Other Types**

`bit` type that allows you to store bit values. To specify a bit value literal, you use `b'val'` or `0b'val'` notation, which val is a binary value that contains only `0` and `1`. The leading `0b` is case-sensitive.

If you insert a value to a `BIT(m)` column that is less than m bits long, MySQL will pad zeros on the left of the bit value.

To show bit values when select use `bin()` function and `lpad()` to show right zeros.

Type | Length | Unit
---|---|---|
bit | 64 | bits

`BOOLEAN`, MySQL does not have built-in `BOOLEAN` type. However, it uses `TINYINT(1)` instead. To make it more convenient, MySQL provides `BOOLEAN` or `BOOL` as the synonym of `TINYINT(1)`.

`SERIAL` is an alias for `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE`.

### Date And Time
* `DATE` is one of the five temporal data types used for managing date values, range from `1000-01-01` to `9999-12-31`.
* `DATETIME` to store a value that contains both date and time, range from `1000-01-01 00:00:00` to `9999-12-31 23:59:59`.
* `TIMESTAMP` is a temporal data type that holds the combination of date and time, range from `1970-01-01 00:00:01 UTC` to `2038-01-19 03:14:07 UTC`.
* `TIME` for querying and displaying a time value that represents a time of day, range from `-838:59:59` to `838:59:59`.
* `YEAR` type is a 1-byte type used to represent year values, range from `1901` to `2155`.

Type | Length | Unit
---|---|---|
DATE | 3 | bytes
DATETIME | 5 | bytes
TIMESTAMP | 4 | bytes
TIME | 3 | bytes
YEAR | 1 | byte

**DATETIME vs. TIMESTAMP**

The `TIMESTAMP` requires 4 bytes while `DATETIME` requires 5 bytes. Both `TIMESTAMP` and `DATETIME` require additional bytes for fractional seconds precision.

MySQL stores `TIMESTAMP` in **UTC value**. However, MySQL stores the DATETIME value as is without timezone.

### String Data

**1- Small String Data "less" then 255 bytes**

* `CHAR` data type is a fixed-length character type.
* `VARCHAR` is the variable-length string.
* `BINARY` data type is a fixed-length binary strings.
* `VARBINARY` is the variable-length binary string.

description | CHAR | VARCHAR | BINARY | VARBINARY
---|---|---|---|---|
Add padding when insert  | Yes | No | Yes | No
Removes trailing when select | Yes | No | No | No
'a' = 'a.', . = space | Yes | Yes | Yes | No
*Truncation of excess trailing non-spaces | warning | warning | warning | warning
*Truncation of excess trailing spaces | silently | warning | warning | warning

\* If strict SQL mode is not enabled.

**2- Big String Data "more" then 255 bytes**

`TEXT` and `BOLB` columns as a `VARCHAR` and `VARBINARY` columns that can be as large as you like. `TEXT` and `BOLB` differ from `VARCHAR` and `VARBINARY` in the following ways:
* For indexes on `TEXT` or `BOLB` column, you must specify an index prefix length. For `CHAR` and `VARCHAR`, a prefix length is optional.
* `TEXT` or `BOLB` column cannot have DEFAULT values.

Type | Length | Unit
---|---|---|
TINYTEXT / TINYBOLB | 255 | bytes
TEXT / BOLB | 65 `KB` | bytes
MEDIUMTEXT / MEDIUMBOLB | 16 `MB` 777 `KB` | bytes
LONGTEXT / LONGBOLB | 4 `GB` 294 `MB` | bytes

**3- Other Types**

`ENUM:`

`ENUM` is a string object with a value chosen from a list of permitted values that are enumerated explicitly in the column specification at table creation time.

MySQL sorts `ENUM` values based on their index numbers. Therefore, the order of member depends on how they were defined in the enumeration list.

Advantages:
* `ENUM` is a compact data storage in situations where a column has a limited set of possible values. The strings you specify as input values are automatically encoded as numbers.
* Readable queries and output.

Disadvantages:
* If you make enumeration values that look like numbers, it is easy to mix up the literal values with their internal index numbers.
* Changing enumeration members requires rebuilding the entire table.
* Porting to other RDBMS could be an issue because `ENUM` is not SQL-standard.

`SET:`
* `SET` is a string object that can have zero or more values, each of which must be chosen from a list of permitted values specified when the table is created.

Type | Length | Unit
---|---|---|
ENUM | 1 or 2 | bytes
SET | 1, 2, 3, 4, or 8 | bytes

### JSON Data
The `JSON` data type provides these advantages over storing JSON-format strings in a string column:
* Automatic validation of `JSON` documents stored in `JSON` columns. Invalid documents produce an error.
* Optimized storage format. `JSON` documents stored in `JSON` columns are converted to an internal format that permits quick read access to document elements.

The space required to store a `JSON` document is roughly the same as for `LONGBLOB` or `LONGTEXT`.

A `JSON` column cannot have a default value.

`JSON` columns, like columns of other binary types, are not indexed directly, instead, you can create an index on a generated column that extracts a scalar value from the `JSON` column.

The `UPDATE` statement uses any of the three functions `JSON_SET()`, `JSON_REPLACE()`, or `JSON_REMOVE()` to update the column. A direct assignment of the column value (for example, `UPDATE mytable SET jcol = '{"a": 10, "b": 25'})` cannot be performed as a **partial update**.

You can creating JSON values as **JSON array []**, **JSON object {}** or mix form both [{}]/{[]}.

To look up for JSON key, you can use the column-path operator `->`.
```sql
SELECT col->"$.val" FROM qtest;
# +---------------------------------------------+
# | col->"$.val"                                |
# +---------------------------------------------+
# | "Our mascot is a dolphin named \"Sakila\"." |
# +---------------------------------------------+
```

To display the desired value as the key, but without including the surrounding quote marks or any escapes, use the inline path operator `->>`.
```sql
SELECT sentence->>"$.val" FROM facts;
# +-----------------------------------------+
# | sentence->>"$.val"                      |
# +-----------------------------------------+
# | Our mascot is a dolphin named "Sakila". |
# +-----------------------------------------+
```

When a string is parsed and found to be a valid JSON document, it is also normalized. This means that members with keys that duplicate a key found later in the document, reading from left to right, are discarded.

Also you can merging JSON values or search and modify inside them.
