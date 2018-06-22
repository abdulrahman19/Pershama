# Getting Started

* [Git initializing](#git-initializing)
* [Tracked and untracked files](#tracked-and-untracked-files)
* [First commit](#first-commit)
* [Commit message best practices](#commit-message-best-practices)
* [Git log](#git-log)

## Git initializing
Make git works, by tell git to trace files on this dir. <br>
Navigating to your working dir and write.
```bash
git init
```
## Tracked and untracked files
To show what changes happened use.
```bash
git status
```
It'll list all changes you made on working dir.

Please note: when you run <code>git status</code> you will find two sections, first one for tracked files and those for files you commit them before and you make a new changes on them. <br>
The other section for untracked files, and those for files you add them to your working dir for first time and never commit any changes on them.

To show list of all untracked files use
```bash
git status -u
```

For more info also please read this section [Ignoring files](./6-ignoring-files.md)

## First commit
First you need add all changes you did on stage area.
```bash
git add .
# . for current directory.
```
After that commit them.
```bash
git commit -m "My first commit"
# -m for massage.
```
HOORAY your first commit is done.

Shortcut for add all **tracking files** and commit them in the same step.
```bash
git commit -am "bla bla bla"
```

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
# Or
git log -2
```
Show commits from specific date.
```bash
git log --since=2018-05-10
```
Show commits before specific date.
```bash
git log --until=2018-05-10
```
And we can merge between them to get commits in specific period. <br>
Also we can use not only date but phrases like
```bash
git log --until="2 weeks ago"
# or
git log --until=2.weeks
# or
git log --until=2.days
```
Show commits for specific author (you can put only part form his name).
```bash
git log --author="bla"
```
Log by searching using regular expression on commit messages.
```bash
git log --grep="bla bla bla"
```
To list commits in one line use following
```bash
git log --oneline
# that's will return small SHA
git log --format=oneline
# that's will return long SHA
```
you can get range of commits by put first point SHA and last point SHA
```bash
git log 42423..23443 --oneline
# .. for go forward to up.
```
You can ask it for log changes in specific file
```bash
git log file_name.txt
# or from specific commit in specific file
git log 324234.. file_name.txt
```
To see what happen in each commit, with log use -p option
```bash
git log -p
# you can mix them
git log -p 324234.. file_name.txt
# that's will show all log and what happened in it form specific commit and up for specific file.
```
To show summary for each commit
```bash
git log --stat --summary
```
We can use <code>--format</code> to show different informations like
```bash
git log --format=raw
# that's will show raw information that store in git.
git log --format=email
# to show log as email format.
# you can messing up with format option.
```
One important command is log commits graph
```bash
git log --graph
```
We can show log in nice way like
```bash
git log --oneline --graph --all --decorate
```
