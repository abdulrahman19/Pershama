# REVOKE Statement

* [REVOKE Examples](#revoke-examples)

MySQL allows you to revoke one or more privileges or all privileges from a user.

The following illustrates the syntax of revoking specific privileges from a user:
```sql
REVOKE  privilege_type [(column_list)] [, priv_type [(column_list)]]...
ON [object_type] privilege_level
FROM user [, user]...
```

**When the MySQL REVOKE command takes effect?**
* The changes that are made to the global privileges only take effect when the client connects to the MySQL in the subsequent sessions. The changes are not applied to all currently connected users.
* The changes of the database privileges are applied after the next `USE` statement.
* The changes of table and column privilege are applied to all queries issued after the changes were made.

### REVOKE Examples
You can revoke the `UPDATE` and `DELETE` privileges from the `rfc` user:
```sql
REVOKE UPDATE, DELETE ON classicmodels.* FROM rfc;
```
If you want to revoke all privileges of the `rfc` user, you execute the following command:
```sql
REVOKE ALL PRIVILEGES, GRANT OPTION FROM rfc;
```
