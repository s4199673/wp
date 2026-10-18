<?php
include('includes/tools.inc');
$title = "Login";
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
include "includes/db_connect.inc";
include "includes/header.inc";
include "includes/nav.inc";

?>

<main class="container my-4">
  <h1>Login</h1>
  <?php showFlashAlerts(); ?> 
  <form action="process_login.php" method="post" class="mt-4">

    <div class="mb-3">
      <label for="login" class="form-label">Username or Email</label>
      <input
        type="text"
        class="form-control"
        id="login"
        name="login"
        required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        id="password"
        name="password"
        required>
    </div>

    <button type="submit" class="btn btn-primary">
      Login
    </button>
  </form>
</main>

<?php
include "includes/footer.inc";
?>
