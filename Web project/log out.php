<?php
    // Start the session
    session_start();

    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <p id="logoutMessage">Successfully logged out. Redirecting...</p>

    <script>
        setTimeout(function() {
            window.location.href = 'sign in.php';
        }, 1000); // Redirect after 1 second
    </script>
</body>
</html>
