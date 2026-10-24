<?php
include('includes/tools.inc');
include('includes/db_connect.inc');

$pageName = 'Seller page';
$fileName = 'seller.php';

//get the seller ID from the URL. Use 0 if it is missing.
$seller_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

include_once('includes/header.inc');
?>

<header>
    <?php include_once('includes/nav.inc'); ?>
</header>

<?php
$message = '';
$seller = false;
$result = false;

if ($seller_id <= 0) {
    $message = 'No valid seller was selected.';
} else {
    $sql = "SELECT user_id, username, location, bio
            FROM users
            WHERE user_id = ?";

    $seller_stmt = mysqli_prepare($conn, $sql);

    if ($seller_stmt) {
        mysqli_stmt_bind_param($seller_stmt, "i", $seller_id);
        mysqli_stmt_execute($seller_stmt);
        $seller_result = mysqli_stmt_get_result($seller_stmt);
        $seller = mysqli_fetch_assoc($seller_result);
        mysqli_stmt_close($seller_stmt);

        if (!$seller) {
            $message = 'Seller not found.';
        } else {
            $sql = "SELECT book_id, title, author, price, image_path, status
                    FROM books
                    WHERE user_id = ?
                    ORDER BY book_id ASC";

            $book_stmt = mysqli_prepare($conn, $sql);

            if ($book_stmt) {
                mysqli_stmt_bind_param($book_stmt, "i", $seller_id);
                mysqli_stmt_execute($book_stmt);
                $result = mysqli_stmt_get_result($book_stmt);

            } else {
                $message = "Seller's books could not be loaded.";
            }
        }
    } else {
        $message = 'Seller information could not be loaded.';
    }
}
?>

<main class="container my-4 seller-page">
    <?php if ($message != ''): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php else: ?>
        <div class="row g-4 seller-layout">
            <aside class="col-12 col-md-4">
                <section class="seller-profile">
                    <h1><?= htmlspecialchars($seller['username']) ?></h1>
                    <p class="seller-location">
                        <?= !empty($seller['location'])
                        ? htmlspecialchars($seller['location'])
                        : 'Location not provided' ?></p>
                    <p class="seller-bio">
                        <?= !empty($seller['bio'])
                        ? htmlspecialchars($seller['bio']) 
                        : 'No bio provided' ?></p>
                </section>
            </aside>

            <section class="col-12 col-md-8 seller-books">
                <h2>Books by <?= htmlspecialchars($seller['username']) ?></h2>

                <?php if ($result && mysqli_num_rows($result) > 0): ?>
    <div class="row g-3">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <article class="col-12 col-sm-6 col-lg-4"> 
                <div class="card book-card h-100">
                    <img
                        src="assets/images/covers/<?= htmlspecialchars($row['image_path']) ?>"
                        class="card-img-top"
                        alt="<?= htmlspecialchars($row['title']) ?> book cover">

                    <div class="card-body">
                        <h3 class="card-title">
                            <?= htmlspecialchars($row['title']) ?>
                        </h3>

                        <p class="card-price">
                            $<?= htmlspecialchars($row['price']) ?>
                        </p>

                        <a href="details.php?id=<?= urlencode((int)$row['book_id']) ?>"
                           class="btn view-details-button">
                            View
                        </a>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        </section>
    </div>
<?php endif; ?>
</main>

<?php
include "includes/footer.inc";
?>