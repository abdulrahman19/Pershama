# Show Indexes

* [Filter Index Information](#filter-index-information)

To query the index information of a table.
```sql
SHOW INDEXES FROM table_name;
```

Also you can specify the database name if you are not connected to any database.
```sql
SHOW INDEXES FROM table_name IN database_name;
#or
SHOW INDEXES FROM database_name.table_name;
```

Note that `INDEX` and `KEY` are the synonyms of the `INDEXES`, also `IN` is the synonym of the `FROM`.
```sql
SHOW INDEX IN table_name FROM database_name;

SHOW KEY FROM tablename IN databasename;
```

The `SHOW INDEXES` returns the following information:

Columns | Meaning
---|---|
table | The name of the table
non_unique | 1 if the index can contain duplicates, 0 if it can.
key_name | The name of the index. The primary key index always has the name of `PRIMARY`.
seq_in_index | The column sequence number in the index. The first column sequence number starts from 1.
column_name | The column name
collation | Collation represents how the column is sorted in the index. `A` means ascending, `B` means descending, or `NULL` means not sorted.
cardinality | The cardinality returns an estimated number of unique values in the index. <br> **Note** that the higher the cardinality, the greater the chance that the query optimizer uses the index for lookups.
sub_part | The index prefix. It is null if the entire column is indexed. Otherwise, it shows the number of indexed characters in case column is partially indexed.
packed | indicates how the key is packed; `NULL` if it is not.
null | `YES` if the column may contain `NULL` values and blank if it does not.
index_type | represents the index method used such as `BTREE`, `HASH`, `RTREE`, or `FULLTEXT`.
comment | The information about the index not described in its own column.
index_comment | shows the comment for the index specified when you create the index with the `COMMENT` attribute.
visible | Whether the index is visible or invisible to the query optimizer or not; `YES` if it is, `NO` if not.
expression | If the index uses an expression rather than column or column prefix value, the expression indicates the expression for the key part and also the `column_name` column is `NULL`.

### Filter Index Information
To filter index information, you use a `WHERE` clause as follows:
```sql
SHOW INDEXES FROM table_name
WHERE VISIBLE = 'NO';
```
