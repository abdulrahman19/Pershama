# Creating Updatable Views

* [Checking Updatable View Information](#checking-updatable-view-information)

Views are not only query-able but also updatable. It means that you can use the `INSERT`, `UPDATE` or `DELETE` statement to effect rows of the base table.

However, to create an updatable view, the `SELECT` statement that defines the view must not contain any of the following elements:
* Aggregate functions such as `MIN`, `MAX`, `SUM`, `AVG`, and `COUNT`.
* `DISTINCT`
* `GROUP BY` clause.
* `HAVING` clause.
* `UNION` or `UNION ALL` clause.
* `Left join` or `outer join`.
* `Subquery` in the `SELECT` clause or in the `WHER`E clause that refers to the table appeared in the `FROM` clause.
* Reference to non-updatable view in the `FROM` clause.
* Reference only to literal values.
* Multiple references to any column of the base table.

If you create a view with the `TEMPTABLE algorithm`, you cannot update the view.

### Checking Updatable View Information
You can check if a view in a database in updatable by querying the `is_updatable` column from the views table in the `information_schema` database.
```sql
SELECT
    table_name,
    is_updatable
FROM
    information_schema.views
WHERE
    table_schema = 'classicmodels';
```
