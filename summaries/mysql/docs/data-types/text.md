# TEXT

Min | Max (approximate) | Length | Unit | Note
---|---|---|---|---|
0 | 65 `KB` | L + 2 bytes, where L < 2^16, 2^16 = 65,536 |  Bytes | -

In most respects, you can regard a `TEXT` column as a [VARCHAR](./varchar.md) column that can be as large as you like. `TEXT` differ from `VARCHAR` in the following ways:

* For indexes on `TEXT` column, you must specify an index prefix length. For `CHAR` and `VARCHAR`, a prefix length is optional.
* `TEXT` column cannot have `DEFAULT` values.

#### Because `TEXT` value can be extremely long, you might encounter some constraints in using them:

* Only the first `max_sort_length` bytes of the column are used when sorting. The default value of `max_sort_length` is 1024. You can make more bytes significant in sorting or grouping by increasing the value of `max_sort_length` at server startup or runtime.

```sql
SET max_sort_length = 2000;

SELECT id, comment FROM t
ORDER BY comment;
```

* Instances of `TEXT` column in the result of a query that is processed using a temporary table causes the server to **use a table on disk rather than in memory** because the MEMORY storage engine does not support those data types. **Use of disk incurs a performance penalty**, so include `TEXT` column in the query result only if they are really needed. For example, avoid using `SELECT *`, which selects all columns.
* The maximum size of a `TEXT` object is determined by its type, but the largest value you actually can transmit between the client and server is **determined by the amount of available memory and the size of the communications buffers**. You can change the message buffer size by changing the value of the `max_allowed_packet` variable, but you must do so for **both** the server and your client program. For example, both `mysql` and `mysqldump` enable you to change the client-side `max_allowed_packet value`.
