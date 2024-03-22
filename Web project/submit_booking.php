<?php


include 'connect.php';

// Get data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$nutritionist = $_POST['nutritionist'];

// Insert data into the database
$sql = "INSERT INTO bookings (name, email, phone, date, nutritionist) 
VALUES ('$name', '$email', '$phone', '$date', '$nutritionist')";

if ($connect->query($sql) === TRUE) {
    echo "Booking successfully submitted!";
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

// Close connection
$connect->close();
?>