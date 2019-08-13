# Data Manipulation Chapter Terminologies

<br> Term <img width=300/>| Meaning
---|---|
Operator precedence | is the order of evaluates the logical operator in an expression.`()` then `AND` final `OR`.
SubQuery | A MySQL subquery is a query nested within another query such as `SELECT`, `INSERT`, `UPDATE` or `DELETE`. In addition, a MySQL subquery can be nested inside another subquery.
Correlated SubQuery | When you can uses the data from the `outer query` inside the `inner query`, in this case it called correlated subquery.
Derived Table | is a virtual table returned from a `SELECT` statement when use SubQuery.
UPDATE JOIN | is a combination from two statements `UPDATE` and `JOIN`, they use to update multiple tables.
DELETE JOIN | is a combination from two statements `DELETE` and `JOIN`, they use to delete multiple tables.
Prepared Statements | is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
Transaction | is a set of tasks into a single execution unit. Each transaction begins with a specific task and ends when all the tasks in the group successfully complete. If any of the tasks fail, the transaction fails.
Table Locking | is a flag associated with a table allows a client session to explicitly acquire a table lock for preventing other sessions from accessing the same table during a specific period.
