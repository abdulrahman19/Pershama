# MySQL Index Cheat Sheet

* [Show Indexes](#show-indexes)

### Show Indexes
```sql
SHOW INDEXES FROM table_name [IN database_name];
#or
SHOW INDEXES FROM database_name.table_name;
```
Note that `INDEX` and `KEY` are the synonyms of the `INDEXES`, also `IN` is the synonym of the `FROM`.
```sql
SHOW INDEX IN table_name FROM database_name;

SHOW KEY FROM tablename IN databasename;
```

**Filter Index Information**
```sql
SHOW INDEXES FROM table_name
WHERE VISIBLE = 'NO';
```
