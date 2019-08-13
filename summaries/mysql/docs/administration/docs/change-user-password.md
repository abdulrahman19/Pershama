# Change User Password

* [Using UPDATE Statement](#using-update-statement)
* [Using SET PASSWORD Statement](#using-set-password-statement)
* [Using ALTER USER Statement](#using-alter-user-statement)

**Note:**

In case you want to reset the password of the MySQL `root` account, you need to force the MySQL database server to stop and restart without using grant table validation.

### Using UPDATE Statement
The first way to change the password is to use the `UPDATE` statement, you also need to execute the `FLUSH PRIVILEGES` statement to reload privileges from the `grant tables` into memory.
```sql
USE mysql;

UPDATE user
SET password = PASSWORD('password')
WHERE user = 'admin' AND
      host = 'localhost';

FLUSH PRIVILEGES;
```
From MySQL 5.7.6 the user table uses the `authentication_string` column.
```sql
USE mysql;

UPDATE user
SET authentication_string = PASSWORD('password')
WHERE user = 'admin' AND
      host = 'localhost';

FLUSH PRIVILEGES;
```

### Using SET PASSWORD Statement
You use the user account in `user@host` format to update the password. If you need to change the password for other accounts, your account needs to have at least `UPDATE` privilege.

You don’t need to execute the `FLUSH PRIVILEGES` statement to reload privileges from grant tables.
```sql
SET PASSWORD FOR 'dbadmin'@'localhost' = password;
```

### Using ALTER USER Statement
The following `ALTER USER` statement changes the password of the `admin` user to `password`:
```sql
ALTER USER admin@localhost IDENTIFIED BY 'password';
```
