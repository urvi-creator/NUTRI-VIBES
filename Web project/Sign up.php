<?php
include 'connect.php';
$success = 0;
$unsuccess = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  // Hash user password - password_hash()
  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  // Check if email is already in the db
  $mysql = "SELECT * FROM registration WHERE email = ?";
  $stmt = $connect->prepare($mysql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $myresult = $stmt->get_result();
  if ($myresult) {
    // Check if there is any record from executing the query
    if ($myresult->num_rows > 0) {
      // Email already exists; not successful
      $unsuccess = 1;
    } else {
      $sql = "INSERT INTO registration(username, email, password) VALUES(?, ?, ?)";
      $stmt = $connect->prepare($sql);
      $stmt->bind_param("sss", $username, $email, $password_hash);
      if ($stmt->execute()) {
        // Signup successful; success
        $success = 1;
        session_start();
        $_SESSION['email']=$email;
        header('location:Sign in.php');
      } else {
        die(mysqli_error($connect));
      }
    }
  }
}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="Sign up.css">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
   integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-q1gKtGQb0Lzj6QvRAIbZ4n3D3FkW1GTw8zzO6YF/6Z9WR3GmM9KtF5Rmm1BJPdvx" crossorigin="anonymous"></script>


</head>
<body>

<?php
if ($unsuccess) {
  echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Ohh no Sorry </strong> Email already exists.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}
  

?>
<?php
if ($success) {
  echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success </strong> You are successfully signed up.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';}
  

?>



<form action="sign up.php" method="post"id="form" class="form">
       <h1 class="title">SIGN UP</h1>

<div class="input-group">
  <label for="username">Username</label>
  <input type="text" id="username" name="username" placeholder="Enter your username" required>
  <span id="username_error"></span>
</div>
<div class="input-group">
  <label for="email">Email</label>
  <input type="email" id="email" name="email" placeholder="Enter your email" required>
  <span id="email_error"></span>
</div>
<div class="input-group">
  <label for="password">Password</label>
  <input type="password" id="password" name="password" placeholder="Enter your password" required>
  <span id="password_error"></span>
</div>
<div class="input-group">
  <label for="confirm-password">Confirm password</label>
  <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
  <span id="confirm_error"></span>
</div>
<div class="input-group">
  <input type="checkbox" id="agree" name="agree" required>
  <label for="agree">I agree to the <a href="#">terms and conditions</a></label>
</div>

<div class="submit-button">
<button type="submit" class="submit-btn">Sign up</button>
</div>
<div id="success_message" class="success"></div>

</form>

<script src="signup.js"></script>
</body>
</html>