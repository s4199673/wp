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
1/08/2026

**Date Fixed:**  
1/08/2026

**File:**  
index.html

**Related Commit:**  
(e.g., abc1234)

**Symptom:**  
Goggle Icons were not appearing in the navigation bar.

**Steps to Reproduce:**  
1. Add the following stylesheet link to the <head> section of index.html:
 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
2. Open index.html in a browser.
3. Observe that the icons do not display correctly in the navigation bar.

**Root Cause:**  
The Material Icons stylesheet link contained an incorrect URL, preventing the icon font from loading.

**Fix:**  
Updated the stylesheet URL to "https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"

**Verification:**  
- Refreshed the page in the browser after updating the link.
- Confirmed that the Google Icons were displayed correctly in the navigation bar.

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

## Bug 3

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
01/08/2026

**Task Description:**  
Troubleshoot navigation bar alignment issue.

**Tool Used:**  
Copilot

**Prompt / Input:**  
Review my Bootstrap navigation bar. The navigation links appear on the far right side of the page instead of appearing next to BookVerse on the left. Check whether the Bootstrap classes, layout, and CSS are causing this behaviour. Explain the likely cause and  suggest fixes.

**AI Output Summary:**  
The key issue is:
The navbar uses Bootstrap’s navbar + container-fluid layout.
In Bootstrap, the container-fluid inside a navbar is a flex container.
That flex container is arranged with justify-content: space-between by default, so:
the navbar-brand sits on the left
the navbar-nav list sits on the far right
So the links being pushed all the way to the right is very likely a Bootstrap layout behavior, not a custom CSS override.

Your markup is:
brand on the left
ul.navbar-nav as a sibling element
no me-auto / ms-auto utility on the list
no navbar-collapse wrapper
That means Bootstrap is treating the brand and the nav list as two separate flex items and spacing them apart.

Option 1: Add margin-auto to the nav list
This is the simplest and most Bootstrap-friendly fix:

The me-auto utility pushes the nav group toward the left side of the available space, so it appears next to BookVerse.

Option 2: Use the standard Bootstrap navbar structure
A more complete version would be:

This is the standard Bootstrap pattern and is easier to keep responsive.

Option 3: If you want the links immediately beside the brand
You can also remove the default spacing behavior with a small custom CSS rule, but that is usually less clean than using Bootstrap utilities.

**What You Accepted:**  
I accepted the recommendation to use Bootstrap's 'me-auto' utility class on the 'ul.navbar-nav' element. This aligned the navigation links beside the BookVerse brand rather than on the far right side of the navigation bar.

**What You Changed:**  
I used Option 1 ('me-auto') because it was a simple Bootstrap-based solution that matched the required design. I did not implement 'navbar-collapse' structure suggested by AI.

**Validation Performed:**  
- Examined the navbar structure in 'index.html'.
- Confirmed that 'style.css' contained no custom CSS affecting navbar alignment.
- Added the 'me-auto' class to the navigation list.
- Tested the page in the browser.
- Verified that the navigation links displayed beside the BookVerse brand.

**Issues Identified:**  
Bootstrap's default flexbox navbar behaviour was causing the navigation links to be positioned on the far right. The issue was not caused by custom CSS. Applying the 'me-auto' utility class corrected the alignment.

---

## AI Task 2

**Date:**  
01/08/2026

**Task Description:**  


**Tool Used:**  
Copilot

**Prompt / Input:**  
Here is my Bootstrap 5 carousel code. Please check whether the carousel indicators, image paths, alt text, active slide, controls, and Bootstrap attributes are correct. Do not rewrite the full page.

**AI Output Summary:**  
✅ What is correct
The outer carousel container uses the right Bootstrap class: class="carousel slide".
The Bootstrap attributes are valid:
data-bs-ride="carousel"
data-bs-target="#bookCarousel"
data-bs-slide-to="0/1/2/3"
data-bs-slide="prev" and data-bs-slide="next"
The control buttons are in the right place for a Bootstrap carousel.
The indicator buttons are correctly linked to the carousel.

⚠️ What is wrong
The .carousel-inner wrapper is nested incorrectly

You have four separate div class="carousel-inner" blocks.
In Bootstrap, there should be only one .carousel-inner, and all .carousel-item slides should be placed inside it.
The active class is repeated on every slide

Only the first slide should have active.
In your code, every slide currently has class="carousel-item active".
The image paths should be normalized

images\covers\1.png uses backslashes.
Bootstrap pages usually work better with forward slashes: images/covers/1.png.
One alt text has a typo

Moonlit circular libray should be library.
Minimal correction summary
The correct pattern is:

One div with class="carousel-inner"
Inside it:
first slide: class="carousel-item active"
other slides: class="carousel-item"
So the main problem is not the indicators or the nav controls — it is the repeated nested .carousel-inner and repeated .active classes.

**What You Accepted:**  
- Moved all carousel slides into a single '.carousel-inner' container.
- Removed unnecessary 'active' classes so that only the first slide remained active.
- Updated image paths to use forward slashes.
- Corrected the spelling mistake.

**What You Changed:**  
- I did not need to modify the AI's recommendations. Implemented all four suggested fixes.

**Validation Performed:**  
- Loaded the page in a browser and confirmed the carousel displayed correctly.
- Tested the previous and next navigation controls.
- Verified that the carousel indicators selected the correct slide.

**Issues Identified:**  
- Multiple '.carousel-inner' containers were incorrectly used.
- The 'active' class was applied to every slide.
- Image paths used Windows-style backslashes.
- An accessibility issue existed due to a spelling error in one 'alt' attribute.

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
