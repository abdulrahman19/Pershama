# Indexes Chapter Terminologies

<br> Term <img width=550/>| Meaning
---|---|
Metadata | Metadata is “the data about the data.” Anything that describes the database as opposed to being the contents of the database is metadata. Thus column names, database names, user names, version names, and most of the string results from `SHOW` are metadata. This is also true of the contents of tables in `INFORMATION_SCHEMA` because those tables by definition contain information about database objects.
Clustered Index | is an index that enforces the ordering on the rows of the table physically.
Prefix Index | is a index used to not consume a lot of disk space and speed operations when use `INSERT` statement, also increase the performance when use `SELECT` statement by decreasing the number of rows it searches on.
Invisible Index | The invisible indexes allow you to mark indexes as unavailable for the query optimizer.
Index Cardinality | refers to the uniqueness of values stored in a specified column within an index.
