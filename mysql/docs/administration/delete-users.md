# Delete Users Accounts

* [Using DROP USER Statement](#using-drop-user-statement)

### Using DROP USER Statement
To use `DROP USER`, you must have the global `CREATE USER` privilege, or the `DELETE` privilege for the `mysql` system database.
```sql
DROP USER [IF EXISTS] user [, user] ...
```
Example
```sql
DROP USER 'jeffrey'@'localhost';
```

**Note**

`DROP USER` does not automatically close any open user sessions. Rather, in the event that a user with an open session is dropped, the statement does not take effect until that user's session is closed.
