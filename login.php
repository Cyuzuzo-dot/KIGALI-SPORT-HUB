<?php
session_start();
include "config/database.php";

$message = "";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];
$_SESSION['name'] = $user['fullname'];

if($user['role'] == "admin"){
    header("Location: admin/dashboard.php");
}else{
    header("Location: home.php");
}

}else{
$message = "Invalid email or password";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login - Sports Hub</title>

<style>

body{
    margin:0;
    font-family:Segoe UI;
    background:#F3F6FB;
}

.container{
    display:flex;
    min-height:100vh;
}

/* LEFT */
.left{
    flex:1;
    background:linear-gradient(135deg,#0B3D91,#1565C0);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    padding:20px;
}

.left h1{
    font-size:40px;
}

/* RIGHT */
.right{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
}

.form-box{
    width:320px;
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ddd;
    border-radius:6px;
}

button{
    width:100%;
    padding:10px;
    background:#0B3D91;
    color:white;
    border:none;
    border-radius:6px;
}

button:hover{
    background:#FF6B00;
}

.error{
    color:red;
    text-align:center;
}

a{
    color:#0B3D91;
}

@media(max-width:768px){
    .container{
        flex-direction:column;
    }
}

</style>

</head>

<body>

<div class="container">

<div class="left">

<h1>⚽ Welcome Back</h1>
<p>Login to continue shopping sports equipment</p>

</div>

<div class="right">

<div class="form-box">

<h2>Login</h2>

<?php if($message != "") echo "<p class='error'>$message</p>"; ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

<p>Don't have an account? <a href="register.php">Register</a></p>

</div>

</div>

</div>

</body>
</html>