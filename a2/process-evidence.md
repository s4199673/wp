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
(e.g., abc1234)

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
(e.g., 15/03/2026)

**Task Description:**  
What were you trying to do?

**Tool Used:**  
(e.g., GitHub Copilot, ChatGPT)

**Prompt / Input:**  
(What did you type?)

**AI Output Summary:**  
(What did it generate?)

**What You Accepted:**  
(Which parts did you keep?)

**What You Changed:**  
(What did you modify and why?)

**Validation Performed:**  
How did you test correctness?

**Issues Identified:**  
(Any errors or problems in AI output?)

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
