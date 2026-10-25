<?php
include('includes/tools.inc');
include('includes/db_connect.inc');

/*Login check*/
if (!isset($_SESSION['user_id'])) {
    $_SESSION['failure'] = 'Please log in to edit a book.';
    header('Location: login.php');
    exit;
}

/* only accept form submissions via POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: books.php');
    exit;
}

/* validate the submitted book ID */
$book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
if (!$book_id || $book_id < 1) {
    $_SESSION['failure'] = 'Invalid book selected.';
    header('Location: books.php');
    exit;
}

/* always use the logged-in user's ID */
$user_id = $_SESSION['user_id'];

/* read only the expected form fields */
foreach($_POST as $name => $value) {
    $value = trim($value);
    $$name = $value;
}

$errors = []; // new Array();

/* validate text fields */
if (strlen($title) < 2) {
    $errors['title'] = 'Title is too short.';
}
if (strlen($author) < 2) {
    $errors['author'] = 'Author name is too short.';
}
if (strlen($description) < 10) {
    $errors['description'] = 'Description is too short.';
}

/* validate allowed values for genre and book_condition */
$allowedGenres = ['Fiction', 'Science Fiction', 'Fantasy', 'Dystopian', 'Romance', 'Memoir', 'Self-Help'];
if (!in_array($genre, $allowedGenres)) {
    $errors['genre'] = 'Please choose a valid genre.';
}

$allowedConditions = ['New', 'Gently Used', 'Fair'];
if (!in_array($book_condition, $allowedConditions)) {
    $errors['book_condition'] = 'Please choose a valid book condition.';
}

$allowedStatuses = ['Available', 'Reserved', 'Sold'];
if (!in_array($status, $allowedStatuses)) {
    $errors['status'] = 'Please choose a valid status.';
}

/*
$currentYear = (int) date('Y');

if (!filter_var($publication_year, FILTER_VALIDATE_INT) || $publication_year < 1000 || $publication_year > $currentYear) {
    $errors['publication_year'] = 'Please enter a valid publication year.';
}
*/

if (!is_numeric($price) || $price < 0) {
    $errors['price'] = 'Please enter a valid price.';
} 

/*
if (strlen($isbn) < 10) {
    $errors['isbn'] = 'ISBN is too short.';
}
*/

/* retrieve the existing book record to check ownership and get the current image path */
$sql = "SELECT user_id, image_path FROM books WHERE book_id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    $_SESSION['failure'] = 'The book could not be loaded.';
    header('Location: edit.php?book_id=' . urlencode($book_id));
    exit;
}

mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);

/* check whether the statement executed successfully before fetching the result */
if (!mysqli_stmt_execute($stmt)) {
    error_log(mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    $_SESSION['failure'] = 'The book could not be loaded.';
    header('Location: edit.php?book_id=' . urlencode((string) $book_id));
    exit;
}

$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$book) {
    $_SESSION['failure'] = 'Book not found or you do not have permission to edit it.';
    header('Location: books.php');
    exit;
}

$old_image_path = $book['image_path'];
$new_image_path = $old_image_path; // Default to old image path
$new_image_uploaded = false; // Flag to track if a new image was uploaded
$new_image_full_path = ''; // Variable to store the full path of the new image

/* validate a replacement image if one was uploaded */
$picture = $_FILES['image_path'] ?? null;

if (is_array($picture) && isset($picture['error']) && $picture ['error'] !== UPLOAD_ERR_NO_FILE) {
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($picture['name'], PATHINFO_EXTENSION));
    $image_info = false;

    if ($picture['error'] === UPLOAD_ERR_OK
    && is_uploaded_file($picture['tmp_name'])
    && $picture['size'] <= 5000000) { // 5MB limit
        $image_info = getimagesize($picture['tmp_name']);
    }

    if ($picture['error'] !== UPLOAD_ERR_OK || !in_array($extension, $allowed_extensions, true)
        || $image_info === false) {
    $errors[] = 'Invalid image file. Please upload a valid image (jpg, jpeg, png, gif, webp) under 5MB).';
    } else {
        $new_image_path = uniqid() . '.' . $extension;
        $new_image_full_path = __DIR__ . '/assets/images/covers/' . $new_image_path;
  
        if (!move_uploaded_file($picture['tmp_name'], $new_image_full_path)) {
            $errors[] = 'The image could not be uploaded. Please try again.';
        } else {
            $new_image_uploaded = true;
        }
    }

}

/* stop before updating if validation failed */
if (count($errors) > 0) {
    if ($new_image_uploaded && file_exists($new_image_full_path)) {
        unlink($new_image_full_path);
    }
    $_SESSION['failure'] = implode('<br>', $errors);
    header('Location: edit.php?book_id=' . urlencode($book_id));
    exit;
}

/* update the book record in the database */
    $sql = "UPDATE books 
    SET title=?, author=?, genre=?, price=?, book_condition=?, description=?, image_path=?, status=? 
    WHERE book_id=? AND user_id=?";
    
    
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    if ($new_image_uploaded && is_file($new_image_full_path)) {
        unlink($new_image_full_path);
    }

    error_log(mysqli_error($conn));
    $_SESSION['failure'] = 'The book could not be updated.';
    header(
        'Location: edit.php?book_id=' . urlencode((string) $book_id)
    );
    exit;
}
    
    $price = (float) $price;
  
    mysqli_stmt_bind_param($stmt, "sssdssssii", 
        $title, 
        $author, 
        $genre, 
        //$publication_year, 
        $price, 
        //$isbn, 
        $book_condition, 
        $description, 
        $new_image_path, 
        $status,
        $book_id,
        $user_id
    );
    
    $updated = mysqli_stmt_execute($stmt);

    if (!$updated) {
        if ($new_image_uploaded && file_exists($new_image_full_path)) {
            unlink($new_image_full_path);
        }

        error_log(mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);

        $_SESSION['failure'] = 'The book could not be updated.';
        header('Location: edit.php?book_id=' . urlencode($book_id));
        exit;
    }
    mysqli_stmt_close($stmt);

    /* If a new image was uploaded, delete the old image file */
    if ($new_image_uploaded) {
        $old_image_full_path = __DIR__ . '/assets/images/covers/' . $old_image_path;
        
        if (is_file($old_image_full_path)) {
            if (!unlink($old_image_full_path)) {
                $_SESSION['warning'] = 'The book was updated, but the old cover image could not be deleted.';
            } else {
                $_SESSION['success'] = 'Book updated successfully.';
            }
        } else {
            $_SESSION['success'] = 'Book updated successfully.';
        }   
    } else {
        $_SESSION['success'] = 'Book updated successfully.';
    }                               
    
    header('Location: details.php?id=' . urlencode($book_id));
    exit;                                
