<?php
if ($_SERVER["SERVER_NAME"] === "localhost") 
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "destination";

mysqli_report(MYSQLI_REPORT_OFF);
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed.");
}
?>