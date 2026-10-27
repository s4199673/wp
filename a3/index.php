<?php 
include('includes/tools.inc');
include('includes/db_connect.inc');
$pageName = 'Home';
$fileName = 'index.php';
include_once('includes/header.inc'); 
?>

    <header>
        <?php include_once('includes/nav.inc'); ?>
        <?php showFlashAlerts(); ?>
    </header>

    <main>
<?php
$sql = "SELECT books.book_id, books.user_id, books.title, books.author, books.genre, books.description, books.price, books.image_path,
        books.status, users.username
        FROM books
        LEFT JOIN users ON books.user_id = users.user_id
        ORDER BY books.book_id DESC
        LIMIT 4";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die("The books query could not be prepared.");
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$books = [];

while ($row = mysqli_fetch_assoc($result)) {
    $books[] = $row;
}

mysqli_stmt_close($stmt);
?>
        
        <!-- Carousel -->
        <section class="container-fluid px-0 my-4">
            <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <?php foreach ($books as $index => $book) { ?>
                        <button type="button" data-bs-target="#bookCarousel"
                            data-bs-slide-to="<?= $index ?>"
                            class="<?= $index === 0 ? 'active' : '' ?>"
                            <?= $index === 0 ? 'aria-current="true"' : '' ?>
                            aria-label="Slide <?= $index + 1 ?>"></button>
                    <?php } ?>
                </div>
            
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <?php foreach ($books as $index => $book) { ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <img src="assets/images/covers/<?= htmlspecialchars($book['image_path']) ?>"
                        class="d-block w-100"
                        alt="<?= htmlspecialchars($book['title']) ?> book cover">
                    <div class="carousel-caption d-none d-md-block">
                        <h4><?= htmlspecialchars($book['title']) ?></h4>
                        <a href="details.php?id=<?= urlencode((int) $book['book_id']) ?>"
                            class="btn view-details-button">
                            <span class="material-icons">visibility</span>
                            View Details
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel"
            data-bs-slide="prev" <?= empty($books) ? 'disabled' : '' ?>>
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel"
            data-bs-slide="next" <?= empty($books) ? 'disabled' : '' ?>>
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
        </div>
        </section>

        <!-- Start Grid Cards -->
        <section class="featured-books mt-5">
            <div class="featured-heading">
                <span class="material-icons">
                    favorite
                </span>
                <h2>Featured Books</h2>
            </div>
        

        <div class="row book-grid g-3">
              <?php
if (count($books) > 0) {
    foreach ($books as $row) {
        ?>
            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/<?= htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']); ?> book cover">
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($row['title']); ?></h3>
                        <p class="card-author">
                        <?= htmlspecialchars($row['genre']) ?> &middot;    
                        <?= htmlspecialchars($row['author']); ?></p>
                        <p class="book-price">$<?= htmlspecialchars($row['price']); ?></p>
                        <a href="seller.php?id=<?= urlencode((int)$row['user_id']) ?>" class="username"><?= htmlspecialchars($row['username']) ?></a>
                        <a href="details.php?id=<?= urlencode((int)$row['book_id']) ?>" class="btn view-details-button">
                            <span class="material-icons">
                                visibility
                            </span>
                            View Details</a>
                       <!-- <button type="button" class="btn status-available"><?= htmlspecialchars($row['status']); ?></button> -->
                    </div>
                </div>
            </article>
            <?php 
            }
} else {
    echo "<p>No books found.</p>";

}
?>
        </div>

           </section>

    </main>
<?php include_once('includes/footer.inc'); ?>
