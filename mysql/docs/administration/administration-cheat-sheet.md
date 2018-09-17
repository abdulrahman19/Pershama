# MySQL Administration Cheat Sheet

* [Access Control System](#access-control-system)

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
