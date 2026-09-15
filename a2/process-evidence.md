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

**Task Description:**  

**Tool Used:**  

**Prompt / Input:**  

**AI Output Summary:**  

**What You Accepted:**  

**What You Changed:**  

**Validation Performed:**  

**Issues Identified:**  

---

# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
