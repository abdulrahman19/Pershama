# Index Cardinality

Index cardinality refers to the uniqueness of values stored in a specified column within an index.

MySQL generates the index cardinality based on statistics stored as integers, therefore, the value may not be necessarily exact.

The query optimizer uses the index cardinality to generate an optimal query plan for a given query. It also uses the index cardinality to decide whether to use the index or not in the join operations.

The low cardinality indexes negatively impact the performance.

If the query optimizer chooses the index with a low cardinality, it is may be more effective than scan rows without using the index.

To view the index cardinality, you use the `SHOW INDEXES` command.

**More References:**
* [Wikipedia Article](https://en.wikipedia.org/wiki/Cardinality_\(SQL_statements\))
* [IBM Article](https://www.ibm.com/developerworks/data/library/techarticle/dm-1309cardinal/index.html)
* [Understanding MySQL Index Cardinality](https://logicalread.com/mysql-index-cardinality-mc12/)
