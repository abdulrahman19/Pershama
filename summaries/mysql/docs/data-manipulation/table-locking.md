# Table Locking

* [Read Locks](#read-locks)
* [Write Locks](#write-locks)
* [Read vs. Write locks](#read-vs-write-locks)
* [Unlock Tables](#unlock-tables)

A lock is a flag associated with a table. MySQL allows a client session to explicitly acquire a table lock for preventing other sessions from accessing the same table during a specific period. A client session can acquire or release table locks only for itself. It cannot acquire or release table locks for other sessions.

### Read Locks
A `READ` lock has the following features:
* A `READ` lock for a table can be acquired by multiple sessions at the same time. In addition, other sessions can read data from the table without acquiring the lock.
* The session that holds the `READ` lock can only read data from the table, but cannot write. In addition, other sessions cannot write data to the table until the `READ` lock is released. The write operations from another session will be put into the waiting states until the `READ` lock is released.
* If the session is terminated, either normally or abnormally, MySQL will release all the locks implicitly. This feature is also relevant for the `WRITE` lock.

```sql
LOCK TABLE tbl READ;
```

### Write Locks
A `WRITE` lock has the following features:
* The only session that holds the lock of a table can read and write data from the table.
* Other sessions cannot read data from and write data to the table until the `WRITE` lock is released.

```sql
LOCK TABLE tbl WRITE;
```

### Read vs. Write locks
* Read locks are “shared” locks which prevent a write lock is being acquired but not other read locks.
* Write locks are “exclusive ” locks that prevent any other lock of any kind.

When insert operation happened from second session it'll be in the waiting state because a `READ` or `WRITE` lock is already acquired on the table by the first session and it has not released yet.

You can see the detailed information from the `SHOW PROCESSLIST` statement.
```sql
SHOW PROCESSLIST;
```

### Unlock Tables
```sql
UNLOCK TABLES;
```
