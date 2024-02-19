<?php
include'partials/_dbconnect.php';
$method= $_SERVER['REQUEST_METHOD'];
$showAlert=false;
session_start();
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
$email=$_SESSION['email'];
$id=$_GET['id'];
$sql="DELETE  FROM `cart` WHERE `cart`.`cart_id`=$id";
        $result = mysqli_query($conn, $sql);
        header("Location: cart.php");

?>