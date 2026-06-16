<?php
session_start();
include "../config/database.php";
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard - KIGALI SPORTS HUB</title>

<style>

body{
    margin:0;
    font-family:Segoe UI;
    background:#0F172A;
    color:white;
}

/* SIDEBAR */

.sidebar{
    width:220px;
    height:100vh;
    background:#0B3D91;
    position:fixed;
    padding:20px;
}

.sidebar h2{
    color:#FF6B00;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px;
    margin:8px 0;
    border-radius:8px;
}

.sidebar a:hover{
    background:#FF6B00;
}

/* MAIN */

.main{
    margin-left:240px;
    padding:20px;
}

.cards{
    display:flex;
    gap:20px;
}

.card{
    background:#1E293B;
    padding:20px;
    border-radius:12px;
    width:200px;
}

.card h3{
    color:#FF6B00;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>🏀 SPORTS HUB</h2>

<a href="dashboard.php">📊 Dashboard</a>

<a href="manage_products.php">📦 Products</a>



<a href="manage_orders.php">🧾 Orders</a>

<a href="manage_users.php">👤 Users</a>

<a href="analytics.php">📈 Analytics</a>

<hr style="border:0;border-top:1px solid #444;">

<a href="../logout.php">🚪 Logout</a>

</div>


<div class="main">

<h1>Admin Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Products</h3>
<p>Manage sports equipment</p>
</div>

<div class="card">
<h3>Orders</h3>
<p>Track customer orders</p>
</div>

<div class="card">
<h3>Users</h3>
<p>Registered customers</p>
</div>

</div>

</div>

</body>

</html>