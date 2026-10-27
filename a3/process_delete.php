<?php
include('includes/tools.inc');
include('includes/db_connect.inc');

/*login check */
if (!isset($_SESSION['user_id'])) {
    $_SESSION['warning'] = 'Please log in to delete a book.';
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['failure'] = 'Invalid deletion request.';
    header('Location: books.php');
    exit;
}

$book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);

if (!$book_id || $book_id < 1) {
    $_SESSION['failure'] = 'Invalid book selected.';
    header('Location: books.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT book_id, user_id, title, author, genre, publication_year,
               isbn, book_condition, price, description, status, image_path
        FROM books
        WHERE book_id = ? AND user_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log(mysqli_error($conn));
    $_SESSION['failure'] = 'Book details could not be loaded.';
    header('Location: books.php');
    exit;
}

mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);

if (!mysqli_stmt_execute($stmt)) {
    error_log(mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    $_SESSION['failure'] = 'Book details could not be loaded.';
    header('Location: books.php');
    exit;
}

$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$book) {
    $_SESSION['failure'] = 'Book not found or you do not have permission to delete it.';
    header('Location: books.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM books WHERE book_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        error_log(mysqli_error($conn));
        $_SESSION['failure'] = 'The book could not be deleted.';
        header('Location: details.php?id=' . urlencode($book_id));
        exit;
    }

      mysqli_stmt_bind_param($stmt, 'ii', $book_id, $user_id);


      if (!mysqli_stmt_execute($stmt)) {
        error_log(mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);

        $_SESSION['failure'] = 'The book could not be deleted.';
        header('Location: details.php?id=' . urlencode($book_id));
        exit;
    }

    $deleted_rows = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    if ($deleted_rows !== 1) {
        $_SESSION['failure'] = 'The book could not be deleted.';
        header('Location: books.php');
        exit;
    }

    /* delete the image only after the databse record has been deleted successfully */
        $image_path = __DIR__ . '/assets/images/covers/' . $book['image_path'];

    if (is_file($image_path) && !unlink($image_path)) {
        error_log('Could not remove book cover: ' . $image_path);
        $_SESSION['warning'] = 'The book was deleted, but its cover image could not be removed.';
    } else {
        $_SESSION['success'] = 'Book deleted successfully.';
    }

    header('Location: index.php');
    exit;
}