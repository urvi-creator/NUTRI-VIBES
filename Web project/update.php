<?php
    session_start();
    include 'connect.php'; 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_SESSION['userid']; // Get the user ID from the session
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];

        // Prepare the SQL statement
        if (!empty($new_password)) {
            // If the password field is not empty, update both username and password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash the new password
            $stmt = $connect->prepare("UPDATE registration SET username = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssi", $new_username, $hashed_password, $user_id);
        } else {
            // If the password field is empty, only update the username
            $stmt = $connect->prepare("UPDATE registration SET username = ? WHERE id = ?");
            $stmt->bind_param("si", $new_username, $user_id);
        }

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Update the session variable and redirect to the user profile page
            $_SESSION['username'] = $new_username;
            header("Location: User profile.php");
            exit();
        } else {
            // Display an error message if the update failed
            echo "Update failed: " . $stmt->error;
        }
        
        $stmt->close();
        $connect->close();
    }
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        .btn-update {
            width: 100%; 
            background-color: #007bff; 
            color: white;
        }
        .btn-update:hover {
            background-color: #28a745;
        }
        </style>
        <script>
    
    function validateForm() {
        var username = document.getElementById('new_username').value;
        var password = document.getElementById('new_password').value;
        var confirmPassword = document.getElementById('confirm_password').value;

       
        var validUsernameRegex = /^[a-zA-Z0-9_]+$/;

        
        if (!validUsernameRegex.test(username)) {
            alert('Please enter a valid username. Only letters, numbers, and underscores are allowed.');
            return false;
        }

        
        if (password.length > 0) {
            
            var strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

     
            if (!strongPasswordRegex.test(password)) {
                alert('Please enter a strong password. It must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, and one number.');
                return false;
            }

            
            if (password !== confirmPassword) {
                alert('Passwords do not match. Please confirm your password.');
                return false;
            }
        }

        return true; 
    }
</script>

           
    
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Update Profile
                    </div>
                    <div class="card-body">
                        <form action="update.php" onsubmit="return validateForm()" method="post">
                        <input type="hidden" name="user_id">

                            <div class="form-group">
                                <label for="new_username">New Username:</label>
                                <input type="text" class="form-control" id="new_username" name="new_username">
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-update">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
