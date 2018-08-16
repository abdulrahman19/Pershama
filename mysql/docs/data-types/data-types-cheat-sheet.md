# Data Types Cheat Sheet


d | CHAR | VARCHAR | BINARY | VARBINARY
---|---|---|---|---|
Add padding when insert  | Yes | No | Yes | No
Removes trailing when select | Yes | No | No | No
'a' = 'a.', . = space | Yes | Yes | Yes | No


```sql
INSERT INTO test(`bin`,`vbin`,`chr`,`vchr`)
VALUES('ay','a\0','ay','ay');
```
