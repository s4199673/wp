<?php
// Initial debug
// preshow($_POST);
foreach($_POST as $name => $value) {
    echo "Key: $name, Value: $value<br>";
    $$name = htmlspecialchars($value);
}

$picture = $_FILES['image'];
preshow($picture);

$errors = []; // new Array();

?>