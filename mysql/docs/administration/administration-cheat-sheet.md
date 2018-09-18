# MySQL Administration Cheat Sheet

* [Access Control System](#access-control-system)
* [Create User Accounts](#create-user-accounts)
* [Change User Password](#change-user-password)
* [Delete Users Accounts](#delete-users-accounts)

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

**Using SET PASSWORD Statement**
```sql
SET PASSWORD FOR 'dbadmin'@'localhost' = password;
```

**Using ALTER USER Statement**
```sql
ALTER USER admin@localhost IDENTIFIED BY 'password';
```

### Delete Users Accounts
To use `DROP USER`, you must have the global `CREATE USER` privilege, or the `DELETE` privilege for the `mysql` system database.
```sql
DROP USER [IF EXISTS] user [, user] ...
```
`DROP USER` does not automatically close any open user sessions. the statement does not take effect until that user's session is closed.
