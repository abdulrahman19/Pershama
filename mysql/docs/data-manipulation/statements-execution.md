# MySQL Statements Execution Order
<pre>
* FROM clause
(
* ON clause
* JOIN clause
...
)
* WHERE clause
* SELECT clause => SQL Server says it execute after HAVING clause!
* GROUP BY clause
* HAVING clause
* ORDER BY clause
* LIMIT clause
</pre>

For that you cannot use a column `Aliases` defined in a `SELECT` in the `WHERE` clause, for instance, because the `WHERE` is parsed before the `SELECT`.
