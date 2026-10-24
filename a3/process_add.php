<?php
include('includes/tools.inc');
//login check
if (!isset($_SESSION['user_id'])) {
    $_SESSION['warning'] = 'Please log in to add a book.';
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add.php');
    exit;
}

$user_id = (int) $_SESSION['user_id'];

include('includes/db_connect.inc');
// Initial debug
// preshow($_POST);
//Loop through POST fields and create variables with the same name as the field names
foreach($_POST as $name => $value) {
    $value = trim(htmlspecialchars($value));
    $$name = $value;
}

$status_message = 'Initially unset';
$picture = $_FILES['image_path'];
//preshow($picture);

$errors = []; // new Array();

if (strlen($title) < 2) {
    $errors['title'] = 'Title is too short.';
}

if (strlen($author) < 2) {
    $errors['author'] = 'Author name is too short.';
}

if (strlen($description) < 10) {
    $errors['description'] = 'Description is too short.';
}

$allowedGenres = ['Fiction', 'Science Fiction', 'Fantasy', 'Dystopian', 'Romance', 'Memoir', 'Self-Help'];
if (!in_array($genre, $allowedGenres)) {
    $errors['genre'] = 'Please choose a valid genre.';
}

if (!filter_var($publication_year, FILTER_VALIDATE_INT) || $publication_year < 1000 || $publication_year > (int)date('Y')) {
    $errors['publication_year'] = 'Please enter a valid publication year.';
}

if (strlen($isbn) <10) {
    $errors['isbn'] = 'ISBN is too short.';
}

$allowedConditions = ['New', 'Gently Used', 'Fair'];
if (!in_array($book_condition, $allowedConditions)) {
    $errors['book_condition'] = 'Please choose a valid condition.';
}

if (strlen($description) < 10) {
    $errors['description'] = 'Description is too short.';
}

$allowedStatuses = ['Available', 'Reserved', 'Sold'];
if (!in_array($status, $allowedStatuses)) {
    $errors['status'] = 'Please choose a valid status.';
}

if (!isset($_POST['agree'])) {
    $errors['agree'] = 'You must confirm the book information is accurate and complete.';
}

//Image validation
$picture = $_FILES['image_path'];
$allowed_extensions = ["jpg", "jpeg", "png", "gif", "webp"];
$extension = strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION));

if (empty($picture['name']) ||
$picture['error'] != 0 ||
    !in_array($extension, $allowed_extensions, true) ||
    $picture['size'] > 5000000) { // 5MB limit

    $errors['image_path'] = "The image must be JPG, JPEG, PNG, GIF or WEBP image under 5MB.";
}

//Move the validated image first, if the databse insert then fails, remove the moved image
if (count($errors) == 0) {

//Build a unique filename so uploads never overwrite each other
$image_path = uniqid() . '.' . $extension;
$image_full_path = __DIR__ . '/assets/images/covers/' . $image_path;

if (!move_uploaded_file($picture['tmp_name'], $image_full_path)) {
    $status_message = 'The image could not be uploaded. The book was not added.';
} else {
// Ten ? placeholders for the 10 fields in the books table tells MySQLi exactly what type each one is
$sql = "INSERT INTO books (title, author, genre, publication_year, price, isbn, book_condition, description, image_path, status, user_id) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    unlink($image_full_path);
    $status_message = 'The book could not be added. Please try again.';
} else {

mysqli_stmt_bind_param($stmt, "sssidsssssi", 
$title, 
$author, 
$genre, 
$publication_year, 
$price, 
$isbn, 
$book_condition, 
$description, 
$image_path, 
$status,
$user_id
);

if (mysqli_stmt_execute($stmt)) {
    $book_id = mysqli_insert_id($conn);
    $_SESSION['success'] = 'Book added successfully.';
    header('Location: details.php?id=' . urlencode((string) $book_id));
    exit;    

}else{
    error_log(mysqli_stmt_error($stmt));
    unlink($image_full_path);
    $_SESSION['warning'] = 'The cover image could not be uploaded. Please try again';
}

mysqli_stmt_close($stmt);
}
}
}

//$_SESSION['Failure'] = implode("<br>", $errors);

//preshow($errors);
?>

