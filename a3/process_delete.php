<?php
include('includes/tools.inc');
include('includes/db_connect.inc');

/*login check */
if (!isset($_SESSION['user_id'])) {
    $_SESSION['warning'] = 'Please log in to delete a book.';
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $book_id = filter_input(INPUT_GET, 'book_id', FILTER_VALIDATE_INT);
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
} else {
    $_SESSION['failure'] = 'Invalid request method.';
    header('Location: books.php');
    exit;
}

if (!$book_id || $book_id < 1) {
    $_SESSION['failure'] = 'Invalid book selected.';
    header('Location: books.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT book_id, user_id, title, author, genre, publication_year,
               isbn, book_condition, price, description, status, image_path
        FROM books
        WHERE book_id = ? AND user_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    $_SESSION['failure'] = 'Book details could not be loaded.';
    header('Location: books.php');
    exit;
}

mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);

if (!mysqli_stmt_execute($stmt)) {
    error_log(mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    $_SESSION['failure'] = 'Book details could not be loaded.';
    header('Location: books.php');
    exit;
}

$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$book) {
    $_SESSION['failure'] = 'Book not found or you do not have permission to delete it.';
    header('Location: books.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM books WHERE book_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        error_log(mysqli_error($conn));
        $_SESSION['failure'] = 'The book could not be deleted.';
        header('Location: details.php?id=' . urlencode($book_id));
        exit;
    }

      mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);


      if (!mysqli_stmt_execute($stmt)) {
        error_log(mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);

        $_SESSION['failure'] = 'The book could not be deleted.';
        header('Location: details.php?id=' . urlencode($book_id));
        exit;
    }

    $deleted_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($deleted_rows !== 1) {
        $_SESSION['failure'] = 'The book could not be deleted.';
        header('Location: books.php');
        exit;
    }

    /* delete the image only after the databse record has been deleted successfully */
        $image_path = __DIR__ . '/assets/images/covers/' . $book['image_path'];

    if (is_file($image_path) && !unlink($image_path)) {
        error_log('Could not remove book cover: ' . $image_path);
        $_SESSION['warning'] = 'The book was deleted, but its cover image could not be removed.';
    } else {
        $_SESSION['success'] = 'Book deleted successfully.';
    }

    header('Location: index.php');
    exit;
}

$pageName = 'Delete Book';
$fileName = 'process_delete.php';

include_once('includes/header.inc');
?>

<header>
        <?php include_once('includes/nav.inc'); ?>
        <?php showFlashAlerts(); ?> 

    </header>

    <main>

    <section class ="book-details-section">
        <div class="book-details-container">
            <div class="book-details-image">
                <img src="assets/images/covers/<?= htmlspecialchars($book['image_path']); ?>" 
                alt="<?= htmlspecialchars($book['title']); ?> book cover">
            </div>

            <div class="book-details-info">
                <h1><?= htmlspecialchars($book['title']); ?></h1>

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
                            <th>Author</th>
                            <td><?= htmlspecialchars($book['author']); ?></td>                                                                            
                        </tr>
                        <tr>
                            <th>Publication Year</th>
                            <td><?= htmlspecialchars($book['publication_year']); ?></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>$<?= htmlspecialchars(number_format($book['price'], 2)); ?></td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <td><?= htmlspecialchars($book['isbn']); ?></td>
                        </tr>
                        <tr>
                            <th>Condition</th>
                            <td><?= htmlspecialchars($book['book_condition']); ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?= htmlspecialchars($book['description']); ?></td>
                        </tr>

                    </tbody>
                </table>


                <div class ="details-actions">
                <a href="details.php?id=<?= (int) $book['book_id'] ?>" class="btn details-back-to-details-btn">
                    Back</a>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </section>
    </main>

    <!-- Delete Confirmation Modal -->
<div class="modal fade confirm-delete-modal" id="confirmDeleteModal" tabindex="-1"
     aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="confirmDeleteLabel">Delete book?</h2>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>Are you sure you want to delete <strong><?= htmlspecialchars($book['title']) ?></strong>? This action cannot be undone.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>

                <form method="POST" action="process_delete.php">
                    <input type="hidden" name="book_id" value="<?= (int) $book['book_id'] ?>">

                    <button type="submit" class="btn btn-danger">
                        Delete book
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
                    
<?php include_once('includes/footer.inc'); ?>