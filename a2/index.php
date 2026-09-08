<?php 
$pageName = 'Home';
$fileName = 'index.php';
include_once('includes/header.inc'); 
?>

    <header>
        <?php include_once('includes/nav.inc'); ?>

    </header>

    <main>
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
                </div>
            </div>
        
        <div class="carousel-item">
            <img src="assets/images/covers/2.png" class="d-block w-100" alt="Astronaut floating in space">
            <div class="carousel-caption d-none d-md-block">
                <h4>Project Hail Mary</h4>
            </div>
        </div>

        <div class="carousel-item">
            <img src="assets/images/covers/3.png" class="d-block w-100" alt="A person walking in a desert">
            <div class="carousel-caption d-none d-md-block">
                <h4>Dune</h4>
            </div>
        </div>

        <div class="carousel-item">
            <img src="assets/images/covers/4.png" class="d-block w-100" alt="Doorway to a hobbit hole in a hill">
            <div class="carousel-caption d-none d-md-block"> 
                <h4>The Hobbit</h4>
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
            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/1.png" class="card-img-top" alt="The Midnight Library">
                   
                    <div class="card-body">
                        <h3 class="card-title">The Midnight Library</h3>
                        <p class="card-text">Fiction • Matt Haig</p>
                        <p class="book-price">$24.99</p>
                        <button type="button" class="btn status-available">Available</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/2.png" class="card-img-top" alt="Project Hail Mary">
                    <div class="card-body">
                        <h3 class="card-title">Project Hail Mary</h3>
                        <p class="card-text">Science Fiction • Andy Weir</p>
                        <p class="book-price">$28.99</p>
                        <button type="button" class="btn status-available">Available</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/3.png" class="card-img-top" alt="Dune">
                    <div class="card-body">
                        <h3 class="card-title">Dune</h3>
                        <p class="card-text">Science Fiction • Frank Herbert</p>
                        <p class="book-price">$22.99</p>
                        <button type="button" class="btn status-available">Available</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/4.png" class="card-img-top" alt="The Hobbit">
                    <div class="card-body">
                        <h3 class="card-title">The Hobbit</h3>
                        <p class="card-text">Fantasy • J.R.R. Tolkien</p>
                        <p class="book-price">$18.99</p>
                        <button type="button" class="btn status-available">Available</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/5.png" class="card-img-top" alt="1984">
                    <div class="card-body">
                        <h3 class="card-title">1984</h3>
                        <p class="card-text">Dystopian Fiction • George Orwell</p>
                        <p class="book-price">$16.99</p>
                        <button type="button" class="btn status-available">Available</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/6.png" class="card-img-top" alt="Pride and Prejudice">
                    <div class="card-body">
                        <h3 class="card-title">Pride and Prejudice</h3>
                        <p class="card-text">Romance • Jane Austen</p>
                        <p class="book-price">$14.99</p>
                        <button type="button" class="btn status-reserved">Reserved</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/7.png" class="card-img-top" alt="To Kill a Mockingbird">
                    <div class="card-body">
                        <h3 class="card-title">To Kill a Mockingbird</h3>
                        <p class="card-text">Fiction • Harper Lee</p>
                        <p class="book-price">$19.99</p>
                        <button type="button" class="btn status-available">Available</button>
                    </div>
                </div>
            </article>

            <article class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card book-card h-100">
                    <img src="assets/images/covers/8.png" class="card-img-top" alt="The Great Gatsby">
                    <div class="card-body">
                        <h3 class="card-title">The Great Gatsby</h3>
                        <p class="card-text">Fiction • F. Scott Fitzgerald</p>
                        <p class="book-price">$15.99</p>
                        <button type="button" class="btn status-sold">Sold</button>
                    </div>
                </div>
            </article>
        </div>
        </section>

        <!-- End of Grid Cards-->

    </main>
<?php include_once('includes/footer.inc'); ?>
