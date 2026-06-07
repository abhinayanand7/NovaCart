<?php
session_start();
include("config/db.php");

$result = mysqli_query($conn,"SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NovaCart - Shop</title>

<link rel="stylesheet" href="css/style.css">

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}
.products-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.product-card {
    border: 1px solid #ccc;
    padding: 15px;
    width: 200px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
}
.product-card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 4px;
}
.product-card h3 {
    margin: 10px 0;
}
.product-card a {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    text-decoration: none;
    border-radius: 4px;
    margin-top: 10px;
}
.product-card a:hover {
    background-color: #0056b3;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    margin-bottom: 20px;
}
.navbar .logo {
    font-size: 24px;
    font-weight: bold;
}
.navbar .nav-links a {
    color: white;
    text-decoration: none;
    margin-left: 20px;
}
.navbar .nav-links a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<nav class="navbar">
    <div class="logo">NovaCart</div>

    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>

        <?php if(isset($_SESSION['user_id'])){ ?>
            <a href="my-orders.php">My Orders</a>
            <a href="logout.php">Logout</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
        <?php } ?>
    </div>
</nav>

<h1>NovaCart</h1>

<div class="products-container">
<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="product-card">
    <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
    <h3><?php echo $row['product_name']; ?></h3>
    <p>₹<?php echo $row['product_price']; ?></p>
    <a href="cart.php?id=<?php echo $row['id']; ?>">
Add To Cart
</a>
</div>

<?php } ?>
</div>

</body>
</html>