<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "uploads/";
    
    // Check if directory exists and if not, create it
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755);
    }

    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $_SESSION['avatar'] = $target_file;
        echo "<script>alert('Profile picture updated successfully!');</script>";
        header('Location: User profile.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>PROFILE PICTURE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        label, input[type="file"], input[type="submit"] {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Profile Picture</h1>
    <form action="UP.php" method="post" enctype="multipart/form-data">
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>

