<?php 
include('includes/tools.inc');
include('includes/db_connect.inc');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1 ) {
    $_SESSION['failure'] = 'Invalid book selected.';
    header('Location: books.php');
    exit;
}

$sql = "SELECT book_id, user_id, title, author, genre, publication_year, isbn, book_condition, price, description, status, image_path 
        FROM books 
        WHERE book_id = ?"; 

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

    <header>
        <?php include_once('includes/nav.inc'); ?>
    </header>

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

                             <?php if (!$logged_in): ?> 
                                <!-- Visitor NOT loggged in-->
                            <a href="add.php" class="btn details-add-button">
                                <span class="material-icons">add</span>
                                Add Similar Book
                            </a>
                    
                        <?php elseif ($is_owner): ?> 
                            <!-- Loggged in & Owner of the books-->
                               <a href="edit.php?book_id=<?= (int) $book['book_id'] ?>" class="btn btn-warning edit-edit-button">
                                Edit
                            </a>

                            <a href="process_delete.php?book_id=<?= (int) $book['book_id'] ?>" class="btn btn-danger edit-delete-button">
                                Delete
                            </a>

                        <?php else: ?>
                            <!-- Loggged in but NOT Owner of the books-->
                        
                       <?php endif; ?>
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
    </main>
<?php include_once('includes/footer.inc'); ?>