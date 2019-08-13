# Merging Branches

* [Merging](#merging)
* [Fast forward vs real](#fast-forward-vs-real)
* [Merge conflicts](#merge-conflicts)
* [Rebase](#rebase)

## Merging
Now after we test our feature and it succeeded, we need to **mrege** it. <br>
Checkout the branch you want merge **to**, in this case master branch and type.
```bash
git merge feature_branch
```

## Fast forward vs real
**Fast forward merge** <br>
If you add some new commits on your feature branch and It be forward your master branch, and your master branch didn't move, in this case the fast forward merge will happened, it only takes a new commits and put master HEAD pointer on last commit and that's it!.
![real vs fast forward](./images/10-1-real-vs-fast-forward.jpg)
![fast forward digram](./images/10-1-2-fast-forward-digram.jpg)
![fast forward command](./images/10-1-3-fast-forward.jpg)

> In fast forward merge it doesn't create a merge commit, if you need a merge commit use <code>--no-ff</code> option, this commit mean **don't do the fast forward**, and opposite this command is <code>--ff-only</code> and that's mean **do the fast forward if it possible and if it not, cancel the merge operation**.

**The real merge** <br>
If your master branch has any commits after you created your feature branch, now it'll do the real merge. It will create a new commit with merge details.

And there types from real merge, one of them is **recursive strategy**, the recursive strategy is exactly what we read above in simple way.

> Note: recursive strategy apply if there's no conflict.

## Merge conflicts
If we make a changes in same line on both branches, now git will stop merging and ask you what it should do in this situation, and this what we called (Merge conflict).

In case of merge conflict we have 3 chooses:
* Abort merge.
* Solve the conflict manually.
* Use a merge tool.

**Abort merge**
```bash
git merge --abort
```
Every thing will back like before.

**Solve the conflict manually** <br>
In this case you need to read the code and decide what should do, after that just commit the new changes to succeed the merge operation.
```bash
git commit
# notice: commit without the message, to put standard default git message.
```

**Use a merge tool** <br>
Type
```bash
git mergetool --tool=bla bla bla
# to show list of git tools, type
git mergetool
# and hit tab
```

To **reduce conflicts** here's some tips.
![reduce conflicts](./images/10-5-reduce-conflicts.jpg)

## Rebase
The first thing to understand about <code>git rebase</code> is that it solves the same problem as <code>git merge</code>. Both of these commands are designed to integrate changes from one branch into another branch they just do it in very different ways.

Rebase solves problem of un-clean history that's made by merge in active projects. <br>
The main idea in rebase is "rebase" first branch commit (older one) on last master (or any other branches) commit (newest one), that allows us to make <code>fast forward</code> merge, in this way the history will be totally clean even in active projects.
![rabse explain image one](./images/9-2-rabse-explain.svg)
![rabse explain image two](./images/9-2-2-rabse-explain.svg)

To do the <code>rebase</code> checkout the branch you want rebase it on <code>master</code> branch for example, then write
```bash
git rebase master
```
In this way you "rebased" your branch on last commit in <code>master</code> branch, If there any conflict you can solve it then <code>add</code> it to staging area then
```bash
# after solving the conflict if found.
git add .
# then
git rebase --continue
```
Now the rebase done, <code>checkout</code> your <code>master</code> branch again, then merge.
```bash
git merge branch-name
```
You mast find now a <code>fast forward</code> merge happened.