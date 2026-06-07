<?php
session_start();
include("config/db.php");

$message = "";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: dashboard.php");
            exit();

        }else{
            echo "Password Verify Failed";
            exit();
        }

    }else{
        $message = "Email Not Found";
    }

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

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

<h2>Login NovaCart 🛒</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input type="email" name="email" placeholder="Email">

<input type="password" name="password" placeholder="Password">

<button class="btn" type="submit" name="login">
Login
</button>

</form>

<p>
Create Account?
<a href="register.php">Register</a>
</p>

</div>

</body>
</html>
