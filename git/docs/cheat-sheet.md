# Cheat Sheet

* [help](#help)
* [config](#config)
* [init](#init)
* [status](#status)
* [add](#add)
* [commit](#commit)
* [log](#log)
* [diff](#diff)
* [rm](#rm)
* [mv](#mv)
* [checkout](#checkout)
* [reset](#reset)
* [revert](#revert)
* [clean](#clean)
* [ls-tree](#ls-tree)
* [show](#show)
* [branch](#branch)
* [merge](#merge)
* [rebase](#rebase)
* [tag](#tag)
* [stash](#stash)
* [remote](#remote)
* [clone](#clone)
* [fetch](#fetch)
* [push](#push)
* [pull](#pull)

## help
```bash
git help
git help log
```

## config
```bash
git config # project
git config --system # user
git config --global
git config --global user.name "bla bla bla"
git config --global user.email "bla@bla.bla"
git config --list
git config user.name # show specific config value
git config --global core.editor "bla bla bla"
git config --global color.ui true
git config --global alias.logg "log --oneline --graph --all --decorate --abbrev-commit"
git config --global core.excludesfile ~/.gitignore_global
```

## init
```bash
git init
```
## status
```bash
git status
git status -u # list of untracked files
```

## add
```bash
git add .
git add file_name.txt
git add file_*
```

## commit
```bash
git commit
git commit -m "bla bla bla"
git commit -am "bla bla bla" # add all and commit
git commit --amend -m "bla bla bla"
```

## log
```bash
git log
git log origin/branch-name
git log -n 2
git log -2
git log --since=2018-05-10
git log --until=2018-05-10
git log --since=2018-05-06 --until=2018-05-10
git log --until="2 weeks ago"
git log --until=2.weeks
git log --until=2.days
git log --author="bla"
git log --grep="bla bla bla" # search in message commits
git log --oneline # short SHA
git log --format=oneline # long SHA
git log 42423..23443 --oneline #from..to
git log file_name.txt # file history
git log 324234.. file_name.txt # file history from specific commit
git log -p # show commit details
git log --stat --summary
git log --format=raw
git log --format=email
git log --graph
git log --oneline --graph --all --decorate --abbrev-commit
got log --no-merges # see log without merges commits
```

## diff
```bash
git diff
git diff file_name.txt
git diff --staged
git diff 211rr323 # compare dir to SHA
git diff 211rr323 file_name.txt
git diff 211rr323..3432fddsw # compare two commits
git diff 211rr323..3432fddsw file_name.txt
git diff --stat --summary 211rr323..HEAD
git diff --ignore-space-change 211rr323..HEAD
git diff -b 211rr323..HEAD # shortcut for --ignore-space-change
git diff --ignore-all-space 211rr323..HEAD
git diff -w 211rr323..HEAD # shortcut for --ignore-all-space
git diff --color-words file_name.txt
git diff master..new_branch # compare branches
git diff --color-words master..new_branch^ # use Tree-ish
git diff origin/branch-name..branch-name
git diff --name-only --diff-filter=U # show conflict files only
```

## rm
```bash
git rm deleted_file.txt
git rm --cached file_name.txt # untrack
```

## mv
```bash
git mv old_file_name.txt new_file_name.txt
```

## checkout
```bash
git checkout -- . # remove from working dir
git checkout -- file_name.txt # remove from working dir
git checkout -- dir_name/ # remove from working dir
git checkout 4d2333dsqw -- file_name.txt # change file content to changes in commit SHA
git checkout new_branch # change branch
git checkout -b new_branch # create and check
git checkout -b branch-name origin/branch-name # copy branch and checkout it
```

## reset
```bash
git reset HEAD file_name.txt # remove form staging area
git reset --soft 324kkdf323
git reset --mixed 324kkdf323
git reset --hard 324kkdf323
```

## revert
```bash
git revert 4d2333dsqw
```

## clean
```bash
git clean -nf
git clean -n -d
```

## ls-tree
```bash
git ls-tree HEAD
git ls-tree HEAD dir/
git ls-tree HEAD^ dir/
git ls-tree HEAD~2
```

## show
```bash
git show 214ds33
git show --format=oneline HEAD
git show 211rr323 # like ls-tree
```

## branch
```bash
git branch # list
git branch new_branch # create
git branch --merged
git branch -m old_branch_name new_branch_name # rename
git branch -d deleted_branch # delete
git branch -r # show remote branches
git branch -a # show all branches
git branch --track  branch-name origin/branch-name
git branch branch-name origin/branch-name # copy branch
```

## merge
```bash
git merge feature_branch
git merge origin/branch-name
git merge --abort
```

## rebase
```bash
git rebase master
git rebase --continue
git rebase HEAD~3 -i # to change commit message
```

## tag
```bash
git tag tag_name
git tag tag_name 324dsa
git tag -a tag_name -m "bla bla bla" # annotated tags
git tag # show all tags
git tag -l "v1.*"
git show tag_name
git push --tags
git push origin tag_name
git tag -d tag_name
git tag -d tag_name tag_name2 tag_name3
git push origin -d tag_name
git push origin :tag_name
git checkout tag_name
git checkout -b branch_name tag_name
```

## stash
```bash
git stash list
git stash save "bla bla bla"
git stash show stash@{x}
git stash show -p stash@{x}
git stash apply stash@{x}
git stash pop stash@{x}
git stash drop stash@{x}
git stash clear
```

## remote
```bash
git remote
git remote -v
git remote add origin https://bla.bla/bla.git
git remote rm origin
```
## clone
```bash
git clone https://bla.bla/bla.git folder_name
git clone -b branch-name https://bla.bla/bla.git folder_name # specific branch
```

## fetch
```bash
git fetch # fetch everything
git fetch origin branch-name # fetch branch
```

## push
```bash
git push # if branch tracked
git push --all # push every thing branches and commits
git push -u origin master
git push -f origin branch-name
git push -f origin branch-name:branch-name
git push origin 312fasdf:branch-name
git push origin --delete branch-name
git push origin :branch-name
```

## pull
```bash
git pull # if branch tracked
git pull origin branch-name
git pull --rebase upstream master
# that's will rebase your work above last commit in Fork/master branch so you able to do fast forward merge. check rebase section.
```
