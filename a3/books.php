<?php 
include('includes/tools.inc');
include('includes/db_connect.inc');
$pageName = 'Browse Books';
$fileName = 'books.php';
include_once('includes/header.inc'); 
?>

    <header>
       <?php include_once('includes/nav.inc'); ?>
       <?php showFlashAlerts(); ?>
    </header>

    <main>
        <!-- Book Table -->
        <section class="books-section">
            <div class="books-container">
                <div class="books-heading">
                    <span class="material-icons my-4">
                        library_books
                    </span>
                    <h1>All Books</h1>
                </div>

                <?php 
                // Get all books from the table
                $sql = "SELECT books.book_id, books.user_id, books.title, books.author, books.genre, books.publication_year, books.price, books.status,
                users.username 
                FROM books 
                LEFT JOIN users ON books.user_id = users.user_id
                ORDER BY books.book_id";
                $result = mysqli_query($conn, $sql);
               // Get the distinct status values to build the filter dropdown
                $statusSql = "SELECT DISTINCT status FROM books ORDER BY status";
                $statusResult = mysqli_query($conn, $statusSql);
                ?>
               



                <div class="filter-panel">
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="all" selected>Show All</option>
                        <!-- Filter dropdown from $statusResult -->
                        <?php while ($statusRow = mysqli_fetch_assoc($statusResult)) { ?>
                            <option value="<?= htmlspecialchars($statusRow['status']) ?>">
                                <?= htmlspecialchars($statusRow['status']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="table-responsive books-table-wrapper">
                    <table class="table books-table">
                        <thead>
                            <tr class="value">
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Year</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Seller</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <tr class="value" data-status="<?= htmlspecialchars($row['status']) ?>">
                                        <th scope="row">
                                            <a href="details.php?id=<?= urlencode((int)$row['book_id']) ?>">
                                                <?= htmlspecialchars($row['title']) ?>
                                            </a>
                                        </th>
                                        <td><?= htmlspecialchars($row['author']) ?></td>
                                        <td><?= htmlspecialchars($row['genre']) ?></td>
                                        <td><?= htmlspecialchars($row['publication_year']) ?></td>
                                        <td>$<?= htmlspecialchars($row['price']) ?></td>
                                        <td>
                                            <span class="table-status status-<?= strtolower(htmlspecialchars($row['status'])) ?>">
                                                <?= htmlspecialchars($row['status']) ?>
                                            </span>
                                        </td>
                                        <td><a href="seller.php?id=<?= urlencode((int)$row['user_id']) ?>" 
                                        class="username"><?= htmlspecialchars($row['username']) ?></a></td>
                                    </tr>
                                <?php }
                                } else {
                                    echo '<tr><td colspan="6">No books found.</td></tr>';
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
<?php include_once('includes/footer.inc'); ?>