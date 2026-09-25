<?php 
include('includes/db_connect.inc');
$pageName = 'Add Book';
$fileName = 'add.php';
include_once('includes/header.inc'); 
?>

    <header>
       <?php include_once('includes/nav.inc'); ?>
    </header>

    <main>
        <!-- Form -->
        <div class="add-book-container">
            <div class="add-book-heading">
                <span class="material-icons my-4">
                    add_box
                </span>
                <h1>Add New Book</h1>
            </div>
                                                     
            <form id="addBook" class="add-book-form" method="POST" action="process_add.php" enctype="multipart/form-data">
                <!-- method="post" tells the browser to send the form data to process_add.php for processing when the form is submitted.
                     action="process_add.php" tells the brwoser where to send the data when the form is submitted. 
                     enctype="multipart/form-data" is necessary for file uploads. -->
                <div class="mb-3">
                    <label for="title" class="form-label d-flex align-items-center">
                        <span class="material-icons">
                            title
                        </span>
                        Book Title</label>
                    <input type="text" class="form-control" id="title" name ="title" placeholder="Enter book title" required>
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label d-flex align-items-center">
                        <span class="material-icons">
                            person
                        </span>
                        Author Name</label>
                    <input type="text" class="form-control" id="author" name ="author" placeholder="Enter author name" required>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label d-flex align-items-center">
                        <span class="material-icons">
                            category
                        </span>
                        Genre</label>

                    <select class="form-select" id="genre" name="genre" required>
                        <option value="">Select a genre</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Science Fiction">Science Fiction</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Dystopian">Dystopian</option>
                        <option value="Romance">Romance</option>
                        <option value="Memoir">Memoir</option>
                        <option value="Self-Help">Self-Help</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="publication_year" class="form-label d-flex align-items-center">
                            <span class="material-icons">
                                calendar_today
                            </span>
                            Publication Year</label>
                        <input type="number" class="form-control" id="publication_year" name="publication_year" placeholder="2024" required>
                    </div>
                    <div class="col">
                        <label for="price" class="form-label d-flex align-items-center">
                            <span class="material-icons">
                                attach_money
                            </span>
                            Price ($)</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="19.99" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="isbn" class="form-label d-flex align-items-center">
                            ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="978-1-234567-89-0" required>
                    </div>
                    <div class="col">
                        <label for="book_condition" class="form-label d-flex align-items-center">
                            <span class="material-icons">
                                assignment
                            </span>
                            Book Condition</label>
                        <select class="form-select" id="book_condition" name="book_condition" required>
                            <option value="">Select condition</option>
                            <option value="New">New</option>
                            <option value="Gently Used">Gently Used</option>
                            <option value="Fair">Fair</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label for="description" class="form-label d-flex align-items-center">
                            <span class="material-icons">
                                description
                            </span>
                            Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the book..."
                            required></textarea>
                    </div>

                    <div class="mb-1">
                        <label for="image_path" class="form-label d-flex align-items-center">
                            <span class="material-icons">
                                image
                            </span>
                            Upload Cover Image</label>
                        <input type="file" class="form-control" id="image_path" name="image_path"
                            accept=".jpg,.jpeg,.png,.gif,.webp" required>

                            <p id="selectedFileName" class="selected-file-name"></p>

                        <img id="imagePreview" src="" alt="Selected book cover preview" class="img-fluid mt-2 d-none">

                    </div>


                    <div class="mb-1">
                        <label for="status" class="form-label d-flex align-items-center">
                            <span class="material-icons">
                                check_circle
                            </span>
                            Availability Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="">Select status</option>
                            <option value="Available">Available</option>
                            <option value="Reserved">Reserved</option>
                            <option value="Sold">Sold</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="agree" name="agree" required>
                            <label for="agree" class="form-check-label">
                                I agree that this book information is accurate and complete
                            </label>
                        </div>
                    </div>

                </div>

                <div class="submit-button">
                    <button type="submit" class="btn add-book-button">
                        <span class="material-icons">
                            save
                        </span>
                        Add Book to Collection</button>
                </div>

            </form>
        </div>
        <div id="errorMsg" aria-live="polite"></div>


    </main>
<?php include_once('includes/footer.inc'); ?>
