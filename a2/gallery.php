<?php 
include('includes/db_connect.inc');
$pageName = 'Gallery';
$fileName = 'gallery.php';
include_once('includes/header.inc'); 

$sql = "SELECT book_id, title, author, genre, publication_year, price, image_path, status FROM books ORDER BY book_id";
$result = mysqli_query($conn, $sql);
?>

    <header>
        <?php include_once('includes/nav.inc'); ?>
    </header>

    <main>
        <!-- Gallery -->
        <section class="gallery-section">
            <div class="gallery-container">
                <div class="gallery-heading">
                    <span class="material-icons my-4">
                        image_search
                    </span>
                    <h1>Book Cover Gallery</h1>
                </div>

                <div class="row gallery-grid g-2">
                    <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="col-6 col-sm-4 col-lg-2">
                                <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                                    data-bs-target="#imageModal" data-image="assets/images/covers/<?= htmlspecialchars($row['image_path']) ?>"
                                    data-title="<?= htmlspecialchars($row['title']) ?> by <?= htmlspecialchars($row['author']) ?>">
                                    <img src="assets/images/covers/<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['title']) ?> book cover">
                                </button>
                            </div>
                        <?php } ?>
                        <?php } else { ?>
                            <p>No books found.</p>
                        <?php } ?>
                
            <!-- Image modal -->
            <div class="modal" id="imageModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title" id="imageModalLabel">Image preview
                            </h2>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="modalImage" src="data:," class="img-fluid" alt="Preview">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn modal-button previous-button">‹ Previous</button>
                            <button type="button" class="btn modal-button next-button">Next ›</button>
                        </div>
                    </div>
                </div>
            </div>




        </section>
    </main>
   <?php include_once('includes/footer.inc'); ?>
   