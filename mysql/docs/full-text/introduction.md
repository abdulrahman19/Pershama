# Introduction To Full-Text Search Index

* [Defining FULLTEXT Index](#defining-fulltext-index)
* [Removing FULLTEXT Index](#removing-fulltext-index)

MySQL Full-Text search provides a simple way to implement various advanced search techniques such as `natural language search`, `Boolean text search` and `query expansion`.

**Why you need to use Full-Text index?**

When you search by using the `LIKE` operator and regular expression you will face some limitations like:
* **Bad Performance**: MySQL has to scan the whole table to find the exact text based on a pattern in the `LIKE` statement or pattern in the regular expressions.
* **Not a flexible search**: with the `LIKE` operator and regular expression searches, it is difficult to have a flexible search query e.g., to find product whose description contains `car` but not `classic`.
* **Can't specify relevance ranking**: there is no way to specify which row in the result set is more relevant to the search terms.

Because of these limitations, MySQL extended a very nice feature so-called full-text search. The following are some important features of MySQL full-text search:
* **Native SQL-like interface**: you use the SQL-like statement to use the full-text search.
* **Fully dynamic index**: MySQL automatically updates the index of text column whenever the data of that column changes.
* **Moderate index size**: it doesn’t take much memory to store the index.
* **Flexible search**: It is fast to search based on complex search queries.

**How Full-Text search index works?**

Technically, MySQL creates an index from the words of the enabled full-text search columns and performs searches on this index. MySQL uses a sophisticated algorithm to determine the rows matched against the search query.

### Defining FULLTEXT Index
You can define the `FULLTEXT` index for a column when you create a new table using the `CREATE TABLE` statement as follows:
```sql
CREATE TABLE table_name(
    column1 data_type,
    column2 data_type,
    …
    PRIMARY_KEY(key_column),
    FULLTEXT KEY index_name (column1,column2,..)
);
```

**Defining FULLTEXT Index For Existing Tables**

Using `ALTER TABLE` statement:
```sql
ALTER TABLE table_name
ADD FULLTEXT(column_name1, column_name2,…)
```
Using `CREATE INDEX` statement:
```sql
CREATE FULLTEXT INDEX index_name
ON table_name(idx_column_name,...)
```

### Removing FULLTEXT Index
```sql
ALTER TABLE table_name
DROP INDEX index_name;
```
