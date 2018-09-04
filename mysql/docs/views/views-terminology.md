# Views Chapter Terminologies

Term | Meaning
---|---|
View | View is a virtual table or logical table which is defined as a SQL `SELECT` query with `joins`.
Materialized View | Materialized view allows user to store result of a query physically and update the data periodically. MySql does not support it.
View Resolution | It's the combination of input query and the query in the view definition into one query.
View Consistency | That means prevents user from updating or inserting rows that are not visible through the view.
