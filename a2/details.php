<?php 
include('includes/db_connect.inc');
$pageName = 'Book Details';
$fileName = 'details.php';
include_once('includes/header.inc'); 
?>

    <header>
        <?php include_once('includes/nav.inc'); ?>
    </header>

    <main>
    <?php  
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // Get the book ID from the query string if it exists and cast it to an integer
        $sql = "SELECT book_id, title, genre, publication_year, isbn, book_condition, price, description, status, image_path 
        FROM books 
        WHERE book_id = ?"; // id comes straight from the URL; placeholder and prepared statement ensure that it is treated as an integer and not executable code, preventing SQL injection
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $book = mysqli_fetch_assoc($result);
        ?>

        <?php if ($book) { ?>
            <section class="book-details-section">
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
                            <a href="books.php" class="btn details-back-button">
                                <span class="material-icons">arrow_back</span>
                                Back to Books
                            </a>
                            <a href="add.php" class="btn details-add-button">
                                <span class="material-icons">add</span>
                                Add Similar Book
                            </a>
                        </div>
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