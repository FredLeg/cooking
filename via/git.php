<?php
require_once 'partials/header.php';
###############################################################################
?>
<style>
	.bazou {background: lightgrey}
</style>
To start, you can always use <b>git help</b> to see a basic list of commands.<br/>
<br/>
<div class="bazou">Git Terminology:</div>
<b>master</b>	default branch we develop in<br/>
<b>origin</b>	default upstream repo (Github)<br/>
<b>HEAD</b>	current branch<br/>
<b>remote</b>	repository stored on another computer<br/>
<b>staging</b> (adding)	adding changed files to index tree to be committed<br/>
Here’s a <a href="http://stackoverflow.com/questions/7076164/terminology-used-by-git">good glossary</a> of definitions.<br/>
<br/>
<div class="bazou">Starting a Repo: <b>init</b> / <b>clone</b/> / <b>remote</b></div>
<b>git init</b>	Create a repo from existing data<br/>
<b>git clone (repo_url)</b>	Clone a current repo (into a folder with same name as repo)<br/>
<b>git clone (repo_url) (folder_name)</b>	Clone a repo into a specific folder name<br/>
<b>git clone (repo_url) .</b>	Clone a repo into current directory (should be an empty directory)<br/>
<b>git remote add origin https://github.com/(username)/(repo_name).git</b>	Create a remote repo named origin pointing at your Github repo (after you’ve already created the repo on Github) (used if you git init since the repo you created locally isn’t linked to a remote repo yet)<br/>
<b>git remote add origin git@github.com:(username)/(repo_name).git</b>	Create a remote repo named origin pointing at your Github repo (using SSH url instead of HTTP url)<br/>
<b>git remote</b>	Show the names of the remote repositories you’ve set up<br/>
<b>git remote -v</b>	Show the names and URLs of the remote repositories<br/>
<b>git remote rm (remote_name)</b>	Remove the reference to the named remote repository<br/>
<b>git remote set-url origin (git_url)</b>	Change the URL of the git repo<br/>
<b>git push</b>	Push your changes to the origin<br/>
<br/>
(repo_url) can be like https:// or git:// or ssh:// or user@server:url<br/>
<br/>
<div class="bazou">Showing Changes: <b>status</b> / <b>diff</b/> / <b>log</b> / <b>blame</b></div>
<b>git status</b>	Show the files changed<br/>
<b>git diff</b>	Show changes to files compared to last commit<br/>
<b>git diff (filename)</b>	Show changes in single file compared to last commit<br/>
<b>git diff (commit_id)</b>	Show changes between two different commits.<br/>
<b>git log</b>	Show history of changes<br/>
<b>git blame (filename)</b>	Show who changed each line of a file and when<br/>
<br/>
Commit ID: This can be that giant long SHA-1 hash. You can call it many different ways. I usually just use the first 4 characters of the hash.<br/>
<br/>
<div class="bazou">Undoing Changes: <b>reset</b> / <b>revert</b></div>
<b>git reset –hard</b>	Go back to the last commit (will not delete new unstaged files)<br/>
<b>git revert HEAD</b>	Undo/revert last commit AND create a new commit<br/>
<b>git revert (commit_id)</b> Undo/revert a specific commit AND create a new commit<br/>
<br/>
<div class="bazou">Staging Files: <b>add</b> / <b>rm</b></div>
<b>git add -A</b>	Stage all files (new, modified, and deleted)<br/>
<b>git add .</b>	Stage new and modified files (not deleted)<br/>
<b>git add -u</b>	Stage modified and deleted files (not new)<br/>
<b>git rm (filename)</b>	Remove a file and untrack it<br/>
<b>git rm (filename) –cached</b>	Untrack a file only. It will still exist. Usually you will add this file to .gitignore after rm<br/>
<b>git mv (file_from) (file_to)</b>	Move a file<br/>
<br/>
Git Workflow Trees: How adding and committing moves files between the different git trees.<br/>
Working Tree	The “tree” that holds all our current files.<br/>
Index (after adding/staging file)	The “staging” area that holds files that need to be committed.<br/>
HEAD	Tree that represents the last commit.<br/>
<br/>
<div class="bazou">Publishing: <b>commit</b> / <b>stash</b> / <b>push</b></div>
<b>git commit -m “message”</b>	Commit the local changes that were staged</br/>
<b>git commit -am “message”</b>	Stage files (modified and deleted, not new) and commit</br/>
<b>git stash</b>	Take the uncommitted work (modified tracked files and staged changes) and saves it</br/>
<b>git stash list</b>	Show list of stashes</br/>
<b>git stash apply</b>	Reapply the latest stashed contents</br/>
<b>git stash apply (stash_id)</b>	Reapply a specific stash. (stash id = stash@{2})</br/>
<b>git stash drop (stash_id)</b>	Drop a specific stash</br/>
<b>git push</b>	Push your changes to the origin</br/>
<b>git push origin (local_branch_name)</b>	Push a branch to the origin</br/>
<b>git tag (tag_name)</b>	Tag a version (ie v1.0). Useful for Github releases.</br/>
<br/>
<div class="bazou">Updating and Getting Code: <b>fetch</b> / <b>pull</b></div>
<b>git fetch</b>	Get the latest changes from origin (don’t merge)<br/>
<b>git pull</b>	Get the latest changes from origin AND merge<br/>
<b>git checkout -b (new_branch_name) origin/(branch_name)</b>	Get a remote branch from origin into a local branch (naming the branch and switching to it)<br/>
<br/>
<div class="bazou">Branching: <b>branch</b> / <b>checkout</b></div>
<b>git branch</b>	Show all branches (local)<br/>
<b>git branch -a</b>	Show all branches (local and remote)<br/>
<b>git branch -r</b>	Show remote branches<br/>
<b>git branch (branch_name)</b>	Create a branch (from HEAD)<br/>
<b>git checkout -b (branch_name)</b>	Create a new branch (from HEAD) and switch to it<br/>
<b>git checkout (branch_name)</b>	Switch to an already created branch<br/>
<b>git push origin (branch_name)</b>	Push a branch up to the origin (Github)<br/>
<b>git checkout -b (new_branch_name) origin/(branch_name)</b>	Get a remote branch from origin into a local branch (naming the branch and switching to it)<br/>
<b>git push origin –delete (branch_name)</b>	Delete a branch locally and remotely<br/>
<br/>
<div class="bazou">Integrating Branches: <b>merge</b> / <b>rebase</b></div>
<b>git checkout master</b>	Merge a specific branch into the master branch.<br/>
<b>git merge (branch_name)</b><br/>
<b>git rebase (branch_name)</b>	Take all the changes in one branch and replay them on another. Usually used in a feature branch. Rebase the master to the feature branch so you are testing your feature on the latest main code base. Then merge to the master.<br/>
<b>git cherry-pick (commit_id)</b>	Merge just one specific commit from another branch to your current branch.<br/>
<br/>
Merging will occur FROM the branch you name TO the branch you are currently in.<br/>
<br/>
Rebasing usually switch to a feature branch (git checkout newFeature). Then rebase (git rebase master). Then merge back so you have all the changes of master and the feature branch (git checkout master, and git merge newFeature).<br/>
<br/>
<a href="https://scotch.io/bar-talk/git-cheat-sheet">origin</a><br/>
<br/>
<?php
echo <<<EOF
<pre class="prettyprint lang-php">
</pre>
EOF;

###############################################################################
require_once 'partials/footer.php';
