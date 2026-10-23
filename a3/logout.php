<?php
session_start();

$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();
//start a new session to set the flash message
session_start();
session_regenerate_id(true);
$_SESSION["success"] = "Logged out successfully.";

header("Location: index.php");
exit;
?>
