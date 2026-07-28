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
(e.g., 15/03/2026)

**Date Fixed:**  
(e.g., 15/03/2026)

**File:**  
(e.g., about.html)

**Related Commit:**  
(e.g., abc1234)

**Symptom:**  
What went wrong?

**Steps to Reproduce:**  
How can the issue be triggered?

**Root Cause:**  
Why did the issue occur?

**Fix:**  
What did you change?

**Verification:**  
How did you confirm the fix?

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
21/07/2026 - Week 2

**Task Description:**  
Upgrade week 1 pages to implement Bootstrap

**Tool Used:**  
GitHub Copilot, ChatGPT

**Prompt / Input:**  
I have a basic multi-page HTML website from Week 1. I need to upgrade it using Bootstrap. The site should have a consistent banner, Bootstrap navigation, a search field in the navbar, a Bootstrap-styled footer, a responsive home page layout, a responsive gallery page, and a Bootstrap-styled contact form.

Please give me a step-by-step plan, but do not write the full code yet.


**AI Output Summary:**  
Here’s a clear, step-by-step plan to upgrade your basic multi-page Week‑1 site to Bootstrap. It’s broken into small, testable tasks you can implement one at a time. No full code yet — just the roadmap and what to change in each file.

Summary of goals
- Add Bootstrap (CSS + JS)
- Create a consistent banner/header and footer across pages
- Replace site navigation with a responsive Bootstrap navbar that includes a search field
- Build a responsive home layout (hero + card/grid content)
- Build a responsive gallery page (grid + optional modal/lightbox)
- Build a Bootstrap-styled contact page with client-side validation
- Keep everything accessible and mobile-friendly

Recommended defaults
- Bootstrap version: Bootstrap 5 (current stable with no jQuery dependency)
- Use CDN links for CSS/JS to keep the Week‑1 assignment simple
- Keep a small custom CSS file (site.css) for colours/spacing overrides
- For a static site, simplest way to keep header/footer consistent is to copy them into each HTML page or use a small JavaScript include for header/footer if you want DRY (both options described below)

Step-by-step plan

1) Prep & backup (5–10 min)
- Make a copy/branch of the current site so changes are reversible.
- Note which pages exist (e.g., index.html, gallery.html, contact.html, about.html).
Deliverable: a checklist of pages to update.

2) Add Bootstrap to every page (10–15 min)
- Add the Bootstrap 5 CSS CDN link into the <head> of each HTML page.
- Add the Bootstrap 5 JS bundle (includes Popper) near the end of <body>.
- Link a local custom CSS file (css/site.css) after Bootstrap for overrides.
What to change:
  - head: <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.x/dist/css/bootstrap.min.css" rel="stylesheet">
  - body end: <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.x/dist/js/bootstrap.bundle.min.js"></script>
Acceptance criteria: Pages load and Bootstrap classes (e.g., container, row) visibly affect layout.

3) Create consistent banner/header and footer (20–30 min)
- Decide how to share header/footer across pages:
  Option A (simple, allowed for Week1): copy the same header and footer markup into each HTML file.
  Option B (DRY): create header.html and footer.html and use a small JavaScript snippet to load them into <div id="header"></div> and <div id="footer"></div> (this is client-side include).
- Header: large banner area above navbar or integrated into the hero (use a .bg-primary with text-white and a container).
- Footer: Bootstrap styled footer with container, small text, links and social icons if desired (simple is fine).
Deliverable: identical header and footer on every page.
Acceptance criteria: Visual consistency across pages; header and footer responsive.

4) Replace navigation with a Bootstrap navbar that includes a search field (20–30 min)
- Build a responsive, collapsible navbar using Bootstrap's navbar component.
- Include brand/logo on the left, nav links (Home, Gallery, Contact, About), and a search form on the right.
- Search field: use a form with .d-flex containing <input type="search" class="form-control"> and a button. Make the form submit to search page or to the site’s pages (for Week1 static, you can have the form redirect to gallery.html?q=... or use JavaScript to filter gallery).
- Ensure the navbar collapses into a toggle button on small screens.
What to check:
  - Focus styles and aria attributes for accessibility (aria-label on search input, aria-controls on collapse).
Acceptance criteria: Navbar toggles on small screens; search field visible on medium+ screens and accessible on mobile.

5) Home page responsive layout (30–45 min)
- Hero/intro: use a full-width container with a background color/image, a heading and a short paragraph and CTA button (e.g., “View Gallery”).
- Content area: use Bootstrap grid (container > row > columns). For example:
  - Use Bootstrap cards for feature blocks or services: row with col-12 col-md-4 for three columns on desktop and stacked on mobile.
  - Images: use class="img-fluid" for responsiveness.
- Ensure spacing using Bootstrap spacing utilities (py-4, mb-3).
Acceptance criteria: On small screens content stacks vertically; on larger screens grid shows columns.

6) Gallery page: responsive grid + optional modal (30–60 min)
- Layout: use a responsive grid: <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"> and put images inside card or figure elements.
- Thumbnails: use img-fluid and object-fit CSS if needed.
- Optional lightbox: implement a Bootstrap modal that shows the larger image when a thumbnail is clicked (simple JS to set modal image src).
- If many images, lazy load with loading="lazy".
Acceptance criteria: Gallery shows 1 column on XS, 2 on SM, 3+ on MD+, images scale and the modal opens to show large image.

7) Contact form: Bootstrap form + client-side validation (20–40 min)
- Use form markup following Bootstrap form layout (floating labels or stacked labels + inputs).
- Fields: name, email (type=email), subject, message (textarea), and submit button.
- Add required attributes and pattern where appropriate.
- Add Bootstrap validation script (example from Bootstrap docs): prevent submission and show .was-validated class to display .invalid-feedback.
- For static site submission options:
  - Option A: mailto: action="mailto:you@example.com" (simple but less user-friendly)
  - Option B: Form handling service (Formspree, Netlify Forms) — mention if user wants that we can configure.
Acceptance criteria: Required-field feedback appears client-side and form layout matches Bootstrap styles.

8) Accessibility & semantics (15–30 min)
- Ensure all images have alt text.
- Ensure form controls have labels (use <label> or aria-label).
- Use semantic HTML5 elements (header, nav, main, footer).
- Ensure sufficient color contrast for banner and text.
- Keyboard testing: navbar toggle reachable by keyboard, modal focus trap if modal used.
Acceptance criteria: Basic Lighthouse accessibility checks pass (no obvious missing labels).

9) Small CSS customizations (15–30 min)
- Create css/site.css for:
  - Branding colors and banner overrides
  - Custom spacing or object-fit for gallery items
  - Footer styles
- Keep overrides minimal — prefer Bootstrap utilities where possible.

10) Testing on devices and cleanup (15–30 min)
- Local testing:
  - Open pages in browser, use DevTools device toolbar to test common widths (320, 375, 768, 1024).
  - Test navbar collapse, search field behavior, gallery layout, contact validation and modal.
- Run Lighthouse audit for performance/accessibility/best practices.
- Fix issues found (images too large, missing alt, broken links).
Acceptance criteria: Pages render properly on phone/tablet/desktop; forms and modal behave correctly.

11) Optional enhancements (time varies)
- Add smooth scrolling and minor JS enhancements (e.g., autofocus search on click).
- Add lightbox library if you prefer richer gallery (not necessary for assessment).
- Add SEO metadata (title, meta description, open graph tags).

12) Commit plan & deliverables
- Make small commits for each major step (e.g., "Add Bootstrap CDN and base CSS", "Replace header/footer with Bootstrap banner", "Add responsive navbar with search", etc.). Include Co-authored-by trailer if automating commits later (per repo rules).
- Final deliverable: updated pages (index.html, gallery.html, contact.html, css/site.css), plus any header/footer include files if using JS includes.
Acceptance criteria: All pages updated, site looks consistent and responsive, and user can demo on their machine.

Estimates (approximate)
- Quick upgrade (minimal): 2–3 hours (CDN Bootstrap, copy header/footer, navbar, basic home/galleries)
- Full polish (modal lightbox, validation, accessibility fixes): 4–6 hours

Next step suggestion
- If this plan looks good, pick one of:
  - “Proceed: I want you to implement step 2–4 first (Bootstrap + header + navbar)”
  - “Proceed: Implement everything end-to-end”
  - Or request a preference about form submission (mailto vs external service)
If you want to proceed, say which option you prefer and whether to use CDN or local Bootstrap files. (If you want me to ask that selection formally, I can prompt a choice.)

**What You Accepted:**  
All

**What You Changed:**  
11) Optional enhancements (time varies)

**Validation Performed:**  
To do later

**Issues Identified:**  
Nothing yet

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
