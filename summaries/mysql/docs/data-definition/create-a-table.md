# Create a Table

* [Create a Table](#create-a-table)
* [Define a Column](#define-a-column)
* [Set a Primary Key](#set-a-primary-key)

### Create a Table
```sql
CREATE TABLE [IF NOT EXISTS] table_name(
    column_list
) ENGINE=storage_engine
```

### Define a Column
```sql
column_name data_type(length) [NOT NULL] [DEFAULT value] [AUTO_INCREMENT]
```

### Set a Primary Key
```sql
PRIMARY KEY (col1,col2,...)
```

**Complete Example**
```sql
CREATE TABLE IF NOT EXISTS tasks (
    task_id INT AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    start_date DATE,
    due_date DATE,
    status TINYINT NOT NULL,
    priority TINYINT NOT NULL,
    description TEXT,
    PRIMARY KEY (task_id)
)  ENGINE=INNODB;
```
