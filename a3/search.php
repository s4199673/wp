<?php
include('includes/tools.inc');
include('includes/db_connect.inc');

$pageName = 'Search Books';
$fileName = 'search.php';

// Get the search term safely.
$search_term = trim($_GET["q"] ?? "");
$books = [];

if (!empty($search_term)) {
    $search = "%" . strtolower($search_term) . "%";

    // Search the title, author and description.
    $sql = "SELECT book_id, title, author, description, image_path
            FROM books
            WHERE LOWER(title) LIKE ?
            OR LOWER(author) LIKE ?
            OR LOWER(description) LIKE ?
            ORDER BY title";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("The search query could not be prepared.");
    }

    mysqli_stmt_bind_param($stmt, "sss", $search, $search, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    mysqli_stmt_close($stmt);
}

include_once('includes/header.inc');
?>

<header>
    <?php include_once('includes/nav.inc'); ?>
    <?php showFlashAlerts(); ?>
</header>

<main>
    <section class="search-section">
        <div class="search-container">
            <div class="search-heading">
                <span class="material-icons">search</span>
                <h1>Search Books</h1>
            </div>

            <form method="get" action="search.php" class="search-form">
                <label for="searchTerm" class="visually-hidden">Search books</label>
                <input type="text" id="searchTerm" name="q" value="<?= htmlspecialchars($search_term); ?>"
                    placeholder="Search by title, author, or description">
                <button type="submit" class="search-button">Search</button>
            </form>

            <?php if (empty($search_term)) { ?>
                <p class="search-message">Enter a keyword to search for books.</p>
            <?php } elseif (count($books) === 0) { ?>
                <p class="search-message">
                    No books found for: <strong><?= htmlspecialchars($search_term); ?></strong>
                </p>
            <?php } else { ?>
                    <div class="row search-results g-3">
                    <?php foreach ($books as $book) { ?>
                        <article class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card search-card h-100">
                                <img src="assets/images/covers/<?= htmlspecialchars($book['image_path']); ?>"
                                    class="card-img-top"
                                    alt="<?= htmlspecialchars($book['title']); ?> book cover">
                                <div class="card-body">
                                    <h2 class="card-title"><?= htmlspecialchars($book['title']); ?></h2>
                                    <p class="card-author">
                                        by <?= htmlspecialchars($book['author']); ?>
                                    </p>
                                    <a href="details.php?id=<?= (int) $book['book_id']; ?>"
                                        class="btn view-details-button">
                                        View
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php include_once('includes/footer.inc'); ?>
