<?php
session_start();
include("config/db.php");

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $product = mysqli_fetch_assoc(
        mysqli_query($conn,"SELECT * FROM products WHERE id='$id'")
    );

    $_SESSION['cart'][] = $product;

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Shopping Cart</h2>

<?php
$total = 0;

foreach($_SESSION['cart'] as $key => $item){

    echo "<p>";
    echo $item['product_name'];
    echo " - ₹".$item['product_price'];

    echo " <a href='remove-cart.php?id=".$key."'
style='color:red;'>Remove</a>";

    echo "</p>";

    $total += $item['product_price'];
}

echo "<h3>Total = ₹".$total."</h3>";

echo "<a href='checkout.php'>Checkout</a>";
?>

</body>
</html>