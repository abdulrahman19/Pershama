# Undoing Changes

* [Undo working dir](#undo-working-dir)
* [Unstaging files](#unstaging-files)
* [Amend commits](#amend-commits)
* [Rebase to change message](#rebase-to-change-message)
* [Retrieving old versions](#retrieving-old-versions)
* [Using reset](#using-reset)
* [Remove untracked](#remove-untracked)

## Undo working dir
To undo things we did in our working dir simply do following:
```bash
git checkout -- file_name.txt
# -- for checkout changes on current branch not for checkout between branches.
# or dir like current dir
git checkout -- .
# or by dir name
git checkout -- dir_name/
```
Please note that if there a branch with same name of dir git will checkout the branch, for that, the best practice is put <code>--</code> before file or dir we want to undo it.
```bash
git checkout -- file_name.txt
```
## Unstaging files
We can unstaging files to working dir by following:
```bash
git reset HEAD file_name.txt
```
## Amend commits
If we wanna amend to commit in the repo, we have a problem!, that commit SHA is use to be parent to another commit, and if we change that commit is SHA will change too and the previous commit to it will be broken. And so on!.

![Commit parent for next commit will be broken if we change commit itself](./images/6-3-amend-commits.jpg)

And also it'll change next commit SHA because git use all data to generate SHA, if we change anything the SHA will change too.

![Next commit SHA will change if we change its parent](./images/6-3-2-amend-commits.jpg)

But last commit because nothing depend on it we can amend it by using amend option.
```bash
git commit --amend -m "bla bla bla"
```
That's will (merge) amend the new changes to the last commit in our repo.

> You can use this command if you wanna change last commit message too.

## Rebase to change message
Like I explained on previous section if you wanna change last commit message you can use <code>amend</code> option, but what if you want change older commit message!

You can use rebase! <br>
Rebase to commit you wanna change its message
```bash
git rebase HEAD~3 -i
# lets say it's third older one form the HEAD.
```
You can now see the last 3 commits. <br>
Find the commit with the bad commit message and change <code>pick</code> to <code>reword</code>. <br>
You can now edit the message with your editor and git will update the commits.

## Retrieving old versions
If we wanna change/remove commit in middle of other commits (undo), that we can't use amend option with it (check the previous section).

First way, we gonna checkout the commit's parent to get the old state before this commit to undo it. <br>
Or the commit itself for change small pieces or something.
```bash
git checkout 4d2333dsqw -- file_name.txt
# 4d2333dsqw that's can be (parent commit)/(commit SHA) we wanna change to it.
# -- for current branch
# file_name.txt the file we wanna change it form the commit.
```
Then we'll find it on our staging area, from this point we can do what we want like reset HEAD to move it to working dir, and checkout it form working dir to remove it totally. <br>
Or change thing and commit it again, that's up for you, do what you want.

> The best practice if you gonna commit other changes again, that you put commit SHA in the new commit message to keep others know that's a retrieving commit.

And for undo the commit totally, git provide command for that.
```bash
git revert 4d2333dsqw
```
Now git will do the opposite of this commit. <br>
If something added it'll be deleted if something delete it'll be added and so on.

## Using reset
Git record like cassette recorder. <br>
For that you can move the HEAD to a previous point and star record form it. <br>
It's a powerful tool you must use it wisely : )

There's a three different options to do that:

1- <code>--soft</code> (It doesn't change staging index or working dir).

2- <code>--mixed</code> the default option (Changes staging index to match repo & doesn't change working dir).

3- <code>--hard</code> (Changes staging index and working dir to match repo).

**Reset soft**
```bash
git reset --soft 324kkdf323
# 324kkdf323 the SHA for commit we wanna reset to it.
```
Now the HEAD will reset to the commit we write its SHA above, but nothing in our staging or working dir will change, all staff will be there and that's the safest choose.

> Please note the commits content after reset your head will find them in staging area.

**Reset mixed**
```bash
git reset --mixed 324kkdf323
```
Everything will be like soft choose but the different here, you will find all staff on working dir only, nothing on staging area.

**Reset hard**
```bash
git reset --hard 324kkdf323
```
If you wanna lose everything after specific commit then use reset hard. <br>
Now git will move HEAD to commit you want and you'll find you staging and working dir clean.

> If you wanna back again even after use reset hard, that's possible but you must remember SHA for the commit to reset it. <br>
COOL...Right!

## Remove untracked
If we want remove untracked file all on one we can use following command:
```bash
git clean -nf
# -n for show what file will remove
# -f to force remove
# the both will delete all untracked files.
git clean -n -d
# to clean dirs.
```
