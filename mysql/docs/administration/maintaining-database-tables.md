# Maintaining Database Tables

* [Analyze Tables](#analyze-tables)
* [Optimize Tables](#optimize-tables)
* [Check Tables](#check-tables)
* [Checksum The Tables](#checksum-the-tables)
* [Repair Tables](#repair-tables)

### Analyze Tables
`ANALYZE TABLE` generates table statistics, it's performs a key distribution analysis and stores the distribution for the named table or tables.

MySQL uses the stored key distribution and other factors to decide the order in which tables should be joined when you performing the `JOIN`, and which index should be used for a specific table.
```sql
ANALYZE TABLE table_name;
```

### Optimize Tables
`OPTIMIZE TABLE` reorganizes the physical storage of table data and associated index data, to reduce storage space and improve I/O efficiency when accessing the table.
```sql
OPTIMIZE TABLE table_name;
```

### Check Tables
`CHECK TABLE` checks a table or tables for errors. `CHECK TABLE` can also check views for problems, such as tables that are referenced in the view definition that no longer exist.
```sql
CHECK TABLE table_name;
```

### Checksum The Tables
`CHECKSUM TABLE` reports a checksum for the contents of a table. You can use this statement to verify that the contents are the same before and after a backup, rollback, or other operation that is intended to put the data back to a known state. It idea near to MD5 checksum.
```sql
CHECKSUM TABLE table_name;
```

### Repair Tables
`REPAIR TABLE` repairs a possibly corrupted table, for certain storage engines only.
```sql
REPAIR TABLE table_name;
```
