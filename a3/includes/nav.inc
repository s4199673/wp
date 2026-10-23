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
                        <ul class="navbar-nav ms-auto">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="login.php">
                                        <span class="material-icons me-2">login</span>Login
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" href="register.php">
                                        <span class="material-icons me-2">person_add</span>Register
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item dropdown account-dropdown">
                                    <button class="nav-link dropdown-toggle d-flex align-items-center"
                                        type="button" id="userDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="material-icons me-2">account_circle</span>
                                        <?= htmlspecialchars($_SESSION['username']) ?>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                        <li><a class="dropdown-item" href="seller.php?id=<?= urldecode((int)$_SESSION['user_id']) ?>">
                                            My Profile &amp; Books</a></li>
                                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </ul>
                </div>
            </div>
        </nav>