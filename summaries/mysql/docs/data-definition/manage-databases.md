# Manage Databases

* [Creating Database](#creating-database)
* [Displaying Databases](#displaying-databases)
* [Selecting a Database](#selecting-a-database)
* [Removing Databases](#removing-databases)

### Creating Database
To create a database in MySQL, you use the `CREATE DATABASE` statement as follows:
```sql
CREATE DATABASE [IF NOT EXISTS] database_name;
```

### Displaying Databases
The `SHOW DATABASES` statement displays all databases in the MySQL database server
```sql
SHOW DATABASES;
```

### Selecting a Database
Before working with a particular database, you must tell MySQL which database you want to work with by using the `USE` statement.
```sql
USE database_name;
```

### Removing Databases
Removing database means you delete the database physically. All the data and associated objects inside the database are permanently deleted and this cannot be undone.
```sql
DROP DATABASE [IF EXISTS] database_name;
```
