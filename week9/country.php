<?php
$title = "Countries";
include "includes/db_connect.inc";
include "includes/header.inc";
include "includes/nav.inc";
?>
<main class="container my-4">
  <h1>Countries</h1>
  <p>This page displays country records from the MySQL database.</p>

  <?php
  $sql = "SELECT countryid, countryname, description, image, caption FROM country";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
      echo "<p>There was a problem retrieving country records.</p>";
  }
  ?>

  <div class="row g-3">
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
                  <h2 class="h5"><?php echo htmlspecialchars($row["countryname"]); ?></h2>
                  <p><?php echo htmlspecialchars($row["description"]); ?></p>
                </div>
              </div>
            </section>
            <?php
        }
    } else {
        echo "<p>No country records found.</p>";
    }
    ?>
  </div>
</main>
<?php
include "includes/footer.inc";
?>