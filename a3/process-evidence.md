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

**Validation Performed:**  
How did you test correctness?

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

# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
