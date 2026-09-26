<?php 
include('includes/db_connect.inc');
$pageName = 'Home';
$fileName = 'index.php';
include_once('includes/header.inc'); 
?>

    <header>
        <?php include_once('includes/nav.inc'); ?>

    </header>

    <main>
       <?php $sql = "SELECT book_id, title, author, genre, description,
               price, image_path, status
        FROM books
        ORDER BY book_id ASC
        LIMIT 4";
       $result = mysqli_query($conn, $sql);?>

        
        <!-- Carousel -->
        <section class="container-fluid px-0 my-4">
            <div id="bookCarousel" class="carousel slide" data-bs-ride="carousel">
                
                <!-- Indicators/dots -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#bookCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="First slide"></button>
                    <button type="button" data-bs-target="#bookCarousel" data-bs-slide-to="1"
                        aria-label="Second slide"></button>
                    <button type="button" data-bs-target="#bookCarousel" data-bs-slide-to="2"
                        aria-label="Third slide"></button>
                    <button type="button" data-bs-target="#bookCarousel" data-bs-slide-to="3"
                        aria-label="Fourth slide"></button>
                </div>
            
        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/covers/1.png" class="d-block w-100" alt="Moonlit circular library">
                <div class="carousel-caption d-none d-md-block">
                    <h4>The Midnight Library</h4>
                    <a href="details.php?id=1" class="btn view-details-button">
                        <span class="material-icons">
                            visibility
                        </span>
                        View Details</a>
                </div>
            </div>
        
        <div class="carousel-item">
            <img src="assets/images/covers/2.png" class="d-block w-100" alt="Astronaut floating in space">
            <div class="carousel-caption d-none d-md-block">
                <h4>Project Hail Mary</h4>
                <a href="details.php?id=2" class="btn view-details-button">
                    <span class="material-icons">
                        visibility
                    </span>
                    View Details</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="assets/images/covers/3.png" class="d-block w-100" alt="A person walking in a desert">
            <div class="carousel-caption d-none d-md-block">
                <h4>Dune</h4>
                <a href="details.php?id=3" class="btn view-details-button">
                    <span class="material-icons">
                        visibility
                    </span>
                    View Details</a>
            </div>
        </div>

        <div class="carousel-item">
            <img src="assets/images/covers/4.png" class="d-block w-100" alt="Doorway to a hobbit hole in a hill">
            <div class="carousel-caption d-none d-md-block"> 
                <h4>The Hobbit</h4>
                <a href="details.php?id=4" class="btn view-details-button">
                    <span class="material-icons">
                        visibility
                    </span>
                    View Details</a>
            </div>
        </div>
        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next">
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
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {

        ?>
            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/<?= htmlspecialchars($row['image_path']); ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']); ?> book cover">
                    <div class="card-body">
                        <h3 class="card-title"><?= htmlspecialchars($row['title']); ?></h3>
                        <p class="card-text"><?= htmlspecialchars($row['author']); ?></p>
                        <p class="book-price"><?= htmlspecialchars($row['price']); ?></p>
                        <a href="details.php?id=<?= (int)$row['book_id']; ?>" class="btn view-details-button">
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
