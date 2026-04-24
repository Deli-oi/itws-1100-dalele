Section 1: Server-Side Fundamentals


Part A — The Full Request Journey (Add Movie)


When the form submits, the browser packages the fields into a POST request body and sends it to movies.php. POST keeps the data out of the URL — you don't see it in the address bar the way you would with GET.

Apache sees the .php extension and knows not to serve it as a static file. It hands the request to the PHP interpreter, which runs the script top to bottom.

PHP pulls the values from $_POST:

    $title = trim($_POST['title']);
    $year  = trim($_POST['year']);

$_POST is PHP's built-in array for POST data. trim() strips extra whitespace. Then PHP connects and inserts with a prepared statement:

    $db = new mysqli('localhost', 'phpmyadmin', 'Oftheway13', 'iit');
    $stmt = $db->prepare('INSERT INTO movies (title, year) VALUES (?, ?)');
    $stmt->bind_param('ss', $title, $year);
    $stmt->execute();

prepare() locks in the query structure with ? placeholders before any user input is involved. bind_param() fills them in as typed data. By the time the user's input arrives, MySQL already knows the query's shape — it can only treat that input as a value, never as a command.

Without a prepared statement you'd concatenate directly:

    $query = "INSERT INTO movies (title, year) VALUES ('" . $title . "', '" . $year . "')";

Type this as a movie title:

    '); DROP TABLE movies; --

MySQL reads that as two statements. The first closes, the second drops your table, and -- kills the rest. That's SQL injection. Prepared statements prevent it structurally — there's no way to break out of a value slot once the query is already parsed.

After the insert, PHP runs a SELECT, loops through the results, and echoes the full updated page back. No AJAX — the browser receives the new page in one shot.


Part B — Lab 8 JSON/AJAX vs Lab 9 PHP/MySQL


Where the data lives

Lab 8 is a flat JSON file on the server — zero infrastructure, just a file JavaScript fetches. Lab 9 is a MySQL database with a full query layer. The database gives you structure, filtering, and write capability, but it comes with setup cost — credentials, connections, permissions. A JSON file just works. A database can and does fail in ways that take time to debug.

When the data loads

Lab 8 is async. The page loads first, then $.getJSON() fires and injects the data into the DOM without a reload.

Timeline: page loads → JS runs → AJAX request → JSON comes back → DOM updates.

Lab 9 is synchronous. PHP runs before any HTML exists and bakes the data into the page before it's sent.

Timeline: browser requests page → PHP queries DB → loops through rows → finished HTML sent to browser.

Who builds the HTML

Lab 8: the browser builds it from JSON. Lab 9: the server builds it in PHP. The difference matters because client-side rendering exposes the raw data in the network tab. Server-side rendering keeps the logic locked on the server — authentication can happen before any data leaves the database.

Adding search

Lab 8 search means loading the full file and filtering in JavaScript. Fine for small data, breaks at scale. Lab 9 search is a SQL WHERE clause:

    SELECT * FROM movies WHERE title LIKE '%searchterm%'

The database filters before anything leaves the server. SQL search is easier to scale and doesn't require shipping the full dataset to the browser.


Part C — Lab 10 Azure Server Configuration


What .htaccess does

.htaccess is Apache's per-directory config file. Drop it in a folder and Apache applies those rules to every request hitting that directory and everything below it. For it to work, the Apache config needs AllowOverride All (or AllowOverride AuthConfig) set for that directory — without it, Apache reads the file and ignores it completely.

The .htaccess and .htpasswd relationship

.htaccess is the instruction — it tells Apache authentication is required and points to the password file. .htpasswd is the store — hashed username/password pairs. .htaccess goes inside the folder you want to protect. .htpasswd should live outside the web root entirely so no browser request can reach it. If it's inside the web root and Apache misconfigures, anyone can download your credentials as a plain text file.

In Lab 10 the setup moves from blanket-protecting the entire iit/ directory to per-folder protection on lab01/ and lab09/ specifically, so the rest of the site stays public.

Why Lab 9 needed protection

Lab 9 PHP files have database credentials hardcoded. Without authentication on that folder, anyone can hit the endpoints directly, probe the database, or read the source if PHP isn't handling the request correctly. With the credentials out, an attacker has full access to the iit database — read, modify, drop. That's why lab09/ gets its own .htaccess.

The header() redirect

header('Location: /iit/') sends an HTTP 302 Found. The browser sees it and navigates immediately. The rule is that header() must fire before any output — not even a space or blank line above it. PHP sends headers first, then the body, and once the body starts the headers are gone. Any output before header() throws a "headers already sent" warning and the redirect doesn't happen. Nothing comes before header(), and exit comes right after it.
