<?php 
include('includes/tools.inc');

if(!isset($_SESSION['user_id'])) {
    $_SESSION['failure'] = "Please log in to edit a book.";
    header("Location: login.php");
    exit;
}

// Validate book_id from GET parameter
$book_id = filter_input(INPUT_GET, 'book_id', FILTER_VALIDATE_INT);


if(!$book_id || $book_id < 1) {
    $_SESSION['failure'] = "No book selected.";
    header("Location: books.php");
    exit;
}    

include('includes/db_connect.inc');

$sql = "SELECT book_id, title, author, genre, publication_year, price, isbn, book_condition, description, image_path, status, user_id 
FROM books WHERE book_id=? AND user_id=?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    $_SESSION['failure'] = "The edit form could not be loaded.";
    header("Location: books.php");
    exit;
}

$user_id = $_SESSION['user_id'];

mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$book) {
    $_SESSION['failure'] = "Book not found or you do not have permission to edit this book.";
    header("Location: books.php");
    exit;
}

$pageName = 'Edit Book';
$fileName = 'edit.php';
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
                    edit
                </span>
                <h1>Edit Book</h1>
            </div>
             <?php showFlashAlerts(); ?>                                       
            <form id="editBook" class="add-book-form" method="POST" action="process_edit.php" enctype="multipart/form-data">
            <input type="hidden" name="book_id" value="<?= (int) $book['book_id'] ?>">  
                <!-- method="post" tells the browser to send the form data to process_add.php for processing when the form is submitted.
                     action="process_add.php" tells the brwoser where to send the data when the form is submitted. 
                     enctype="multipart/form-data" is necessary for file uploads. -->
                <div class="mb-3">
                    <label for="title" class="form-label d-flex align-items-center">
                       
                        Title *</label>
                    <input type="text" class="form-control" id="title" name ="title" required value="<?php echo htmlspecialchars($book["title"]); ?>">
                </div>

                <div class="mb-3">
                    <label for="author" class="form-label d-flex align-items-center">
                      
                        Author *</label>
                    <input type="text" class="form-control" id="author" name ="author" required value="<?php echo htmlspecialchars($book["author"]); ?>">
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label d-flex align-items-center">
                      
                        Genre *</label>

                    <select class="form-select" id="genre" name="genre" required> 
                        <optgroup label="Current selection">
                            <option value="<?= htmlspecialchars($book['genre']); ?>" selected><?= htmlspecialchars($book['genre']); ?></option>
                        </optgroup>
                        <optgroup label="Change genre">
                        <option value="Fiction" <?= $book["genre"] === "Fiction" ? "selected" : "" ?>>Fiction</option>
                        <option value="Science Fiction" <?= $book["genre"] === "Science Fiction" ? "selected" : "" ?>>Science Fiction</option>
                        <option value="Fantasy" <?= $book["genre"] === "Fantasy" ? "selected" : "" ?>>Fantasy</option>
                        <option value="Dystopian" <?= $book["genre"] === "Dystopian" ? "selected" : "" ?>>Dystopian</option>
                        <option value="Romance" <?= $book["genre"] === "Romance" ? "selected" : "" ?>>Romance</option>
                        <option value="Memoir" <?= $book["genre"] === "Memoir" ? "selected" : "" ?>>Memoir</option>
                        <option value="Self-Help" <?= $book["genre"] === "Self-Help" ? "selected" : "" ?>>Self-Help</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="price" class="form-label d-flex align-items-center">
                            
                            Price *</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="19.99" required value="<?php echo htmlspecialchars($book["price"]); ?>">
                    </div>
                
                    <div class="col">
                        <label for="book_condition" class="form-label d-flex align-items-center">
                          
                            Condition *</label>
                        <select class="form-select" id="book_condition" name="book_condition" required>
                            <optgroup label="Current selection">
                            <option value="<?= htmlspecialchars($book['book_condition']); ?>" selected><?= htmlspecialchars($book['book_condition']); ?></option>
                        </optgroup>
                        <optgroup label="Change condition">
                            <option value="New" <?= $book["book_condition"] === "New" ? "selected" : "" ?>>New</option>
                            <option value="Gently Used" <?= $book["book_condition"] === "Gently Used" ? "selected" : "" ?>>Gently Used</option>
                            <option value="Fair" <?= $book["book_condition"] === "Fair" ? "selected" : "" ?>>Fair</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="description" class="form-label d-flex align-items-center">
                         
                            Description *</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe the book..."
                            required><?php echo htmlspecialchars($book["description"]); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label d-flex align-items-center">
                        
                            Status *</label>
                        <select class="form-select" id="status" name="status" required>
                            <optgroup label="Current selection">
                            <option value="<?= htmlspecialchars($book['status']); ?>" selected><?= htmlspecialchars($book['status']); ?></option>
                        </optgroup>
                        <optgroup label="Change status">
                            <option value="Available" <?= $book["status"] === "Available" ? "selected" : "" ?>>Available</option>
                            <option value="Reserved" <?= $book["status"] === "Reserved" ? "selected" : "" ?>>Reserved</option>
                            <option value="Sold" <?= $book["status"] === "Sold" ? "selected" : "" ?>>Sold</option>
                        </select>
                    </div>

                 <div class="mb-3">
                        <label for="image_path" class="form-label d-flex align-items-center">
                         
                            Cover Image</label>
                        <input type="file" class="form-control" id="image_path" name="image_path"
                            accept=".jpg,.jpeg,.png,.gif,.webp">

                        <img width="200" height="150" src="assets/images/covers/<?= htmlspecialchars($book["image_path"]) ?>" alt="Current cover for <?= htmlspecialchars($book["title"]) ?>" class="img-fluid mt-2">
                        <p id="currentImage">Current image - upload a new one to replace it.</p>
                    </div>

                <div class="submit-button mt-3">
                    <button type="submit" class="btn add-book-button">
                        <span class="material-icons">
                            save
                        </span>
                        Save Changes</button>
                </div>

            </form>
        </div>
        <div id="errorMsg" aria-live="polite"></div>

    </main>
<?php include_once('includes/footer.inc'); ?>

