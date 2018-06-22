# GitHub

* [GitHub Fork](#github-fork)

## GitHub Fork
GitHub Fork is a great operation let you take your own version form other repos to build up on it or add new feature, then you can ask repo owner by <code>pull request</code> operation to merge your work in the original repo.

Now the workflow usually be like that:
* Login to your GitHub account.
* Browse the repo you want Fork it.
* Click in a <code>Fork</code> button and wait to finish.
* After that return to your GitHub account and you'll find the repo coped to your account.
* Now you can make a <code>clone</code>.
* Edit or add or remove what you want then push it to your repo.
* To let project owner <code>merge</code> your edits to his repo you need to make a <code>pull request</code> order, in this way you let the owner know about your edits and decide if it's good to add them to his repo.

**Please note** if you need to sync your copy with original repo updates you need to add new <code>remote</code> to your project, you can call it for example <code>upstream</code>, so you can <code>fetch</code> or <code>pull</code> the new update from it.
```bash
git remote add upstream https://bla.bla/bla.git
# the url will be for original repo not your copy one.
```
After that you can <code>fetch</code> or <code>pull</code>
```bash
git fetch upstream master
# or
git pull upstream master
# or you can rebase when you pull
git pull --rebase upstream master
# that's will rebase your work above last commit in Fork/master branch so you able to do fast forward merge. check rebase section.
```
Now you let your version up to date will original repo.

And if you make the <code>--rebase</code> instead of normal pulling <code>merge</code> you will need to force pushing your edit because the SHA will change.
```bash
git push -f
```