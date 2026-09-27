# COSC2446 Web Programming – Assessment 2  
# BookVerse Online Bookstore Platform

## Student Details

| Item | Details |
|---|---|
| Student name | Emilia Kim |
| Student ID | s4199673 |
| GitHub repository URL | https://github.com/s4199673 |
| Deployed website URL | https://titan.csit.rmit.edu.au/~s4199673/wp/a2/ |

---

## 1. Purpose of This README

This README documents the Assessment 2 project and should be completed by the student.

It is used to:

- summarise the project;
- explain the structure and technical choices;
- document database, security, testing, and deployment decisions;
- support marking of documentation and submission quality;
- help AI tools such as GitHub Copilot follow the assessment requirements.

TODO: After completing the project, update every TODO section in this file.

---

## 2. Copilot and AI Coding Instructions

This section must be completed by the student after reading the Assessment 2 brief.

Write clear instructions that would help GitHub Copilot or another AI tool produce code that follows the Assessment 2 requirements.

Your instructions should help the AI understand what it is allowed to generate, what it must not generate, and which assessment constraints must be followed.

TODO: Include instructions about:

- allowed technologies;
- technologies, frameworks, libraries, or tools that must not be used;
- required files and folders;
- PHP include file requirements;
- database connection requirements;
- MySQLi procedural prepared statement requirements;
- CSS and JavaScript file requirements;
- Bootstrap layout requirements;
- image upload and validation requirements;
- gallery modal requirements;
- book status filtering requirements;
- security requirements;
- deployment requirements;
- AI usage and process-evidence requirements.

### My Copilot / AI instructions

TODO: Write your Copilot/AI instructions here in clear bullet points.

---

## 3. Project Overview

Briefly describe the purpose of the BookVerse dynamic website.

TODO: In 3–5 sentences, explain:

- what BookVerse is;
- what users can view or interact with;
- how Assessment 2 extends the static website from Assessment 1;
- which technologies were used;
- how the website uses a database.

BookVerse is a wesite for browsing the managing a collection of books.
It is designed for readers and book enthusiasts who want to view book details, browse cover images and add new books through a form.
Assessment 2 turns the static Assessment 1 site into a dynamic one by pulling book content from a database instead of hard-coding it into HTML. It is built with PHP, MySQLi, MySQL on top of the HTML, CSS, Google Fonts, Material Icons, Boostrap and Javascript foundation from Assessment 1.
The website uses a MySQL databse with a single books table. index.php, books.php and gallery.php read from it to display book records and cover images. details.php retrieves a specific book by ID and add.php/process_add.php insert new records and cover images into it. 

---

## 4. Website Structure

Complete the table below by describing the purpose of each page.

| File | Purpose |
|---|---|
| `index.php` | Homepage. Features a navigation bar, carousel and a responsive grid of 4 latest books selected from the database. |
| `books.php` | Displays the full book records from the database and allows users to filter books by availability status with the filter options from the status values in the database. Clicking on the book title takes the user to details.php |
| `gallery.php` | Displays book cover images in a gallery format and the book titles come from the database. Allows users to view larger versions of the images in a Bootstrap modal.|
| `add.php` | Provides a functional form for entering new book information and book cover image which can be added to the database. |
| `details.php` | Displays the full details of a single book retrieved from the database. |
| `process_add.php` *(optional)* | Receives the submitted Add Book form data, performs server-side validation on all fields and the uploaded cover image, generates a unique filname for the image and inserts the new records into the database. Displays a success or error message once processing is complete. |

---

## 5. Project Folder Structure

Show the final structure of your `a2` folder.

TODO: Update this structure if your final project contains additional required files or folders.

```
a2/
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
│       └── covers/
├── includes/
│   ├── db_connect.inc
│   ├── header.inc
│   ├── nav.inc
│   └── footer.inc
├── index.php
├── books.php
├── gallery.php
├── add.php
├── details.php
├── README.md
└── process-evidence.md

Optional:
└── process_add.php
```

---

## 6. Technologies Used

Complete the table below. Explain how each technology was used in your project.

| Technology | How it was used in this project |
|---|---|
| HTML5 | Used to create the structure and content of the website, including the pages, navigation menu, book cards, tables, forms, images and semantic elements. |
| CSS3 | Used to style the website, including colours, fonts, spacing, layouts, gradients, hover effects, responsive design and dark mode. |
| Bootstrap 5 | Used to build responsive layouts and components such as the navbar, carousel, cards, tables, forms, buttons, grid system and modal.|
| JavaScript | Used to add interactive features such as filtering books by status, displaying gallery images in a gallery modal, navigating images with Previous/Next buttons, validating uploaded image files and showing image previews. |
| PHP | Used as the server-side language to connect to the database, run queries and dynamically generate page content. |
| MySQL | Used as the database storing all book records in a single books table including fields such as title, author, genre, publication year, ISBN, condition, price, description, cover image filename and availability status. |
| MySQLi procedural prepared statements | Used to safely query and insert data wherever user input is involved. |
| Google Fonts | Used to load and apply the Righteous and Elms Sans fonts required for BookVerse design. |
| Material Icons | Used to add icons to the navigation bar, page headings, form labels, buttons and BookVerse logo. |
| GitHub | Used for version control to track changes through commits and maintain a history of development throughout the project. |
| Coreteaching server | Used to host and test the website online so it could be accessed through a web browser. |
| Jacob 5 database server | Used to host the MySQL databse for the deployed version of the website allowing the live site on Coreteaching to connect to and query book records once deployed. |
| AI tools | Used to help review code, explain PHP and MySQL concepts, identify bugs, and provide suggestions for improving the website during development.|

---

## 7. Design and Layout

Based on the assessment document, describe the required design and layout choices.

TODO: Explain:

- how the design should continue from Assessment 1;
- how the required colour palette should be used;
- how the required fonts should be used;
- how Material Icons should be used;
- how Bootstrap should be used for layout and responsiveness;
- how shared include files support consistency across pages.

BookVerse continues the same look and feel established in Assessment 1, carrying the same overall page structure, navagation and branding while extending it into a responsive, database-driven layout across all five pages.

The website uses the required teal and amber colour palette as its primary branding colours as specified in the assingment brief while dark mode uses navy blue backgrounds with teal, amber and sky-blue accent colours to match the provided screenshots. These colours are applied consistently to the navigation bar, footer, buttons, headings and status indicators.

The required Google Fonts, Righteous and Elms Sans are used throughout the website. Righteous is used for ehadings and Elms Sans is used for body text, navigation links, talbes, form labels, buttons and modals.

Material Icons are used throughout the website. Icons are used for the BookVerse logo, navigation links, page headings and form labels.

Boostrap 5 is used to create responsive layouts using the grid system and components such as the navbar, carousel, cards, tables, forms, buttons and modal. This ensures the website adapts automatically to different screen sizes and desktop, table and mbile devices.

Shared PHP include files (header.inc, nav.inc and footer.inc) are used across every page to keep the layout, branding and navigation identical site-wide so a change made in one include file applies consistently everywhere without having to edit each page individually.

---

## 8. Required Features

Complete the table below by explaining where and how each required feature should be implemented.

| Feature | Page/File | Explanation |
|---|---|---|
| Carousel | `index.php` | A Bootstrap carousel displays featured books using rotating images, captions and navigation controls. View Details button underneath the book title is linked to details page. |
| Latest 4 books from database | `index.php` | A prepared query selects the 4 most recent books from the database ordered by book id descending and displays them as cards in a responsive grid with title, author, price and a View Details button. |
| Book table | `books.php` | A query retrieves all books from the databse and displays them in a Bootstrap table with each row showing title, author, genre, publication year, price and status. |
| Status filter | `books.php` | A dropdown of status options is generated dynamically from the status values in the database. JavaScript reads each row's data-status to show or hide rows client-side when a status is selected. |
| Book detail link | `books.php` / `details.php` | Each book title in the table is a hyperlink to details.php?id=, passing that book's bookd_id in the URL so the details page can look up the correct record. |
| Details page | `details.php` | Reads the id from the URL, retrieves the matching book using a prepared statement and displays its cover image, title, status, genre, publication year, ISBN, condition, price and description. Shows a "Book Not Found" message if no book matches the given ID. |
| Gallery grid | `gallery.php` | A query retrieves every book's cover image and title from the database and displays them as a responsive grid of clickable thumbnails. |
| Bootstrap image modal | `gallery.php` | Clicking a gallery thumbnail opens a Bootstap modal showing a larger version of the cover image and its title with Previous/Next buttons to cycle through the gallery without closing the modal. |
| Add Book form | `add.php` | A form collets all required book fields with HTML required attributes and client-side validation including a image preview before submission. |
| Record insertion | `add.php` or `process_add.php` | process_add.php validates all submitted fields server-side then inserts the new book into the database using a MySQLi prepared statement. |
| Image upload | `add.php` or `process_add.php` | The uploaded cover image is validated server-side for file type and size saved under a unique filename generated with uniqid() to prevent overwriting existing files and moved into assets/images/covers. |

---

## 9. Database Design and Use

Describe how the database is used in your project.

TODO: Explain:

- which database server is used locally and on deployment;
- the database name used on Jacob 5;
- which table or tables are used;
- how the supplied schema was followed;
- how records are retrieved and displayed;
- how new records are inserted;
- how `details.php` retrieves one selected record;
- how prepared statements are used.

BookVerse uses MySQL as its database server. Locally, the website connects to a MySQL databse running through XAMPP on localhost. 
On deployment, it connects to the Jacob 5 database server using a database named S4199673. db_connect.inc automatically detects which environmnet the site is running in and connects to the appropriate database acoordingly so no code changes are needed when moving between local development and the deployed site.

The table named 'books' stores every book_id, title, author, genre, publication_year, isbn, book_condition, description, price, image_path, status and created_at. This structure follows the schema supplied for the assignment including mathcing column names and types (e.g price as decimal (8,2)) so that form field names and validation logic correspond to the database columns.

Records are retrieved using mysqli_query() with SELCT statements on index.php, books.php and gallery.php looped through with mysqli_fetch_assoc() and displayed dynamically. The 4 latest books on the hompage, the full list in a table on books.php and all cover images in a grid on gallery.php. New records are inserted via process_add.php which validates the submitted form data server-side then inserts the new book using a prepared INSET statement with bound parameters.

details.php retrieves one selected record by reading the id value from the URL query string ($_GET['id']), casting it to an integer and using it in a prepared SELECT ... WHERE book_id = ? statment to fetch that single book's full details.

Prepared statements (mysqli_prepare(), mysqli_stmt_bind_param(), mysqli_stmt_execute()) are used specifically wherever user input is involved in a query such as the book ID lookup in details.php and the record insertion in process_add.php since both use MySQLi placeholders and bound parameters to keep the supplied values strictly separate from the SQL syntax and protecting against SQL injection. mysqli_query() is used for the read-only queries elsewhere since those don't incorporate any user provided values into the SQL string. 

### Database tables and important fields

Complete this section using the schema supplied for the assessment.

| Table | Important fields | Purpose |
|---|---|---|
| books| book_id, title, author, genre, publication_year, isbn, description, book_condition (New, Gently Used, Fair), price, image_path, status (Available, Reserved, Sold), created_at | Stores every book listed on the site. This table holds all the data needed across the whole website. book_id is used to look up individual records in details.php, status drives the filter on books.php, image_path links each record ot its cover image in assets/images/covers and created_at records when each book was added. |

---

## 10. PHP Includes and Reusable Structure

Describe how the include files are used.

| Include file | Purpose |
|---|---|
| `includes/db_connect.inc` | Establishes the MySQLi databse connection, detecting whether the site is running on localhost or the deployed Coreteaching/Jacob 5 server and connecting to the appropriate database accordingly. |
| `includes/header.inc` | Includes the shared <head> section (page title, meta tags, linked stylesheet, Bootstrap, Google Fonts and Material Icons) and the shared HTML document structure used by every page. |
| `includes/nav.inc` | Includes the navigation bar and logo with links to index.php, books.php, gallery.php and add.php |
| `includes/footer.inc` | Includes the shared site footer including the copyright line and closes the shared HTML structure. |
| `includes/tools.inc` (optional) | Provides the preshow() debugging helper used during development to inspect the contents of $_POST, $_FILES and $errors while building and testing process_add.php |

TODO: Explain how these files reduce repetition and support consistent layout or database access.

These includes files reduce repetition by keeping the layout, branding and database connection logic in one place rather than duplication the same HTML or PHP code across all the pages. Any change tot he navigation, footer or database connection only needs to be made once and it automatically applies across every page that includes it.

---

## 11. JavaScript Functionality

Describe the JavaScript features that should be implemented in your website.

| JavaScript feature | Page | How it works |
|---|---|---|
| Image extension validation | `add.php` | JavaScript checks the selected file's extension against a list of suppported image formats (jpg, jpeg, pnp, gif, webp). If an invalid file type is selected, an error message is displayed and the file input is cleared. |
| Image preview | `add.php` | When a user selects a valid image file, JavaScript generates a temporary preview using URL.createObject() and displays it alongside the form so the user can confirm the correct cover was chosen before submitting. |
| Gallery modal | `gallery.php` | Clikcing a gallery thumbnail opens a Boostrap modal and JavaScript updates it with that book's cover image and title, read from the data-image and data-title attributes. Previous and Next buttons in the modal update currentIndex to cycle through the other books in the gallery. |
| Book status filter | `books.php` | JavaScript listens for changes to the status filter dropdown and shows or hides each table row based on its data-status attribut, matching the selected status or showing all rows when "Show All" is selected. Filtering happens entirely client-side. |

---

## 12. Form Handling and Validation

Describe the validation and processing used on the Add Book form.

TODO: Explain:

- which fields are required;
- how labels are associated with form fields;
- which input types were used;
- how client-side image validation works;
- how server-side checks are performed;
- how the image file is uploaded;
- how the image filename is made unique;
- how the record is inserted into the database;
- what feedback the user receives if the submission succeeds or fails.

Every field is required. It is enforced both with HTML 'required' attributes and server-side so validation can't be bypassed. 

Labels are linked to their fields using matching for/id attributes for accessibility. Input types are matched to each field: text for title/author/ISBN. number for year/price, select dropdowns for genre/condition/status. textarea for description, file for the cover image and checkbox for the agreement confirmation.

Client-side: 'scripts.js' check the selected image's extension against an allowed list (jpg, jpeg, png, fig, webp), showing an error and clearing the input if invalid or a preview if valid. The same check runs again on submit. 
Server-side: 'process_add.php' re-validates every field. Minimum lengths on text fields, valid ranges on year and price, whitelist checks on genre/condition/status and checks that the image uploaded without error, has an allowed extension and is under 5MB.

Once valdation passes, the image is renamed using uniqid() plus its original extension to prevent overwriting existing files then moved into assets/images/covers with move_uploaded_file(). The new record including the generated filename is inserted into the books table using a prepared statement with bound parameters.

The user sees a list of specific error messages if validation fails, a success message with a link to view all books if the insert and upload both succeed or a partial-success message if the record saved but the image upload failed.

---

## 13. Security and Best Practices

Briefly explain how your project addresses security and best practices.

TODO: Mention relevant items such as:

- MySQLi procedural prepared statements;
- protection against SQL injection;
- escaping database output with `htmlspecialchars()`;
- validating query string values;
- validating uploaded files;
- unique uploaded filenames;
- not relying on original uploaded filenames;
- `.gitignore` use for uploaded/generated files;
- not displaying raw database errors to users on the deployed site.

Prepared statements (mysqli_prepare(), mysqli_stmt_bind_param(), mysqli_stmt_execute()) are used specifically wherever user input is involved in a query such as the book ID lookup in details.php and the record insertion in process_add.php since both use MySQLi placeholders and bound parameters to keep the supplied values strictly separate from the SQL syntax and protecting against SQL injection. mysqli_query() is used for the read-only queries elsewhere since those don't incorporate any user provided values into the SQL string. All database output is escaped with htmlspecialchars() and the id query string value is cast to (int) before use.

Uploaded images are validated server-side (upload erros, allowed extensions, 5MB limit) rather than relying on client-side JS alone. Files are never saved under their original filename. Each file is renamed with uniqid plus its original extension before being moved into assets/images/covers, preventing overwrites and avoiding exposure of the original filename.

Uploaded cover images are excluded from version control by adding assets/images/covers to .gitignore to prevent sync issues. Database connection failures and PHP error output are handled differently depending on environment. db_connect.inc nad tools.inc both detect whether the site is running on localhost, showing detailed error message only during local development while the deployed site show s a generic message instead of exposing raw database errors.
---

## 14. Accessibility and Usability

Briefly describe what accessibility and usability features must be implemented.

TODO: Mention relevant items such as:

- meaningful page titles;
- semantic HTML;
- form labels;
- image `alt` text;
- consistent navigation;
- readable text;
- colour contrast;
- responsive layout;
- clear user feedback.

The website uses meaningful page titles so users can easily identify the current page in the browser. Semantic HTML elements such as header, nav, main, section, and footer are used to improve structure and accessibility.

All form inputs have associated labels using matching for and id attributes. All images include descriptive alt text so that screen readers can describe their content. A consistent navigation bar is provided on every page to make the website easier to use and navigate.

Readable fonts, appropriate font sizes and sufficient colour contrast are used to improve readability. Bootstrap's responsive grid system ensures the website adapts to different screen sizes on desktop, tablet, and mobile devices.

Clear user feedback is provided through form validation messages, image upload validation, image preview before submission, gallery modal navigation and availability status filtering function.

---

## 15. Testing and Validation

Complete this section after testing your website.

### Rendered HTML Validation

| Page | Result | Notes |
|---|---|---|
| `index.php` | Pass | - |
| `books.php` | Pass | - |
| `gallery.php` | Pass | - |
| `add.php` | Pass | - |
| `details.php` | Pass | - |

### CSS Validation

| File | Result | Notes |
|---|---|---|
| `assets/css/style.css` | Pass | - |

### Functionality Testing

| Feature tested | Result | Notes |
|---|---|---|
| Navigation links | Pass | - |
| Database connection | Pass | - |
| Latest books display | Pass | - |
| Books table | Pass | - |
| Book status filter | Pass | - |
| Details page query string | TODO | TODO |
| Gallery modal | Pass | - |
| Add Book form validation | TODO | TODO |
| Image upload | Pass | TODO |
| Image preview | Pass | TODO |
| Deployed site links/assets | TODO | TODO |
| Deployed database content | TODO | TODO |

---

## 16. Deployment

Provide details of your deployed website.

| Item | Details |
|---|---|
| Deployed website URL | https://titan.csit.rmit.edu.au/~s4199673/wp/a2/ |
| Coreteaching server | Titan |
| Jacob 5 database name | S4199673 |
| Deployment folder | wp/a2 |
| `.htaccess` location | public_html |
| Upload folder permissions | TODO |

TODO: In 2–4 sentences, explain how you checked that the deployed website and database work correctly.

---

## 17. Git and Development Process

Briefly describe how you used Git during the project.

TODO: Explain:

- how often you committed changes;
- what types of changes your commits show;
- how your Git history shows progressive development;
- how your commits relate to your process-evidence records.

I used Git regularly throughout the project and tried to create commits after completing major tasks. My commits include changes such as building page layouts, styling components, implementing Bootstrap features, adding JavaScript functionality, fixing bugs, validating HTML and CSS and updating process-evidence documentation.

My Git history demonstrates progressive development by showing how the website evolved from the initial page structure to the completed stage. 
Each commit records a specific stage of development, making it easier to track changes and identify when features or fixes were added.

Many commits directly relate to entries in my process-evidence records. For example, commits were created after implementing AI-assisted improvements, fixing issues identified during testing and completing validation tasks, providing evidence of the development process and decision-making throughout the project.

---

## 18. AI Use Declaration

AI tools are required for this assessment.

Confirm the following:

- [Y] I used AI tools meaningfully during this assessment.
- [Y] I recorded meaningful AI use in `process-evidence.md`.
- [Y] I reviewed, tested, and adapted AI-assisted output.
- [Y] I can explain all AI-assisted code submitted.

TODO: Write 2–5 sentences explaining how AI tools supported your development.

Detailed AI usage records must be included in `process-evidence.md`.

I used AI tools to review code, explain PHP and MySQLi concepts, identify bugs and suggest improvements throughout the project. All AI-assisted outputs were reviewed, tested, and adapted before being used. Detailed records of meaningful AI use were documented in process-evidence.md and I can explain all AI-assisted code included in my submission.

---

## 19. Process Evidence

Confirm that your process evidence file has been completed.

| Requirement | Completed? |
|---|---|
| `process-evidence.md` file included | TODO: Yes |
| At least 4 debugging records included | TODO: Yes |
| At least 4 meaningful AI usage records included | TODO: Yes |
| Relevant commit links included | TODO: Yes |

---

## 20. Known Issues or Limitations

List any known issues or limitations in your submitted project.

| Issue or limitation | Explanation |
|---|---|
| TODO | TODO |
| TODO | TODO |

If there are no known issues, write:

> No known issues at the time of submission.
