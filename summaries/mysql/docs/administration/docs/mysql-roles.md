# MySQL Roles

* [Create Roles Example](#create-roles-example)
* [Show Users Privileges with Roles](#show-users-privileges-with-roles)
* [Setting Default Roles](#setting-default-roles)
* [Setting Active Roles](#setting-active-roles)
* [Revoking Privileges From Roles](#revoking-privileges-from-roles)
* [Removing Roles](#removing-roles)
* [Copying Privileges From a User Account to Another](#copying-privileges-from-a-user-account-to-another)

Typically, you have a number of users with the same set of privileges. Previously, the only way to grant and revoke privileges to multiple users is to change privileges of each user individually, which is time-consuming.

If you want to grant the same set of privileges to multiple users, you should do it as follows:
* First, create a new role.
* Second, grant privileges to the role.
* Third, grant the role to the users.

### Create Roles Example
1- Create new roles.
```sql
CREATE ROLE crm_dev, crm_read, crm_write;
```
2- Grant privileges to the roles.
```sql
GRANT ALL ON crm.* TO crm_dev;
GRANT SELECT ON crm.* TO crm_read;
GRANT INSERT, UPDATE, DELETE ON crm.* TO crm_write;
```
3- Grant the roles to the users.
```sql
GRANT crm_dev TO crm_dev1@localhost;
GRANT crm_read TO crm_read1@localhost;
GRANT crm_read, crm_write TO crm_write1@localhost, crm_write2@localhost;
```

### Show Users Privileges with Roles
To verify the role assignments, you use the `SHOW GRANTS` statement as the following example:
```sql
SHOW GRANTS FOR crm_write1@localhost;
```
Output:
<pre>
+---------------------------------------------------------------------+
| Grants for crm_write1@localhost                                     |
+---------------------------------------------------------------------+
| GRANT USAGE ON *.* TO `crm_write1`@`localhost`                      |
| GRANT `crm_read`@`%`,`crm_write`@`%` TO `crm_write1`@`localhost`    |
+---------------------------------------------------------------------+
</pre>
As you can see, it just returned granted roles. To show the privileges that roles represent, you use the `USING` clause.
```sql
SHOW GRANTS FOR crm_write1@localhost USING crm_write;
```
Output:
<pre>
+---------------------------------------------------------------------+
| Grants for crm_write1@localhost                                     |
+---------------------------------------------------------------------+
| GRANT USAGE ON *.* TO `crm_write1`@`localhost`                      |
| GRANT INSERT, UPDATE, DELETE ON `crm`.* TO `crm_write1`@`localhost` |
| GRANT `crm_read`@`%`,`crm_write`@`%` TO `crm_write1`@`localhost`    |
+---------------------------------------------------------------------+
</pre>

### Setting Default Roles
When you granted roles to a user account, it did not automatically make the roles to become active when the user account connects to the database server.

To specify which roles should be active each time a user account connects to the database server, you use the `SET DEFAULT ROLE` statement.

The following statement set the default for the `crm_read1@localhost` account all its assigned roles. In previous example will be `crm_read` role.
```sql
SET DEFAULT ROLE ALL TO crm_read1@localhost;
```
To see active roles use `CURRENT_ROLE()` function.
```sql
SELECT current_role();
```

### Setting Active Roles
A user account can modify the current user’s effective privileges within the current session by specifying which granted role are active.

The following statement set the active role to `NONE`, meaning no active role.
```sql
SET ROLE NONE;
```
To set active roles to all granted role, you use:
```sql
SET ROLE ALL;
```
To set active roles to default roles that set by the SET DEFAULT ROLE statement, you use:
```sql
SET ROLE DEFAULT;
```
To set active named roles, you use:
```sql
SET ROLE granted_role_1, granted_role_2, ...
```

### Revoking Privileges From Roles
```sql
REVOKE INSERT, UPDATE, DELETE ON crm.* FROM crm_write;
```

### Removing Roles
```sql
DROP ROLE role_name, role_name, ...;
```

### Copying Privileges From a User Account to Another
MySQL treats user account like a role, therefore, you can grant a user account to another user account like granting a role to that user account. This allows you to copy privileges from a user to another user.
```sql
GRANT crm_dev1@localhost TO crm_dev2@localhost;
```
