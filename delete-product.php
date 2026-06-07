<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/db.php");

if(!isset($_GET['id'])){
    header("Location: admin.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT product_image FROM products WHERE id='$id'");

$row = mysqli_fetch_assoc($result);

if(!empty($row['product_image']) &&
   file_exists($row['product_image'])){
    unlink($row['product_image']);
}

$query = "DELETE FROM products WHERE id='$id'";
mysqli_query($conn, $query);

header("Location: admin.php");
exit();
?>