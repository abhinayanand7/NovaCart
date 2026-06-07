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

$result = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update_product'])){
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];

    $query = "UPDATE products SET product_name='$name', product_price='$price' WHERE id='$id'";
    mysqli_query($conn, $query);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Edit Product</h2>

<form method="POST">

<input type="text"
name="product_name"
value="<?php echo $row['product_name']; ?>">

<br><br>

<input type="number"
step="0.01"
name="product_price"
value="<?php echo $row['product_price']; ?>">

<br><br>

<button class="btn" type="submit" name="update_product">
Update Product
</button>

</form>

</body>
</html>
