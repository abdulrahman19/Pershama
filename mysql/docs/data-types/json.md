# JSON

* [Introduction](#introduction)
* [Partial Updates of JSON Values](#partial-updates-of-json-values)
* [Creating JSON Values](#creating-json-values)
* [SELECT JSON Values](#select-json-values)
* [Normalized JSON Values](#normalized-json-values)
* [Merging JSON Values](#merging-json-values)
* [Searching and Modifying JSON Values](#searching-and-modifying-json-values)


### Introduction
Min | Max (approximate) | Length | Unit | Note
---|---|---|---|---|
0 | 4 `GB` 294 `MB` | L + 4 bytes, where L < 2^32, 2^32 = 4,294,967,296 |  Bytes | -


The `JSON` data type provides these advantages over storing JSON-format strings in a string column:
* Automatic validation of `JSON` documents stored in `JSON` columns. Invalid documents produce an error.
* Optimized storage format. `JSON` documents stored in `JSON` columns are converted to an internal format that permits quick read access to document elements.

MySQL 8.0 also supports the `JSON` Merge Patch format defined in `RFC 7396`, using the `JSON_MERGE_PATCH()` function.

**The space required to store a `JSON` document is roughly the same as for `LONGBLOB` or `LONGTEXT`**

A `JSON` column cannot have a default value.

`JSON` columns, like columns of other binary types, are not indexed directly, instead, you can create an index on a generated column that extracts a scalar value from the `JSON` column.

### Partial Updates of JSON Values
the optimizer can perform a partial, in-place update of a `JSON` column instead of removing the old document and writing the new document in its entirety to the column.

This optimization can be performed for an update that meets the following conditions:
* The column being updated was declared as JSON.
* **The `UPDATE` statement uses any of the three functions `JSON_SET()`, `JSON_REPLACE()`, or `JSON_REMOVE()` to update the column. A direct assignment of the column value (for example, `UPDATE mytable SET jcol = '{"a": 10, "b": 25'})` cannot be performed as a partial update.**
* Updates of multiple `JSON` columns in a single `UPDATE` statement can be optimized in this fashion; MySQL can perform partial updates of only those columns whose values are updated using the three functions just listed.
* The input column and the target column must be the same column; a statement such as `UPDATE mytable SET jcol1 = JSON_SET(jcol2, '$.a', 100)` cannot be performed as a partial update. The update can use nested calls to any of the functions listed in the previous item, in any combination, as long as the input and target columns are the same.
* All changes replace existing array or object values with new ones, and do not add any new elements to the parent object or array.
* The value being replaced must be at least as large as the replacement value. In other words, **the new value cannot be any larger than the old one**. A possible exception to this requirement occurs when a previous partial update has left sufficient space for the larger value. You can use the function `JSON_STORAGE_FREE()` see how much space has been freed by any partial updates of a `JSON` column.


Such partial updates can be written to the binary log using a compact format that saves space; this can be enabled by setting the `binlog_row_value_options` system variable to `PARTIAL_JSON`.


### Creating JSON Values
A **JSON array** contains a list of values separated by commas and enclosed within [ and ] characters:
```sql
["abc", 10, null, true, false]
```
A **JSON object** contains a set of key-value pairs separated by commas and enclosed within { and } characters:
```sql
{"k1": "value", "k2": 10}
```
Nesting is permitted within JSON array elements and JSON object key values:
```sql
[99, {"id": "HK500", "cost": 75.99}, ["hot", "cold"]]
{"k1": "value", "k2": [10, 20]}
```

```sql
CREATE TABLE t1 (jdoc JSON);
# Query OK, 0 rows affected (0.20 sec)

INSERT INTO t1 VALUES('{"key1": "value1", "key2": "value2"}');
# Query OK, 1 row affected (0.01 sec)

INSERT INTO t1 VALUES('[1, 2,');
# ERROR 3140 (22032) at line 2: Invalid JSON text:
# "Invalid value." at position 6 in value (or column) '[1, 2,'.
```

The `JSON_TYPE()` function expects a `JSON` argument and attempts to parse it into a `JSON` value. It returns the value's JSON type if it is valid and produces an error otherwise:

```sql
SELECT JSON_TYPE('["a", "b", 1]');
# +----------------------------+
# | JSON_TYPE('["a", "b", 1]') |
# +----------------------------+
# | ARRAY                      |
# +----------------------------+

SELECT JSON_TYPE('hello');
# ERROR 3146 (22032): Invalid data type for JSON data in argument 1
# to function json_type; a JSON string or JSON type is required.
```

**As an alternative to writing JSON values using literal strings, functions exist for composing JSON values from component elements**.

`JSON_ARRAY()` takes a (possibly empty) list of values and returns a JSON array containing those values:
```sql
SELECT JSON_ARRAY('a', 1, NOW());
# +----------------------------------------+
# | JSON_ARRAY('a', 1, NOW())              |
# +----------------------------------------+
# | ["a", 1, "2015-07-27 09:43:47.000000"] |
# +----------------------------------------+
```
`JSON_OBJECT()` takes a (possibly empty) list of key-value pairs and returns a JSON object containing those pairs:
```sql
SELECT JSON_OBJECT('key1', 1, 'key2', 'abc');
# +---------------------------------------+
# | JSON_OBJECT('key1', 1, 'key2', 'abc') |
# +---------------------------------------+
# | {"key1": 1, "key2": "abc"}            |
# +---------------------------------------+
```
`JSON_MERGE_PRESERVE()` takes two or more JSON documents and returns the combined result:
```sql
SELECT JSON_MERGE_PRESERVE('["a", 1]', '{"key": "value"}');
# +-----------------------------------------------------+
# | JSON_MERGE_PRESERVE('["a", 1]', '{"key": "value"}') |
# +-----------------------------------------------------+
# | ["a", 1, {"key": "value"}]                          |
# +-----------------------------------------------------+
```
**Case sensitivity also applies to the `JSON` null, true, and false literals, which always must be written in lowercase:**
```sql
SELECT JSON_VALID('null'), JSON_VALID('Null'), JSON_VALID('NULL');
# +--------------------+--------------------+--------------------+
# | JSON_VALID('null') | JSON_VALID('Null') | JSON_VALID('NULL') |
# +--------------------+--------------------+--------------------+
# |                  1 |                  0 |                  0 |
# +--------------------+--------------------+--------------------+
```
Sometimes it may be necessary or desirable to insert quote characters (`"` or `'`) into a `JSON` document. One way to insert this as a `JSON` object into the `facts` table is to use the MySQL `JSON_OBJECT()` function. In this case, you must escape each quote character using a backslash, as shown here:
```sql
INSERT INTO facts VALUES
(JSON_OBJECT("mascot", "Our mascot is a dolphin named \"Sakila\"."));
```
This does not work in the same way if you insert the value as a JSON object literal, in which case, you must use the double backslash escape sequence, like this:
```sql
INSERT INTO facts VALUES
('{"mascot": "Our mascot is a dolphin named \\"Sakila\\"."}');
```

### SELECT JSON Values
```sql
SELECT sentence FROM facts;
# +---------------------------------------------------------+
# | sentence                                                |
# +---------------------------------------------------------+
# | {"mascot": "Our mascot is a dolphin named \"Sakila\"."} |
# +---------------------------------------------------------+
```
You can see that the backslashes are present in the `JSON` column value by doing a simple `SELECT`.

**To look up this particular sentence employing mascot as the key, you can use the column-path operator `->`, as shown here:**
```sql
SELECT col->"$.mascot" FROM qtest;
# +---------------------------------------------+
# | col->"$.mascot"                             |
# +---------------------------------------------+
# | "Our mascot is a dolphin named \"Sakila\"." |
# +---------------------------------------------+
```
**To display the desired value using mascot as the key, but without including the surrounding quote marks or any escapes, use the inline path operator `->>`, like this:**
```sql
SELECT sentence->>"$.mascot" FROM facts;
# +-----------------------------------------+
# | sentence->>"$.mascot"                   |
# +-----------------------------------------+
# | Our mascot is a dolphin named "Sakila". |
# +-----------------------------------------+
```

> The previous example does not work as shown if the `NO_BACKSLASH_ESCAPES` server SQL mode is enabled.

### Normalized JSON Values
When a string is parsed and found to be a valid JSON document, it is also normalized. This means that members with keys that duplicate a key found later in the document, reading from left to right, are discarded.
```sql
SELECT JSON_OBJECT('key1', 1, 'key2', 'abc', 'key1', 'def');
# +------------------------------------------------------+
# | JSON_OBJECT('key1', 1, 'key2', 'abc', 'key1', 'def') |
# +------------------------------------------------------+
# | {"key1": "def", "key2": "abc"}                       |
# +------------------------------------------------------+
```
Normalization is also performed when values are inserted into JSON columns, as shown here:
```sql
INSERT INTO t1 VALUES
('{"x": 17, "x": "red"}'),
('{"x": 17, "x": "red", "x": [3, 5, 7]}');

SELECT c1 FROM t1;
# +------------------+
# | c1               |
# +------------------+
# | {"x": "red"}     |
# | {"x": [3, 5, 7]} |
# +------------------+
```
**In versions of MySQL less then 8.0.3**, members with keys that duplicated a key found earlier in the document were discarded.
```sql
SELECT JSON_OBJECT('key1', 1, 'key2', 'abc', 'key1', 'def');
# +------------------------------------------------------+
# | JSON_OBJECT('key1', 1, 'key2', 'abc', 'key1', 'def') |
# +------------------------------------------------------+
# | {"key1": 1, "key2": "abc"}                           |
# +------------------------------------------------------+
```

### Merging JSON Values
Two merging algorithms are supported in MySQL 8.0.3 (and later), implemented by the functions `JSON_MERGE_PRESERVE()` and `JSON_MERGE_PATCH()`. These differ in how they handle duplicate keys:

`JSON_MERGE_PRESERVE()` / `JSON_MERGE()` retains values for duplicate keys,

while `JSON_MERGE_PATCH()` discards all but the last value.

```sql
# multiple arrays
SELECT
JSON_MERGE_PRESERVE('[1, 2]', '["a", "b", "c"]', '[true, false]') AS Preserve,
JSON_MERGE_PATCH('[1, 2]', '["a", "b", "c"]', '[true, false]') AS Patch\G
# Preserve: [1, 2, "a", "b", "c", true, false]
#    Patch: [true, false]

# Multiple objects
SELECT
JSON_MERGE_PRESERVE('{"a": 1, "b": 2}', '{"c": 3, "a": 4}', '{"c": 5, "d": 3}') AS Preserve,
JSON_MERGE_PATCH('{"a": 3, "b": 2}', '{"c": 3, "a": 4}', '{"c": 5, "d": 3}') AS Patch\G
# Preserve: {"a": [1, 4], "b": 2, "c": [3, 5], "d": 3}
#    Patch: {"a": 4, "b": 2, "c": 5, "d": 3}

# Non-array values
SELECT
JSON_MERGE_PRESERVE('1', '2') AS Preserve,
JSON_MERGE_PATCH('1', '2') AS Patch\G
# Preserve: [1, 2]
#    Patch: 2

# Array and object values
SELECT
JSON_MERGE_PRESERVE('[10, 20]', '{"a": "x", "b": "y"}') AS Preserve,
JSON_MERGE_PATCH('[10, 20]', '{"a": "x", "b": "y"}') AS Patch\G
# Preserve: [10, 20, {"a": "x", "b": "y"}]
#    Patch: {"a": "x", "b": "y"}
```

### Searching and Modifying JSON Values
For more details about how to search and modify JSON values please read this part on the [documentation](https://dev.mysql.com/doc/refman/8.0/en/json.html#json-paths)
