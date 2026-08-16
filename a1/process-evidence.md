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
ce767ff

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
7/08/2026

**Date Fixed:**  
7/08/2026

**File:**  
index.html

**Related Commit:**  
57ce722

**Symptom:**  
Carousel stopped working.

**Steps to Reproduce:**  
1. Open home page in a browser.
2. Observe that the carousel images do not slide.
3. Click the Previous and Next controls.
4. The carousel controls and automatic slide functionality do not work.

**Root Cause:** 
Accidentally added a </div> immediately after the carousel indicators, which closed the <div id="bookCarousel" class="carousel slide"> container too early. This caused the .carousel-inner and carousel controls to be placed outside the carousel component, preventing the carousel to work.

**Fix:**  
Removed the incorrect </div> after the carousel indicators were correctly nested inside the carousel container.

**Verification:**  
- Reloaded the page in the browser.
- Confirmed that the carousel automatically cycled through the slides.
- Tested the Previous and Next controls.
- Verified that all four images displayed correctly.
---

## Bug 3

**Date Identified:**  
15/08/2026

**Date Fixed:**  
15/08/2026

**File:** 
gallery.html

**Related Commit:**  
1f41d43

**Symptom:** 
HTML validation reported multiple errors, including duplicate ID values for imageModalLabel and unclosed div elements in the gallery page.

**Steps to Reproduce:**   
1. Upload gallery.html to the W3C HTML Validator.
2. Run validation on the page.
3. Observe validation errors reporting duplicate IDs and incorrectly nested or unclosed elements.

**Root Cause:**  
The gallery page originally contained multiple Bootstrap modals that reused the same id="imageModalLabel" value. During development, some modal-related elements were also not properly closed, resulting in invalid HTML structure.

**Fix:**  
Updated the gallery implementation to use a single reusable Bootstrap modal instead of multiple individual modals. Removed duplicate imageModalLabel, IDs and corrected the HTML structure by ensuring all div elements were properly nested and closed.

**Verification:**  
- Re-ran the page through the W3C HTML Validator.
- Confirmed that duplicate ID errors were resolved.
- Confirmed that all unclosed element errors were removed.

---

## Bug 4

**Date Identified:**  
16/8/2026

**Date Fixed:**  
16/8/2026

**File:**  
scripts.js

**Related Commit:**  

**Symptom:**  
Javascript for gallery modal was not working.
Console error displayed: Cannot read properties of null (reading 'addEventListener')

**Steps to Reproduce:**  
1. Open Console from the website in a browser.
2. Observe the error message indicating that addEventListener() was being called on a null value.

**Root Cause:**  
The scripts.js file was shared across multiple pages, but the statusFilter element only existed on books.html. The script attempted to run: statusFilter.addEventListener(...) even when statusFilter does not exist on other pages, causing the error.

**Fix:**  
Added a conditional check using: if (statusFilter) before the event listener.
This ensured that the books filter code only ran on pages where the statusFilter element existed, preventing JavaScript errors on pages that did not contain the filter.

**Verification:**  
- Refreshed all pages and checked the browser console using Developer Tools (F12). 
- Confirmed that the error no longer appeared. 
- Tested that the book status filter still worked correctly. 
- Opened Book cover gallery page to confirm that the javascript for gallery modal executed.

---

## Bug 5

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
Copilot (VS Code Chat)

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
Reviewed the homepage Bootstrap carousel to verify that the structure, controls, indicators, image paths, alt text, and Bootstrap attributes were correctly implemented.

**Tool Used:**  
Copilot (VS Code Chat)

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

## AI Task 3

**Date:**  
2/8/2026

**Task Description:**  
Improving grid layout 

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
Review my Bootstrap grid layout. The cards are displaying correctly but are too large. I want to reduce the width and height of the cards while keeping the same proportions and responsive behaviour. Explain which Bootstrap classes or CSS properties I should adjust and why. Do not rewrite the full code.

**AI Output Summary:** 
What is controlling the card size
In index.html:144-243, each card is wrapped in a Bootstrap column like:

col-12
col-sm-6
col-lg-4
col-xl-3
Those col-* classes control how wide each card column is at each breakpoint, so they are the main reason the cards stay responsive. The layout is already balanced, but the card itself is still large because Bootstrap’s default card styling and the image/body spacing are being used as-is.

What to adjust
1. Keep the responsive grid, but reduce visual bulk
Use the existing col-* classes to maintain the same responsive behavior. If you want the cards to appear narrower without breaking the layout, the safest tweak is to reduce the card’s own width with CSS rather than changing the breakpoint structure.

For example, these are the right CSS properties to target:

.book-card
max-width
margin: 0 auto
.card-body
padding
.card-img-top
height
object-fit

2. Reduce height by controlling the image and card body
The biggest height impact comes from:

the image at .card-img-top
the inner spacing of .card-body
If the card feels too tall, reduce:

padding on .card-body
height on .card-img-top
use object-fit: cover so the image keeps its proportion without stretching
That preserves the same card ratio while making the overall block smaller.

3. Reduce spacing between cards if they feel oversized
The g-3 on the row adds a gutter between cards. If the cards look too large because the spacing is too wide, shrink that to g-2 or lower the gap via CSS.

Why this works
col-* controls the width of the layout column, so it keeps the grid responsive.
card-body and card-img-top control the internal box size, so they are the best place to make the card itself smaller.
g-3 affects the gap between columns, so it changes visual density without altering the responsive rules. 

**What You Accepted:** 
- Accepted the recommendation to keep the existing Bootstrap column classes.
- Accepted the recommendation to control card sizing using .book-card 

**What You Changed:**  
- Tested '.card-body' padding and '.card-img-top' sizing but found that these changes did not sufficiently reduce the overall visual size of the cards.
- Used the following solution from CSS Basics notes

.book-card img {
    width: 100%;
    height: 12rem;
    object-fit: cover;
}

**Validation Performed:**  
- Compared the appearance of the cards before and after implementing the CSS changes.
- Checked that all card images displayed consistently without distortion.
- Confirmed that the Boostrap grid remained responsive and that card alignment was unaffected by the changes.

**Issues Identified:**  
- The defualt image dimensions made the cards appear visaully larger than intended.
- Reducing image height had the greatest effect on creating a more compact card layout.

---

## AI Task 4

**Date:**  
4/8/2026

**Task Description:**  
Improving homepage header and footer styling to better match the reference screenshot using the existing colour palette defined in 'style.css'.

**Tool Used:**  
Copilot

**Prompt / Input:**  
Compare my current header and footer styling with the attached screeshot. Suggest how I can use the colours already defined in 'style.css' to achieve a similar visual appearance. Do not generate a complete solution. Explain which CSS properties should be changed and why those changes are appropriate.

**AI Output Summary:** 
The screenshot show a teal-themed header and footer with amber accents, whereas your CSS is currently using:

background-color: var(--text-dark)
which is:
#1f2937

This produces a charcoal-grey appearance rather than the teal appearance shown in the screenshot.

Header (nav)
Current
nav {
    background-color: var(--text-dark);
}

Suggested adjustment
Use one of the primary teal colours instead:

background-color: var(--primary-dark);

Why
The screenshot navbar appears much closer to:
#0f766e
than to:
#1f2937


Possible improvement
You may need an explicit colour:
color: var(--background-white);

Why
The screenshot uses highly visible white branding against the darker teal background.

Navigation Links
I don't see a .nav-link rule in your CSS.

Consider
.nav-link {
    color: var(--background-white);
}

and

.nav-link:hover {
    color: var(--accent-amber);
}

Why
The screenshot show light navigation text with warm accent colouring.

Teal Accent Line Under Navigation
The screenshot contain a strong cyan/teal line directly beneath the navbar.

Consider

Adding a border:

border-bottom: 4px solid var(--primary-light);

Why
--primary-light
#14b8a6


is very close to the bright teal accent visible beneath the navigation bar.

Footer
Current
footer {
    background-color: var(--text-dark);
}

Suggested adjustment

Try:

footer {
    background-color: var(--primary-dark);
}

or

footer {
    background: linear-gradient(
        to right,
        var(--primary-dark),
        var(--primary-color)
    );
}

Why
The screenshot show a footer that feels teal rather than neutral dark grey.

Amber Separator Line

The screenshot have a thin amber line directly above the footer.

Consider
footer {
    border-top: 2px solid var(--accent-amber);
}

Why
Using:
--accent-amber: #fbbf24;
matches the thin gold line visible in the reference images.

Footer Text
Current
color: var(--background-white);

✅ Keep this.

The screenshot show white footer text which contrasts well with the darker teal background.

Overall Recommendation

If I were prioritising changes to better match the screenshot, I'd make them in this order:

Change navbar background from --text-dark to --primary-dark.
Change footer background from --text-dark to --primary-dark.
Add a teal border under the navbar using --primary-light.
Add an amber border above the footer using --accent-amber.
Ensure navbar links and branding use --background-white.
Use --accent-amber for hover states instead of introducing new colours.

These changes would move your design much closer to the screenshot while still using only the colours defined in your :root variables.

**What You Accepted:** 
- Adding .nav-link 
- Adding .nav-link:hover
- Adding border-bottom to the header
- Adding background: linear-gradient to the footer
- Adding border-top to the footer

**What You Changed:**  
- AI suggested using #14b8a6 for the border-bottom but used linear-gradient instead to achieve the gradient separator line.
- AI suggested using --primary-dark and --primary-color for the footer gradient but used var(--text-dark) 0%, var(--accent-slate) 50%, var(--primary-dark) 100% to acheive similar visual appearance.
- Used linear-gradient for the border-top

**Validation Performed:** 
- Compared the updated header and footer against the reference homepage screenshot.
- Tested the appearance in the browser after each CSS change rather than applying all changes at once.
- Checked that the gradient separator lines rendered correctly across the full width of the page.
- Tested the layout at desktop and mobile widths using browser developer tools to ensure responsiveness was not affected.

**Issues Identified:**  
- Replacing #1f2937 to #0f766e but did not produce a close visual match to the screenshot.
- A single solid-colour border did not recreate the gradient effect.
- Additional experimentation with gradients and existing colour variables was required to achieve a similar appearance.

---

## AI Task 5

**Date:**  
7/8/2026

**Task Description:**  
Adding gradient overlay to the carousel images

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:** 
Review my Bootstrap carousel and custom CSS. I would like to add a gradient overlay at the bottom of the carousel images. Do not write the full code. Explain which CSS properties should be added or modified. 

**AI Output Summary:** 
Suggested CSS changes
Your carousel is already close to what you need. The cleanest approach is to add a soft dark gradient behind the caption in style.css.

Add or adjust:

.carousel-item { position: relative; overflow: hidden; }
.carousel-item::after (or a similar overlay layer) with:
content: ""
position: absolute
inset: 0
background: linear-gradient(...)
z-index: 1
pointer-events: none
Keep the image visible by making sure it remains behind the overlay:

.carousel-item img { position: relative; z-index: 0; }
Modify the caption styling so it sits above the overlay:

.carousel-caption { position: absolute; bottom: 0; left: 0; right: 0; z-index: 2; padding: ...; }
You can also replace the current bottom: -10px; with bottom: 0; and add a little bottom padding for spacing.
Optional readability improvement:

Add text-shadow to the caption text, or slightly increase the caption’s padding and font weight.
This gives you a subtle bottom fade without making the image look too dark.

**What You Accepted:** 
- .carousel-item { position: relative; overflow: hidden; }
- .carousel-item::after (or a similar overlay layer) with:
content: ""
position: absolute
background: linear-gradient(...)
pointer-events: none

**What You Changed:**  
- Instead of applying the gradient across the entire carousel image using 'inset: 0', I limited the overlay to the bottom portion of the image by setting 'height: 20px' and positioning it at the bottom of the carousel item.
- Used 'var(--text-dark)' in the gradient to match the existing colour scheme.
- Increased the carousel image height from 200px to 260px to better match the proportions shown in the reference screenshot.
- Customised the carousel control icons using var(--primary-color) and a circular background.
- Did not implement the suggested z-index values because the caption already appeared above the gradient overlay without additional stacking rules.

**Validation Performed:** 
- Reloaded the homepage and visually compared the carousel against the reference screenshot.
- Confirmed that the gradient overlay appeared only at the bottom of the image.
- Tested the Previous and Next controls to ensure the overlay did not interfere with carousel functionality.
- Checked that the carousel remained responsive at desktop and mobile screen sizes.

**Issues Identified:** 
- Applying inset: 0; caused the gradient across the entire image, making the carousel appear too dark.

---

## AI Task 6

**Date:**  
08/08/2026

**Task Description:**  
Alternative method for matching the colour of the modal footer to the reference screenshot. Previous attempts using color-mix() did not produce a close visual match.

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
I am trying to match the background colour of the modal footer to the screenshot. I have already tried using color-mix() with my existing colour variables, but the result does not visually match the screenshot. Can you suggest another CSS approach that preserves my existing theme colours while darkening and slightly adjusting the tone? Do not rewrite the full code.

**AI Output Summary:**  
I will suggest a focused CSS approach that fits your existing theme without rewriting the full code.

A good alternative is to use a layered background rather than a mathematical blend.

- Keep your existing footer color as the base.
- Add a subtle overlay behind it using a pseudo-element with a small darkening and tone shift.
- This preserves the original theme color while making it look a bit deeper and more visually matched to the screenshot.

A simple pattern is:

```css
.modal-footer {
  position: relative;
  background-color: var(--your-existing-color);
  overflow: hidden;
}

.modal-footer::before {
  content: "";
  position: absolute;
  inset: 0;
  background: inherit;
  filter: brightness(0.85) saturate(1.05) hue-rotate(-4deg);
  z-index: -1;
}
```

If you want it even subtler, reduce the filter strength slightly. This usually gives a more natural result than 'color-mix()' because it keeps the same base hue and just adjusts the rendered appearance.

**What You Accepted:**  
- Implemented the suggestions using pseudo-elemnt and filter.

**What You Changed:**  
- Experimented with different brightness, saturation, and hue adjustments to better match the screenshot.
- Added/removed z-index to modal elements to ensure the filtered background remained behind the previous and next buttons.
- Removed overflow: hidden; after testing, as it did not make a difference.
**Validation Performed:**  
- Compared the modal footer against the reference screenshot before and after the changes.
- Tested different filter values to determine which combination produced the closest visual match.
- Checked that the filtered background remained behind the the previous and next buttons.
- Verified that the modal footer displayed correctly across all pages.

**Issues Identified:**  
- A gap was appearing between the body and footer. Used border: none to remove this gap.

---

## AI Task 7

**Date:**  
10/08/2026

**Task Description:**  
Reviewed the books page Bootstrap form and filter to verify that the structure, controls, indicators, image paths, alt text, and Bootstrap attributes were correctly implemented.

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
Here is my Bootstrap 5 filter panel and book table code. Please check whether the filter controls, table structure, Bootstrap classes, labels, responsiveness, and status filtering setup are correct. Identify any issues or improvements, but do not rewrite the full page.

**AI Output Summary:**  

What is not correct

1. The filter control markup is invalid
- The label is currently placed inside the select element, which is not valid HTML.
- A `<label>` should be separate from the `<select>` and linked with `for` and `id`.

2. The table structure is broken
- The last status cells in each row are missing a proper closing `</td>`.
- This makes the table structure invalid and can cause rendering problems.

3. The Bootstrap form styling is only partly correct
- `form-select` and `form-select-sm` are appropriate for the dropdown.
- However, the label should use `form-label` for a more proper Bootstrap-style form control.
- A wrapper such as a `div` with spacing classes would make the layout cleaner.

4. Responsiveness is mostly fine
- The `table-responsive` wrapper is the right Bootstrap approach.
- That part is good and should stay.
- The filter area could be improved visually with Bootstrap spacing and alignment classes.

5. The status filter is not truly set up yet
- The dropdown is present, but it is not connected to the table rows.
- If this is meant to be a working filter, you need JavaScript to show/hide rows based on the selected status.
- The rows also need actual status values such as Available, Reserved, or Sold so the filter can compare against them.

What is already okay

- The overall table layout is clear.
- The header row and body rows are in the right general structure.
- The responsive table wrapper is appropriate.

These are mostly small fixes, and you do not need to rewrite the whole page.

**What You Accepted:**  
- Moved the label outside the select element and linked it correctly using 'for' and 'id'.
- Completed adding the status column and closing </td> tags.
- Planned to connect the filter dropdown to JavaScript-based status filtering.

**What You Changed:**  
- Added status within <span></span> to apply styling.
- Did not implement form-label class because the current structure was already functional without it.

**Validation Performed:**  
- Checked the updated HTML structure in the browser.
- Confirmed that all status values displayed correctly within the table.

**Issues Identified:**  
- Nil

---

## AI Task 8

**Date:**  
11/8/2026

**Task Description:**  
Sought advice on why the table wrapper's 'border-radius' was only appearing at the top corners and not at the bottom. 

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
Review my Bootstrap 5 book table code and check why the following CSS only creates rounded corners at the top of the table and not at the bottom: 

.books-table-wrapper {
border-radius: 0.5rem;
} 

Check whether the issue is related to the table element, Bootstrap classes, borders, or overflow settings. Suggest possible fixes and explain the cause. Do not rewrite the whole code.

**AI Output Summary:**  

Cause of the issue

The problem is mostly not with your Bootstrap table structure itself, but with how the rounded corners are being applied.

In books.html, the table sits inside a wrapper with the class `.books-table-wrapper`, and in style.css you only gave that wrapper a `border-radius`. That alone is often not enough because:

- the table content is still drawn as a rectangular box inside the wrapper;
- the wrapper does not clip its child content by default;
- Bootstrap’s `.table` styling also keeps the table layout as a normal rectangular grid, so the corners do not automatically round.

Why it looks rounded only at the top

Rounded corners on a parent element only show properly when the child content is clipped to that shape. Without `overflow: hidden`, the table can still paint over the edges, so the bottom corners appear square or uneven.

Likely fixes

1. Add clipping to the wrapper:
```css
.books-table-wrapper {
    border-radius: 0.5rem;
    overflow: hidden;
}
```

2. If you are using visible borders, make the table render more cleanly with:
```css
.books-table {
    border-collapse: separate;
    border-spacing: 0;
}
```

3. If the bottom corners still do not look right, apply the radius to the table or its last row/cells as well, since the table itself is still rectangular.

4. Try adding a small background color to the wrapper so the rounded shape is easier to see.

In short

- The issue is mainly related to the wrapper’s clipping behavior, not the Bootstrap class by itself.
- `border-radius` alone does not round the visible table edges unless the wrapper clips overflow and the table is styled to work with it.

**What You Accepted:**  
- Adding overlow: hidden and .books-table styling.

**What You Changed:**  
- Added margin-bottom: 0; to remove the bottom of table which had extra lines.
- Did not have to apply the radius to the last row/cells.

**Validation Performed:**  
- Compared the table appearance before and after adding overflow: hidden, border-collapse: separate and border-spacing: 0.
- Verified that the bottom corners displayed correctly after the change.

**Issues Identified:**  
- Adding background colour did not make a difference.

---

## AI Task 9

**Date:**  
18/8/2026

**Task Description:**  
JavaScript book status filter review

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
Here is my JavaScript book filter. Please check whether it correctly uses data-status, dataset.status, querySelectorAll, forEach, and the change event. Do not modify the HTML structure.

**AI Output Summary:**  
Review
I checked books.html and scripts.js. Your current script has a few issues:

- querySelectorAll(".value") is valid, but it selects the table header row too, because the <thead> row also has the value class. That means the filter could hide the header as well as the book rows.
- books.forEach(function (books) { ... }) uses the same name for the NodeList and the loop variable, so book is never defined. It should be function (book).
- const bookStatus = book.dataset.status; is the correct way to read the data-status attribute, but your HTML uses lowercase values like available while your select options use capitalized values like Available. That mismatch prevents the filter from matching.
- The change event listener is correctly attached to statusFilter, so that part is fine.
- For table rows, display = "block" is not ideal; table-row is the correct default display for a <tr>.

Summary
- data-status is used correctly via dataset.status
- querySelectorAll is used correctly, but should target tbody tr.value
- forEach is used correctly with the loop variable named book
- The change event is correct
- The main bug is the mismatch between Available and available, plus the wrong loop variable and the extra header row selection

**What You Accepted:**  
- Correcting the status value mismatch between the dropdown options and the data-status values.
- Reviewing the row selector to ensure only book rows were targeted by the filter.
- Verifying that the change event listener was implemented correctly.

**What You Changed:**  
- Updated the status value mismatch between the dropdown options and the data-status values.


**Validation Performed:**  
- Tested each filter option in the browser.
- Confirmed that Available, Reserved, Sold, and Show All returned the expected rows.

**Issues Identified:**  
- No significant errors were found in the AI recommendations.

---

## AI Task 10

**Date:**  
15/08/2026

**Task Description:**  
Investigated why the linear-gradient strip below the navigation bar and above the footer stopped displaying after recent CSS changes to match Tanya's instructions on using @media (prefers-color-scheme:dark)

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
Inspect the relevant CSS and HTML around the header/footer to suggest why the gradient strip stopped rendering.

**AI Output Summary:**  
Likely reason
I did not change the code, and the problem is most likely the way the accent strip is being drawn, not the layout itself.

The header/footer strip is being created with a border-image rule:

- border-bottom: 4px solid transparent
- border-image: linear-gradient(...)

That pattern is fragile because border-image does not behave like a normal border. It needs the image to be sliced and sized correctly, and a gradient source by itself often renders inconsistently unless the border image is defined more explicitly.

In plain terms:

- the border is set to transparent, so there is no visible solid line
- the gradient is being used as a border image, not as a normal colored bar
- browsers sometimes treat that as “no visible border” if the slice/width is not set up properly

That is why the thin line can vanish even though the gradient values are still in the CSS.

Most reliable alternative
The dependable approach is:

- add a small pseudo-element to the nav/footer
- give it height: 4px
- apply a linear-gradient background to it
- position it at the bottom of the nav or top of the footer

This works consistently and does not depend on browser border-image behaviour.

**What You Accepted:**  
- Adding the gradient strip using a pseudo-element.

**What You Changed:**  
- Removed the border-bottom and border-image styling that was previously used to create the strip.
- Updated both the navigation and footer styling to use the new method consistently.

**Validation Performed:**  
- Compared the appearance of the strip before and after the change.
- Verified that the gradient strip displayed correctly below the navigation bar and above the footer.

**Issues Identified:** 
- The original border-image approach was less reliable and produced inconsistent rendering.
- The AI suggested adding a fixed height to the pseudo-element, but the original implementation already used a 4px height for the linear-gradient strip.

---

## AI Task 11

**Date:**  
16/8/2026

**Task Description:**  
Planning JavaScript for Boostrap modal gallery. 

**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  
I am a beginner web programming student learning JavaScript basics. Client-Side JavaScript requirement for gallery.html is Bootstrap modal functionality for full-size image previews on gallery.html (no inline JS—use `assets/js/scripts.js`). The next and previous buttons of the modal need to load full-size image in the gallery and the title.

Please give me a step-by-step plan for completing javascript. Do not write the full code for me.

**AI Output Summary:**  

## Step-by-Step Plan for Gallery Modal Navigation

### **Step 1: Create Data Structure**
- Use `document.querySelectorAll()` to select all gallery image buttons (hint: use a class selector like `.gallery-image-button`)
- Store this collection in a variable so you can access the image data throughout your script

### **Step 2: Track Current Image Index**
- Create a variable to store the currently displayed image's index
- This will help you know which image to show when users click Previous/Next
- Initialize it as `0` (first image) or update it when the modal opens

### **Step 3: Listen for Modal Open Event**
- Use the `show.bs.modal` Bootstrap event listener on the `#imageModal` element
- This event fires when the modal is about to open (before it becomes visible)
- Inside this listener, determine which image button was clicked and store its index

### **Step 4: Create a Function to Update Modal Content**
- Write a function (e.g., `displayImage(index)`) that:
  - Gets the image button at the given index
  - Extracts the `data-image` and `data-title` attributes from that button
  - Updates the modal's `#modalImage` src attribute
  - Updates the modal's `#imageModalLabel` text with the title

### **Step 5: Handle Previous Button Click**
- Add an event listener to the `.previous-button` element
- Decrease the current index by 1
- Handle edge case: if you're at the first image (index 0), wrap around to the last image (use modulo `%` operator)
- Call your update function to display the previous image

### **Step 6: Handle Next Button Click**
- Add an event listener to the `.next-button` element
- Increase the current index by 1
- Handle edge case: if you're at the last image, wrap around to the first image (use modulo operator)
- Call your update function to display the next image

### **Step 7: Test Navigation**
- Click a gallery thumbnail to open the modal
- Verify the image and title load correctly
- Test Previous/Next buttons
- Test wrapping (Previous from first image, Next from last image)

---

**Key Hints for Implementation:**
- Store image count in a variable: `const totalImages = galleryButtons.length`
- Use modulo arithmetic to handle wrapping: `(index + 1) % totalImages` for next
- The event target when clicking a gallery button is available in the modal event object via `e.relatedTarget`
- Keep your code organized with clear variable names and comments


**What You Accepted:**  
- Using querySelectorAll() to select gallery image buttons.
- Creating a variable to track the currently displayed image.
- Adding a tracking variable to store the index of the currectnly displayed gallery image.

**What You Changed:**  
- Did not use show.bs.modal or e.relatedTarget
- Used click event listeners on the gallery image buttons.
- Used showImage() to update the modal image, title, and alt text.
- Rather than using the modulo operator for navigation, used if statements because I found them easier to understand.

**Validation Performed:**  
- Opened the gallery page and clicked thumbnails to verify that the correct image and title appeared in the modal.
- Tested the previous and next buttons and confirmed it displayed the previous gallery image.
- Confirmed that the modal image and title updated correctly.

**Issues Identified:** 
- AI suggested using the show.bs.modal and e.relatedTarget to determine the selected gallery image.
- Using click event listeners and passing the image index directly to the showImage() function was simpler to understand as a beginner.

---

## AI Task 10

**Date:**  


**Task Description:**  


**Tool Used:**  
Copilot (VS Code Chat)

**Prompt / Input:**  

**AI Output Summary:**  

**What You Accepted:**  


**What You Changed:**  

**Validation Performed:**  


**Issues Identified:** 


# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
