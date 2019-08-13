# MySQL Access Control System

MySQL implements a sophisticated access control and privilege system that allows you to create comprehensive access rules for handling client operations and effectively preventing unauthorized clients from accessing the database system.

The MySQL access control has two stages when a client connects to the server:
* `Connection verification`: a client, which connects to the MySQL database server, needs to have a valid username and password. In addition, the host from which the client connects has to match with the host in the MySQL grant table.
* `Request verification`: once a connection is established successfully, for each statement issued by the client, MySQL checks whether the client has sufficient privileges to execute that particular statement. MySQL has the ability to check a privilege at the `database`, `table`, and `field` levels.

There is a database named `mysql` created automatically by MySQL installer. The `mysql` database contains five main grant tables. You often manipulate these tables indirectly through the statements such as `GRANT` and `REVOKE`.
* `user` : contains user account and global privileges columns. MySQL uses the user table to either accept or reject a connection from a host. A privilege granted in the user table is effective to all databases on the MySQL server.
* `db` : contains database level privileges. MySQL uses the db table to determine which database a user can access and from which host. A privilege granted at the database level in the db table applies to the database and all objects belong to that database e.g., `tables`, `triggers`, `views`, `stored procedures`, etc.
* `table_priv` and `columns_priv` : contains `table-level` and `column-level` privileges. A privilege granted in the `table_priv` table applies to the table and its columns while a privilege granted in the `columns_priv` table applies only to a specific column of a table.
* `procs_priv` : contains `stored functions` and `stored procedures` privileges.
