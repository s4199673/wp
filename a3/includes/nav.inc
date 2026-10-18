<!-- Navigation links -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <!-- Logo and link to the homepage -->
                <a class="navbar-brand d-flex align-items-center" href="index.php">
                    <span class="material-icons me-2">
                        auto_stories
                    </span>
                    <span>BookVerse</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="index.php">
                                <span class="material-icons me-2">
                                    home
                                </span>Home </a>
                        </li>
                       
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="books.php">
                                <span class="material-icons me-2">
                                    list
                                </span>Browse Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="gallery.php">
                                <span class="material-icons me-2">
                                    photo_library
                                </span>Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="add.php">
                                <span class="material-icons me-2">
                                    add_circle
                                </span>Add Book</a>
                        </li>
                        </ul>
                        <?php if(!isset($_SESSION['user_id'])): ?> //only runs if not logged in
                        <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="login.php">
                                <span class="material-icons me-2">
                                    login
                                </span>Login</a>
                                </li>

                                <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="register.php">
                                <span class="material-icons me-2">
                                    person_add
                                </span>Register</a>
                                </li>
                                </ul>
                        <?php else: ?>
                        <li> to do: logout link and welcome <?= $_SESSION['username'] ?> to the page nicely </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>