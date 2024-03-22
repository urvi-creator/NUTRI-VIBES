<?php
include 'connect.php';
$login = 0;
$invalid = 0;
$emailNotFound = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Use prepared statements to prevent SQL injection
  $stmt = $connect->prepare("SELECT * FROM registration WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result) {
    if ($result->num_rows > 0) {
      // Check password
      $row = $result->fetch_assoc();
      $password_hash = $row['password'];

      // Compare password from user with the hash in the db
      if (password_verify($password, $password_hash)) {
        $login = 1;
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $row['username'];
        $_SESSION['userid'] = $row['user_id']; 
        header('location:User profile.php');
      } else {
        $invalid = 1; // Invalid password
      }
    } else {
      $emailNotFound = 1; 
    }
  } else {
    // Handle SQL error
    die(mysqli_error($connect));
  }
}
?>




      

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Sign in.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign in Form</title>
</head>
<body>
   
      <?php if ($login): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are successfully logged in.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php elseif ($invalid): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Invalid Password.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php elseif ($emailNotFound): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Notice!</strong> Invalid Credentials.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>


    <div class="login-container">
        <h2>Sign in</h2>
        <form action="sign in.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit">Sign in</button>
            
            
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
