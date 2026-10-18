<?php
$title = "Countries";

include "includes/db_connect.inc";
include "includes/header.inc";
include "includes/nav.inc";

$sql = "
    SELECT countryid, countryname, image, caption
    FROM country
    ORDER BY countryname
";
$result = mysqli_query($conn, $sql);
?>

<main class="container my-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Countries</h1>
        <a class="btn btn-primary" href="insert_form.php">
            Add Country
        </a>
    </div>

    <div class="row g-4">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <section class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100">
                        <img
                            src="images/<?php echo htmlspecialchars($row["image"]); ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($row["caption"]); ?>">
                        <div class="card-body">
                            <h2 class="h5">
                                <?php echo htmlspecialchars($row["countryname"]); ?>
                            </h2>
                            <a class="btn btn-outline-primary" href="#">
                                Read More
                            </a>
                        </div>
                    </div>
                </section>
        <?php
            }
        } else {
            echo "<p>No country records were found.</p>";
        }
        ?>
    </div>

</main>

<?php
include "includes/footer.inc";
?>