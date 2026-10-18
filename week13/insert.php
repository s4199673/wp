<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: insert_form.php');
    exit;
}

$countryname = trim($_POST['countryname'] ?? "");
$description = trim($_POST['description'] ?? "");
$caption = trim($_POST['caption'] ?? "");

$errors = [];

if ($countryname === "") {
    $errors['countryname'] = 'Country name is required.';
}

if ($description === "") {
    $errors['description'] = 'Description is required.';
}

if ($caption === "") {
    $errors['caption'] = 'Image caption is required.';
}


if (strlen($countryname) > 50) {
    $errors['countryname'] = 'Country name must not exceed 50 characters.';
}


if (strlen($caption) > 255) {
    $errors['caption'] = 'Image caption must not exceed 255 characters.';
}

if (!isset($_FILES['image']) ||
$_FILES["image"]["error"] !== UPLOAD_ERR_OK
) {
    $errors[] = "A valid image upload is required.";
}


$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$maximum_size = 5 * 1024 * 1024;
$image = $_FILES['image'] ?? null;
$extension = '';

if (!is_array($image) || ($image['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    $errors[] = 'A valid image upload is required.';
} else {
    $extension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowed_extensions, true)) {
        $errors[] = 'Only JPG, JPEG, PNG, GIF, and WebP images are allowed.';
    }

    if ($image['size'] > $maximum_size) {
        $errors[] = 'The image must not exceed 5MB.';
    }

    if (getimagesize($image['tmp_name']) === false) {
        $errors[] = 'The uploaded file must be a valid image.';
    }
}

$upload_directory = __DIR__ . '/images/';

if (!is_dir($upload_directory) || !is_writable($upload_directory)) {
    $errors[] = 'The image upload directory is unavailable.';
}


if ($errors) {
    $title = "Submission Error";

    include "includes/header.inc";
    include "includes/nav.inc";
    ?>

    <main class="container my-4">
      <h1>Submission Error</h1>

      <div class="alert alert-danger">
        <p>Please correct the following problems:</p>

        <ul>
                    <?php foreach ($errors as $error) { ?>
            <li><?php echo htmlspecialchars($error); ?></li>
                    <?php } ?>
        </ul>
      </div>

      <a class="btn btn-secondary" href="insert_form.php">
        Return to Form
      </a>
    </main>

    <?php
    include "includes/footer.inc";
    exit;
}

include "includes/db_connect.inc";

$unique_filename = uniqid('img_', true) . '.' . $extension;
$destination_path = $upload_directory . $unique_filename;

if (!move_uploaded_file($image['tmp_name'], $destination_path)) {
    die('The image upload failed.');
}

$sql = "INSERT INTO country (countryname, description, image, caption) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
$inserted = $stmt
    && mysqli_stmt_bind_param($stmt, "ssss", $countryname, $description, $unique_filename, $caption)
    && mysqli_stmt_execute($stmt);

if ($stmt) {
    mysqli_stmt_close($stmt);
}

if (!$inserted) {
    unlink($destination_path);
    die('The country record could not be added. Check that the destination.country table exists.');
}

header("Location: index.php");
exit;
?>