Break It

The broken copies of the relevant files are in `break-it/` — the live site is untouched throughout this exercise. `save_score_broken.php` handles Vulnerability 1, `quiz_broken.js` handles Vulnerability 2.



Vulnerability 1 - SQL Injection


From `break-it/save_score_broken.php`:

```php
$query = "INSERT INTO quiz3_scores (player_name, score, total) VALUES ('" . $name . "', " . $score . ", " . $total . ")";
$db->query($query);
```

The player's name comes straight from `$_POST` and gets dropped into the query string with concatenation. MySQL has no way to tell where the value ends and the SQL begins — it just reads the whole thing as a command.

The Exploit:

Type this as your name in the quiz form:

```
'; DROP TABLE quiz3_scores; --
```

The query that actually executes becomes:

```sql
INSERT INTO quiz3_scores (player_name, score, total) VALUES (''; DROP TABLE quiz3_scores; --', 8, 10)
```

The first statement closes, the second one drops the entire scores table, and `--` comments out whatever's left so MySQL doesn't throw a syntax error. Every score ever saved disappears instantly. The same input pattern works on `quiz3_questions` - you could wipe the whole quiz in two requests. There's no error, no warning, and the attacker's request looks like a normal form submission.

How to fix:

From `php/save_score.php`:

```php
$stmt = $db->prepare('INSERT INTO quiz3_scores (player_name, score, total) VALUES (?, ?, ?)');
$stmt->bind_param('sii', $name, $score, $total);
$stmt->execute();
```

A prepared statement sends the query structure to MySQL first - the `?` placeholders are locked in as value slots before any user input arrives. When the name comes through on `bind_param`, MySQL already knows the query's shape and treats the name as a literal string value, not executable SQL. There's no way to break out of a value slot and inject new statements, because the parsing already happened without the user's data in it.


Vulnerability 2 — XSS (Cross-Site Scripting)



From `break-it/quiz_broken.js`, inside `finishQuiz()`:

```javascript
$.each(data.leaderboard, function (i, row) {
    $tbody.append(
        '<tr><td>' + row.player_name + '</td>' +
        '<td>' + row.score + ' / ' + row.total + '</td></tr>'
    );
});
```

When the leaderboard pulls names back from the database and concatenates them into an HTML string, the browser treats whatever's in `player_name` as markup - not text. It has no way to know the difference.

The Exploit:

Enter this as your name before starting the quiz:

```
<script>alert('hacked')</script>
```

That string gets saved to `quiz3_scores` as-is — there's nothing stopping it from going into the database. Every time anyone loads the leaderboard afterward, that script tag renders into the DOM and executes in their browser. An `alert` is just the proof of concept — a real attacker would replace it with `document.cookie` to steal session data, or a redirect to a phishing page. It runs for every user who sees the leaderboard until someone manually deletes that database row.

### The Safe Version

From `js/quiz.js`:

```javascript
var safeName = $('<div>').text(row.player_name).html();
$tbody.append(
    '<tr><td>' + safeName + '</td>' +
    '<td>' + row.score + ' / ' + row.total + '</td></tr>'
);
```

jQuery's `.text()` treats the value as a plain string and converts any HTML characters to their escaped equivalents — `<` becomes `&lt;`, `>` becomes `&gt;`. The name still makes it into the DOM, but as visible text, not executable markup. The browser renders `&lt;script&gt;` as the literal characters `<script>` on screen and it never runs.
