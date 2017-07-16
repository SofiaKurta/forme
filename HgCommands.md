hg revert -a -C
## Настройка HG
**путь: .hg/hgrc** \
```
[paths]
default = http://myserver/hg/repo1
default-push = ../mytestrepo

[ui]
username = Firstname Lastname <firstname.lastname@example.net>
verbose = True

[alias]
killitwithfire = revert --no-backup --all

```
**проверка через коммандную строку:**
```
hg paths gives the relationship between each path name and its url.

> hg paths
default = ssh://hg@example.org/repo
local = /local/path/to/repo
hg paths <name> gives the url for the name.

> hg paths default
ssh://hg@example.org/repo

> hg paths local
/local/path/to/repo
BTW, to get just the path names:

> hg paths -q
default
local
```
## Список команд:
Mercurial Commands

Commands | Description
-------- | -----------
hg pull | get latest changes like git pull use flags like -u IDK why yet
hg add | only for new files
hg commit | add changes to commit with -m for message just like git
hg addremove | adds new files and removes file not in your file system
hg incoming | see changes commited by others
hg outgoing | see local commits
hg commit --amend | same as ```git commit --amend```
hg record filename | shows history of changes to file uses extension
hg merge | like a ```git merge``` http://hgbook.red-bean.com/read/a-tour-of-mercurial-merging-work.html
hg log -r tip | tip changelog
hg log -l 5 | last 5 changelog statuses
hg status -m | show modified files only
hg status -r | show removed files only
hg status -a | show added files only
hg strip "0000" | remove commit from history and delete changes before push, if pushed you are fucked
hg log -u email@accout.com | see all account commits &#124; type -v for a verbose version
hg diff -r 0000:0000 /dir/location/path | Diff versions of same file from different CHANGESET
hg diff &#124; less; hg commit | show changes committed
hg out | See what is not pushed to remote branch
hg update 0000 | CHANGESET = 0000 or branchname
hg checkout branch | works like a ```git checkout branch```
hg record | shows record of pending changes
hg update -C | resets your head and removes commits not pushed like ```git reset --hard```
hg backout 0000 | CHANGESET = 0000 like a ```git revert tag/hash```
hg blame or hg annotate | same as a git blame
hg bisect | lets you test inbetween commits to find bugs http://mercurial.selenic.com/wiki/BisectExtension
hg shelve | like a ```git stash``` (Requires the ShelveExtension or the AtticExtension.)
hg graft --edit 0000 | lets you pick what changes to push to default or commit CHANGESET = 0000 ```git cherry-pick <commit>``` http://selenic.com/hg/help/graft
hg graft --edit 0000::0005 | add a series of commits from 0000 to 0005 as a batch
hg heads | shows changes in child and parent branches
hg identify --num | current changeset
hg branch feature | go to default branch and use this command to create a new branch namded "feature" based off of it
hg commit --close-branch -m 'closing this branch' | Inside branch you want to close commit this and push so branch disapears and keeps your coworkers happy
note | Hg .hgignore, syntax: glob is the same behaviour as git's .gitignore.

## Branching
http://stevelosh.com/blog/2009/08/a-guide-to-branching-in-mercurial/
