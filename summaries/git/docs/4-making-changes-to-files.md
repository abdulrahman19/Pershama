# Making Changes to Files

* [Adding files](#adding-files)
* [Viewing changes](#viewing-changes)
    * Look also at [Comparing commits](./7-navigating-the-commit-tree.md#comparing-commits)
* [Deleting files](#deleting-files)
* [Moving / renaming files](#moving--renaming-files)

## Adding files
Any new files git doesn't know about them, will show them in (Untracked files). <br>
Add you can add them by following:
```bash
git add file_name.txt
# or
git add . # dot for current directory
# or
git add file_* # * for any files begin with (file_)
```

## Viewing changes
We can compare between the changes in working directory and last changes in stage & repo.
```bash
git diff
```
Or changes on specific file.
```bash
git diff file_name.txt
```
For show changes on the stage area against repo use following command.
```bash
git diff --staged
```
## Deleting files
Just press delete or drag and drop files on trash :) <br>
Or add removed file to stage area use following command.
```bash
git rm deleted_file.txt
```
> With new git versions you can simply use <code>git add</code> to add removed files to staging area. <br>
Or short the holy steps by only use <code>git rm</code> to do both things delete the files and put them in stage area.

## Moving / renaming files
We can renaming any file by regular operation, rename the file with OS. And it'll show on git there's a file deleted and another added. <br>
Or we can use git to short the process.
```bash
git mv old_file_name.txt new_file_name.txt
```
Same thing for moving files.
> On moving case it'll show moving process as a renaming process!
