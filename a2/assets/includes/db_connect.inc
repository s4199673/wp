<?php
if ($_SERVER["SERVER_NAME"] === "localhost") {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "bookverse";
} else {
    $host = "talsprddb02.int.its.rmit.edu.au";
    $user = "s4199673";
    $password = "";
    $database = "s4199673";
}

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed.");
}else{
    echo "<p>Successfully connected to the database.</p>";
}
?>
