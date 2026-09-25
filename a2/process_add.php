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

$status_message = 'Initially unset';
$picture = $_FILES['image_path'];
preshow($picture);

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

if (count($errors) == 0) {

//Build a unique filename so uploads never overwrite each other
$image_path = uniqid() . '.' . $extension;

$sql = "INSERT INTO books (title, author, genre, publication_year, price, isbn, book_condition, description, image_path, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssidsssss", 
$title, 
$author, 
$genre, 
$publication_year, 
$price, 
$isbn, 
$book_condition, 
$description, 
$image_path, 
$status
);

$inserted = mysqli_stmt_execute($stmt);

if ($inserted) {
    if (move_uploaded_file($_FILES["image_path"]["tmp_name"], "assets/images/covers/" . $image_path)) {
        $status_message = "Book added successfully and image uploaded.";
    } else {
        $status_message = "Book added successfully but image upload failed.";
    }
}else {
    $status_message = "Book was not added and image upload failed.";
}
}else{
}

preshow($errors);
?>
