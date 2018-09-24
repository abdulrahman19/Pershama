# MySQL Administration Cheat Sheet

* [Access Control System](#access-control-system)
* [Create User Accounts](#create-user-accounts)
* [Show Users Accounts](#show-user-accounts)
* [Change User Password](#change-user-password)
* [GRANT Statement](#grant-statement)
* [REVOKE Statement](#revoke-statement)
* [MySQL Roles](#mysql-roles)
* [Delete Users Accounts](#delete-users-accounts)
* [Manage The Databases](#manage-the-databases)
* [Maintaining Database Tables](#maintaining-database-tables)
* [Backup Databases](#backup-databases)

### Access Control System
MySQL implements a sophisticated access control and privilege system that allows you to create comprehensive access rules for handling client operations and effectively preventing unauthorized clients from accessing the database system.

The MySQL access control has two stages when a client connects to the server:
* `Connection verification`: check for username, password and client connects host.
* `Request verification`: check a privilege at the `database`, `table`, and `field` levels.

There is a database named `mysql` created automatically by MySQL installer. The `mysql` database contains five main grant tables. You often manipulate these tables indirectly through the statements such as `GRANT` and `REVOKE`.
* `user` : contains user account and global privileges columns.
* `db` : contains database level privileges.
* `table_priv` and `columns_priv` : contains `table-level` and `column-level` privileges.
* `procs_priv` : contains `stored functions` and `stored procedures` privileges.

### Create Users Accounts
MySQL provides the `CREATE USER` statement that allows you to create a new user account. The syntax of the `CREATE USER` statement is as follows:
```sql
CREATE USER admin@localhost IDENTIFIED BY 'secret';
```

**Please Note:**
* The `admin` user only can connect to the MySQL database server from the `localhost`, not from a remote host.
* By combining the `username` and `host`, it is possible to setup multiple accounts with the same name but can connect from different hosts with the different privileges.
* The `admin` user account can only login to the database server and has no other privileges.
* To allow a user account to connect from any host, you use the percentage (`%`) wildcard, also you use the underscore wildcard `_` in the `CREATE USER` statement. This part has the same effect as it is used in the `LIKE` operator.
* It’s important to note that the quote `''` is very important especially when the user account contains special characters such as `_` or `%`.
* If you omit the `hostname` part of the user account, MySQL will accept it and allow the user to connect from any host.
* If you accidentally quote the user account like `'username@hostname'`, MySQL will create a user with the `username@hostname` name and allows the user to connect from any host.
* If you create a user that already exists, MySQL will issue an error.

### Show Users Accounts
```sql
SELECT user, host FROM mysql.user;
```

**Show Users Processes (sessions)**
```sql
SHOW PROCESSLIST;
```
And you can end any active session by using session id.
```sql
KILL 40;
```

**Show User Privileges**
```sql
SHOW GRANTS FOR admin@localhost;
```

### Change User Password
**Note:**

In case you want to reset the password of the MySQL `root` account, you need to force the MySQL database server to stop and restart without using grant table validation.

**Using UPDATE Statement**
```sql
USE mysql;

UPDATE user
SET authentication_string = PASSWORD('password')
WHERE user = 'admin' AND
      host = 'localhost';

FLUSH PRIVILEGES;
```
You need to execute the `FLUSH PRIVILEGES` statement to reload privileges from the grant tables into memory.

**Using SET PASSWORD Statement**
```sql
SET PASSWORD FOR 'dbadmin'@'localhost' = password;
```

**Using ALTER USER Statement**
```sql
ALTER USER admin@localhost IDENTIFIED BY 'password';
```

### GRANT Statement
After creating a new user account, the user doesn’t have any privileges. To grant privileges to a user account, you use the `GRANT` statement.

The following illustrates the syntax of the `GRANT` statement:
```sql
GRANT privilege,[privilege],.. ON privilege_level
TO user [IDENTIFIED BY password]
[REQUIRE tsl_option]
[WITH [GRANT_OPTION | resource_option]];
```
* The `privilege_level` that determines the level at which the privileges apply. MySQL supports global (`*.*`), database (`database.*`), table (`database.table`) and column levels.
* The `user` that you want to grant privileges.  If user already exists, the `GRANT` statement modifies its privilege. Otherwise, the `GRANT` statement creates a new user.
* The `REQUIRE` you specify whether the user has to connect to the database server over a secure connection such as SSL, X059, etc.
* The optional `WITH GRANT OPTION` clause allows you to grant other users or remove from other users the privileges that you possess. In addition, you can use the `WITH` clause to allocate MySQL database server’s resource e.g., to set how many connections or statements that the user can use per hour.

### REVOKE Statement
MySQL allows you to revoke one or more privileges or all privileges from a user.

The following illustrates the syntax of revoking specific privileges from a user:
```sql
REVOKE  privilege_type [(column_list)] [, priv_type [(column_list)]]...
ON [object_type] privilege_level
FROM user [, user]...
```

**When the MySQL GRANT / REVOKE command takes effect?**
* The changes that are made to the global privileges only take effect when the client connects to the MySQL in the subsequent sessions. The changes are not applied to all currently connected users.
* The changes of the database privileges are applied after the next `USE` statement.
* The changes of table and column privilege are applied to all queries issued after the changes were made.

### MySQL Roles
MySQL role is an object that can grant the same set of privileges to multiple users.

If you want to create a role, you should do it as follows:
* First, create a new role.
```sql
CREATE ROLE crm_dev;
```
* Second, grant privileges to the role.
```sql
GRANT ALL ON crm.* TO crm_dev;
```
* Third, grant the role to the users.
```sql
GRANT crm_dev TO crm_dev1@localhost;
```

**Show Users Privileges when use Roles**
```sql
SHOW GRANTS FOR crm_dev1@localhost USING crm_dev;
```

**Setting Default Roles**

When you granted roles to a user account, it did not automatically make the roles to become active when the user account connects to the database server.

To specify which roles should be active each time a user account connects to the database server, you use the `SET DEFAULT ROLE` statement.
```sql
SET DEFAULT ROLE ALL TO crm_read1@localhost;
```
To see active roles use `CURRENT_ROLE()` function.
```sql
SELECT current_role();
```

**Setting Active Roles**

A user account can modify the current user’s effective privileges within the current session by specifying which granted role are active. Like the following statement set the active role to `NONE`, meaning no active role.
```sql
SET ROLE NONE;
```

**Revoking Privileges From Roles**
```sql
REVOKE INSERT, UPDATE, DELETE ON crm.* FROM crm_write;
```

**Removing Roles**
```sql
DROP ROLE role_name, role_name, ...;
```

**Copying Privileges From a User Account to Another**

MySQL treats user account like a role, therefore, you can grant a user account to another user account like granting a role to that user account. This allows you to copy privileges from a user to another user.
```sql
GRANT crm_dev1@localhost TO crm_dev2@localhost;
```

### Delete Users Accounts
To use `DROP USER`, you must have the global `CREATE USER` privilege, or the `DELETE` privilege for the `mysql` system database.
```sql
DROP USER [IF EXISTS] user [, user] ...
```
`DROP USER` does not automatically close any open user sessions. the statement does not take effect until that user's session is closed.

Typically, in this case, you should shutdown user’s session immediately right before executing the `DROP USER` statement.

### Manage The Databases
**Show Databases**
```sql
SHOW DATABASES [LIKE pattern];
```
**Querying database data from `information_schema` database**
```sql
SELECT schema_name
FROM information_schema.schemata
WHERE schema_name LIKE '%schema' OR
      schema_name LIKE '%s';
```
**Show Tables**
```sql
SHOW [FULL] TABLES [LIKE pattern / WHERE expression];
```
**Show Columns**
```sql
SHOW [FULL] COLUMNS FROM table_name [LIKE pattern / WHERE expression];
```

### Maintaining Database Tables
**Analyze Tables**

`ANALYZE TABLE` generates table statistics, it's performs a key distribution analysis and stores the distribution for the named table or tables.

MySQL uses the stored key distribution and other factors to decide the order in which tables should be joined when you performing the `JOIN`, and which index should be used for a specific table.
```sql
ANALYZE TABLE table_name;
```

**Optimize Tables**

`OPTIMIZE TABLE` reorganizes the physical storage of table data and associated index data, to reduce storage space and improve I/O efficiency when accessing the table.
```sql
OPTIMIZE TABLE table_name;
```

**Check Tables**

`CHECK TABLE` checks a table or tables for errors. `CHECK TABLE` can also check views for problems, such as tables that are referenced in the view definition that no longer exist.
```sql
CHECK TABLE table_name;
```

**Checksum The Tables**

`CHECKSUM TABLE` reports a checksum for the contents of a table. You can use this statement to verify that the contents are the same before and after a backup, rollback, or other operation that is intended to put the data back to a known state. It idea near to MD5 checksum.
```sql
CHECKSUM TABLE table_name;
```

**Repair Tables**

`REPAIR TABLE` repairs a possibly corrupted table, for certain storage engines only.
```sql
REPAIR TABLE table_name;
```

### Backup Databases
The `mysqldump` is a program provided by MySQL that can be used to dump databases for backup or transfer database to another database server. The `mysqldump` can be used to generate `CSV`, `delimited` or `XML` files.
```sql
mysqldump -u [username] –p[password] [database_name] > [dump_file.sql]
```
You can backup database structure only.
```sql
mysqldump -u [username] –p[password] –no-data [database_name] > [dump_file.sql]
```
Also you can backup database data Only.
```sql
mysqldump -u [username] –p[password] –no-create-info [database_name] > [dump_file.sql]
```
And you backup multiple MySQL databases into a single file.
```sql
mysqldump -u [username] –p[password]  [dbname1,dbname2,…] > [dump_file.sql]

mysqldump -u [username] –p[password] –all-database > [dump_file.sql]
```
