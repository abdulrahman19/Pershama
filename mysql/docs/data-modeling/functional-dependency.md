# Functional Dependencies

* [Functional Dependencies Definition](#functional-dependencies-definition)
* [Trivial Functional Dependency](#trivial-functional-dependency)

### Functional Dependencies Definition
The data in a table are usually not independent. The values in one column can determine the values in other columns.

SSN | First name | Last name | Date of birth | Address | Phone number
---|---|---|---|---|---|
123-98-1234 | Cindy | Cry | 15-05-1983 | Los Angeles | 123-456-7891
121-45-6145 | John  | O’Neill | 30-01-1980 | Paris | 568-974-2562
658-78-2369 | John  | Lannoy | 30-01-1980 | Dallas | 963-258-7413

Here, the value in the column `SSN` (Social Security Number) determines the values in columns `first_name`, `last_name`, `date_of_birth`, `address`, and `phone_number`.

This means that if we had two rows with the same value in the `SSN` column, then values in columns like `first_name`, `last_name`..etc would be **equal**.

This is called **functional dependency** `FD`.

The notation for functional dependency on the previous table:

<pre>
SSN -> first name, last name, date_of_birth, address, phone_number
</pre>
On the `left hand` side of the arrow we put the name of the column the other is **dependent on**.

Some times may `FD` can **dependent on more then one column**.

Student | Semester | Lecture | Teaching assistant
---|---|---|---|
Cindy Cry | 6 | Databases | Jack Magpie
John Novak | 4 | Databases | Jack Magpie

<pre>
student, lecture -> teaching assistant
</pre>

### Trivial Functional Dependency

In previous table schema, we can say {`Student`, `Semester`} set can determines `Student` column value?

<pre>
student, semester -> student
</pre>

Because `Student` is subset of {`Student`, `Semester`}, it's in left side already, and `Student` can determines its own value.

I know that sound like stupid thing :trollface: but that what a `Trivial DF` means.

**Trivial FD** doesn't add new information, so we don't write them.

And I don't know who's write them from the beginning. :laughing:
