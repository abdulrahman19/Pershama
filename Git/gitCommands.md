* First chapter (Installing Git)
    * [Git configuration](#git-configuration)
        * [Add/show your confg](#addshow-your-confg)
    * [Git help](#git-help)
* Chapter two (Getting Started)
    * [Git initializing](#git-initializing)
    * [First commit](#first-commit)
    * [Commit message best practices](#commit-message-best-practices)
    * [Git log](#git-log)
* Chapter three (Git Concepts and Architecture)
    * [How git save commits (Architecture)](#how-git-save-commits-architecture)
    * [HEAD pointer](#head-pointer)
* Chapter four (Making Changes to Files)
    * [Adding files](#adding-files)
    * [Viewing changes](#viewing-changes)
    * [Deleting files](#deleting-files)
    * [Moving / renaming files](#moving--renaming-files)
* Chapter five (Using Git with a Real Project)
    * [Good tips when using git diff command](#good-tips-when-using-git-diff-command)
    * [Shortcut for add and commit in the same step](#shortcut-for-add-all-and-commit-in-the-same-step)
* Chapter six (Undoing Changes)
    * [Undo working dir](#undo-working-dir)
    * [Unstaging files](#unstaging-files)
    * [Amend commits](#amend-commits)
    * [Retrieving old versions](#retrieving-old-versions)
    * [Using reset](#using-reset)
    * [Remove untracked](#remove-untracked)
* Chapter seven (Ignoring Files)
    * [Git ignore](#git-ignore)
    * [Global ignoring](#global-ignoring)
    * [Ignore tracked](#ignore-tracked)
    * [Track empty dirs](#track-empty-dirs)

# Installing Git

## Git configuration:
System
```bash
git config --system
```
User
```bash
git config --global
```
Project
```bash
git config
```
## Add/show your confg:
```bash
git config --global user.name "bla bla bla"
git config --global user.email "bla@bla.bla"
```
To show current confgs.
```bash
git config --list
Or
git config user.name
```
To show messages on specific editor.
```bash
git config --global core.editor "bla bla bla"
```
To color terminal.
```bash
git config --global color.ui true
```
## Git help:
```bash
git help
```
To show specific command manual.
```bash
git help log
```

# Getting Started

## Git initializing
```bash
git init
```
## First commit
First you need add all changes you did on stage area.
```bash
# . for current directory.
git add .
```
After that commit them.
```bash
# -m for massage.
git commit -m "My first commit"
```
HOORAY your first commit is done.

## Commit Message best practices
Those are some point you need to be aware about them when you write a message.
* short single-line summary (less 50 characters).
* optionally followed by a blank line and more complete description.
* keep each line to less then 72 characters.
* write commit message in present tense.
* bullet points are usually asterisks or hyphens.
* can add (ticket tracking numbers) from bugs or support requests.
    * [css,js] for file type.
    * [bugFix] when you fix a bugs.
    * [#49443] ticket number for bugs or support.
Example for a good commit message.
![Good commit message](./images/2-4-commit-msgs.jpg)

## Git log
To show all log commits.
```bash
git log
```
To show last two or there or last commits.
```bash
git log -n 2 # for last two commit
```
Show commits from specific date.
```bash
git log --since=2018-05-10
```
Show commits before specific date.
```bash
git log --until=2018-05-10
```
Show commits for specific author (you can put only part form his name).
```bash
git log --author="bla"
```
Log by searching using regular expression on commit messages.
```bash
git log --grep="bla bla bla"
```

# Git Concepts and Architecture

## How git save commits (Architecture)
![How git save commits](./images/3-2-commit-refer.jpg)

## HEAD pointer
Pointer to "tip" of current branch in repo.
![git HEAD](./images/3-4-head.jpg)
Git save HEAD pointer on .git/HEAD file, and from this file it'll navigate you to the commit it refer on it.

# Making Changes to Files

## Adding files
* Any new files git doesn't know about them, will show them in (Untracked files).
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
Just press delete or drag and drop files on trash :), To add removed file to stage area use following command.
```bash
git rm deleted_file.txt
```
> With new git versions you can simply use (git add).
OR short the holy steps by only use (git rm) to do both things delete the files and put them in stage area.

## Moving / renaming files
We can renaming any file by regular operation, rename the file with OS. And it'll show on git there's a file deleted and another added.
Or we can use git to short the process.
```bash
git mv old_file_name.txt new_file_name.txt
```
Same thing for moving files.
> On moving case it'll show moving process as a renaming process!

# Using Git with a Real Project

## Good tips when using git diff command
* You can do the (word wrap) on a terminal when you use (git diff) command by following:

    Press minus then shift+s then return key, do the same for remove word wrap.
* You can only colored the changes words by following:
```bash
git diff --color-words file_name.txt
```

## Shortcut for add all and commit in the same step
```bash
git commit -am "bla bla bla"
```

# Undoing Changes

## Undo working dir
To undo things we did in our working dir simply to following:
```bash
git checkout file_name.txt
# or dir like current dir
git checkout .
# or by dir name
git checkout dir_name
```
But if there a branch with same name of dir it'll checkout the branch, for that, the best practice is put -- before file or dir we want to undo it.
```bash
git checkout -- file_name.txt
```
## Unstaging files
We can unstaging files to working dir by following:
```bash
git reset HEAD file_name.txt
```
## Amend commits
If we wanna amend to commit in the repo, we have a problem!, that commit SHA is use to be parent to another commit, and if we change that commit is SHA will change too and the next commit to it will be broken. And so on!.

![Commit parent for next commit will be broken if we change commit itself](./images/6-3-amend-commits.jpg)

And also it'll change next commit SHA because git use all data to generate SHA, if we change anything the SHA will change too.

![Next commit SHA will change if we change its parent](./images/6-3-2-amend-commits.jpg)

But last commit because nothing depend on it we can amend it by using amend option.
```bash
git commit --amend -m "bla bla bla"
```
That's will (merge) amend the new changes to the last commit in our repo.

> You can use this command if you wanna change commit message.

## Retrieving old versions
If we wanna change/remove commit in the middle of other commits (undo), that we can't use amend option with it (check the previous section).

First way, we gonna checkout the commit's parent for get the old state we wanna undo to it, or the commit itself for change small pieces or something.
```bash
git checkout 4d2333dsqw -- file_name.txt
# that's a parent commit/commit SHA we wanna change to it 4d2333dsqw
# -- for current branch
# file_name.txt the file we wanna change it form the commit.
```
Then we'll find it on our staging area, from this point we can do what we want like reset HEAD to move it to working dir, and checkout it form working dir to remove it totally, or change thing and commit it again, it's up for you for what you want.

> The best practice if you gonna commit other changes again, that you put commit SHA in the new commit message to keep others know that's a retrieving commit.

And for undo the commit totally, git provide command for that.
```bash
git revert 4d2333dsqw
```
Now it'll do the opposite of this commit. if something added it'll be deleted if something delete it'll be added and so on.

## Using reset
Git reset it like cassette recorder, you'll move the HEAD to a point and star record form it.
It's a powerful tool you must use it wisely : )

There's a three different options to do that:<br>
1- --soft (It doesn't change staging index or working dir).<br>
2- --mixed the default option (Changes staging index to match repo & doesn't change working dir).<br>
3- --hard (Changes staging index and working dir to match repo).

* Reset soft
```bash
git reset --soft 324kkdf323
# 324kkdf323 the SHA for commit we wanna reset to it.
```
Now the HEAD will reset to the commit we write its SHA above, but nothing in our staging or working dir will change, all staff will be there and that's the safest choose.

> Please note the commits content after reset your head will find them in staging area.

* Reset mixed
```bash
git reset --mixed 324kkdf323
```
Everything will be like soft choose but the different here, you will find all staff on working dir only, nothing on staging area.

* Reset hard
If you wanna lose everything after specific commit then use reset hard.
```bash
git reset --hard 324kkdf323
```
Now git will move HEAD to commit you want and you'll find you staging and working dir clean.

> If you wanna back again even after use reset hard, that's possible but you must remember SHA for the commit to reset it.

## Remove untracked
If we want remove untracked file all on one we can use following command:
```bash
git clean -nf
# -n for show what file will remove
# -f to force remove 
# the both will delete all untracked files.
```

# Ignoring Files

## Git ignore
* To ignore some files we won't track them, we need to create (.gitignore) file.
* .gitignore Will not ignore the files already tracked, the only new one.
* We can use basic regular expression to ignore files like \*,?,[0-9]...etc.
* We can also negate expression with !, for example ignore all php file (\*.php) but not index.php (!index.php).
* Ignore dir by put / in the end.
* Put comments by using # symbol.

## Global ignoring
You can choose which files you want ignore anywhere by following:
```bash
git config --global core.excludesfile ~/.gitignore_global
```
Now put whatever you want inside gitignore_global file and it'll be ignored everywhere.

## Ignore tracked
Git not ignore tracked files, so we need to tell git to stop track those files, we have some scenarios here:
* Delete those files so git will not track them anymore.
```bash
git rm file_name.txt
```
* But what if we don't want delete those files, just we want untrack them!, now we need one more option.
```bash
git rm --cached file_name.txt
```
That command will remove files from staging index so git will ignore them in the future.

> After using last command you will find those files staged as deleted files, that's ok, that's how git stop tracking files, and also other contributors will understand that git delete those files so it'll not track them anymore. But all files on working dir and repo will still there.

## Track empty dirs
Git is designed to be a file-tracking system, so it'll not track those dirs they not have any files at all.<br>
If you want git track empty dirs you need cheat on it by put any kind of files inside it to let git track this dir, and (.gitkeep) make the trick.