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
18/10/2026

**Date Fixed:**  
18/10/2026

**File:**  
process_register.php

**Related Commit:**  
961c939

**Symptom:**  
What went wrong?

Warning: Undefined variable $conn in C:\xampp\htdocs\wp\a3\process_register.php on line 38

Fatal error: Uncaught TypeError: mysqli_prepare(): Argument #1 ($mysql) must be of type mysqli, null given in C:\xampp\htdocs\wp\a3\process_register.php:38 Stack trace: #0 C:\xampp\htdocs\wp\a3\process_register.php(38): mysqli_prepare(NULL, '\r\n INSERT IN...') #1 {main} thrown in C:\xampp\htdocs\wp\a3\process_register.php on line 38

**Steps to Reproduce:**  
How can the issue be triggered?
1. Open the registration form and enter:
username => emilia_kim
email => emilia@bookverse.com
password => password123
confirm_password => password123
2. Submit the form.
3. The page displays warning and fatal error.

**Root Cause:**  
Why did the issue occur?
- The database connection variable $conn was not defined before calling mysqli_prepare().
As a result, mysqli_prepare() received null instead of a valid MySQLi connection object.
- Users table in the database doesn't have a column named password_hash.

**Fix:**  
What did you change?
- Added include('includes/db_connect.inc'); Ensure the database connection file was included correctly 
- Updated password_hash to password as per bookverse.spl file.

**Verification:**  
How did you confirm the fix?
1. Reloaded the registration page after the change.
2. Fixing the bug led to Bug #2.

---

## Bug 2

**Date Identified:**  
18/10/2026

**Date Fixed:**  
18/10/2026

**File:**  
register.php

**Related Commit:**  
961c939

**Symptom:**
Fatal error: Uncaught Error: Call to undefined function showFlashAlerts() in C:\xampp\htdocs\wp\a3\register.php:21 Stack trace: #0 {main} thrown in C:\xampp\htdocs\wp\a3\register.php on line 21  

**Steps to Reproduce:**  
1. Open the registration page.
2. The page displays fatal error.

**Root Cause:**  
Made a typo in register.php 
The function is named showFlashAlerts() (plural) in toolsinc but register.php is calling showFlashAlert() (Singular)

**Fix:**  
Updated the function call in register to use showFlashAlerts() (plural).

**Verification:**  
1. Reloaded the registration page after the change.
2. Confirmed that the register page is displayed correctly without any errors.
---

## Bug 3

**Date Identified:**  
18/10/2026

**Date Fixed:**  
18/10/2026

**File:**  
register.php

**Related Commit:**  
961c939

**Symptom:**
Fatal error: Allowed memory size of 536870912 bytes exhausted (tried to allocate 262144 bytes) in C:\xampp\htdocs\wp\a3\includes\tools.inc on line 60

**Steps to Reproduce:**  
1. Open the registration page.
2. The page displays fatal error.

**Root Cause:**  
Caused by infinite recursion in tools.inc

**Fix:**  
Updated tools.inc file

**Verification:**  
1. Reloaded the registration page after the change.
2. Confirmed that the register page is displayed correctly without any errors.

---

## Bug 4

**Date Identified:**  
18/10/2026

**Date Fixed:**  
18/10/2026

**File:**  
register.php

**Related Commit:**  
961c939

**Symptom:**
Fatal error: Uncaught Error: Undefined constant "bind" in C:\xampp\htdocs\wp\a3\process_register.php:52 Stack trace: #0 {main} thrown in C:\xampp\htdocs\wp\a3\process_register.php on line 52

**Steps to Reproduce:**  
1. Open the registration form and enter:
username => emilia_kim
email => emilia@bookverse.com
password => password123
confirm_password => password123
2. Submit the form.
3. The page displays warning and fatal error.

**Root Cause:**  
Bind online 52 is being treated as a PHP constant but it isn't defined.
mysqli_stmt_bind_param() already called above. 

**Fix:**  
Remove && bind.

**Verification:**  
1. Submitted the form after the change.
2. Confirmed that the process_register.php displays the following without any errors:
username => emilia_kim
email => emilia@bookverse.com
password => password123
confirm_password => password123
(Need to work on login.php page next)
---

## Bug 5

**Date Identified:**  
18/10/26

**Date Fixed:**  
18/10/26

**File:**  
login.php

**Related Commit:**  
961c939

**Symptom:**
Fatal error: Uncaught Error: Call to undefined function showFlashAlerts() in C:\xampp\htdocs\wp\a3\login.php:14 Stack trace: #0 {main} thrown inC:\xampp\htdocs\wp\a3\login.phpon line14

**Steps to Reproduce:**
1. Open the registration form and enter:
username => emilia_kim
email => emilia@bookverse.com
password => password123
confirm_password => password123
2. Submit the form.
3. The page displays fatal error.

**Root Cause:**  
showFlashAlerts() is defined in tools.inc but login.php doesn't include tools.inc

**Fix:**  
Add include('includes/tools.inc'); to login.php

**Verification:**  
1. Submitted the form after the change.
2. Confirmed that login.php is displayed correctly without any errors.

---

## Bug 6

**Date Identified:**  
19/10/2026

**Date Fixed:**  
19/10/2026

**File:**  
process_register.php

**Related Commit:**  
08e60dc

**Symptom:**
Page redirects to Login.php without showing success message after submitting the registration form.

**Steps to Reproduce:**  
1. Open the registration form and enter:
username => s4199673
email => s4199673@bookverse.com
password => password123
confirm_password => password123
2. Submit the form.
3. Page redirects to Login.php without showing success message. 
4. The database table successfully saves the new user.

**Root Cause:**  
PHP session keys are case-sensitive.
process_register.php contained success message under $_SESSION['Success'] (capital S)
while showFlashAlers() on the login page looked for $_SESSION['success'] (lowercase s) in tools.inc

**Fix:**  
Changed all session keys to lowercase.

**Verification:**  
1. Submitted the form after the change.
2. Page redirected to login.php with success message.
(Need to change the location of the flash message to appear below the nav bar and immediately log in user upon successful registration.)

---

## Bug 7

**Date Identified:**  
20/10/2026

**Date Fixed:**  
20/10/2026

**File:**  
add.php

**Related Commit:**  
4cd495b

**Symptom:**
Unable to open add.php after successfully logging in.

**Steps to Reproduce:**  
1. Log in.
2. Click on Add Book.
3. Page stays on index.php

**Root Cause:**  
add.php missing braces.

**Fix:**  
Grouped the first three statements inside the if by adding {}

**Verification:**  
1. Log in.
2. Click on Add Book.
3. Add New Book Form displayed correctly.

---

## Bug 8

**Date Identified:**  
23/10/2026

**Date Fixed:**  
23/10/2026

**File:**  
index.php

**Related Commit:**  
4cd495b

**Symptom:**
Unable to open details.php from clicking 'View Details'

**Steps to Reproduce:**  
1. Click 'View Details' from index.php
2. 'Book not found' message displayed

**Root Cause:**  
The view details page had an incorrectly formatted query string so details.php did not receive the book ID under the expected 'id' parameter.

**Fix:**  
Removed the spaces around '=' in the details.php 

**Verification:**  
1. Clicked 'View Details' from index.php
2. Confirmed the correct book details page opened.
3. Tested a different book and confirmed its details also displayed.

---

## Bug 9

**Date Identified:**  
23/10/2026

**Date Fixed:**  
23/10/2026

**File:**  
seller.php

**Related Commit:**  
4cd495b

**Symptom:**
Deprecated: htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in C:\xampp\htdocs\wp\a3\seller.php on line 72

Deprecated: htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in C:\xampp\htdocs\wp\a3\seller.php on line 73

**Steps to Reproduce:**  
1. Open the seller page for a user whose location or bio is empty in the database.
2. Warnings displayed.

**Root Cause:**  
The user's location and bio fields can be 'NULL'. Passing 'NULL' directly to 'htmlspecialchars()' causes a deprecated warning.

**Fix:**  
Display 'Location not provided' or 'No bio provided' when the database value is empty.

**Verification:**  
1. Open a seller page with a location and bio; confirm both are displayed without warnings.
2. Open a seller page with an empty location or bio; confirm 'Location not provided' or 'No bio provided' appears without warnings.

---

## Bug 10

**Date Identified:**  
24/10/2026

**Date Fixed:**  
24/10/2026

**File:**  
index.php

**Related Commit:**  
7c28ac1

**Symptom:**
Warning: Undefined array key "username" in C:\xampp\htdocs\wp\a3\index.php on line 125

Deprecated: htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in C:\xampp\htdocs\wp\a3\index.php on line 125

**Steps to Reproduce:**  
1. Open the index page.
2. Warnings displayed in the book cards where username needs to be displayed.

**Root Cause:**  
Tries to display $row['username'] but the query at the top of index.php only selects fields from books. It never fetches a username so that array key is missing and htmlspecialchars() receives null.

**Fix:**  
Updated the query to join each book to its user.

**Verification:**  
1. Open the index.php
2. Username for the book displayed correctly without warnings.

---

## Bug 11

**Date Identified:**  
25/10/2026

**Date Fixed:**  
25/10/2026

**File:**  
edit.php

**Related Commit:**  

**Symptom:**
<br /> <b>Warning</b>: Undefined variable $description in <b>C:\xampp\htdocs\wp\a3\edit.php</b> on line <b>172</b><br /> <br /> <b>Deprecated</b>: htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated in <b>C:\xampp\htdocs\wp\a3\edit.php</b> on line <b>172</b><br />
Current image - upload a new one to replace it.

**Steps to Reproduce:**  
1. Click 'Edit' to open Edit Book page.
2. Warnings displayed under Cover Image caption.

**Root Cause:**  
- $description is no longer defined as a separate variable because the edit page now loads the book into the $book array.

**Fix:**  
- Updated the names of the variables.
- Removed required so users can save edits without selecting a new image.

**Verification:**  
1. Click 'Edit' to open Edit Book page.
2. Warnings no longer displayed under Cover Image caption.
3. All form fields filled and image loads from database.

---

## Bug 12

**Date Identified:**  
25/10/2026

**Date Fixed:**  
25/10/2026

**File:**  
edit.php

**Related Commit:**  

**Symptom:**

Warning: Undefined variable $publication_year in C:\xampp\htdocs\wp\a3\process_edit.php on line 66

Warning: Undefined variable $isbn in C:\xampp\htdocs\wp\a3\process_edit.php on line 74

Deprecated: strlen(): Passing null to parameter #1 ($string) of type string is deprecated in C:\xampp\htdocs\wp\a3\process_edit.php on line 74

Fatal error: Uncaught ArgumentCountError: The number of variables must match the number of parameters in the prepared statement in C:\xampp\htdocs\wp\a3\process_edit.php:89 Stack trace: #0 C:\xampp\htdocs\wp\a3\process_edit.php(89): mysqli_stmt_bind_param(Object(mysqli_stmt), 'ii', '15', 15) #1 {main} thrown in C:\xampp\htdocs\wp\a3\process_edit.php on line 89

**Steps to Reproduce:**  
1. Click 'Edit' to open Edit Book page.
2. Choose a new image and click save changes.
3. Warnings displayed

**Root Cause:**  
- publication_year and isbn missing from the edit.php (**CHECK IF REQUIRED**)
- Query only has one placeholder when there are two parameters causing ArgumentCountError.
- allowedConditions does not match what the edit form submits

**Fix:**  
- Updated the names of the variables.
- Updated the query to also verify ownership.
- Updated allowedConditions

**Verification:**  
1. Click 'Edit' to open Edit Book page.
2. Warnings no longer displayed under Cover Image caption.
3. All form fields filled and image loads from database.


# 🤖 Section 2: AI Usage Log

## AI Task 1

**Date:**  
17/10/2026

**Task Description:**  
What were you trying to do?
Ask AI to explain the complete session workflow.

**Tool Used:**  
GitHub Copilot

**Prompt / Input:**  
(What did you type?)
I am a beginner PHP student. I have a dynamic Bookverse webiste with pages for viewing and inserting records. I now need to add registration, login, logout and session-based access control.

Please explain the workflow:
1. Create a users table
2. Register a user with a hashed password
3. Log in using password_verify()
4. Store login state in $_SESSION
5. Show different navigation links depending on login state
6. Protect insert pages from direct access
7. Log out and destroy the session
8. Test logged-in and logged-out behaviour

Do not write the complete solution.

**AI Output Summary:**  
(What did it generate?)

Here’s the workflow to build it yourself, following the requirements in `a3/README.md`. I’ll keep this to guidance rather than writing the complete solution.

| Step | What it does | Where to work |
|---|---|---|
| 1. Create a `users` table | Store a user ID, username, email, and **password hash**. Make usernames and emails unique. Match the column names to the queries your PHP pages use. | Your BookVerse MySQL database; compare with `process_login.php`, which expects `userid`, `username`, `email`, and `password_hash`. |
| 2. Register a user | The registration form sends its fields to a processing page. Validate the inputs, check that the password confirmation matches, hash the password with PHP’s `password_hash()`, then insert the hash using a prepared statement. Never store the plain-text password. | `register.php` and `process_register.php`. |
| 3. Log in | Look up the account by username or email using a prepared statement. Use `password_verify()` to compare the submitted password with the stored hash. On success, establish the session and redirect; on failure, show a generic error. | `login.php` and `process_login.php`. |
| 4. Store login state | Start the session before sending page output. On successful login, store the user’s ID and any display information you need in `$_SESSION`. Use the same session key everywhere; regenerating the session ID after login is also a good security practice. | `includes/tools.inc` starts the session. |
| 5. Show the right navigation | Check the session to decide whether to show Login/Register or the logged-in user’s links, such as Logout. Remember: hiding a link changes the display, not the user’s actual access. | `includes/nav.inc`. |
| 6. Protect insert pages | At the top of the page, check for the agreed logged-in session key. If it is missing, redirect to login and stop processing. Protect the form page **and** its submission handler so a visitor cannot bypass the form and submit directly. | `add.php` and `process_add.php`. |
| 7. Log out | Clear the session data, expire the session cookie when applicable, destroy the session, then redirect. | `logout.php`. |
| 8. Test both states | Test registration, valid and invalid login, navigation before and after login, direct visits to insert URLs, and logout. Try the insert processing URL directly while logged out too. | Test the pages locally in your browser and confirm the database contains a hash—not the original password. |

A few things to reconcile in the current files before testing:

- **Session-key mismatch:** `process_login.php` sets `$_SESSION["userid"]`, while `add.php` and `login.php` check `$_SESSION['user_id']`. `includes/nav.inc` checks `userid`. Choose one name and use it consistently.
- **Registration behaviour:** The assessment README says to automatically log a user in after successful registration. Your `process_register.php` currently redirects to the login page instead. Also check that database insertion happens only when validation has passed.
- **Registration form labels:** `register.php` currently has a “Login” title even though it is the registration form.
- **Logout feedback:** The README calls for flash feedback after logout. Consider how you’ll show a one-time message after redirecting.
- **Evidence:** The assessment asks you to document AI assistance and your testing in `process-evidence.md`.

A useful test is to open the add page in a private/incognito window while logged out, then try both the form URL and its submission handler directly. After logging in, check that the same actions work and that logout removes access again.

**What You Accepted:**  
(Which parts did you keep?)
- All the workflow from 1 to 8.
- Session-key mismatch
- Registration behaviour
- Registration form labels
- Logout feedback

**What You Changed:**  
(What did you modify and why?)
- Added users table to both localhost and Jacob 5.
- Corrected the inconsistent session names.

**Validation Performed:**  
How did you test correctness?
- Confirmed that both tables were created succesfully without SQL errors.
- Checked that the table structure included the fields required by the registration and login code.
- Compared the databse column names with the PHP files.

**Issues Identified:**  
(Any errors or problems in AI output?)
- AI did not explicitly suggest creating users table for both localhost and Jacob 5.

---

## AI Task 2

**Date:**
17/10/2026

**Task Description:** 
Review register.php form to verify labels, field names, password inputs and POST submission.

**Tool Used:**  
GitHub Copilot

**Prompt / Input:** 
Here is my registration form. Please check whether every field has a matching label, whether the field names are suitable for PHP processing, whether password fields use type password, and whether the form submits using POST. Do not write the processing script.

**AI Output Summary:** 

All requested checks pass in `register.php`:

| Field | Matching label | PHP-friendly `name` | Type |
|---|---|---|---|
| Username | Yes (`for="username"` matches `id="username"`) | `username` | `text` |
| Email | Yes (`for="email"` matches `id="email"`) | `email` | `email` |
| Password | Yes (`for="password"` matches `id="password"`) | `password` | `password` |
| Confirm Password | Yes (`for="confirm_password"` matches `id="confirm_password"`) | `confirm_password` | `password` |

The form uses `method="post"` and submits to `process_register.php`. I did not write or modify a processing script.

**What You Accepted:**  
- Accepted Copilot's review.

**What You Changed:**
- No changes made to the form.

**Validation Performed:**  
- Verified each form field has a corresponding <label> with matching for and id attributes.
- Confirmed all name attributes are suitable for PHP form processing.

**Issues Identified:**  
- No issues identified.

---

## AI Task 3

**Date:**  
18/10/2026

**Task Description:**  
Review process_register.php

**Tool Used:**  
GitHub Copilot

**Prompt / Input:**  
Here is my registration processing code. Please check whether:
1. request method is checked;
2. missing fields are handled;
3. email is validated;
4. passwords are compared correctly;
5. password_hash() is used before database insertion;
6. a prepared statement is used;
7. duplicate username or email errors are handled safely.

Do not rewrite the whole script.

**AI Output Summary:**  

| # | Check | Result |
|---|---|---|
| 1 | Request method | **No.** There’s no check that this handler received a `POST` request. |
| 2 | Missing fields | **Not safely handled.** The code can use undefined variables if fields are absent. It collects `$errors` but never checks it, so it continues to the database insert even if validation fails. |
| 3 | Email validation | **Partially.** `FILTER_VALIDATE_EMAIL` checks a supplied email, but a missing email isn’t safely handled first. |
| 4 | Password comparison | **Partially.** The strict comparison (`!==`) is correct, but a missing password or confirmation field isn’t safely handled. |
| 5 | Password hashing | **No.** `$password_hash` is created but never used. The insert binds `$password`, which stores the password in plain text. |
| 6 | Prepared statement | **Yes, partially.** The insert uses placeholders and `mysqli_stmt_bind_param()`. However, preparation and binding aren’t safely checked before execution. |
| 7 | Duplicate username/email | **Partially.** The catch block returns a generic failure message, which avoids displaying database details. It doesn’t identify duplicates, and the database needs unique constraints on both columns to prevent them. |

**Fix these first:**

- Remove the `echo` inside the POST loop: it prints submitted values, including the passwords.
- Read and validate the expected fields safely, then stop processing when `$errors` isn’t empty.
- Bind `$password_hash` instead of `$password`, and make the SQL column name match the actual hash column in your database.
- Check that `mysqli_prepare()` succeeds before binding parameters.
- Add unique constraints for username and email if they aren’t already present.

One other detail: the `try` block currently starts **after** prepare and bind, so exceptions from those operations won’t be caught by it.

**What You Accepted:**
2. Missing fields
3. Email validation
4. Password comparison 
5. Password hashing
6. Prepared statement

**What You Changed:**  
1. Request method
7. Duplicate username/email

**Validation Performed:**  
- Checked the register.php after the new code was added to ensure the registration process still functioned correctly.
- Verified that passwords were being stored as hashed values in the database.
- Tested duplicate username and email scenarios to confirm that an alert message was displayed.

**Issues Identified:**  
- AI did not understand the function of the 'echo' inside the POST loop which is being used as a development/debugging tool.
- AI suggested modifying the database by adding unique constraints for username and email. 
Added sql query that checks for existing usernames or emails using aprepared statment before attempting the insert instead.

---

## AI Task 4

**Date:**  
18/10/2026

**Task Description:**  
Review process_login.php

**Tool Used:**
GitHub Copilot  

**Prompt / Input:**  
Here is my login processing code. Please check whether:
1. the user is retrieved using a prepared statement;
2. username or email login is handled correctly;
3. password_verify() is used correctly;
4. $_SESSION values are set only after a successful password check;
5. failed login messages do not reveal which field was wrong.

Do not rewrite the whole script.

**AI Output Summary:**  

1. **Prepared statement — Yes.** The user lookup uses a prepared query and binds the login value to both placeholders in the `username = ? OR email = ?` condition in `process_login.php`.

2. **Username or email — Yes in the handler.** The same submitted value is checked against both columns. The form label says “Username,” though, so it doesn’t tell users they can enter an email address: `login.php`.

3. **`password_verify()` — Used with the right arguments, but there are consistency concerns.** It checks the submitted password against the selected hash in `process_login.php`. However, the handler reads `password_hash`, while `process_register.php` stores the hash in the `password` column. Those column names need to match the actual database schema. Also, the POST loop trims and applies `htmlspecialchars()` to the password before verification; that can change valid passwords containing certain characters or leading/trailing whitespace.

4. **Session values — Yes.** The user session values are assigned inside the branch that runs only after a user is found and `password_verify()` succeeds: `process_login.php`. There is a separate likely bug there: the query selects `userid`, but the session assignment reads `user_id`, so the user ID may be missing.

5. **Failed-login message — Yes.** The failure path uses the same generic “Invalid username/email or password” message rather than identifying which field failed: `process_login.php`.

**What You Accepted:**
1. Prepared statement
2. Username or email
3. password_verify()
4. Session values
5. Failed-login message

**What You Changed:**  
- Removed OR email =? from the login query because the login form only accepts a username.
- Corrected password verification to use the hash stored in the password column.
- Corrected the session assignment to use user_id instead of userid.

**Validation Performed:**  
- Verified the login process after the code changes were applied.
- Confirmed that the login query now matches the intended login method (username only).
- Confirmed that password verification uses the hash stored in the password column.
- Verified that the user_id session value is populated correctly after a successful login.
- Tested successful and failed login scenarios to ensure expected behaviour.

**Issues Identified:**  
No issues identified.

---

## AI Task 5

**Date:**  
19/10/2026

**Task Description:**  
Reviewed process_register.php 

**Tool Used:**  
GitHub Copilot

**Prompt / Input:**  
Review process_register.php to check whether succesful registration redirects to the home page, creates an authenticated session so the logged-in navigation appears and displays a success message using Bootstrap's close button.
Here is an example after successful login from lab exercise:
$_SESSION["message"] = "You are now logged in.";
header("Location: index.php");
exit;
Display once in header.inc or after nav.inc:
<?php if (isset($_SESSION["message"])): ?>
  <div class="container mt-3">
    <div class="alert alert-success">
      <?php echo htmlspecialchars($_SESSION["message"]); ?>
    </div>
  </div>
  <?php unset($_SESSION["message"]); ?>
<?php endif; ?>

**AI Output Summary:**  
`process_register.php` **does redirect to `index.php` after a successful insert** and stores a lowercase `success` flash message. But it **does not log the user in**: it never sets `$_SESSION['user_id']` or `$_SESSION['username']`.

The navigation in `nav.inc` shows the logged-in section only when `$_SESSION['user_id']` is set, and displays the username from `$_SESSION['username']`. Those values are set during login in `process_login.php`, but not during registration.

**Suggested targeted changes**

1. In the successful-insert branch of `process_register.php`, set the session’s `user_id` to the new account’s ID (available from `mysqli_insert_id($conn)`) and set `username` and `email`, matching the keys used in `process_login.php`.
2. Keep the existing redirect to `index.php`. The lowercase `$_SESSION['success']` key matches the flash-message helper.
3. Add a call to `showFlashAlerts()` on `index.php` where the message should appear. It includes the helper but currently does not call it, so the success message won’t be displayed on that page.
4. Use the existing success, failure, and warning flash keys rather than introducing a separate $_SESSION["message"] key. In tools.inc, update flashAlert() so the close button is inside the alert:

(**CHECK WITH TREVOR**)
<?php
function flashAlert(string $message = '', string $type = 'info')
{
    echo '<div class="alert alert-' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8')
        . ' alert-dismissible fade show mt-2" role="alert">'
        . htmlspecialchars($message, ENT_QUOTES, 'UTF-8')
        . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
        . '</div>';
}

Then call showFlashAlerts() where you want the message to appear.

This aligns with the Assessment 3 requirement to automatically log the user in after successful registration (`README.md`). One related issue: `process_register.php` checks `$errors` before initializing and populating it; move the error check to after validation and before the insert so invalid submissions are stopped.

**What You Accepted:** 
- Suggestions 1 to 4.
- Move the error check to after validation and before the insert so invalid submissions are stopped.

**What You Changed:**  
- Updated 'process_register.php' to set the authenticated user's session values after a successful insert, store a lowercase 'success' message and redirect to 'index.php'
- Moved the validation-error check 
- Added 'showFlashAlerts()' to 'index.php' so the success message can be displayed.
- Updated flashAlert() in tool.inc

**Validation Performed:**  
- Verified the registration process after the code changes were applied.
- Confirmed that the successful registation message appears on index.php 
- Tested successful and failed registration scenarios to ensure expected behaviour.

**Issues Identified:**  
No issues identified.

---

## AI Task 6

**Date:**  
24/10/2026

**Task Description:**  
Review protected page pattern

**Tool Used:**  
GitHub Copilot

**Prompt / Input:**
Every new management page and processing script created must check login state. Please review if this requirement has been met. 

**AI Output Summary:** 
**No—not consistently.** The page guards are present, but the processing scripts don’t all enforce login themselves:

1. `add.php` and `edit.php` check for a logged-in user.
2. `process_add.php` has no login check. It also takes `user_id` from submitted form data rather than verifying it against the logged-in session.
3. `process_edit.php` has no login check either. It appears not to be the handler currently included by `edit.php`, but it is still a processing script without its own guard.

`process_login.php` and `process_register.php` are expected to allow unauthenticated requests so visitors can log in or register. The `a3 README` says to restrict access to `add.php`, but the processing endpoints should also verify the session rather than rely on the page guard.


**What You Accepted:**  
- AI correctly reminded that `process_login.php` and `process_register.php` are expected to allow unauthenticated requests so visitors can log in or register.
- edit.php needs to include login check.
- `user_id` from submitted form data rather than verifying it against the logged-in session? (**CHECK WITH TREVOR**)

**What You Changed:**  
- add.php checks for a logged-in user so initially thought that process_add.php does not need to check login again but it doesn't protect the current form submission if someone send a request to process_add.php without first loading add.php. Decided to add a check to process_add.php.
- AI suggesting to replace the foreach ($_POST as ...) loop in process_add.php with explicit assignments for the expected form fields because it creates variables from submitted field names and a crafted request containing user_id can overwrite that value. 

**Validation Performed:**  
- Checked add.php, process_add.php, edit.php and process_edit.php all includes login check and runs correctly.

**Issues Identified:**  
(Any errors or problems in AI output?)
- No issues in the output. 

---

## AI Task 7

*Date:**  
25/10/2026

**Task Description:**  
Review edit.php and process_edit.php

**Tool Used:**  
GitHub Copilot

**Prompt / Input:**

I am a beginner PHP student.
Please review my edit.php and process_edit.page.
Check whether:
1. it requires login;
2. it validates the query string ID;
3. it retrieves one record with a prepared statement;
4. it uses a hidden book_id;
5. it pre-fills text fields safely;
6. it displays the current image separately;
7. it does not pre-fill the file input.

Check:
1. session protection;
2. POST-only processing;
3. book_id validation;
4. old image retrieval;
5. distinction between no file and an upload error;
6. optional new image validation;
7. prepared UPDATE syntax;
8. old image cleanup after successful update;
9. new image cleanup if the database update fails.
Do not convert the code to PDO or object-oriented MySQLi.
Do not rewrite the whole script.

**AI Output Summary:** 

### `edit.php`

| Check | Result | Notes |
|---|---|---|
| Requires login | ✅ Pass | `edit.php:4-9` checks `$_SESSION['user_id']` and redirects unauthenticated users. |
| Validates query-string ID | ✅ Pass | `edit.php:13-19` uses `FILTER_VALIDATE_INT` and rejects values below `1`. |
| Retrieves one record with a prepared statement | ✅ Pass | `edit.php:22-41` uses a prepared `SELECT`, filtered by both `book_id` and `user_id`. |
| Uses a hidden `book_id` | ✅ Pass | `edit.php:68` includes a hidden form field containing the integer book ID. |
| Safely pre-fills text fields | ✅ Mostly pass | Title, author, price, description, and select values use `htmlspecialchars()`. For maximum clarity, specify `ENT_QUOTES` and `'UTF-8'` explicitly. |
| Displays the current image separately | ✅ Pass | `edit.php:159` displays the existing image and `edit.php:160` explains that a new upload replaces it. |
| Does not pre-fill the file input | ✅ Pass | `edit.php:156-157` has no `value` attribute on the file input. |

### `process_edit.php`

| Check | Result | Notes |
|---|---|---|
| Session protection | ✅ Pass | `process_edit.php:5-10` requires a logged-in user. |
| POST-only processing | ✅ Pass | `process_edit.php:13-17` rejects non-POST requests. |
| `book_id` validation | ✅ Pass | `process_edit.php:20-25` validates a positive integer. |
| Old image retrieval | ✅ Pass | `process_edit.php:81-103` retrieves the old image using a prepared statement and verifies ownership. |
| Distinguishes no file from an upload error | ✅ Pass | `process_edit.php:113-115` ignores `UPLOAD_ERR_NO_FILE` but processes other upload errors. |
| Optional new image validation | ⚠️ Mostly pass | `process_edit.php:116-140` checks upload status, extension, size, `is_uploaded_file()`, and `getimagesize()`. It does not explicitly compare the detected MIME type against an allowed MIME list. |
| Prepared `UPDATE` syntax | ✅ Pass | `process_edit.php:153-190` uses a prepared statement and includes `WHERE book_id=? AND user_id=?`. |
| Old image cleanup after successful update | ✅ Pass | `process_edit.php:207-222` deletes the old image only after a successful database update and only when a replacement was uploaded. |
| New image cleanup if database update fails | ✅ Pass | `process_edit.php:194-204` removes the new file when `execute()` fails. It also removes it when earlier validation fails at `process_edit.php:143-150`. |

## Issues worth correcting

### 1. POST fields are escaped before database storage

At `process_edit.php:29-32`, the script does this:

```php
$value = trim(htmlspecialchars($value));
$$name = $value;
```

This is not ideal because `htmlspecialchars()` should normally be used when outputting data into HTML, not before storing it in the database. For example, a title containing `&` could be stored as `&amp;`, and later output could become double-escaped.

A safer beginner-friendly pattern is:

```php
$value = trim($value);
```

Then keep using `htmlspecialchars()` when displaying values in `edit.php`.

### 2. The dynamic-variable loop accepts unexpected fields

The same loop creates variables from every POST key:

```php
$$name = $value;
```

This means a user can submit arbitrary field names. It is clearer and safer to read only the expected fields explicitly, such as:

```php
$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$genre = trim($_POST['genre'] ?? '');
```

This also avoids undefined-variable warnings when a required field is missing.

### 3. Missing upload data is treated like “no replacement”

The expression at `process_edit.php:113-115` treats a missing or malformed `$_FILES['image_path']` value as if no file was selected:

```php
$picture = $_FILES['image_path'] ?? null;
```

For a normal form submission, this is acceptable. However, a more precise implementation would distinguish:

- no file selected: `UPLOAD_ERR_NO_FILE`;
- malformed/missing upload information: an error;
- valid upload: validate and process it.

### 4. Add explicit MIME validation

The current validation uses the extension and `getimagesize()`, which is a good start. The A3 README also requires file-type validation. Consider adding `finfo_file()` or checking the MIME value returned by `getimagesize()` against allowed MIME types:

```php
$allowed_mime_types = [
    'image/jpeg',
    'image/png',
    'image/gif',
    'image/webp'
];
```

The extension should still be checked as well.

### 5. Check the first `SELECT` execution result

The ownership/image lookup calls `mysqli_stmt_execute()` at `process_edit.php:91`, but does not check whether execution succeeded before calling `mysqli_stmt_get_result()`.

A database failure could therefore be handled like “book not found.” It would be better to check the execution result and report a database error separately.

## Overall result

The requested structure is substantially present:

- login protection: **yes**;
- ID validation: **yes**;
- ownership protection: **yes**;
- prepared statements: **yes**;
- hidden ID: **yes**;
- safe form pre-filling: **yes, with explicit-encoding improvement recommended**;
- current image display: **yes**;
- file input not pre-filled: **yes**;
- upload replacement and cleanup logic: **yes**.

The most important improvement is to stop applying `htmlspecialchars()` before database storage and to replace the dynamic POST-variable loop with explicit field retrieval.

**What You Accepted:**  
- Results table for edit.php and process_edit.php
- Issues worth correcting 1, 3 & 5.

**What You Changed:**  
- Stopped applying htmlspecialchars() before database storage.
- Kept the dynami-variable loop 
- Adding MIME validation is not a requirement for this assignment.
- Added a check in process_edit.php whether the prepared SELECT executed sucessfully to prevent mysqli_stmt_get_result() from being called after a failed query.

**Validation Performed:**  
- Tested successful and failed edit book scenarios to ensure expected behaviour.

**Issues Identified:**  
- AI introducing new code that is not a requirement for this assignment.

---

## AI Task 8

**Date:**  
25/10/2026

**Task Description:**  
Review process_delete.php

**Tool Used:**  
GitHub Copilot

**Prompt / Input:**  

Please review my process_delete.php script.
Check:
1. session protection;
2. POST-only access;
3. book_id validation;
4. image filename retrieval before deletion;
5. prepared DELETE syntax;
6. image deletion only after the database delete succeeds;
7. redirect behaviour.
`Do not rewrite the whole script.`

**AI Output Summary:**  

## Review of `process_delete.php`

I reviewed `process_delete.php` against each requested requirement.

| Check | Result | Review |
|---|---|---|
| 1. Session protection | ✅ Pass | Lines 5–10 check `$_SESSION['user_id']`. Unauthenticated users are redirected to `login.php`. |
| 2. POST-only access | ⚠️ Partially pass | The actual deletion only occurs inside the POST block, but the script also accepts GET requests to load and display the confirmation page. |
| 3. `book_id` validation | ✅ Pass | Lines 13–25 validate either the GET or POST value using `FILTER_VALIDATE_INT` and reject IDs below `1`. |
| 4. Image filename retrieval before deletion | ✅ Pass | Lines 30–52 retrieve the book, including `image_path`, before the delete operation. The query also checks ownership. |
| 5. Prepared DELETE syntax | ✅ Pass | Lines 57–75 use a prepared statement with `WHERE book_id = ? AND user_id = ?`. |
| 6. Image deletion only after database deletion succeeds | ✅ Pass | Lines 91–101 delete the image only after the database `DELETE` succeeds and exactly one row was affected. |
| 7. Redirect behaviour | ✅ Pass | Successful deletion redirects to `index.php`. Errors redirect to an appropriate page and use session flash messages. |

## Important detail about POST-only access

The script currently supports two stages:

```php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $book_id = filter_input(INPUT_GET, 'book_id', FILTER_VALIDATE_INT);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
}
```

The GET request displays the delete confirmation form. The actual deletion is only performed here:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM books WHERE book_id = ? AND user_id = ?";
    // ...
}
```

Therefore:

- ✅ A GET request cannot delete a book.
- ✅ The database deletion is POST-only.
- ⚠️ The whole script is not technically POST-only because GET is used for the confirmation page.

This matches the current link in `details.php`, which opens the confirmation page using:

```php
<a href="process_delete.php?book_id=...">
    Delete
</a>
```

If your requirement means **“only the destructive database operation must use POST”**, the current design is correct.

If your requirement means **“process_delete.php must reject every GET request”**, then the confirmation page should be moved to a separate page, or the delete form should be placed directly on the details page. Do not simply remove GET support without changing `details.php`, because the current Delete link depends on it.

## One additional improvement

The first prepared `SELECT` does not check whether `mysqli_stmt_execute()` succeeds:

```php
mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
```

It should be changed to:

```php
mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);

if (!mysqli_stmt_execute($stmt)) {
    error_log(mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    $_SESSION['failure'] = 'Book details could not be loaded.';
    header('Location: books.php');
    exit;
}

$result = mysqli_stmt_get_result($stmt);
```

This prevents the script from treating a database execution failure as if the book simply did not exist.

## Final assessment

The deletion logic is correctly protected:

- owner-only access is enforced server-side;
- the ID is validated;
- the image filename is retrieved before deletion;
- the `DELETE` query is prepared;
- the image is removed only after a successful database deletion;
- success and failure redirects are present.

The only requested item that needs clarification is **POST-only access**: the destructive deletion is POST-only, but GET is intentionally supported for the confirmation screen.

**What You Accepted:**  
- Result table 1- 7 except for 2: POST-only access | ⚠️ Partially pass 

**What You Changed:**  
- The exisint script already allows GET for the confirmation page and restricts the 'DELETE' query to POST requests.

**Validation Performed:**  
- Tested successful and failed deletion scenarios that the database record and image were removed.
- Tested an invalid book ID and confirmed that the deletion was refused.

**Issues Identified:**  
- AI described the script as only partially passing POST-only acccess.
Clarified the lab instructions which noted that GET is allowed for the confirmation page so this requirment should be recorded as passed.

---


# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
