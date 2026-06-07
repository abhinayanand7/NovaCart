<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("config/db.php");

$result = mysqli_query($conn, "SELECT * FROM orders");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <h1>Orders Management</h1>

    <div class="top-buttons">
        <a href="admin.php" class="btn">Back to Dashboard</a>
    </div>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
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

            <td>
                <a href="update-status.php?id=<?php echo $row['id']; ?>&status=Processing">
                    Processing
                </a>

                |

                <a href="update-status.php?id=<?php echo $row['id']; ?>&status=Delivered">
                    Delivered
                </a>

                |

                <a href="update-status.php?id=<?php echo $row['id']; ?>&status=Cancelled">
                    Cancelled
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>