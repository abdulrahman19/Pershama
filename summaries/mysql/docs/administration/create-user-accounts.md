# Create Users Accounts

MySQL provides the `CREATE USER` statement that allows you to create a new user account. The syntax of the `CREATE USER` statement is as follows:
```sql
CREATE USER user_account@hostname IDENTIFIED BY password;
```
Example
```sql
CREATE USER admin@localhost IDENTIFIED BY 'secret';
```

**Please Note:**
* The `admin` user only can connect to the MySQL database server from the `localhost`, not from a remote host such as `mysqltutorial.org`. This makes the MySQL database server even more secure.
* By combining the `username` and `host`, it is possible to setup multiple accounts with the same name but can connect from different hosts with the different privileges.
* The `admin` user account can only login to the database server and has no other privileges. To grant permission to the user, you use the `GRANT` statement.
* To allow a user account to connect from any host, you use the percentage (`%`) wildcard, also you use the underscore wildcard `_` in the `CREATE USER` statement. This part has the same effect as it is used in the `LIKE` operator.
* It’s important to note that the quote `''` is very important especially when the user account contains special characters such as `_` or `%`.
* If you omit the `hostname` part of the user account, MySQL will accept it and allow the user to connect from any host.
* If you accidentally quote the user account like `'username@hostname'`, MySQL will create a user with the `username@hostname` name and allows the user to connect from any host.
* If you create a user that already exists, MySQL will issue an error.
