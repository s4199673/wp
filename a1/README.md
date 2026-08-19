# COSC2446 Web Programming – Assessment 1  
# BookVerse Online Bookstore Platform

## Student Details

| Item | Details |
|---|---|
| Student name | Emilia Kim |
| Student ID | s4199673 |
| GitHub repository URL | https://github.com/s4199673 |
| Deployed website URL | https://titan.csit.rmit.edu.au/~s4199673/wp/a1/ |

---

## 1. Purpose of This README

This README documents the Assessment 1 project and should be completed by the student.

It is used to:

- summarise the project;
- explain the structure and technical choices;
- document testing and deployment;
- support marking of documentation and submission quality;
- help AI tools such as GitHub Copilot follow the assessment requirements.

TODO: After completing the project, update every TODO section in this file.

---

## 2. Copilot and AI Coding Instructions

This section must be completed by the student after reading the Assessment 1 brief.

Write clear instructions that would help GitHub Copilot or another AI tool produce code that follows the Assessment 1 requirements.

Your instructions should help the AI understand what it is allowed to generate, what it must not generate, and which assessment constraints must be followed.

TODO: Include instructions about:

- allowed technologies;
- technologies, frameworks, or tools that must not be used;
- required files and folders;
- CSS and JavaScript file requirements;
- whether inline CSS or inline JavaScript is allowed;
- Bootstrap layout requirements;
- form requirements;
- image validation requirements;
- gallery modal requirements;
- book status filtering requirements;
- accessibility and usability expectations;
- AI usage and process-evidence requirements.

### My Copilot / AI instructions

TODO: Write your Copilot/AI instructions here in clear bullet points.

- Use only HTML5, CSS3, Bootstrap 5, JavaScript, Google Fonts, and Material Icons.
- Do not use React, Vue, Angular, jQuery, TypeScript, Node.js, PHP, databases, APIs, or other external frameworks.
- Use the following file structure:
a1/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
│       └── covers/
├── index.html
├── books.html
├── gallery.html
├── add.html
├── README.md
└── process-evidence.md
- Place all custom CSS in assets/css/style.css and all custom JavaScript in assets/js/scripts.js.
- Use the provided BookVerse colour palette and required dark-mode colours.
- Use Righteous for headings and Elms Sans for body text and form content.
- Do not use inline CSS or JavaScript.
- Use the Bootstrap 5 grid system (container, row, col-*) for responsive layout.
- All fields must be mandatory on the form for adding a new book. 
- All fields should have a placeholder (except for select elements).
- All form fields must be presented with an associated <label> including Book Title – title, Author Name – author, Genre – genre, Publication Year – publication_year, ISBN – isbn, Description – description, Book Condition – book_condition (New, Gently Used, Fair), Price – price, Upload Cover Image – image_path, Status – status (Available, Reserved, Sold), and I agree that this book information is accurate and complete – agree.
- Validate uploaded files using JavaScript to only allow:.jpg, .jpeg, .png, .gif, .webp
- Display a preview of the selected image before form submission.
- Clicking an image in the gallery should open the modal.
- JavaScript should update: Modal image and Modal title with author name
- Previous and Next buttons should load other gallery images without closing the modal.
- Use JavaScript to filter rows using data-status attributes (Available, Reserved, Sold, Show All).
- Use meaningful page titles.
- Use semantic HTML elements (header, nav, main, section, footer).
- Provide descriptive alt text for all images.
- Associate all form labels with matching for and id attributes.
- Maintain consistent navigation on all pages.
- Ensure adequate colour contrast and readable text.
- Use AI to explain concepts, review code, identify bugs, and suggest improvements. 
- Meaningful AI use must be documented in process-evidence.md file.


---

## 3. Project Overview

Briefly describe the purpose of the BookVerse website.

TODO: In 3–5 sentences, explain:

- what BookVerse is;
- who the website is for;
- what users can view or interact with;
- which technologies were used;
- whether this is a static or dynamic website.

BookVerse is a website for browsing and managing a collection of books. It is designed for readers and book enthusiasts who want to view book details, browse cover images, and add new books through a form. Users can interact with features such as a homepage carousel, filtering book listings, a gallery of book covers with image previews, and an add-book form. The website was built using HTML5, CSS3, Bootstrap 5, and JavaScript. It is primarily a static website.

---

## 4. Website Structure

Complete the table below by describing the purpose of each page.

| File | Purpose |
|---|---|
| `index.html` | Serves as the homepage. Features a navigation bar, carousel, and a responsive grid of featured books. |
| `books.html` | Displays the full book catalogue in a table and allows users to filter books by availability status. |
| `gallery.html` | Displays book cover images in a gallery format and allows users to view larger versions of the images in a Bootstrap modal. |
| `add.html` | Provides a form for entering new book information (title, author, genre, publication year, ISBN, description, book condition, price, availability status and tick agreement box) including book cover image upload, image file type validation and image preview function. |

---

## 5. Project Folder Structure

Show the final structure of your `a1` folder.

TODO: Update this structure if your final project contains additional required files or folders.

```text
a1/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
│       └── covers/
├── index.html
├── books.html
├── gallery.html
├── add.html
├── README.md
└── process-evidence.md
```

## 6. Technologies Used

Complete the table below. Explain how each technology was used in your project.

| Technology | How it was used in this project |
|---|---|
| HTML5 | Used to create the structure and content of the website, including the pages, navigation menu, book cards, tables, forms, images and semantic elements.|
| CSS3 | Used to style the website, including colours, fonts, spacing, layouts, gradients, hover effects, responsive design and dark mode. |
| Bootstrap 5 | Used to build responsive layouts and components such as the navbar, carousel, cards, tables, forms, buttons, grid system and modal. |
| JavaScript | Used to add interactive features such as filtering books by status, displaying gallery images in a gallery modal, navigating images with Previous/Next buttons, validating uploaded image files and showing image previews. |
| Google Fonts | Used to load and apply the Righteous and Elms Sans fonts required for BookVerse design. |
| Material Icons | Used to add icons to the navigation bar, page headings, form labels and BookVerse logo. |
| GitHub | Used for version control to track changes through commits and maintain a history of development throughout the project. |
| Coreteaching server | Used to host and test the website online so it could be accessed through a web browser. |
| AI tools | Used to help review code, explain Bootstrap and JavaScript concepts, identify bugs, and provide suggestions for improving the website during development. |

## 7. Design and Layout

Based on the assessment document, describe the design and layout choices.

TODO: Explain:

how the required colour palette should be used;
how to use the required fonts;
how to use Material Icons;
how Bootstrap should be used for layout and responsiveness.

The BookVerse website uses the required teal and amber colour palette as its primary branding colours as specified in the assignment brief, while the dark-mode uses navy blue backgrounds with teal, amber, and sky-blue accent colours to match the provided screenshots. These colours are applied consistently to the navigation bar, footer, buttons, headings and status indicators.

The required Google Fonts, Righteous and Elms Sans are used throughout the website. Righteous is used for headings and Elms Sans is used for body text, navigation links, tables, form lables, buttons and modals.

Material Icons are used throughout the website. Icons are used for the BookVerse logo, navigation links, page headings and form labels.

Bootstrap 5 is used to create responsive layouts using the grid system and components such as the navbar, carousel, cards, tables, forms, buttons, and modal. 
This ensures the website adapts automatically to different screen sizes on desktop, tablet, and mobile devices.

## 8. Required Features

Complete the table below by explaining where and how each required feature should be implemented.

| Feature | Page | Explanation |
|---|---|---|
| Carousel | index.html | A Bootstrap carousel displays featured books using rotating images, captions and navigation controls. |
| Responsive book layout | index.html |	Bootstrap cards and the grid system (row and col-* classes) are used to display featured books in a layout that adapts to different screen sizes. |
| Book table | books.html |	A Bootstrap table displays book information such as title, author, genre, year, price, and availability status. |
| Status filter | books.html | JavaScript filters the table rows based on the selected status (Available, Reserved, or Sold) using a dropdown menu and data-status attributes. |
| Gallery grid | gallery.html |	A responsive Bootstrap grid displays book cover thumbnails that users can select. |
| Bootstrap image modal | gallery.html | A Bootstrap modal displays a full size image of the selected book cover, its title and author with JavaScript controlling the Previous and Next navigation buttons. |
| Add Book form | add.html | A form allows users to enter book details including title, author, genre, publication year, ISBN, description, condition, price, image, availability status and tick agreement box. |
| Image validation | add.html |	JavaScript checks that the uploaded file has an allowed image files (jpg, jpeg, png, gif, or webp). |
| Image preview | add.html | JavaScript displays a preview of the selected book cover image before the form is submitted. |

## 9. JavaScript Functionality

Describe the JavaScript features that should be implemented in your website.

| JavaScript feature | Page | How it works |
|---|---|---|
| Image extension validation | add.html	| JavaScript checks the selected file's extension and only allows supported image formats (jpg, jpeg, png, gif, and webp). If an invalid file type is selected, an error message is displayed. |
| Image preview | add.html | When a user selects a valid image file, JavaScript displays a preview of the book cover. |
| Gallery modal	| gallery.html | JavaScript updates Bootstrap modal with the selected book cover image, title and author when a gallery thumbnail is clicked. The Previous and Next buttons update the modal to display other images in the gallery. |
| Book status filter | books.html |	JavaScript listens for changes to the status filter dropdown and shows or hides table rows based on each book's data-status value allowing users to view books by status or show all books. |

## 10. Form Validation

Describe the validation that should be used on the Add Book form.

TODO: Explain:

which fields are required;
how labels are associated with form fields;
which input types were used;
how the image file type is checked;
which image file extensions are accepted;
how the image preview works;
what feedback the user receives if the selected file is invalid.

All fields in the Add Book form are required including Book Title, Author, Genre, Publication Year, ISBN, Description, Book Condition, Price, Upload Cover Image, Availability Status and the agreement checkbox. The required attribute is used to ensure users complete each field before submitting the form.

Each form field has an associated <label> element linked using matching for and id attributes. 

The form uses HTML input types including text for title, author, and ISBN, number for publication year and price, textarea for the description, select elements for genre, book condition, and status, file for the image upload, and a checkbox for the agreement confirmation.

JavaScript is used to validate the uploaded image file by checking its file extension before processing the file. The accepted image formats are .jpg, .jpeg, .png, .gif, and .webp. 

If a valid image is selected, JavaScript reads the file and displays a preview of the image.

If the selected file has an invalid extension, an error message is displayed to the user and the image preview is not shown until a valid image file is selected.

## 11. Accessibility and Usability

Briefly describe what accessibility and usability features must be implemented.

TODO: Mention relevant items such as:

meaningful page titles;
semantic HTML;
form labels;
image alt text;
consistent navigation;
readable text;
colour contrast;
responsive layout;
clear user feedback.

The website uses meaningful page titles so users can easily identify the current page in the browser. Semantic HTML elements such as header, nav, main, section, and footer are used to improve structure and accessibility.

All form inputs have associated labels using matching for and id attributes. All images include descriptive alt text so that screen readers can describe their content. A consistent navigation bar is provided on every page to make the website easier to use and navigate.

Readable fonts, appropriate font sizes and sufficient colour contrast are used to improve readability. Bootstrap's responsive grid system ensures the website adapts to different screen sizes on desktop, tablet, and mobile devices.

Clear user feedback is provided through form validation messages, image upload validation, image previews, gallery modal navigation and availability status filtering function.

## 12. Testing and Validation

Complete this section after testing your website.

HTML Validation
File	Result	Notes
index.html	TODO: Pass 
books.html	TODO: Pass 
gallery.html	TODO: Pass 
add.html	TODO: Pass 

CSS Validation
File	Result	Notes
assets/css/style.css	TODO: Pass Minor validation issues were corrected and stylesheet validated successfully.

Functionality Testing
Feature tested	Result	Notes
Navigation links	Pass All navigation links correctly load the corresponding pages.
Carousel	Pass Carousel automatically cycles through images and Previous/Next controls function correctly.
Gallery modal	Pass Clicking a gallery image opens the Bootstrap modal with the correct image, title and author. Previous and Next buttons work correctly.
Book status filter	Pass Books are filtered correctly based on the selected status and can return to showing all books.
Add Book form validation	Pass Required fields prevent submission when empty and image file types are checked using JavaScript.
Image preview	Pass A preview of the selected image is displayed before form submission.
Deployed site links/assets	Pass All pages, stylesheets, scripts, images, fonts, and icons load correctly on the deployed site.

## 13. Deployment

Provide details of your deployed website.

Item	Details
Deployed website URL	https://titan.csit.rmit.edu.au/~s4199673/wp/a1/
Coreteaching server	Titan
Deployment folder	wp/a1
.htaccess location	public_html 

TODO: In 2–4 sentences, explain how you checked that the deployed website works correctly.

I tested the deployed website by opening each page and checking that all navigation links, images, stylesheets, fonts, icons, and JavaScript features loaded correctly. I verified that the carousel, gallery modal, book status filter, image validation, and image preview functions worked as expected. 
The website was also tested on different screen sizes to confirm that the responsive layouts displayed correctly on desktop, tablet, and mobile devices. 
Finally, I checked the browser console for errors and confirmed that all pages functioned without issues.

## 14. Git and Development Process

Briefly describe how you used Git during the project.

TODO: Explain:

how often you committed changes;
what types of changes your commits show;
how your Git history shows progressive development;
how your commits relate to your process-evidence records.

I used Git regularly throughout the project and tried to create commits after completing major tasks. My commits include changes such as building page layouts, styling components, implementing Bootstrap features, adding JavaScript functionality, fixing bugs, validating HTML and CSS and updating process-evidence documentation.

My Git history demonstrates progressive development by showing how the website evolved from the initial page structure to the completed stage. 
Each commit records a specific stage of development, making it easier to track changes and identify when features or fixes were added.

Many commits directly relate to entries in my process-evidence records. For example, commits were created after implementing AI-assisted improvements, fixing issues identified during testing and completing validation tasks, providing evidence of the development process and decision-making throughout the project.

## 15. AI Use Declaration

AI tools are required for this assessment.

Confirm the following:
- [Y] I used AI tools meaningfully during this assessment.
- [Y] I recorded meaningful AI use in `process-evidence.md`.
- [Y] I reviewed, tested, and adapted AI-assisted output.
- [Y] I can explain all AI-assisted code submitted.

TODO: Write 2–5 sentences.

I used AI tools to review code, explain Bootstrap and JavaScript concepts, identify bugs and suggest improvements throughout the project. All AI-assisted outputs were reviewed, tested, and adapted before being used. Detailed records of meaningful AI use were documented in process-evidence.md and I can explain all AI-assisted code included in my submission.

Detailed AI usage records must be included in process-evidence.md.

## 16. Process Evidence

Confirm that your process evidence file has been completed.

Requirement	Completed?
process-evidence.md file included	TODO: Yes
At least 2 debugging records included	TODO: Yes 
At least 2 meaningful AI usage records included	TODO: Yes 
Relevant commit links included	TODO: Yes 

## 17. Known Issues or Limitations

List any known issues or limitations in your submitted project.

Issue or limitation	Explanation

As a beginner, I initially found it difficult to organise commits in a clear and logical sequence because I often discovered typos, bugs or small improvements while working and would fix them immediately but would not create a commit until completing a larger task. As a result, some commits contained multiple related changes rather than a single focused change. Later in the project, I learned how to use staging changes before committing which helped me separate assignment work from lab work and create more meaningful commits. Trevor also provided guidance when I experienced difficulties managing commits.


