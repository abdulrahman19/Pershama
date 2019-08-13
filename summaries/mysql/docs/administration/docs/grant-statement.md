# GRANT Statement

* [GRANT Examples](#grant-examples)
* [Permissible Privileges](#permissible-privileges)

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

### GRANT Examples
To grant all privileges to the `super@localhost` user account, you use the following statement.
```sql
GRANT ALL ON *.* TO 'super'@'localhost' WITH GRANT OPTION;

SHOW GRANTS FOR super@localhost;
```
Output:
<pre>
+----------------------------------------------------------------------+
| Grants for super@localhost                                           |
+----------------------------------------------------------------------+
| GRANT ALL PRIVILEGES ON *.* TO `super`@`localhost` WITH GRANT OPTION |
+----------------------------------------------------------------------+
1 row in set (0.00 sec)
</pre>

To create a user that has all privileges in the `classicmodels` database.
```sql
GRANT ALL ON classicmodels.* TO auditor@localhost;
```
You can grant multiple privileges in a single `GRANT` statement.
```sql
GRANT SELECT, UPDATE, DELETE ON classicmodels.* TO rfc;
```

### Permissible Privileges
You can check them from [mysqltutorial.org - MySQL Grant](http://www.mysqltutorial.org/mysql-grant.aspx)
