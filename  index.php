<!DOCTYPE html>
<html>
<head>

<title>NovaCart</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:linear-gradient(135deg,#071739,#0f1f4d);
    color:white;
    min-height:100vh;
}

nav{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(10px);

    padding:20px 60px;

    display:flex;
    justify-content:space-between;
    align-items:center;
}

nav h2{
    color:cyan;
}

a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    font-weight:bold;
    transition:0.3s;
}

a:hover{
    color:cyan;
}

.hero{
    text-align:center;
    margin-top:150px;
}

.hero h1{
    font-size:70px;
    margin-bottom:20px;
}

.hero p{
    font-size:22px;
    color:#cbd5e1;
    margin-bottom:40px;
}

.btn{
    background:cyan;
    color:black;
    padding:15px 30px;
    border-radius:10px;
    text-decoration:none;
    font-weight:bold;
}

.btn:hover{
    background:white;
}

</style>

</head>

<body>

<nav>

<div>
<h2>NovaCart 🛒</h2>
</div>

<div>
<a href="login.php">Login</a>
<a href="register.php">Register</a>
</div>

</nav>

<div class="hero">

    <h1>NovaCart 🛒</h1>

    <p>
        Modern Full Stack Ecommerce Website
    </p>

    <a href="login.php" class="btn">
        Shop Now
    </a>

</div>

</body>
</html>
