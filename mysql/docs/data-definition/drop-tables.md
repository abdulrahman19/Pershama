# Drop Tables

To remove existing tables, you use the MySQL `DROP TABLE` statement. The syntax of the `DROP TABLE` is as follows:
```sql
DROP [TEMPORARY] TABLE [IF EXISTS] table_name [, table_name] ...
[RESTRICT | CASCADE]
```
* The `TEMPORARY` flag allows you to remove temporary tables only. It is very convenient to ensure that you do not accidentally remove non-temporary tables.
* The `RESTRICT` and `CASCADE` flags are reserved for the future versions of MySQL.

Example:
```sql
DROP TABLE IF EXISTS tasks, nonexistent_table;
```

### DROP TABLE With Pattern
Unfortunately, MySQL does not provide the `DROP TABLE LIKE` statement that can remove tables based on pattern matching like the following:
```sql
DROP TABLE LIKE '%pattern%'
```
However, there are some workarounds. We will discuss one of them here for your reference.

```sql
-- set table schema and pattern matching for tables
SET @schema = 'classicmodels';
SET @pattern = 'test%';

-- build dynamic sql (DROP TABLE tbl1, tbl2...;)
SELECT CONCAT('DROP TABLE ',GROUP_CONCAT(CONCAT(@schema,'.',table_name)),';')
INTO @droplike
FROM information_schema.tables
WHERE @schema = database()
AND table_name LIKE @pattern;

-- display the dynamic sql statement [optional]
SELECT @droplike;

-- execute dynamic sql using prepared statement
PREPARE stmt FROM @dropcmd;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
```
All you need to do is replacing the pattern and the database schema in `@pattern` and `@schema` variables. If you often have to deal with this task, you can always develop a `stored procedure` based on the script and reuse this stored procedure.

