<?php
session_start();

if(!isset($_SESSION['fullname'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>

<link rel="stylesheet" href="css/style.css">

</head>
<body>

<div class="container">

<h1>
Welcome, <?php echo $_SESSION['fullname']; ?> 🚀
</h1>

<div class="top-buttons">
<a href="index.php" class="btn">Home</a>

<a href="my-orders.php" class="btn">
    My Orders
</a>

<a href="logout.php" class="btn">Logout</a>
</div>

</div>

</body>
</html>