# Manage The Databases

* [Show Databases](#show-databases)
* [Show Tables](#show-tables)
* [Show Columns](#show-columns)

### Show Databases
To list all databases on a MySQL server host, you use the `SHOW DATABASES` command as follows:
```sql
SHOW DATABASES;
```
The `SHOW SCHEMAS` command is a synonym for `SHOW DATABASES`.

If you want to query the database that matches a specific pattern, you use the `LIKE` clause as follows:
```sql
SHOW DATABASES LIKE pattern;
```

**Querying database data from `information_schema` database**
```sql
SELECT schema_name
FROM information_schema.schemata
WHERE schema_name LIKE '%schema' OR
      schema_name LIKE '%s';
```

### Show Tables
To list tables in a MySQL database, you follow these steps:
* Login to the MySQL database server using a MySQL client such as `mysql`.
* Switch to a specific database using the `USE` statement.
* Use the `SHOW TABLES` command as following:
```sql
SHOW TABLES;
```
To include the table type in the result, you use the following form of the `SHOW FULL TABLES` statement.
This command allows you to show if a table is a base table or a view.
```sql
SHOW FULL TABLES;
```

The `SHOW TABLES` command provides you with an option that allows you to filter the returned tables using the `LIKE` operator or an expression in the `WHERE` clause as follows:
```sql
SHOW TABLES LIKE pattern;

SHOW TABLES WHERE expression;
```

### Show Columns
To show all columns of a table, you use the following steps:
* Login to the MySQL database server.
* Switch to a specific database.
* Use the `DESCRIBE` statement as following:
```sql
DESCRIBE table;
```

The more flexible way to get a list of columns in a table is to use the MySQL `SHOW COLUMNS` command.
```sql
SHOW COLUMNS FROM table_name;
```
Now you can use `LIKE` operator or an expression in the `WHERE` clause as follows:
```sql
SHOW COLUMNS FROM table_name LIKE pattern;

SHOW COLUMNS FROM table_name WHERE expression;
```

To get more information about the column, you add the `FULL` keyword to the `SHOW COLUMNS` command as follows:
```sql
SHOW FULL COLUMNS FROM table_name;
```
