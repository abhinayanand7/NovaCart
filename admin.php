<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/db.php");

$totalProducts = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM products")
);

$totalOrders = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM orders")
);

$pendingOrders = mysqli_num_rows(
    mysqli_query($conn, "SELECT * FROM orders WHERE status='Pending'")
);

$revenueData = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(total_amount) AS revenue FROM orders")
);

$revenue = $revenueData['revenue'] ?? 0;

$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Admin Panel</h1>

    <div class="stats-container">

        <div class="stat-card">
            <h3><?php echo $totalProducts; ?></h3>
            <p>Products</p>
        </div>

        <div class="stat-card">
            <h3><?php echo $totalOrders; ?></h3>
            <p>Orders</p>
        </div>

        <div class="stat-card">
            <h3><?php echo $pendingOrders; ?></h3>
            <p>Pending</p>
        </div>

        <div class="stat-card">
            <h3>₹<?php echo $revenue; ?></h3>
            <p>Revenue</p>
        </div>

    </div>

    <div class="dashboard-header">

        <div>
            <h2>
                Welcome,
                <?php echo $_SESSION['fullname']; ?> 👋
            </h2>

            <p>
                Manage Products & Orders
            </p>
        </div>

    </div>

    <input
    type="text"
    id="searchProduct"
    placeholder="Search Products..."
    class="search-box">

    <div class="top-buttons">
        <a href="orders.php" class="btn">View Orders</a>
        <a href="add-product.php" class="btn">Add Product</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>

    <h2 class="section-title">
        All Products
        (<?php echo $totalProducts; ?>)
    </h2>

    <div class="products-grid">

    <?php while($row = mysqli_fetch_assoc($result)): ?>

    <div class="product-card">

        <img src="<?php echo $row['product_image']; ?>">

        <h3>
            <?php echo $row['product_name']; ?>
        </h3>

        <p>
            ₹<?php echo $row['product_price']; ?>
        </p>

        <div class="card-buttons">

            <a
            href="edit-product.php?id=<?php echo $row['id']; ?>"
            class="edit-btn">
            Edit
            </a>

            <a
            href="delete-product.php?id=<?php echo $row['id']; ?>"
            class="delete-btn">
            Delete
            </a>

        </div>

    </div>

    <?php endwhile; ?>

    </div>

</div>

<script>

document.getElementById("searchProduct")
.addEventListener("keyup", function(){

let value = this.value.toLowerCase();

let rows =
document.querySelectorAll("table tr");

rows.forEach(function(row,index){

if(index===0) return;

let text =
row.innerText.toLowerCase();

row.style.display =
text.includes(value)
? ""
: "none";

});

});

</script>

</body>
</html>
