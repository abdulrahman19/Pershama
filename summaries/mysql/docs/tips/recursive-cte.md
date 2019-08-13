# Recursive CTE

* [Table Structure](#table-structure)
* [Recursive CTE Examples](#recursive-cte-examples)

`Recursive CTE` is a `CTE` that has a subquery which refers to the `CTE` name itself. The following illustrates the syntax of a `recursive CTE`:
```sql
WITH RECURSIVE cte_name (col_name, col_name, col_name) AS
(
    subquery base case -- anchor member
    UNION ALL
    subquery referencing cte_name -- recursive member that references to the CTE name
)
SELECT ... FROM cte_name ...
```
Small Example: Generating a Series of Numbers.
```sql
WITH RECURSIVE MySeries (n) AS
(
    SELECT 1 AS n
    UNION ALL
    SELECT 1+n FROM MySeries WHERE n < 10
)
SELECT * FROM MySeries;
```
output
<pre>
+----+
| n  |
+----+
| 1  |
| 2  |
| 3  |
| 4  |
| 5  |
| 6  |
| 7  |
| 8  |
| 9  |
| 10 |
+----+
</pre>

**Recursive member restrictions**

The recursive member must not contain the following constructs:
* Aggregate functions e.g., `MAX`, `MIN`, `SUM`, `AVG`, `COUNT`, etc.
* `GROUP BY` clause
* `ORDER BY` clause
* `LIMIT` clause
* `DISTINCT`

Note that the above constraint does not apply to the anchor member. Also, the prohibition on `DISTINCT` applies only when you use `UNION` operator. In case you use the `UNION DISTINCT` operator, the `DISTINCT` is permitted.

In addition, the recursive member can only reference the `CTE` name once and in its `FROM` clause, not in any subquery.

**Pros:**
* ANSI SQL-99 Standard
* Compatible with other SQL implementations
* Works with Adjacency List (single source of authority)
* Referential integrity!

**Cons:**
* Not compatible with earlier MySQL versions
* Use of materialized temporary tables may cause performance problems

### Table Structure
![Adjacency List Table Structure](./files/adjacency-list-table-structure.png)

### Recursive CTE Examples
Query ancestors of comment #7
```sql
WITH RECURSIVE CommentTree (comment_id, parent_id, author, comment, depth) AS
(
        SELECT comment_id, parent_id, author, comment, 0 AS depth
        FROM Comments
        WHERE comment_id = 7
    UNION ALL
        SELECT c.comment_id, c.parent_id, c.author, c.comment, ct.depth+1
        FROM CommentTree ct
        JOIN Comments c ON (ct.parent_id = c.comment_id)
)
SELECT * FROM CommentTree;
```

Query subtree under comment #4
```sql
WITH RECURSIVE CommentTree (comment_id, parent_id, author, comment, depth) AS
(
        SELECT comment_id, parent_id, author, comment, 0 AS depth
        FROM Comments
        WHERE comment_id = 4
    UNION ALL
        SELECT c.comment_id, c.parent_id, c.author, c.comment, ct.depth+1
        FROM CommentTree ct
        JOIN Comments c ON (ct.comment_id = c.parent_id)
)
SELECT * FROM CommentTree;
```
