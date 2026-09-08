<?php 
$pageName = 'Gallery';
$fileName = 'gallery.php';
include_once('includes/header.inc'); 
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
                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/1.png"
                            data-title="The Midnight Library by Matt Haig">
                            <img src="assets/images/covers/1.png" alt="The Midnight Library book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/2.png"
                            data-title="Project Hail Mary by Andy Weir">
                            <img src="assets/images/covers/2.png" alt="Project Hail Mary book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/3.png" data-title="Dune by Frank Herbert">
                            <img src="assets/images/covers/3.png" alt="Dune book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/4.png"
                            data-title="The Hobbit by J.R.R Tolkien">
                            <img src="assets/images/covers/4.png" alt="The Hobbit book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/5.png" data-title="1984 by George Orwell">
                            <img src="assets/images/covers/5.png" alt="1984 book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/6.png"
                            data-title="Pride and Prejudice by Jane Austen">
                            <img src="assets/images/covers/6.png" alt="Pride and Prejudice book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/7.png"
                            data-title="To Kill a Mockingbird by Harper Lee">
                            <img src="assets/images/covers/7.png" alt="To Kill a Mockingbird book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/8.png"
                            data-title="The Great Gatsby by F. Scott Fitzgerald">
                            <img src="assets/images/covers/8.png" alt="The Great Gatsby book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/9.png" data-title="Educated by Tara Westover">
                            <img src="assets/images/covers/9.png" alt="Educated">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/10.png"
                            data-title="The Seven Husbands by Taylor Jenkins Reid">
                            <img src="assets/images/covers/10.png" alt="The Seven Husbands book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/11.png"
                            data-title="Atomic Habits by James Clear">
                            <img src="assets/images/covers/11.png" alt="Atomic Habits book cover">
                        </button>
                    </div>

                    <div class="col-6 col-sm-4 col-lg-2">
                        <button class="gallery-image-button" type="button" data-bs-toggle="modal"
                            data-bs-target="#imageModal" data-image="assets/images/covers/12.png" data-title="Sapiens by Yuval Noah Harari">
                            <img src="assets/images/covers/12.png" alt="Sapiens book cover">
                        </button>
                    </div>
                </div>
            </div>




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
   