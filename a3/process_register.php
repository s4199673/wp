<?php
include('includes/tools.inc');    
include('includes/db_connect.inc');

/*Loop through POST fields and create variables with the same name as the field names
foreach($_POST as $name => $value) {
    $value = trim(htmlspecialchars($value));
     echo ($name . ' => ' . $value . "<br>\n");
    $$name = $value;
} */

//Handle missing fields and stop on validation errors
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

$username = is_string($username) ? trim($username) : '';
$email = is_string($email) ? trim($email) : '';
$password = is_string($password) ? $password : '';
$confirm_password = is_string($confirm_password) ? $confirm_password : '';

//Check if username or email already exists in the database
$sql = "
    SELECT username, email
    FROM users
    WHERE username = ? OR email = ?
";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    $_SESSION['failure'] = 'Registration could not be completed. Please try again.';
    header('Location: register.php');
    exit;
}

mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$existing_user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if ($existing_user) {
    $_SESSION['failure'] = 'That username or email is already in use.';
    header('Location: register.php');
    exit;
}

if (!empty($errors)) {
    $_SESSION['failure'] = implode(' ', $errors);
    header('Location: register.php');
    exit;
}

//Basic Validation
$errors = [];

if ($username === "") {
    $errors[] = "Username is required.";
}

if ($email === "") {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email address is not valid.";
}

if ($password === "") {
    $errors[] = "Password is required.";
}

if ($confirm_password === '') {
    $errors[] = 'Please confirm your password.';
} elseif ($password !== $confirm_password) {
    $errors[] = 'Passwords do not match.';
}
//Hash the Password
$password_hash = password_hash($password, PASSWORD_DEFAULT);
//Prepared Insert
$sql = "
    INSERT INTO users
    (username, email, password)
    VALUES (?, ?, ?)
";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sss",
    $username,
    $email,
    $password_hash
);

try {
    if ($stmt && mysqli_stmt_execute($stmt)) {
    $_SESSION['Success'] = "Welcome to Bookverse, ".$username."! Registration successful! Please log in.";
    //Redirect After Successful Registration
    header("Location: login.php");
    exit;
    } else {
    $_SESSION['Failure'] = "Registration failed. Please try again.";
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['Failure'] = "Registration failed: ";
}
?>