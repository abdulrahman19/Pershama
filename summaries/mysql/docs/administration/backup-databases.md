# Backup Databases

The `mysqldump` is a program provided by MySQL that can be used to dump databases for backup or transfer database to another database server. The `mysqldump` can be used to generate `CSV`, `delimited` or `XML` files.
```sql
mysqldump -u [username] –p[password] [database_name] > [dump_file.sql]
```
You can backup database structure only.
```sql
mysqldump -u [username] –p[password] –no-data [database_name] > [dump_file.sql]
```
Also you can backup database data Only.
```sql
mysqldump -u [username] –p[password] –no-create-info [database_name] > [dump_file.sql]
```
And you backup multiple MySQL databases into a single file.
```sql
mysqldump -u [username] –p[password]  [dbname1,dbname2,…] > [dump_file.sql]

mysqldump -u [username] –p[password] –all-database > [dump_file.sql]
```
