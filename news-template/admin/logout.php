<?php
    include 'config.php';
    session_start();

    // Clear all session variables
    $_SESSION = [];

    // If the session uses cookies, destroy the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();

    // Redirect and exit
    header("Location: {$hostname}/index.php");
    exit;
?>
