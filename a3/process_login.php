<?php
include('includes/tools.inc');
include('includes/db_connect.inc');
// Initial debug
// preshow($_POST);
//Loop through POST fields and create variables with the same name as the field names
foreach($_POST as $name => $value) {
    $value = trim(htmlspecialchars($value));
    $$name = $value;
}

//Prepared SELECT
$sql = "
    SELECT user_id, username, email, password
    FROM users
    WHERE username = ? 
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $login
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

//Verify Password
if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user_id"] = $user["user_id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["email"] = $user["email"];
    $_SESSION["success"] = 'Welcome back, ' . $_SESSION["username"] . '!';

    header("Location: index.php");
    exit;
} else {
    //Failed Login
    $_SESSION["failure"] = "Invalid username or password.";
    $status_message = "Invalid username or password.";
    header("Location: login.php?error=" . urlencode($status_message));
    exit;
}

?>