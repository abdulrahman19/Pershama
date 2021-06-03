# Stashing Changes

* [Saving in stash](#saving-in-stash)
* [Viewing stash](#viewing-stash)
* [Retrieve from stash](#retrieve-from-stash)
* [Delete stash](#delete-stash)

## Saving in stash
Stash is a place we can save files in it temporarily, without need to commit them. <br>
You can save things in the stash and move free between branches.
```bash
git stash
git stash save "bla bla bla"
```
In this way we can save files inside the stash.

you can add also untracked files using `--include-untracked`

```bash
git stash --include-untracked
```

## Viewing stash
To show what in the stash.
```bash
git stash list
```
And to show details.
```bash
git stash show stash@{x}
# stash@{x} is the ID for stash number, {x} is start from zero and it increases every time you put things in the stash.
```
And to show what we changed, we need to add <code>-p</code> option.
```bash
git stash show -p stash@{x}
```

## Retrieve from stash
To get what you put in the stash write.
```bash
git stash pop stash@{x}
# or
git stash apply stash@{x}
```
And the differences between both is <code>pop</code> will get changing out of the stash and delete them after that. <br>
<code>Apply</code> will only get them out of the stage.

Or you can write them like
```bash
git stash pop
# and I'll take stash@{0}.
```
And like merge it can show a conflict, and you will need to solve it.

## Delete stash
To delete from the stash
```bash
git stash drop stash@{x}
```
Or for delete everything in the stash
```bash
git stash clear
```
