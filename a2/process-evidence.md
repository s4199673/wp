# Process Evidence Log

This file combines:
1. Debugging records
2. AI (e.g., Copilot/ChatGPT) usage logs

You must maintain this file throughout development.

---

## General Instructions
- Record entries as you work (not at the end)
- Be honest and specific
- Link to commits.Each debugging record must include at least one related GitHub commit 
(using commit hash and URL).
- Superficial or fabricated entries will not receive marks

---

# 🔧 Section 1: Debugging Records

## Bug 1

**Date Identified:**  
08/09/2026

**Date Fixed:**  
08/09/2026

**File:**  
nav.inc

**Related Commit:**  
02e50e4

**Symptom:**  
What went wrong?
The page did not load properly and included incorrect file path warnings.

**Steps to Reproduce:**  
How can the issue be triggered?
1. Open 'a2' through localhost.
2. Observe the PHP warnings.

**Root Cause:**  
Why did the issue occur?
1. Cover images were not copied across from a1.
2. css and js files were not copied across from a1.
3. The navigation links still pointed to .html files 

**Fix:**  
What did you change?
1. Added cover images. 
2. Copied across css and js files.
3. Changed .html to .php inside nav.inc

**Verification:**  
How did you confirm the fix?
Refreshed the page and confirmed that the warning disappeared and the full page loaded.

---

## Bug 2

**Date Identified:**  
26/09/2026

**Date Fixed:** 
26/09/2026 

**File:**  
scripts.js

**Related Commit:** 
b955793 

**Symptom:**  
Clicking "Add Book to Collection" on add.php did nothing.
The page stayed on add.php with no error message or no page change.

**Steps to Reproduce:**  
1. Fill in every required field on add.php page.
2. Click "Add Book to Collection".
3. The page remains on add.php

**Root Cause:**  
The browser was running a cached, outdated copy of scripts.js.
An earlier version of the form's submit event listening called event.preventDefault() and displayed "Form is valid. No data has been submitted." instead of allowing the form to actually submit.

**Fix:**  
Performed a hard refresh (Ctrl+Shift+R).

**Verification:**  
After the hard refresh, resubmittd the form with all fields filled in.
The page correctly navigated to process_add.php and displayed the expected debug output.
---
## Bug 3

**Date Identified:**  
26/09/2026

**Date Fixed:** 
26/09/2026

**File:**  
scripts.js

**Related Commit:** 
ca24a10

**Symptom:**  
Filter by Status not working

**Steps to Reproduce:**  
1. Open books.php
2. Select from the status filter dropdown.
2. The table contents do not change and the filter is not applied. 

**Root Cause:**  
Unclosed block caused the browser to reject all of scripts.js including the filter handler.

**Fix:**  
Added back } at the end of the code.

**Verification:**  
Refreshed the page. Tested the status filter to check that matching rows remain visible and non-mathcing rows are hidden.

---
## Bug 4

**Date Identified:**  
26/09/2026

**Date Fixed:** 
26/09/2026

**File:**  
gallery.php

**Related Commit:** 
ca24a10

**Symptom:**  
Newly uploaded book cover image not loading in gallery.php

**Steps to Reproduce:**  
1. Open gallery.php
2. The cover image fails to load.

**Root Cause:**  
gallery.php was generating image paths using <book.id>.png which assumed all cover images were stored as png giles names after the book ID. Newly uploded covers are saved using their original filename and extension cauing the generated image path to be incorrect.

**Fix:**  
Fixed the gallery.php to use each book's stored image_path instead of <book.id>.png
Newly uploaded cover should load using their actual filenmae and extension.

**Verification:**  
1. Open gallery.php
2. Confirm that the uploaded cover image is displayed correctly.

---
## Bug 5

**Date Identified:**  
26/09/2026

**Date Fixed:** 
26/09/2026

**File:**  
details.php

**Related Commit:** 


**Symptom:**  
<$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; $sql = "SELECT book_id, title, author, genre, publication_year, isbn, book_condition, description, status, image_path FROM books WHERE book_id = ?"; $stmt = mysqli_prepare($conn, $sql); mysqli_stmt_bind_param($stmt, "i", $id); mysqli_stmt_execute($stmt); $result = mysqli_stmt_get_result($stmt); $book = mysqli_fetch_assoc($result); ?>
Warning: Undefined variable $book in C:\xampp\htdocs\wp\a2\details.php on line 24
Book Not Found

**Steps to Reproduce:**  
1. Open details.php?id=13
2. Warning message appears and book details are missing.

**Root Cause:**  
Missed '<?php' before $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

**Fix:**  
Added the missing '<?php' opening tag.

**Verification:**  
1. Refresh details.php?id=13
2. No warning messages are displayed. 
3. The book cover image is shown.
4. All book information is displayed correctly except for price field. (See Bug 6)

---

## Bug 6

**Date Identified:**  
26/09/2026

**Date Fixed:** 
26/09/2026

**File:**  
details.php

**Related Commit:** 


**Symptom:**  
Warning: Undefined array key "price" in C:\xampp\htdocs\wp\a2\details.php on line 60

**Steps to Reproduce:**  
1. Open details.php?id=13
2. Warning message displayed on the page where price should appear.

**Root Cause:**  
Missed adding price to $sql query.

**Fix:**  
Added the price column to the SELECT statement:
$sql = "SELECT book_id, title, author, genre, publication_year, isbn, book_condition, price, description, status, image_path 

**Verification:**  
1. Refresh details.php?id=13
2. All book details including the price and book cover image are displayed correctly.
3. The page loads without errors.
 
---
## Bug 7

**Date Identified:**  


**Date Fixed:** 


**File:**  


**Related Commit:** 


**Symptom:**  


**Steps to Reproduce:**  


**Root Cause:**  


**Fix:**  


**Verification:**  

---
# 🤖 Section 2: AI Usage Log

## AI Task 1

**Date:**  
15/09/2026

**Task Description:**  
What were you trying to do?
Review the PHP code, MySQLi usage and Bootstrap grid structure

**Tool Used:**  
Copilot

**Prompt / Input:**  
(What did you type?)
Here is my PHP code for selecting records from a MySQL table and displaying them with a while loop. Please check:
1. Whether the SQL query uses the correct table and column names
2. Whether mysqli_query and mysqli_fetch_assoc are used correctly
3. Whether database output is escaped with htmlspecialchars()
4. Whether the Bootstrap grid structure is valid
Do not rewrite the whole file. 

**AI Output Summary:**  
(What did it generate?)

**Review of `index.php`**

1. **SQL table and columns**
   - `FROM books` and `book_id`, `title`, `description` appear consistent with the project naming, but the schema is not included, so verify these names in your supplied database schema.
   - The assessment requires the latest four books. The query currently has no ordering or limit. Consider:
   ```php
   $sql = "SELECT book_id, title, description
           FROM books
           ORDER BY book_id DESC
           LIMIT 4";
   ```

2. **`mysqli_query()` and `mysqli_fetch_assoc()`**
   - `mysqli_query($conn, $sql)` is used correctly.
   - `mysqli_fetch_assoc($result)` is also correctly placed inside a `while` loop.
   - Add query failure handling so database errors are not silently ignored:
   ```php
   if (!$result) {
       die("Query failed.");
   }
   ```
   - The `while` loop currently has no visible PHP closing brace after the card markup. This will likely cause a PHP syntax error.

3. **Database output escaping**
   - No database values are currently displayed. The cards still contain hard-coded titles, authors, prices, and descriptions.
   - When displaying values, escape them:
   ```php
   htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8')
   ```
   For example:
   ```php
   <h3><?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') ?></h3>
   <p><?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') ?></p>
   ```
   The selected `description` column is currently never used.

4. **Bootstrap grid**
   - `row`, `g-3`, and the responsive column classes are valid Bootstrap classes.
   - However, the closing `</div>` for `.row` and `</section>` are inside the large HTML comment near the end of the file. Therefore, the grid is not properly closed.
   - The loop should generate one card per database row. At present, every fetched row would output the same four hard-coded cards repeatedly.
   - Move the closing PHP brace immediately after the database-driven card, then close the `.row` and section outside the loop and outside the HTML comment.

The smallest correction is to keep one `<article>` inside the `while` loop, replace its hard-coded values with escaped `$row[...]` values, close the loop with `<?php } ?>`, and restore the `.row` closing tag. I did not modify the file.

**What You Accepted:**  
(Which parts did you keep?)
- All 4 suggestions.

**What You Changed:**  
(What did you modify and why?)
- Changed DESC to ASC to display the first 4 latest books.
- Added else loop for query failure handling.
- Left out ENT_QUOTES, 'UTF-8'

**Validation Performed:**  
How did you test correctness?
- Refreshed http://localhost/wp/a2/index.php 
- Checked the first 4 latest books details and images are displayed in the home page.
- Confirmed that the no errors appeared. 

**Issues Identified:**  
(Any errors or problems in AI output?)
- No significant errors were found in the AI recommendations.
---

## AI Task 2

**Date:**  
25/09/2026

**Task Description:**  
Review the connection file

**Tool Used:**  
Copilot

**Prompt / Input:**  
Here is my db_connect.inc file using procedural MySQLi. Please check whether the variable names are clear, whether mysqli_connect is used correctly, and whether the connection file is included in the correct place. Do not ask me for or expose real passwords.

**AI Output Summary:** 
- Variable names are understandable, but `$user`, `$password`, and `$database` could be clearer as `$dbUser`, `$dbPassword`, and `$dbName`.
- `mysqli_connect($host, $user, $password, $database)` is correct procedural MySQLi usage.
- The connection is included before database queries in `index.php:2` and `add.php:2`, so placement is correct there.
- The success message should be removed from `db_connect.inc:17-19`. An include file should establish the connection, not output HTML on every page.
- The current path `assets/includes/db_connect.inc` matches the pages, but it differs from the structure documented in `README.md:100-112`. Update either the folder structure or the README.
- Only `index.php` and `add.php` currently include the connection file. Any other page that uses `$conn` must include it as well.
- A separate path issue exists in `add.php`: it includes `assets/includes/process_add.php`, while the file appears to be located at `process_add.php`.

The file contains no exposed password value in the reviewed content. PHP syntax validation could not be run because the `php` command is not available in the terminal environment. 

**What You Accepted:**  
- Updated the folder structure and file paths to align with the assignment requirements.
- Added the databse connection include to all pages that require database access.

**What You Changed:**  
- Retained the existing variable names as they were already clear and meaningful.

**Validation Performed:**  
- Refreshed http://localhost/wp/a2/index.php 
- Confirmed that the page loadded successfully with no errors displayed.

**Issues Identified:**  
- No significant errors were found in the AI recommendations.

---
## AI Task 3

**Date:**  
25/09/2026

**Task Description:**  
Connet books.php to database and generate status filter from database values.

**Tool Used:**  
Copilot

**Prompt / Input:**  
Here is my books.php page. I want list records from database and it must output each row with a data-status attribute and generate filter options from the database status values. Filtering must be performed client-side using JavaScript show/hide logic. Book names link to details.php. Do not write the complete code.

**AI Output Summary:**  
At the top of the file, add the database connection and prepare one query:

```php
<?php
include('includes/db_connect.inc');

$pageName = 'Books';
$fileName = 'books.php';
include_once('includes/header.inc');

$sql = "SELECT book_id, title, author, genre, year, price, status
        FROM books
        ORDER BY title";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$books = [];
$statuses = [];

while ($row = mysqli_fetch_assoc($result)) {
    $books[] = $row;
    $statuses[$row['status']] = true;
}

$statuses = array_keys($statuses);
sort($statuses);
?>
```

Replace the hard-coded filter options with a loop:

```php
<option value="all" selected>Show All</option>

<?php foreach ($statuses as $status): ?>
    <option value="<?= htmlspecialchars($status) ?>">
        <?= htmlspecialchars($status) ?>
    </option>
<?php endforeach; ?>
```

Replace the hard-coded table rows with a loop. Each row must contain `data-status`, and the title should link using the book ID:

```php
<?php foreach ($books as $book): ?>
    <tr class="value"
        data-status="<?= htmlspecialchars($book['status']) ?>">

        <th scope="row">
            <a href="details.php?id=<?= (int) $book['book_id'] ?>">
                <?= htmlspecialchars($book['title']) ?>
            </a>
        </th>

        <td><?= htmlspecialchars($book['author']) ?></td>
        <td><?= htmlspecialchars($book['genre']) ?></td>
        <td><?= htmlspecialchars($book['year']) ?></td>
        <td>$<?= htmlspecialchars($book['price']) ?></td>
        <td>
            <span class="table-status">
                <?= htmlspecialchars($book['status']) ?>
            </span>
        </td>
    </tr>
<?php endforeach; ?>
```

Use the actual year column name from your database schema if it differs from `year`.

Your existing JavaScript can remain mostly unchanged. For a more precise selector, change:

```javascript
const books = document.querySelectorAll("tbody tr.value");
```

to:

```javascript
const books = document.querySelectorAll(
  ".books-table tbody tr[data-status]"
);
```

`details.php` is currently empty, so it will also need to read `$_GET['id']`, validate it, and retrieve the matching book record.

**What You Accepted:**  
- Replace the hard-coded filter options with a loop.
- Replace the hard-coded table rows with a loop.
- Added a data-status attribute to each table row for client-side filtering.

**What You Changed:**  
- Used publication_year instaed of year.
- Used a separate SELECT DISTINCT status query to generate the filter dropdown values.
- Replaced the hard-coded book rows with a PHP while loop.

**Validation Performed:**  
- Confirmed that book records are retrieved and displayed in the table.
- Tested the status filter to check that matching rows remain visible and non-mathcing rows are hidden.

**Issues Identified:** 
- The AI-generated example used year but used publication_year as per column name in the assignment.

---
## AI Task 4

**Date:**  
25/09/2026

**Task Description:**  

**Tool Used:**  

**Prompt / Input:**  
Here is my PHP add book form. Please check:
1. whether every control has a matching label;
2. whether id and name attributes are correct;
3. whether the form uses POST;
4. whether multipart/form-data is present;
5. whether the file input accepts the required image extensions;
6. whether Bootstrap form classes are used.

Do not write the processing script.

**AI Output Summary:**  
1. **Labels:** Pass. Every input, select, and textarea has a matching `<label for="...">`. The submit button does not require a label.
2. **`id` and `name`:** Pass. IDs are unique and each form control has an appropriate name.
3. **POST:** Pass. The form uses `method="POST"` at `add.php:25`.
4. **Multipart encoding:** Pass. `enctype="multipart/form-data"` is present.
5. **Image extensions:** Pass. The file input accepts `.jpg`, `.jpeg`, `.png`, `.gif`, and `.webp` at `add.php:120-121`.
6. **Bootstrap classes:** Pass. The form uses classes such as `form-control`, `form-select`, `form-label`, `form-check`, `form-check-input`, and `btn`.

**Additional issue**

The `//` explanations inside the form are not valid HTML comments, so they may appear as visible text. Use `<!-- ... -->` or remove them.

Also, the top of `add.php:2-4` includes `includes/process_add.php`, but the form submits to `process_add.php` in the `a2` root. This path should be checked separately. I did not create or modify any processing script.

**What You Accepted:**  
- All the findings plus the additional issues

**What You Changed:**  
- Changed // to <!--...--> for comments.
- Removed if ($_SERVER['REQUEST_METHOD'] === 'POST') and 'includes/process_add.php' as it never queries the database itself.

**Validation Performed:**  

**Issues Identified:**  

---
## AI Task 5

**Date:**  
25/09/2026

**Task Description:**  
Review process_add.php for required field validation, file upload handling and prepared statements.

**Tool Used:** 
Copilot 

**Prompt / Input:**  
Review my process_add.php for:

Required-field validation:

Missing array keys.
Rejection of whitespace-only input.
Length limits matching VARCHAR(50) and VARCHAR(255).

File upload handling:

Upload error checks.
Lowercasing file extensions.
Strict in_array() usage.
File size validation.
Server-generated filenames.
Preservation of the original extension.
Correct use of __DIR__ in the upload path.

Procedural MySQLi prepared statement:

Columns match bound values.
Correct number of placeholders.
Appropriate four bind types.
Bound variable order matches column order.
Uploaded file is deleted if the database insert fails.

Note any limitations, but do not rewrite the script, change the folder structure, add frameworks, or convert to PDO/object-oriented MySQLi.

**AI Output Summary:**  
- **Critical: upload field names are inconsistent.** The form uses `image_path`, but the script reads `$_FILES["image"]["name"]`, so the extension check uses a missing key and rejects valid uploads. See `process_add.php:54` and `add.php:118`.
- **Missing POST keys are not handled.** Variables are created dynamically from `$_POST`, then accessed directly. Missing fields can produce notices and undefined variables. See `process_add.php:5`.
- **Whitespace-only input is partly rejected.** `trim()` is used, and minimum-length checks reject empty title, author, ISBN, and description values. However, there is no explicit required-field check for every field.
- **Maximum lengths are not validated.** There are no checks matching `VARCHAR(50)` or `VARCHAR(255)`. The database may reject or truncate oversized values.
- **Form select values do not match validation values.** The form submits numeric genre, condition, and status values, while the script expects text labels. These validations will fail. See `add.php:50`, `process_add.php:28`.
- **Condition variable mismatch.** The form submits `book_condition`, which creates `$book_condition`; the script validates and binds `$condition`, which is undefined. See `add.php:91` and `process_add.php:37`.
- **No upload error check exists.** The script does not inspect `$_FILES['image_path']['error']`, verify that a file was uploaded, or check `is_uploaded_file()`.
- **Extension lowercasing and strict comparison are correct in isolation.** `strtolower()` is used and `in_array(..., true)` is correctly strict. However, the wrong upload key prevents this from working.
- **No file-size validation exists.**
- **No server-generated filename exists.** The original client filename is used directly, creating overwrite and filename-security risks. See `process_add.php:88`.
- **The original extension is preserved conceptually**, but the filename source is incorrect and the final filename is not safely generated.
- **`__DIR__` is not used.** The upload path is relative to the current working directory rather than being constructed from the script directory.
- **Prepared statement structure is mostly correct.** There are 10 columns, 10 placeholders, 10 bound variables, and the type string contains 10 types. The `i` publication year and `d` price types are appropriate.
- **Bound variable order is not correct in practice.** `$condition` should correspond to `book_condition`, but it is never populated from the form. `$image_path` is also not populated from the uploaded file.
- **Database failure cleanup is missing.** There is no `unlink()` call. Also, the file is moved only after a successful database insert, so the current order cannot clean up an uploaded file when the insert fails.
- **Insert/upload consistency is incomplete.** If the database insert succeeds but `move_uploaded_file()` fails, the database row remains even though its image is unavailable. See `process_add.php:84`.

**Limitations**

The repository does not include the database schema, so the exact `VARCHAR` definitions and column types cannot be independently confirmed. Based on the requested limits, the script is missing the required maximum-length validation regardless.

No files were changed.

**What You Accepted:**
- Inconsistent upload field names
- Mssing POST Keys not handled
- Condition variable mismatch
- Select value mismatch
- Missing minimum-length check 
- Missing server-generated filename 
- Missing upload error/size/type checks  

**What You Changed:**  
- Added minimum-length checks for description.
- Kept current minimum-length checks.
- Updated numberic option value in add.php to the text labels that match the process_add.php
- Kept foreach loop.
- $condition corrected to $book_condition.

**Validation Performed:**  
- Compared field names and submitted values in add.php with the corresponding validation and processing logic in process_add.php
- Added tools.inc to enable preshow() debug output for inspecting $_FILES and $errors during testing.
- Confirmed a new book was added to books.php 

**Issues Identified:**  
- AI identified that there is "No explicit required-field check for every field" but my understanding is that this is handled by HTML using 'required'.

---

## AI Task 6

**Date:**  
25/09/2026

**Task Description:**  
Building details.php page

**Tool Used:**  
Copilot

**Prompt / Input:**  
I am a beginner PHP student building a database-driven website. I need to create details.php, a page that displays one book's full details including its cover image based on a book ID passed through the URL. Please explain a good starting point and the overall workflow. Do not write the complete solution

**AI Output Summary:** 
**Good Starting Point**
Your page already has the right basic structure in `details.php`: it includes the database connection and shared header, navigation, and footer. The main work belongs inside `<main>`. Before writing that section, trace how a book gets selected:

- `books.php` links to `details.php?id=...`, passing the book’s `book_id` in the URL.
- `add.php` shows the fields used for a book, including its description and cover.
- `process_add.php` saves the cover’s filename in `image_path`.
- `gallery.php` shows how that filename is combined with `assets/images/covers/` to display an image.

**Overall Workflow**

1. **Read and validate the ID.** PHP receives URL parameters through `$_GET`. Check that `id` exists and is a valid integer before using it. Think about what your page should show when it is missing or malformed.

2. **Look up one book.** Use a `SELECT` query on the `books` table for the fields the page needs: for example, `title`, `author`, `genre`, `publication_year`, `price`, `isbn`, `book_condition`, `description`, `image_path`, and `status`. Use a MySQLi procedural prepared statement: prepare a query with a `?` placeholder, bind the validated ID as an integer, then execute it. Don’t insert the URL value directly into the SQL string.

3. **Handle the result.** A valid ID might not match any book, so plan for both “book found” and “no matching book” cases. Give the visitor a clear message for the latter.

4. **Display the details.** If a row is found, show its values in semantic HTML within `<main>`. For the cover, use the stored `image_path` with the same `assets/images/covers/` directory used by the gallery. Don’t assume the image filename is the book ID.

5. **Escape displayed values.** Wrap database text used in HTML with `htmlspecialchars()`, including values in the cover’s `src` and `alt` attributes. This is separate from using a prepared statement for the database query.

6. **Test a few URL cases.** Try a real book link from the books table, then check a missing ID, a non-numeric ID, and a numeric ID that doesn’t exist. Confirm the cover loads and the page still uses the shared navigation and footer.

A useful first milestone is just to make the page distinguish “valid ID with a matching book” from “no matching book.” Then add the displayed fields and cover image one at a time. You can verify the actual stored image filename in `process_add.php` and compare its display path with `gallery.php`.

One small troubleshooting note: `db_connect.inc` currently prints a connection-success message. If that appears above your page content, it’s coming from the include rather than the details-page layout.

**What You Accepted:**  
- All 6 workflow suggestions.

**What You Changed:**  
- Displayed Genre, Publication Year, ISBN, Conditon and price as an HTML table to match the screenshot provided.

**Validation Performed:**  
- Tested details.php?id=1 and other books and confirmed book details displayed correctly.
- Tested an invalid ID (e.g id=99) and confirmed the "Book Not Found" message displayed.

**Issues Identified:**  
- AI did not consider css styling

---

## AI Task 7

**Date:**  
27/09/2026

**Task Description:**  
Review the connection file

**Tool Used:**  
Copilot

**Prompt / Input:**  


Do not ask me to share passwords.

**AI Output Summary:** 


**What You Accepted:**  
- 
**What You Changed:**  
- 

**Validation Performed:**  
- 

**Issues Identified:**  
- No significant errors were found in the AI recommendations.
---
# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
