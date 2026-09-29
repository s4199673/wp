<?php
if ($_SERVER["SERVER_NAME"] === "localhost") {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "bookverse";
} else {
    $host = "talsprddb02.int.its.rmit.edu.au";
    $user = "S4199673";
    include("/home/sh3/S4199673/jacob5_pass");
    //$password = $jacob5_pass;
    $database = "S4199673_159009";
}

$conn = mysqli_connect($host, $user, $password, $database);

/* if (!$conn) {
    die("Database connection failed.");
}else{
    echo "<p>Successfully connected to the database.</p>";
} */
?>
