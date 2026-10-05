<?php
$title = "Insert Country";

include "includes/header.inc";
include "includes/nav.inc";
?>

<main class="container my-4">

    <h1>Add a Country</h1>

    <form action="insert.php" method="post" enctype="multipart/form-data" class="mt-4">

        <div class="mb-3">
            <label for="countryname" class="form-label">
                Country Name
            </label>
            <input
                type="text"
                class="form-control"
                id="countryname"
                name="countryname"
                maxlength="50"
                required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                Description
            </label>
            <textarea
                class="form-control"
                id="description"
                name="description"
                rows="5"
                required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">
                Country Image
            </label>
            <input
                type="file"
                class="form-control"
                id="image"
                name="image"
                accept=".jpg,.jpeg,.png,.gif,.webp"
                required>
        </div>

        <div class="mb-3">
            <label for="caption" class="form-label">
                Image Caption
            </label>
            <input
                type="text"
                class="form-control"
                id="caption"
                name="caption"
                maxlength="255"
                required>
        </div>

        <button type="submit" class="btn btn-primary">
            Add Country
        </button>

    </form>

</main>

<?php
include "includes/footer.inc";
?>