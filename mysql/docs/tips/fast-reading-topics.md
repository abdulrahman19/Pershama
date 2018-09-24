# Fast Reading Topics

* [CTE](#cte)

**In this File I'll collect summaries of articles I had read, It just a (summary) no details here, I'll back to read more about them later.**

### CTE
`CTE` in short since version 8.0.

**C**ommon **T**able **E**xpression or `CTE`, `CTE` is a named temporary result set that exists within the scope of a single statement e.g.,`SELECT`, `INSERT` and that can be referred to later within that statement, possibly multiple times.

It's Similar to a `Derived Table`. Different from a `derived table`, a `CTE` can be self-referencing (a `Recursive CTE`) or can be referenced multiple times in the same query. In addition, a `CTE` provides better readability and performance in comparison with a `derived table`.
```sql
WITH cte_name (column_list) AS (
    query
)
SELECT * FROM cte_name;
```
