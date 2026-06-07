<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/db.php");

$user_id = $_SESSION['user_id'];
$result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>My Orders</h1>

    <div class="top-buttons">
        <a href="dashboard.php" class="btn">Back to Dashboard</a>
    </div>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>₹<?php echo $row['total_amount']; ?></td>
            <td>
            <?php
            if($row['status'] == 'Pending'){
                echo "<span style='color:orange;font-weight:bold;'>Pending</span>";
            }
            elseif($row['status'] == 'Processing'){
                echo "<span style='color:blue;font-weight:bold;'>Processing</span>";
            }
            elseif($row['status'] == 'Delivered'){
                echo "<span style='color:green;font-weight:bold;'>Delivered</span>";
            }
            else{
                echo "<span style='color:red;font-weight:bold;'>Cancelled</span>";
            }
            ?>
            </td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>