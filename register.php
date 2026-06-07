<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config/db.php");

$message = "";

if(isset($_POST['register'])){

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $folder = "uploads/" . time() . "_" . $imageName;

    move_uploaded_file($tmpName, $folder);

    $query = "INSERT INTO users(fullname,email,password,image)
    VALUES('$fullname','$email','$password','$folder')";

    if(mysqli_query($conn,$query)){
        $message = "Registration Successful";
    }else{
        $message = "Registration Failed";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>

<style>

body{
    background:#071739;
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.form-box{
    background:#0f1f4d;
    padding:40px;
    width:400px;
    border-radius:15px;
    box-shadow:0 0 20px cyan;
}

h2{
    color:white;
    text-align:center;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:8px;
}

button{
    width:100%;
    padding:12px;
    background:cyan;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}

p{
    color:yellow;
    text-align:center;
}

a{
    color:cyan;
}

</style>

</head>

<body>

<div class="form-box">

<h2>Create Account 🛒</h2>

<p><?php echo $message; ?></p>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="fullname" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="password" name="password" placeholder="Password" required>

<input type="file" name="image" required>

<button class="btn" type="submit" name="register">
Register
</button>

</form>

<p>
Already have account?
<a href="login.php">Login</a>
</p>

</div>

</body>
</html>
