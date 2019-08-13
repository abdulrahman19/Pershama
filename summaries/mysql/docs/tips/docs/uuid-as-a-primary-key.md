# UUID as a Primary Key

* [UUID vs. Auto-Increment as a Primary Key](#uuid-vs-auto-increment-as-a-primary-key)
* [MySQL UUID Solution](#mysql-uuid-solution)

UUID stands for Universally Unique IDentifier. In MySQL, a UUID value is a 128-bit number represented as a `utf8` string of five hexadecimal numbers in the following format:
```sql
aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee
```

To generate UUID values, you use the `UUID()` function as follows:
```sql
UUID()
```

### UUID vs. Auto-Increment as a Primary Key
**Pros**

Using UUID for a primary key  brings the following advantages:
* UUID values are unique across tables, databases, and even servers that allow you to merge rows from different databases or distribute databases across servers.
* UUID values do not expose the information about your data so they are safer to use in a URL. For example, if a customer with id `10` accesses his account via `http://www.example.com/customers/10/` URL, it is easy to guess that there is a customer `11`, `12`, etc., and this could be a target for an attack.
* UUID values can be generated anywhere that avoid a round trip to the database server. It also simplifies logic in the application. For example, to insert data into a parent table and child tables, you have to insert into the parent table first, get generated id and then insert data into the child tables. By using UUID, you can generate the primary key value of the parent table up front and insert rows into both parent and child tables at the same time within a transaction.

**Cons**

Besides the advantages, UUID values also come with some disadvantages:
* Storing UUID values (16-bytes) takes more storage than integers (4-bytes) or even big integers(8-bytes).
* Debugging seems to be  more difficult, imagine the expression `WHERE id = 'df3b7cb7-6a95-11e7-8846-b05adad3f0ae'` instead of WHERE `id = 10`.
* Using UUID values may cause performance issues due to their size and not being ordered.

### MySQL UUID Solution

In MySQL, you can store UUID values in a compact format `BINARY` and display them in human-readable format `VARCHAR`with help of the following functions:
* `UUID_TO_BIN`
* `BIN_TO_UUID`
* `IS_UUID`

Notice that `UUID_TO_BIN()`, `BIN_TO_UUID()`, and `IS_UUID()` functions are only available in MySQL 8.0 or later.

```sql
INSERT INTO customers(id, name)
VALUES(UUID_TO_BIN(UUID()),'John Doe');

SELECT
    BIN_TO_UUID(id) id,
    name
FROM
    customers;
```
