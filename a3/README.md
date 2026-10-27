# COSC2446 Web Programming – Assessment 3  
# BookVerse Online Bookstore Platform

## Student Details

| Item | Details |
|---|---|
| Student name | Emilia Kim |
| Student ID | S4199673 |
| GitHub repository URL | https://github.com/s4199673 |
| Deployed website URL | https://titan.csit.rmit.edu.au/~s4199673/wp/a3/ |

---

## 1. Purpose of This README

This README documents the Assessment 3 project and should be completed by the student.

It is used to:

- summarise the project;
- explain the structure and technical choices;
- document database, security, authentication, testing, and deployment decisions;
- support marking of documentation and submission quality;
- help AI tools such as GitHub Copilot follow the assessment requirements.

TODO: After completing the project, update every TODO section in this file.

---

## 2. Copilot and AI Coding Instructions

This section must be completed by the student after reading the Assessment 3 brief.

Write clear instructions that would help GitHub Copilot or another AI tool produce code that follows the Assessment 3 requirements.

Your instructions should help the AI understand what it is allowed to generate, what it must not generate, and which assessment constraints must be followed.

TODO: Include instructions about:

- allowed technologies;
- technologies, frameworks, libraries, or tools that must not be used;
- required files and folders;
- PHP include file requirements;
- database connection requirements;
- MySQLi procedural prepared statement requirements;
- session and flash-message requirements;
- registration, login, and logout requirements;
- authentication and authorisation requirements;
- owner-only edit and delete requirements;
- CRUD requirements;
- search requirements;
- seller page requirements;
- image upload and validation requirements;
- CSS and JavaScript file requirements;
- Bootstrap layout requirements;
- gallery modal requirements;
- book status filtering requirements;
- deletion confirmation requirements;
- security requirements;
- deployment requirements;
- AI usage and process-evidence requirements.

### My Copilot / AI instructions

TODO: Write your Copilot/AI instructions here in clear bullet points.

- Use PHP, HTML, CSS, JavaScript, Bootstrap 5, and MySQL only.
- Do not use React, Angular, Vue, Node.js, Laravel, Symfony, CodeIgniter, PDO, or other frameworks.
- Follow the required project file and folder structure.
- Every PHP page must include: includes/header.inc, includes/nav.inc, includes/footer.inc which use resuasable include files to avoid duplicate code.
- Create a single connection file: includes/db_connect.inc which automatically detect localhost or Coreteaching/Jacob 5 environment.
- All queries must use prepared statements.
- Start sessions where necessary. Flash messages must use $_SESSION and display success or error feedback after registration, login, logout, add record, edit record and delete record.
Messages should be shown once and then removed from the session.
- Registration: create new user account and use password_hash(), automatically log the user in after succesful registration, store user information in session.
- Login: Authenticate using username/email and passowrd, verify password using password_verify().
- Logout: Destroy session, redirect to home page. 
- Authentication: Only logged-in users can access add.php
- Authorisation: Only the owner of a book can edit and delete the record. Owndership must be checked server-side before editing or deleting a record.
- Before editing or deleting, retrieve the record owner, compare ownder ID against the logged-in user's ID and deny access if IDs do not match.
- Only show Edit and Delete buttons to the owner. Deletion must remove database row and remove uploaded image file.
- Create: add.php, insert new book record, upload image, generate unique filename.
- Read: index.php, books.php, gallery.php, details.php, seller.php, search.php
- Update: edit.php, replace image if a new image is uploaded, delete old image file, retain existing image if no new file uploaded.
- Delete: owner only, confimation required, remove record and image.
- search.php allows users to search title, author, description using a keyword search with prepared statements.
- seller.php displays all books belonging to the selected owner, suing an owner ID passed through the query string (prepared statements). No login required to view the page. The owner links must appear on index.php, books.php, details.php. If the seller is logged in, they also have a link to their page in the navbar.
- Validate image uploads by checking file type, extension, size, and upload errors. 
- Store uploaded images in the specified upload folder and save filenames in the database.
- Do not use original filenames. Generate unique names using uniqid() or suffxing the original filename with a timestamp e.g. time() or date() functions
- Keep CSS and JavaScript in separate external files where required. Do not generate inline JavaScript.
- Use Bootstrap's grid system and components for responsive layouts throughout the site.
- gallery.php displays all book images which come from database recrods. Clicking an image opens a Boostrap modal which displays full-size image. 
- books.php retrive all records from database and generate filter options dynamically from status values. Filtering must be client-side only and use JavaScript show/hide logic.
- When users click Delete, open Boostrap confirmation modal, require user confirmation beofore deletion and modal functionality must be handled through scripts.js
- Protect against SQL injection, XSS, and invalid file uploads. Escape all output using htmlspecialchars().
- Ensure the application runs correctly on the Titan server using relative paths where appropriate.
- Use AI to explain concepts, review code, identify bugs and suggest improvements. 
- process-evidence.md file must include at least 5 debugging records, at least 5 records of meaningful AI use and links to relevant GitHub commits.



---

## 3. Project Overview

Briefly describe the purpose of the BookVerse extended project.

TODO: In 3–5 sentences, explain:

- what BookVerse is;
- what authenticated users can do;
- what anonymous visitors can do;
- how Assessment 3 extends Assessment 2;
- which technologies were used;
- how the website uses database persistence.

BookVerse is an extended online bookstore platform where readers can browse books, view detailed information, search the collection and explore cover images in a gallery. Visitors can browse, search, view book details and see seller pages. Authenticated users can register, log in, add books and edit or delete books they own. Assessment 3 extends Assessment 2 by adding user authentication, sessions, authorisation, ownership controls, seller profiles and CRUD management. The website uses PHP, MySQLi, MySQL, HTML, CSS, JavaScript and Boostrap with book, user and image information persistently stored in the database.

---

## 4. Website Structure

Complete the table below by describing the purpose of each page.

| File | Purpose |
|---|---|
| `index.php` | Homepage. Features a navigation bar, carousel and a responsive grid of 4 latest books retrieved from the database.  |
| `books.php` | Displays the full book records from the database and allows visitors to filter books by availabtility status.  |
| `gallery.php` | Displays book cover images in a gallery format and the book titles come from the database. Allows users to view larger versions of the images in a Bootstrap modal. |
| `details.php` | Displays the full details of a single book retrieved from the database. |
| `seller.php` | Displays the profile and books belonging to a selected seller. This page can be viewed without logging in. |
| `search.php` | Allows visitors to search the book collection by tile, author or description using a keyword. |
| `register.php` | Provides a registration form for creating a new user account. |
| `login.php` | Provides a login form and authenticates users using username or email address and password. |
| `logout.php` | Logs the current user out, destroys the session and redirects them to the homepage. |
| `add.php` | Provides an authenticated user with a form for adding a new book and uploading its cover image. |
| `edit.php` | Allows the owner of a book to edit its information and optionally replace its book cover image |
| 'process_register.php' | process registration |
| 'process_login.php' | process login |
| 'process_add.php' | process adding books |
| 'process_edit.php' | process book updates |
| 'process_delete.php' | process book deletion |

---

## 5. Project Folder Structure

Show the final structure of your `a3` folder.

TODO: Update this structure if your final project contains additional required files or folders.

```
a3/
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
│   ├── tools.inc
│   └── footer.inc
├── index.php
├── books.php
├── gallery.php
├── details.php
├── seller.php
├── search.php
├── register.php
├── login.php
├── logout.php
├── add.php
├── edit.php
├── process_register.php
├── process_login.php
├── process_add.php
├── process_edit.php
├── process_delete.php
├── README.md
└── process-evidence.md

```

---

## 6. Technologies Used

Complete the table below. Explain how each technology was used in your project.

| Technology | How it was used in this project |
|---|---|
| HTML5 | Used to create the structure and content of the website, including the pages, navigation menu, book cards, tables, forms, images and semantic elements.|
| CSS3 | Used to style the website, including colours, fonts, spacing, layouts, gradients, hover effects, responsive design and dark mode. |
| Bootstrap 5 | Used to build responsive layouts and components such as the navbar, carousel, cards, tables, forms, buttons, grid system, dropdowns and confirmation/gallery modals. |
| JavaScript | Used to add interactive features such as filtering books by status, displaying gallery images in a gallery modal, navigating images with Previous/Next buttons, validating uploaded image files and showing image previews. |
| PHP | Used as the server-side language to process forms, manage authentication, connect to the database, run queries and dynamically generate page content.|
| MySQL | Used as the database storing user accounts and book records in a single books table including fields such as title, author, genre, publication year, ISBN, condition, price, description, cover image filename and availability status and ownership information. |
| MySQLi procedural prepared statements | Used to safely retrieve, insert, update and delete database records wherever user input is involved. |
| PHP sessions | Used to maintain login state, store the authenticated user's ID and username, control access to restricted features, verify book ownership and display temporary success or error flash messages. |
| Google Fonts | Used to load and apply the Righteous and Elms Sans fonts required for BookVerse design. |
| Material Icons |  Used to add icons to the navigation bar, page headings, form labels, buttons and BookVerse logo. |
| GitHub | Used for version control to track changes through commits and maintain a history of development throughout the project. |
| Coreteaching server | Used to host and test the website online so it could be accessed through a web browser. |
| Jacob 5 database server. |
| Jacob 5 database server | Used to host the MySQL databse for the deployed version of the website allowing the live site on Coreteaching to connect to and query book records once deployed. |
| AI tools | Used to help review code, explain PHP and MySQL concepts, identify bugs, and provide suggestions for improving the website during development. |

---

## 7. Design and Layout

Based on the assessment document, describe the required design and layout choices.

TODO: Explain:

- how the design should continue from previous assessments;
- how the required colour palette should be used;
- how the required fonts should be used;
- how Material Icons should be used;
- how Bootstrap should be used for layout and responsiveness;
- how shared include files support consistency across pages;
- how navigation changes depending on whether the user is logged in.

The BookVerse design continues the visual style established in Assessments 1 and 2 while extending it with the functionality required for authenticated users. The existing BookVerse branding, navigation structure, book-focused content, responsive layout and overall visual identity remain consistent across the project.

The required colour palette is used consistently throughout the website. Teal is used as the main brand colour for navigation elements, headings, links and primary buttons, while amber and related accent colours are used to highlight important actions, statuses and visual details. Neutral colours provide readable backgrounds, borders and text, while the dark-mode colours maintain contrast and readability when dark mode is enabled.

The Righteous font is used for the BookVerse logo and prominent branding, while Elms Sans is used for normal page text, headings, labels, buttons and other interface content. Material Icons are used alongside navigation links, headings, form labels, buttons and the BookVerse logo to make the interface clearer and more visually consistent.

Bootstrap 5 is used for the responsive layout and interface components. Its container, row and column grid system organises content across different screen sizes, while components such as the navbar, cards, tables, forms, buttons, dropdowns and modals provide a consistent user experience on desktop, tablet and mobile devices.

Shared include files such as `header.inc`, `nav.inc`, `footer.inc` and `tools.inc` are used across the PHP pages. These files prevent duplicated markup and ensure that the page header, stylesheets, scripts, navigation, footer and flash messages remain consistent throughout the website.

The navigation changes according to the user's authentication status. Anonymous visitors see links to log in and register as well as the public browsing, gallery, search and book-detail features. Authenticated users see their username and account options, including a link to their seller page and a logout option. The Add Book link is available in the navigation but server-side access control ensures that only authenticated users can use the feature.

---

## 8. Required Features

Complete the table below by explaining where and how each required feature should be implemented.

| Feature | Page/File | Explanation |
|---|---|---|
| Carousel of latest images | `index.php` | Displays a Bootstrap carousel containing cover images from the latest book records retrieved from the database. |
| Latest 4 books from database | `index.php` | Retrieves the four most recently added books from the database and displays them in a responsive card layout with links to their details pages.  |
| Book table | `books.php` | Retrieves all book records from the database and displays their information in a responsive table including the title, author, status, price and seller. |
| Status filter | `books.php` | Creates filter options from the available book statuses and uses JavaScript to show or hide table rows on the client side without reloading the page. |
| Book detail link | `books.php` / `details.php` | Provides links containing the selected book ID so visitors can open the corresponding record on `details.php`.|
| Details page | `details.php` |  Retrieves and displays the complete information for one book including its cover image, title, author, description, status, price and seller. It also displays edit and delete controls only when the logged-in user owns the book. |
| Seller link | `index.php`, `details.php`, `books.php` | Displays links containing the seller's user ID so visitors can view all books listed by that seller on `seller.php`.|
| Seller page | `seller.php` | Retrieves the selected seller's information and all books owned by that seller. The page is publicly accessible and does not require visitors to log in.|
| Gallery grid | `gallery.php` | Retrieves book cover images from the database and displays them in a responsive Bootstrap grid with their book titles.|
| Bootstrap image modal | `gallery.php` | Opens a Bootstrap modal when a gallery image is selected and displays the larger cover image, its title and previous/next navigation controls.|
| Search | `search.php` | Accepts a keyword and uses a prepared statement to search book titles, authors and descriptions then displays the matching records. |
| User registration | `register.php` | Provides a registration form and processes the submitted username, email and password. The password is securely hashed before the new user is inserted into the database and the user is logged in after successful registration.|
| User login | `login.php` | Provides a login form and authenticates a user by checking their username or email and verifying their password against the stored password hash.|
| User logout | `logout.php` | Ends the authenticated user's session, clears the stored session data, displays a logout message and redirects the user to the homepage. |
| Add Book form | `add.php` | Provides an authenticated user with a form for entering book information and uploading a cover image. The processing file validates the data and inserts the new book record into the database.  |
| Edit Book form | `edit.php` | Retrieves an existing book and allows only its owner to update the book information or replace its cover image. The ownership check is performed on the server. |
| Delete action | `details.php` or optional processing file | Displays a delete option only to the book owner. A Bootstrap confirmation modal requires confirmation before `process_delete.php` verifies ownership, deletes the database record and removes the uploaded image file. |
| Image upload | `add.php` / `edit.php` | Accepts cover image uploads, validates the file type, extension, size and upload status, generates a unique filename, stores the file in the upload folder and saves the filename in the database. When an edited book receives a replacement image, the previous image is removed. |
| Flash messages | Session-based pages/actions | Stores success and error messages in `$_SESSION` after registration, login, logout, adding, editing and deleting records. Shared helper functions display each message once and then remove it from the session. |

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
- how existing records are edited;
- how records are deleted;
- how books are linked to owners;
- how `details.php` retrieves one selected record;
- how `seller.php` retrieves records for one selected owner;
- how `search.php` searches records;
- how prepared statements are used.

The project uses MySQL on the local XAMPP development environment and the Jacob 5 MySQL server for deployment. The local database is named `bookverse`, while the deployed website uses the `S4199673_159009` database on the Jacob 5 server. The connection file detects the environment and connects to the appropriate database using the local credentials or the deployed Jacob 5 credentials.

The project uses the 'books' and 'users' tables. The 'books' table follows the supplied schema and stores each book's title, author, genre, publication year, ISBN, condition, price, description, cover image filename and availability status. Assessment 3 extends the book records with a 'user_id' field, which links each book to the user who created it. The 'users' table stores account information such as the user ID, username, email address, password hash, location and bio.

Book records are retrieved from the database using SELECT queries and are displayed dynamically on the homepage, books table, gallery, details page, search results and seller page. The homepage retrieves the latest four book records, while the books page retrieves the complete collection. Gallery and card layouts use the retrieved image filenames to display the stored cover images from the uploads folder.

New records are inserted by process_add.php after an authenticated user submits the Add Book form. The submitted values and uploaded image are validated, a unique filename is generated for the image, and the new book information is inserted into the 'books' table with the logged-in user's ID as its owner.

Existing records are edited through edit.php and process_edit.php. Before updating a record, the application checks that the selected book belongs to the logged-in user. The book information is then updated and a replacement cover image can be uploaded. If a new image is used, the previous image file is removed after the database update is successful.

Records are deleted through process_delete.php. The application checks that the user is logged in and owns the selected book before deleting it. After the database record is successfully deleted, the associated uploaded cover image is also removed from the server.

Books are linked to their owners through the 'user_id' field in the 'books' table. This value is taken from the authenticated user's session when a book is added. Ownership checks use both the selected book ID and the logged-in user's ID, ensuring that only the owner can edit or delete a book.

The details.php page retrieves one selected record using the book ID supplied in the URL. The ID is validated and passed to a prepared SELECT statement which retrieves the matching book from the 'books' table. The page then displays the book information and shows edit or delete controls only when the logged-in user is the book's owner.

The seller.php page retrieves the selected owner using the user ID supplied in the URL. It first retrieves the seller's profile from the 'users' table and then retrieves all books from the 'books' table whose 'user_id' matches that seller ID. This allows anonymous visitors to view a seller's profile and books without logging in.

The search.php page accepts a keyword through the search form and searches the title, author and description fields in the 'books' table. The keyword is used with LIKE conditions so that matching records are displayed as search results.

Prepared statements are used for database operations involving user input. Values such as book IDs, seller IDs, search keywords, form fields and logged-in user IDs are passed to SQL statements using placeholders and mysqli_stmt_bind_param(). This prevents user input from being inserted directly into SQL queries and helps protect the application against SQL injection.

### Database tables and important fields

Complete this section using the schema supplied for the assessment.

| Table | Important fields | Purpose |
|---|---|---|
| users | user_id, username, email, passowrd, location, bio | Stores registered user accounts, login details, hashed passwords and seller profile information |
| books | book_id, user_id, title, author, genre, publication_year, isbn, description, book_condition, price, image_path, status | Stores book records including their details, uploaded cover image filenames, avilabitliy status and the 'user_id' of the owner who created each book. |

---

## 10. PHP Includes and Reusable Structure

Describe how the include files are used.

| Include file | Purpose |
|---|---|
| `includes/db_connect.inc` | Establishes the MySQLi databse connection, detecting whether the site is running on localhost or the deployed Coreteaching/Jacob 5 server and connecting to the appropriate database accordingly. |
| `includes/header.inc` | Includes the shared <head> section (page title, meta tags, linked stylesheet, Bootstrap, Google Fonts and Material Icons) and the shared HTML document structure used by every page. |
| `includes/nav.inc` | Includes the shared navigation bar and logo with links to index.php, books.php, gallery.php, search.php and add.php. The account section displays Register and Login links for anonymous visitors. For authenticated users, it displays the logged-in username, a link to My Profile & Books and a Logout link.|
| `includes/footer.inc` | Includes the shared site footer including the copyright line and closes the shared HTML structure. |
| `includes/tools.inc` (optional) | Provides the preshow() debugging helper used during development to inspect the contents of $_POST, $_FILES and $errors while building and testing process_add.php |

TODO: Explain how these files reduce repetition and support consistent layout, database access, session messages, or navigation.

The shared include files reduce repetition by storing common code and layout elements in one place instead of repeating them on every PHP page. header.inc provides the common HTML head section, Bootstrap and external font links, the stylesheet and JavaScript references, while footer.inc provides the shared page footer and closing layout elements. nav.inc provides the BookVerse logo, navigation links and authentication-dependent account links consistently across the website.

db_connect.inc contains the database connection logic and selects the correct local or deployed database environment, so individual pages do not need to repeat the connection details. tools.inc contains reusable functions for starting sessions and displaying session-based flash messages. These includes make the application easier to maintain because changes to the layout, navigation, database connection or message display can be made in one file and applied across all pages.

---

## 11. Authentication, Sessions, and Access Control

Describe how authentication and sessions are implemented.

TODO: Explain:

- how registration works;
- how passwords are hashed before storage;
- how login verifies passwords;
- how sessions are used after login;
- how logout works;
- how flash messages are stored and displayed;
- how anonymous and authenticated views differ;
- which pages require login;
- which actions are owner-only.

Authentication and sessions are implemented using PHP sessions and the 'users' table. The registration form in register.php collects a username, email address, password and password confirmation. process_register.php validates the submitted values, checks whether the username or email already exists, hashes the password with password_hash() and stores the new account in the database. After successful registration, the new user's ID, username and email are stored in the session and the user is automatically logged in.

The login form in login.php sends the submitted username and password to process_login.php. The login process retrieves the matching user record with a prepared statement and verifies the submitted password using password_verify() against the stored password hash. When the credentials are valid, the user's ID, username and email are stored in $_SESSION, and the user is redirected to the homepage.

PHP sessions maintain the authenticated user's state between page requests. The session stores values such as user_id, username and email, which are used to display the account menu, identify the owner of a book and protect restricted pages. Anonymous visitors do not have a user_id in their session, so they can browse books, view details, search, use the gallery and view seller pages, but they cannot access protected book-management features.

The logout process in logout.php clears the session data, removes the session cookie, destroys the current session and starts a new session for the logout confirmation message. The user is then redirected to the homepage.

Flash messages are stored temporarily in session variables such as $_SESSION['success'], $_SESSION['failure'] and $_SESSION['warning']. The shared showFlashAlerts() function displays these messages as Bootstrap alerts and removes them from the session after displaying them so each message appears only once. Flash messages provide feedback after registration, login, logout, adding a book, editing a book, deleting a book or encountering an error.

Anonymous and authenticated views differ through the shared navigation and server-side access checks. Anonymous visitors see Login and Register links, while authenticated users see their username, a link to My Profile & Books and a Logout link. Book details also show Edit and Delete controls only when the logged-in user owns the selected book.

The add.php page requires the user to be logged in before the Add Book form is displayed. The edit and delete processing actions also require an authenticated session. Editing and deleting are owner-only actions: the application compares the logged-in user's ID with the user_id stored on the selected book and performs the action only when the IDs match. Registration, login, logout, browsing, searching, viewing details, gallery access and seller pages remain available to visitors without an account.

### Protected routes and actions

| Page or action | Who can access it? | How access is checked |
|---|---|---|
| `add.php` | Authenticated users only | The page checks whether $_SESSION['user_id'] is set. If not set, the visitor recieves a warning message and is redirected to login.php. |
| `edit.php` | Authenticated users who own the selected book | The page checks for a logged-in user and retrieves the selected book using its ID and the logged-in user's ID. The edit form is displayed only when both values match. |
| Delete action | Authenticated users who own the selected book | process_delete.php requires a valid session user ID and uses the seleted book ID together with that user ID in the prepared query. The book is deleted only when the ownership check succeeds. |
| Owner edit/delete buttons | The owner of the selected book | details.php compares the logged-in user's session ID with the book's stored 'user_id'. Edit and Delete buttons are displayed only when the IDs match. |
| Anonymous visitor pages | All visitors including users who are not logged in. | Public pages such as index.php, books.php, gallery.php, details.php, seller.php and search.php do not require a logged-in session. Visitors can view and search content but cannot perform protected book-management actions. |

---

## 12. CRUD Functionality

Describe how create, read, update, and delete functionality is implemented.

| CRUD operation | Page/File | Explanation |
|---|---|---|
| Create book | `add.php` / 'process_add.php' | `add.php` provides the form for authenticated users to enter book info and upload a cover image. 'process_add.php' validates the submitted values and image, generates a unique image filename and inserts the new book into the 'books' table with the logged-in user's user_id.  |
| Read all books | `books.php` | Retrieves book records from the 'books' table and displays them in a responsive tabble. The page includes book info, availability status, prices and links to the relevant details and seller pages. |
| Read one book | `details.php` | Valides the book ID from the query string, uses a prepared SELECT statement to retrieve the matching record and displays its complete information including its cover image, seller and available actions. |
| Update book | `edit.php` / 'process_edit.php' | `edit.php` loads the selected book and provides an editing form for its owner. 'process_edit.php' validates the submitted values, updates the database record and optionally uploads a replacement cover image while removing the old image after a succesfful update. |
| Delete book | `details.php` / 'process_delete.php' | `details.php` provides the owner with a Delete button and confirmation step. 'process_delete.php verifies the request, deletes the matching database record and removes its uploaded cover image after the database deletion succeeds. |

TODO: Explain how ownership is checked before editing or deleting a record.

Ownership is checked before editing or deleting by comparing the logged-in user's user_id stored in $_SESSION with the user_id stored on the selected book record. The edit and delete prepared statements include both the book ID and the logged-in user's ID in the WHERE condition. As a result, a user cannot edit or delete another user's book by changing an ID in the URL or form submission. The edit and delete controls are also displayed only when the logged-in user is the owner.

---

## 13. Search, Filtering, and Seller Pages

Describe the dynamic browsing features.

| Feature | Page | Explanation |
|---|---|---|
| Status filtering | `books.php` | TODO |
| Keyword search | `search.php` | TODO |
| Seller page | `seller.php` | TODO |

TODO: Explain:

- how status filtering works;
- how `data-status` is used;
- how search uses prepared statements;
- how the selected seller is identified;
- how seller links are displayed.

---

## 14. JavaScript Functionality

Describe the JavaScript features that should be implemented in your website.

| JavaScript feature | Page | How it works |
|---|---|---|
| Image extension validation | `add.php` / `edit.php` | TODO |
| Image preview | `add.php` / `edit.php` | TODO |
| Gallery modal | `gallery.php` | TODO |
| Book status filter | `books.php` | TODO |
| Delete confirmation modal | `details.php` | TODO |

---

## 15. Form Handling and Validation

Describe the validation and processing used on forms.

TODO: Explain:

- which forms are included;
- which fields are required;
- how labels are associated with form fields;
- which input types were used;
- how client-side image validation works;
- how server-side checks are performed;
- how uploaded images are validated;
- how uploaded image filenames are made unique;
- what happens if no new image is uploaded during editing;
- what feedback the user receives if an action succeeds or fails.

---

## 16. File Uploads and File-System Hygiene

Describe how image uploads are handled.

TODO: Explain:

- where uploaded images are stored;
- how unique filenames are generated;
- how the original filename is handled;
- how old images are deleted when a record is edited;
- how images are deleted when a record is deleted;
- how `.gitignore` is used for uploaded/generated files;
- how file permissions are handled on Coreteaching.

---

## 17. Security and Best Practices

Briefly explain how your project addresses security and best practices.

TODO: Mention relevant items such as:

- MySQLi procedural prepared statements;
- protection against SQL injection;
- escaping database output with `htmlspecialchars()`;
- validating query string values;
- validating form input;
- validating uploaded files;
- unique uploaded filenames;
- not relying on original uploaded filenames;
- server-side ownership checks;
- session-based access control;
- flash messages;
- not displaying raw database errors to users on the deployed site.

---

## 18. Accessibility and Usability

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
- clear user feedback;
- error and success messages;
- authenticated and anonymous user experience.

---

## 19. Testing and Validation

Complete this section after testing your website.

### Rendered HTML Validation

| Page | Result | Notes |
|---|---|---|
| `index.php` | TODO: Pass / Issues found | TODO |
| `books.php` | TODO: Pass / Issues found | TODO |
| `gallery.php` | TODO: Pass / Issues found | TODO |
| `details.php` | TODO: Pass / Issues found | TODO |
| `seller.php` | TODO: Pass / Issues found | TODO |
| `search.php` | TODO: Pass / Issues found | TODO |
| `register.php` | TODO: Pass / Issues found | TODO |
| `login.php` | TODO: Pass / Issues found | TODO |
| `add.php` | TODO: Pass / Issues found | TODO |
| `edit.php` | TODO: Pass / Issues found | TODO |

### CSS Validation

| File | Result | Notes |
|---|---|---|
| `assets/css/style.css` | TODO: Pass / Issues found | TODO |

### Functionality Testing

| Feature tested | Result | Notes |
|---|---|---|
| Navigation links | TODO | TODO |
| Database connection | TODO | TODO |
| Latest books display | TODO | TODO |
| Books table | TODO | TODO |
| Book status filter | TODO | TODO |
| Details page query string | TODO | TODO |
| Seller page query string | TODO | TODO |
| Search | TODO | TODO |
| Gallery modal | TODO | TODO |
| Registration | TODO | TODO |
| Login | TODO | TODO |
| Logout | TODO | TODO |
| Session flash messages | TODO | TODO |
| Add Book form validation | TODO | TODO |
| Image upload | TODO | TODO |
| Image preview | TODO | TODO |
| Edit Book | TODO | TODO |
| Delete confirmation | TODO | TODO |
| Owner-only access | TODO | TODO |
| Anonymous user access | TODO | TODO |
| Deployed site links/assets | TODO | TODO |
| Deployed database content | TODO | TODO |

---

## 20. Deployment

Provide details of your deployed website.

| Item | Details |
|---|---|
| Deployed website URL | TODO |
| Jacob 5 database name | TODO |
| Deployment folder | TODO |
| `.htaccess` location | TODO |
| Upload folder permissions | TODO |

TODO: In 2–4 sentences, explain how you checked that the deployed website, authentication, uploads, and database functionality work correctly.

---

## 21. Git and Development Process

Briefly describe how you used Git during the project.

TODO: Explain:

- how often you committed changes;
- what types of changes your commits show;
- how your Git history shows progressive development;
- how your commits relate to your process-evidence records.

---

## 22. AI Use Declaration

AI tools are required for this assessment.

Confirm the following:

- [ ] I used AI tools meaningfully during this assessment.
- [ ] I recorded meaningful AI use in `process-evidence.md`.
- [ ] I reviewed, tested, and adapted AI-assisted output.
- [ ] I can explain all AI-assisted code submitted.

TODO: Write 2–5 sentences explaining how AI tools supported your development.

Detailed AI usage records must be included in `process-evidence.md`.

---

## 23. Process Evidence

Confirm that your process evidence file has been completed.

| Requirement | Completed? |
|---|---|
| `process-evidence.md` file included | TODO: Yes / No |
| At least 5 debugging records included | TODO: Yes / No |
| At least 5 meaningful AI usage records included | TODO: Yes / No |
| Relevant commit links included | TODO: Yes / No |

---

## 24. Known Issues or Limitations

List any known issues or limitations in your submitted project.

| Issue or limitation | Explanation |
|---|---|
| TODO | TODO |
| TODO | TODO |

If there are no known issues, write:

> No known issues at the time of submission.
