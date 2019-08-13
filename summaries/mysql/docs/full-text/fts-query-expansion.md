# Full-Text Search Query Expansion

The query expansion is used to widen the search result of the full-text searches based on [`Automatic Relevance Feedback`](https://en.wikipedia.org/wiki/Relevance_feedback) (or `blind query expansion`).

Technically, MySQL full-text search engine performs the following steps when the query expansion is used:
* First, MySQL full-text search engine looks for all rows that match the search query.
* Second, it checks all rows in the search result and finds the relevant words.
* Third, it performs a search again based on the relevant words instead of the original keywords provided by the users.

The following illustrates the syntax of the query using the `WITH QUERY EXPANSION` search modifier.
```sql
SELECT column1, column2
FROM table1
WHERE MATCH(column1,column2)
      AGAINST('keyword',WITH QUERY EXPANSION);
```
Notice that blind query expansion tends to increase noise significantly by returning non-relevant results. It is highly recommended that you use query expansion only when the searched keyword is short.
