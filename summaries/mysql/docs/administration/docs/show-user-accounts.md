# Show Users Accounts

* [Show Users Accounts](#show-users-accounts)
* [Show Users Processes](#show-users-processes)
* [Show Users Privileges](#show-users-privileges)

### Show Users Accounts
To view all users in the MySQL database server, you use the following `SELECT` statement:
```sql
SELECT user, host FROM mysql.user;
```

### Show Users Processes
To view all users processes (sessions) in the MySQL database server, you can use the `SHOW PROCESSLIST` statement as follows:
```sql
SHOW PROCESSLIST;
```
So you can end any active session by using session id.
```sql
KILL 40;
```

### Show Users Privileges
To view the privileges of a user account, you use the `SHOW GRANTS` statement as follows:
```sql
SHOW GRANTS FOR admin@localhost;
```
Result
<pre>
+-------------------------------------------+
| Grants for admin@localhost                |
+-------------------------------------------+
| GRANT USAGE ON *.* TO `admin`@`localhost` |
+-------------------------------------------+
1 row in set (0.00 sec)
</pre>
Note that `USAGE` privilege means no privileges in MySQL.
