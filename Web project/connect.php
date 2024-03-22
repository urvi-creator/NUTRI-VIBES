<?php
$connect = mysqli_connect('localhost', 'root', '', 'Nutritionists');
if (!$connect) {
    die(mysqli_connect_error());
}
?>