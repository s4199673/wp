<?php

$picture = $_FILES['image_path'];

if (!empty(trim($picture['name']))) || $picture['error'] != 0 || !in_array($extension, $allowed_extensions, true) ||
$picture['size'] > 5000000) { // 5MB limit
$_SESSION['failure'] = 'Invalid image file. Please upload a valid image (jpg, jpeg, png, gif, webp) under 5MB. Keeping the old image.';
$new_image_path = $old_image_path;    
}else{

$new_image_path = $picture['name'];
    }

    $sql = "UPDATE books SET title=?, author=?, genre=?, publication_year=?, price=?, isbn=?, book_condition=?, description=?, image_path=? 
    WHERE book_id=? AND user_id=?";
    
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        $_SESSION['failure'] = 'Update could not be completed. Please try again.';
        header('Location: edit.php?book_id=' . urlencode($book_id));
        exit;
    }
    
  $stmt->bind_param("sssidsissii", 
        $title, 
        $author, 
        $genre, 
        $publication_year, 
        $price, 
        $isbn, 
        $book_condition, 
        $description, 
        $new_image_path, 
        $book_id, 
        $user_id
    );
    
    $stmt->execute();

    if ($stmt->affected_rows >0) {
        $_SESSION['success'] = 'Book updated successfully.';
    }

    if (!empty(trim($picture['name'])) && $picture['error'] == 0 && in_array($extension, $allowed_extensions, true) && $picture['size'] <= 5000000) {
        if (move_uploaded_file($picture['tmp_name'], "assets/images/covers/" . $new_image_path)) {
            $_SESSION['success'] = 'Book updated successfully and image uploaded.';
        } else {
            $_SESSION['warning'] = 'Book updated successfully but image upload failed.';
        }
    }
    header('Location: sell.php');
    exit;
    
    else{
        $_SESSION['error'] = 'Book updated successfully but image upload failed.';

    }
    header('Location: edit.php?book_id=' . urlencode($book_id));
    exit;
?>