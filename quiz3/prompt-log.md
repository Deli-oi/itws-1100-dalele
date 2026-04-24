# Prompt Log — Quiz 3

---

## Entry 1

**Prompt:**
> create a file called prompt-log.md in my quiz3 folder. you will make entries for each prompt with the following:
> • The prompt I gave you (exact text)
> • A 1-2 sentence summary of what you returned
> • Section for me to put: What I kept, what I changed, and what I threw away — and WHY

**What Claude returned:**
Created `prompt-log.md` in `Labs/Quiz3/` with Entry 1 pre-filled and a commented-out copy-paste template for future entries.

**My reflection:**

- What I kept: everything
- What I changed: asked for more with below prompt to make things easier. 
- What I threw away: nothing. 
- Why: wanted to see if I could create something to help me do this more efficiently.

---

## Entry 2

**Prompt:**
> correction: I want you to automatically make entries in it for each time I prompt you

**What Claude returned:**
Set up a `UserPromptSubmit` hook via a PowerShell script (`.claude/log-prompt.ps1`) that automatically appends each prompt as a new entry to `prompt-log.md` and injects a reminder into Claude's context to fill in the response summary after each reply.

**My reflection:**

- What I kept: it, this is cool and helps my workflow
- What I changed: Nothing, just asked it to actually establish the tool for future sessions, as I've been doing this semi-manually for all of the group project. 
- What I threw away: n/a
- Why: very useful feature

---

## Entry 3

**Prompt:**
> read @Labs/Quiz3/original_prompt.md and do everything I established there. should you need any clarification, stop and ask. (also, for the prompt log of this, summarize the originalprompt.md and reference it in the summary)

**What Claude returned:**
Read `original_prompt.md` (flower facts quiz: JS/jQuery frontend, PHP+MySQL backend, Azure deploy, leaderboard as the DB write) and lab09 for DB credential patterns, then stopped to ask two blocking questions: (1) which MySQL database to target and whether credentials are still `root`/`root`, and (2) whether the DB write should be a leaderboard (player name + score) or something else.

**My reflection:**

- What I kept:
- What I changed:
- What I threw away:
- Why:

---
## Entry 4

**Prompt:**
> 1. This is a full briefing that I had my other claude agent draft to help you understand how everything is linked easier Quiz3 Deployment Briefing          
>                        
>   Server
>   - FQDN:
>   dalelerpi.eastus.cloudapp.azure.com
>   - SSH: dalele@dalelerpi.eastus.clou
>   dapp.azure.com
>   - Stack: Ubuntu 22, Apache2, PHP,
>   MySQL, phpMyAdmin
>   - Web root: /var/www/html/
> 
>   Folder structure
>   /var/www/html/
>     iit/           ΓåÉ IIT classwork
>   git repo (the one quiz3 lives in)
>       phpmyadmin/  ΓåÆ symlink to
>   /usr/share/phpmyadmin (do not
>   touch)
>       lab09/       ΓåÉ reference
>   project with working PHP+MySQL
>       quiz3/       ΓåÉ THIS is where
>   your new project goes
> 
>   Git workflow on the server
>   All git operations must run as
>   www-data:
>   sudo -u www-data git pull   # from
>   inside /var/www/html/iit/
>   The www-data SSH key is at
>   /var/www/.ssh/id_ed25519 and is
>   already registered on GitHub. Push
>   from local ΓåÆ GitHub, then SSH in
>   and pull as www-data.
> 
>   Database answer to the agent's
>   questions:
>   - Yes, add Quiz3 tables to the
>   existing iitF23 database. No new
>   database needed. Lab09 already uses
>    new mysqli('localhost', 'root',
>   'root', 'iitF23') and it works.
>   - Yes, credentials are root/root ΓÇö
>   same as lab09. Use new
>   mysqli('localhost', 'root', 'root',
>    'iitF23') for Quiz3 as well.
>   - phpMyAdmin is live at
>   http://dalelerpi.eastus.cloudapp.az
>   ure.com/iit/phpmyadmin/ ΓÇö use it to
>    create tables and verify data.
> 
>   Deploy steps for quiz3
>   1. Build the project locally in a
>   quiz3/ folder at the root of the
>   iit repo
>   2. Commit and push to GitHub
>   3. SSH into the server: ssh dalele@
>   dalelerpi.eastus.cloudapp.azure.com
>   4. Pull as www-data: cd
>   /var/www/html/iit && sudo -u
>   www-data git pull
>   5. App will be live at:
>   http://dalelerpi.eastus.cloudapp.az
>   ure.com/iit/quiz3/
> 
>   Stack constraints (course rules)
>   HTML, CSS, vanilla JS, jQuery, PHP,
>    MySQL only. No Node, React,
>   TypeScript, or npm build tools.
> 
>   Project requirements summary
>   - Quiz game with flower facts
>   - Questions stored in MySQL, served
>    by PHP, answered via JS/jQuery in
>   browser
>   - Tracks and displays score
>   - At least one CREATE TABLE you
>   designed
>   - PHP reads AND writes to DB
>   - Prepared statements for all
>   queries that include user input
>   - Clean, minimal frontend ΓÇö
>   barebones, easy to read like a lab
>   assignment
>   - Deployed at the FQDN above
> 2. your solution sounds great, go for that. 
> 

**What Claude returned:**
A deployment briefing (drafted by a separate Claude agent) answered both blocking questions — use `iitF23` with `root`/`root`, leaderboard approach confirmed — then built the full Quiz3 project: `sql/schema.sql` (2 tables, 15 seed questions), `php/db.php` + `get_questions.php` + `save_score.php`, `js/quiz.js` (jQuery single-page quiz with shuffle + answer feedback), `css/style.css` (clean green theme), and `index.html`, all in root-level `quiz3/` ready to serve at `/iit/quiz3/`.

**My reflection:**

- What I kept: everything
- What I changed: I ended up having to backtrack here, I forgot that by answering with the conext of my previous conversations, I would deal with the same issues as before when I didn't know as much about phpmyadmin and SQL. 
- What I threw away: n/a
- Why: I wanted to ensure that I covered all of my bases for this project so that claude could be as autonomous with the rest as possible. 

---

## Entry 5

**Prompt:**
> give me all commands to run in orer to deploy

**What Claude returned:**
Gave 3 ordered steps: (1) run `schema.sql` in phpMyAdmin via browser, (2) `git add quiz3/ && git commit && git push` locally, (3) SSH in and `sudo -u www-data git pull` from `/var/www/html/iit/`.

**My reflection:**

- What I kept: the instructions
- What I changed: ensured everything was up to our environment. 
- What I threw away: n/a
- Why: helped me move as fast as claude was moving to continue developement and debugging came first and fast. 

---

## Entry 6

**Prompt:**
> [Image #1] is this correct for step 1

**What Claude returned:**
Confirmed the SQL ran correctly (both tables created, 15 rows inserted — all green), but caught a critical issue: phpMyAdmin shows the database is `iit` not `iitF23`, so updated `db.php` to connect to `'iit'` instead.

**My reflection:**

- What I kept: change in iit23 to iit
- What I changed: n/a
- What I threw away: n/a
- Why: imported an image of an error I got, realizing that i forgot to change iit23 to iit

---

## Entry 7

**Prompt:**
> i did step three and got this dalele@daleleRPI:~$ cd /var/www/html/iit
> dalele@daleleRPI:/var/www/html/iit$ sudo -u www-data git pull
> remote: Enumerating objects: 32, done.
> remote: Counting objects: 100% (32/32), done.
> remote: Compressing objects: 100% (16/16), done.
> remote: Total 32 (delta 11), reused 32 (delta 11), pack-reused 0 (from 0)
> Unpacking objects: 100% (32/32), 9.36 KiB | 104.00 KiB/s, done.
> From https://github.com/Deli-oi/itws-1100-dalele
>    be90b5c..184ab9b  lab09      -> origin/lab09
>  * [new branch]      quiz3      -> origin/quiz3
> Already up to date.
> dalele@daleleRPI:/var/www/html/iit$ but clicking on the link didnt work, do you think this is an issue with branching?

**What Claude returned:**
Diagnosed the issue: git fetched the quiz3 branch but the server is still checked out on a different branch, so the files aren't in the working directory. Fix is `sudo -u www-data git checkout quiz3` on the server.

**My reflection:**

- What I kept: checked out the branch
- What I changed: n/a
- What I threw away: n/a
- Why: forgot to checkout branch

---

## Entry 8

**Prompt:**
> did you ever create a questions database to pull from? im getting a "could not load questions, please try again" error

**What Claude returned:**
Confirmed the `db.php` fix was included in the push (git shows branch is clean); diagnosed the real issue as the server not yet being on the quiz3 branch. Fix: `sudo -u www-data git checkout quiz3` on server, then verify by visiting the `get_questions.php` URL directly.

**My reflection:**

- What I kept: nothing, just the knowlege that it was wrong with this assuption
- What I changed: n/a 
- What I threw away: its suggestions
- Why: it returned this because I didn't give enough context. 


--- 

## Entry 9

**Prompt:**
> jquery-3.7.1.min.js:2  GET http://dalelerpi.eastus.cloudapp.azure.com/iit/quiz3/php/get_questions.php 500 (Internal Server Error)
> above is the eroor within f12 console and opening get_questions.php on the server results in dalelerpi.eastus.cloudapp.azure.com is currently unable to handle this request.
> http error 500

**What Claude returned:**
Identified 500 as a PHP crash (before any output); asked them to run `sudo tail -30 /var/log/apache2/error.log` on the server to get the exact PHP error, and noted the likely cause is MySQL root auth failing via PHP on Ubuntu.

**My reflection:**

- What I kept: ran the comman to see, but there was nothing
- What I changed: n/a 
- What I threw away: n/a
- Why: gave it errors i was getting to identify the real problem

---

## Entry 10

**Prompt:**
> my phpmyadmin does require a password if thats what your saying. sudo tail -30 /var/log/apache2/error.log results in nothing

**What Claude returned:**
Gave a PHP one-liner to run directly on the server to instantly test if the MySQL credentials (`root`/`root`/`iit`) are valid without touching any files.

**My reflection:**

- What I kept: knowlege that my root/root was invalid
- What I changed: n/a
- What I threw away: n/a
- Why: needed to identify the problem

---

## Entry 11

**Prompt:**
> thats what i was saying before, log this as a bad error in my prompt-log, and -> $dbuser='username';
> $dbpass='password$';

**⚠️ CLAUDE ERROR:** When the user said "my phpmyadmin does require a password" (Entry 15), Claude should have immediately asked "what username and password do you use to log in?" Instead, Claude sent them on a 5-prompt detour through log files and one-liners before finally getting the credentials. Always ask for the actual credentials directly when auth fails.

**What Claude returned:**
Updated `db.php` to use `username`/`password$` credentials, gave the git commit/push/pull commands to deploy the fix.

**My reflection:**

- What I kept: the knowlege of where to change
- What I changed: username and password to my actual ones. 
- What I threw away: n/a 
- Why: to ensure data was actually accessible

---
