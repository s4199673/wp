<?php
include('includes/tools.inc');
include('includes/db_connect.inc');
$status_message = '';
if ($_SERVER['REQUEST_METHOD'] =="POST")
    include('includes/process_register.inc');
$pageName = "Register";
$fileName = "register.php";
include_once('includes/header.inc');
?>



<main class="container my-4">
   <section class="register-section my-5">
            <div class="register-container">
                <div class="register-heading">
<span class="material-icons">
person_add
</span>
<h1>Create Account</h1>
</div>
<?php showFlashAlerts(); ?>
  <form action="process_register.php" method="post" class="mt-4">

    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input
        type="text"
        class="form-control"
        id="username"
        name="username"
        maxlength="50"
        placeholder="Choose a username"
        required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        maxlength="100"
        placeholder="Enter your email"
        required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input
        type="password"
        class="form-control"
        id="password"
        name="password"
        placeholder="Enter password"
        required>
    </div>

    <div class="mb-3">
      <label for="confirm_password" class="form-label">Confirm Password</label>
      <input
        type="password"
        class="form-control"
        id="confirm_password"
        name="confirm_password"
        placeholder="Confirm password"
        required>
    </div>

    <button type="submit" class="btn register-btn">
    <span class="material-icons">
      check_circle
      </span>  
      Register
    </button>

    <p class="mt-3">
      Already have an account? <a href="login.php">Login here</a>.
    </p>
  </form>
  </div>
  </section>
</main>

<?php
include "includes/footer.inc";
?>
