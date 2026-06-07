<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['place_order'])){

    $user_id = $_SESSION['user_id'];

    $name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $total = 0;
    foreach($_SESSION['cart'] as $item){
        $total += $item['product_price'];
    }

    $query = "INSERT INTO orders
    (user_id, customer_name, phone, address, total_amount)
    VALUES
    ('$user_id','$name','$phone','$address','$total')";

    mysqli_query($conn, $query);

    unset($_SESSION['cart']);

    header("Location: my-orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Checkout</h2>

<form method="POST">

<input type="text"
name="customer_name"
placeholder="Full Name"
required>

<br><br>

<input type="text"
name="phone"
placeholder="Phone Number"
required>

<br><br>

<textarea
name="address"
placeholder="Address"
required></textarea>

<br><br>

<button class="btn" type="submit"
name="place_order">
Place Order
</button>

</form>

</body>
</html>
