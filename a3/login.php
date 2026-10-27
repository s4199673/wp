<?php
include('includes/tools.inc');
include('includes/db_connect.inc');
$title = "Login";
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
}
include_once('includes/header.inc');
?>

<div class="container-fluid">
  <?php showFlashAlerts(); ?>
</div>

<main class="container my-4">
     <section class="login-section my-5">
            <div class="login-container my-3">
                <div class="login-heading">
<span class="material-icons">
login
</span>
  <h1>Login to BookVerse</h1>
  </div>
  
  <form action="process_login.php" method="post" class="mt-4">

    <div class="mb-3 mt-5">
      <label for="login" class="form-label">Username</label>
      <input
        type="text"
        class="form-control"
        id="login"
        name="login"
        placeholder="Enter your username"
        required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        id="password"
        name="password"
        placeholder="Enter your password"
        required>
    </div>

    <button type="submit" class="btn login-btn">
      <span class="material-icons">
      check_circle
      </span>  
      Login
    </button>
    <p class="mt-5">
      Dont have an account? <a href="register.php">Register here</a>.
    </p>
  </form>
  </div>
  </section>
</main>

<?php
include "includes/footer.inc";
?>
