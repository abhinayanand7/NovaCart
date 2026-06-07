<?php
include("config/db.php");

if(isset($_POST['add_product'])){

    $name = $_POST['product_name'];
    $price = $_POST['product_price'];

    $imageName = $_FILES['product_image']['name'];
    $tmpName = $_FILES['product_image']['tmp_name'];

    $dbPath = "uploads/" . time() . "_" . $imageName;

    $fullPath = __DIR__ . "/" . $dbPath;

    move_uploaded_file($tmpName, $fullPath);

    $folder = $dbPath;

    $query = "INSERT INTO products(product_name, product_price, product_image)
              VALUES('$name','$price','$folder')";

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
    <title>Add Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Add Product</h1>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

<input type="text"
name="product_name"
placeholder="Product Name"
required>

<br><br>

<input type="number"
step="0.01"
name="product_price"
placeholder="Price"
required>

<br><br>

<input type="file"
name="product_image"
required>

<br><br>

<button type="submit" name="add_product" class="btn">
    Add Product
</button>

</form>

</div>

</body>
</html>