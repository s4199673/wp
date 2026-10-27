<?php 
include('includes/tools.inc');
include('includes/db_connect.inc');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1 ) {
    $_SESSION['failure'] = 'Invalid book selected.';
    header('Location: books.php');
    exit;
}

$sql = "SELECT books.book_id, books.user_id, books.title, books.author, books.genre, books.publication_year, books.isbn, books.book_condition, books.price, books.description, books.status, books.image_path, users.username AS seller_username
        FROM books 
        LEFT JOIN users ON books.user_id = users.user_id
        WHERE books.book_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
error_log(mysqli_error($conn));
$_SESSION['failure'] = 'Book details could not be loaded.';
header('Location: books.php');
exit;
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$book) {
    $_SESSION['failure'] = 'Book not found.';
    header('Location: books.php');
    exit;
}

$logged_in = isset($_SESSION['user_id']);
$is_owner = $logged_in && (int) $_SESSION['user_id'] === (int) $book['user_id'];

$pageName = 'Book Details';
$fileName = 'details.php';
include_once('includes/header.inc'); 
?>



    <main>
         <?php showFlashAlerts(); ?>   
    
        <?php if ($book) { ?>
            <section class="book-details-section">
            <div class="book-details-container">
                <div class="book-details-image">
                    <img src="assets/images/covers/<?= htmlspecialchars($book['image_path']); ?>" 
                    alt="<?= htmlspecialchars($book['title']); ?> book cover">
                </div>

                <div class="book-details-info">
                    <h1><?= htmlspecialchars($book['title']); ?></h1>
                    <p class="book-author">by <?= htmlspecialchars($book['author']); ?></p>

                    <span class="table-status status-<?= strtolower(htmlspecialchars($book['status'])); ?>">
                        <?= htmlspecialchars($book['status']); ?>
                    </span>

                    <table class="details-table">
                        <tbody>
                            <tr>
                                <th>Genre</th>
                                <td><?= htmlspecialchars($book['genre']); ?></td>
                            </tr>
                            <tr>
                                <th>Publication Year:</th>
                                <td><?= htmlspecialchars($book['publication_year']); ?></td>
                            </tr>
                            <tr>
                                <th>ISBN:</th>
                                <td><?= htmlspecialchars($book['isbn']); ?></td>
                            </tr>
                            <tr>
                                <th>Condition:</th>
                                <td><?= htmlspecialchars($book['book_condition']); ?></td>
                            </tr>
                            <tr>
                                <th>Price:</th>
                                <td class="details-price">$<?= htmlspecialchars(number_format($book['price'], 2)); ?></td>
                            </tr>
                            <tr>
                                <th>Seller:</th>
                                <td><a href="seller.php?id=<?= urlencode((int)$book['user_id']) ?>"
                                class="username"><?= htmlspecialchars($book['seller_username']); ?></a></td>
                            </tr>
                        </tbody>
                    </table>

                <div class="details-card-row">
                    <h2 class="details-card-label">Description</h2>
                    <p class="details-description"><?= (htmlspecialchars($book['description'])); ?></p>
                </div>
                        <div class="details-actions"> 
                            <!-- Always displayed for every visitor -->
                                <a href="books.php" class="btn details-back-button">
                                Back
                            </a>

                             <?php if (!$logged_in) { ?> 
                                <!-- Visitor NOT logged in-->
                            <a href="add.php" class="btn details-add-button">
                                <span class="material-icons">add</span>
                                Add Similar Book
                            </a>
                    
                        <?php } elseif ($is_owner) { ?> 
                            <!-- Logged in and owner of the book-->
                               <a href="edit.php?book_id=<?= (int) $book['book_id'] ?>" class="btn btn-warning edit-edit-button">
                                Edit
                            </a>

                           <button type="button"
                               class="btn btn-danger edit-delete-button"
                               id="deleteButton"
                               data-bs-toggle="modal"
                               data-bs-target="#deleteModal">
                               Delete
                           </button>

                        <?php } else { ?>
                            <!-- Logged in but not the owner of the book-->
                        
                       <?php } ?>
                        </div>
                </div>
            </div>
            </section>
            <?php } else { ?>
        <section class="details-section">
            <div class="details-container">
                <p>Book Not Found</p>
                <a href="books.php" class="btn details-back-button">Back to Browse Books</a>
            </div>
        </section>
        <?php } ?>

        
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="deleteModalLabel">
                Delete book?
                </h2>
                <button type="button" class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete <strong><?= htmlspecialchars($book['title']) ?></strong>? 
                This action cannot be undone.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">
                    Cancel
                </button>

                <form method="post" action="process_delete.php">
                    <input type="hidden" name="book_id"
                        value="<?= (int) $book['book_id'] ?>">
                    <button type="submit" class="btn btn-danger">
                        Delete book
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
    </main>
<?php include_once('includes/footer.inc'); ?>