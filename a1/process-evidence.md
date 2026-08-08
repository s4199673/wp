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


**Symptom:**  
Carousel stopped working.

**Steps to Reproduce:**  
1. Open `index.html` in a browser.
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



# 📌 Final Reflection (End of Assessment)

**What AI was most useful for:**  

**Where AI was incorrect or misleading:**  

**What you learned about debugging:**  

**How your approach changed over time:**  
