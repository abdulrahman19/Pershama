# Second Normal Form

* [Second Normal Form Definition](#second-normal-form-definition)
* [Apply In Our Example](#apply-in-our-example)

### Second Normal Form Definition
The table be in the 2N if:
* The table is in `1st normal form`.
* All the non-key columns are dependent on the table’s primary key `partial dependency`.

![Table Not Normalized](../images/data-modeling/N2-summary.png)

### Apply In Our Example

![Table Not Normalized](../images/data-modeling/FirstNormalFormDataExample.png)

Now let's fix that!

![Table Not Normalized](../images/data-modeling/SecondNormalFormIssues.png)

![Table Not Normalized](../images/data-modeling/SecondNormalFormDataModel.png)

![Table Not Normalized](../images/data-modeling/SecondNormalFormSampleData1.png)

![Table Not Normalized](../images/data-modeling/SecondNormalFormSampleData2.png)

> An **intersection table** is useful when you need to model a many-to-many relationship.

![Table Not Normalized](../images/data-modeling/SecondNormalFormSampleData3.png)

Three out of the four tables are even in third normal form, but there is one table which still has a minor issue.
