<?php
 session_start();
if(!isset( $_SESSION['email'] )){
    header("location:sign in.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="user profile.css">
    <title>User Profile Page</title>
</head>
<body>
   
<nav>
        <a href="home.html" class="logo">
            <img src="assets/logo.jpeg.jpg" alt="Logo">
        </a>
        <div class="links">
            <a href="home.html">Home</a>
            <a href="nutritionists.html">Find Nutritionist</a>
            <a href="contact.html">Contact Us</a>
            <a href="services.html">Services</a>
        </div>
       
    </nav>
    <div class="profile-page">
        <div class="cover-image"></div>
        <div class="avatar">
        <?php
if (isset($_SESSION['avatar'])) {
    echo "<img src='" . $_SESSION['avatar'] . "' alt='Profile Picture' 
    style='width: 100px; height: 100px; object-fit: cover;'>";
}
?>


        </div>
        <div class="user-details">
        
            <?php
            if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
                echo "<p>Username: " . $_SESSION['username'] . "</p>";
                echo "<p>Email: " . $_SESSION['email'] . "</p>";
            }
            ?>
        </div>
        <div class="actions">
            <button class="update-button" onclick="location.href='update.php'">Update</button>
            <button class="log_out-button" onclick="location.href='log out.php'">log out</button>
            <button class="delete-account-button" onclick="location.href='delete.php'">Delete Account</button>
            <button class="change-profile-pic-button" onclick="location.href='UP.php'">Change Profile Picture</button>
           
        </div>
    </div>
</body>
</html>
