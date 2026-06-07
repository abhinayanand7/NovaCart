<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/db.php");

if(!isset($_GET['id']) || !isset($_GET['status'])){
    header("Location: orders.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE orders SET status='$status' WHERE id='$id'";
mysqli_query($conn, $query);

header("Location: orders.php");
exit();
?>