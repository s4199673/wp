<?php 
$pageName = 'Browse Books';
$fileName = 'books.php';
include_once('includes/header.inc'); 
?>

    <header>
       <?php include_once('includes/nav.inc'); ?>
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

                <div class="filter-panel">
                    <label for="statusFilter">Filter by Status:</label>
                    <select id="statusFilter" class="form-select form-select-sm">
                        <option value="all" selected>Show All</option>
                        <option value="Available">Available</option>
                        <option value="Reserved">Reserved</option>
                        <option value="Sold">Sold</option>
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
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="value" data-status="Available">
                                <th scope="row">The Midnight Library</th>
                                <td>Matt Haig</td>
                                <td>Fiction</td>
                                <td>2020</td>
                                <td>$24.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">Project Hail Mary</th>
                                <td>Andy Weir</td>
                                <td>Science Fiction</td>
                                <td>2021</td>
                                <td>$28.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">Dune</th>
                                <td>Frank Herbert</td>
                                <td>Science Fiction</td>
                                <td>1965</td>
                                <td>$22.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">The Hobbit</th>
                                <td>J.R.R. Tolkien</td>
                                <td>Fantasy</td>
                                <td>1937</td>
                                <td>$18.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">1984</th>
                                <td>George Orwell</td>
                                <td>Dystopian</td>
                                <td>1949</td>
                                <td>$16.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Reserved">
                                <th scope="row">Pride and Prejudice</th>
                                <td>Jane Austen</td>
                                <td>Romance</td>
                                <td>1813</td>
                                <td>$14.99</td>
                                <td>
                                    <span class="table-status status-reserved">
                                        Reserved
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">To Kill a Mockingbird</th>
                                <td>Harper Lee</td>
                                <td>Fiction</td>
                                <td>1960</td>
                                <td>$19.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Sold">
                                <th scope="row">The Great Gatsby</th>
                                <td>F. Scott Fitzgerald</td>
                                <td>Fiction</td>
                                <td>1925</td>
                                <td>$15.99</td>
                                <td>
                                    <span class="table-status status-sold">
                                        Sold
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">Educated</th>
                                <td>Tara Westover</td>
                                <td>Memoir</td>
                                <td>2018</td>
                                <td>$20.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Reserved">
                                <th scope="row">The Seven Husbands</th>
                                <td>Taylor Jenkins Reid</td>
                                <td>Fiction</td>
                                <td>2017</td>
                                <td>$18.99</td>
                                <td>
                                    <span class="table-status status-reserved">
                                        Reserved
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">Atomic Habits</th>
                                <td>James Clear</td>
                                <td>Self-Help</td>
                                <td>2018</td>
                                <td>$26.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                            <tr class="value" data-status="Available">
                                <th scope="row">Sapiens</th>
                                <td>Yuval Noah Harari</td>
                                <td>Non-Fiction</td>
                                <td>2014</td>
                                <td>$27.99</td>
                                <td>
                                    <span class="table-status status-available">
                                        Available
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
<?php include_once('includes/footer.inc'); ?>