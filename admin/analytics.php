<?php
include "../config/database.php";
session_start();

// PRODUCTS
$products = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM products"))['total'];

// USERS
$users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM users"))['total'];

// ORDERS
$orders = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM orders"))['total'];

// ORDER STATUS
$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM orders WHERE status='Pending'"))['total'];
$delivered = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM orders WHERE status='Delivered'"))['total'];
$cancelled = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM orders WHERE status='Cancelled'"))['total'];

// REVENUE
$revenue = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total) AS total FROM orders WHERE status='Delivered'"))['total'];
if(!$revenue) $revenue = 0;

?>

<!DOCTYPE html>
<html>
<head>

<title>Analytics</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    font-family:Segoe UI;
    margin:0;
    background:#F3F6FB;
}

.container{
    margin-left:240px;
    padding:20px;
}

h1{
    color:#0B3D91;
}

.cards{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.card{
    background:white;
    padding:15px;
    width:180px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.card h2{
    color:#0B3D91;
}

.card p{
    font-size:20px;
    font-weight:bold;
}

.chartBox{
    margin-top:30px;
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

</style>

</head>

<body>

<div class="container">

<h1>📊 Admin Analytics Dashboard</h1>

<!-- STATS -->
<div class="cards">

<div class="card">
<h2>Products</h2>
<p><?= $products ?></p>
</div>

<div class="card">
<h2>Users</h2>
<p><?= $users ?></p>
</div>

<div class="card">
<h2>Orders</h2>
<p><?= $orders ?></p>
</div>

<div class="card">
<h2>Revenue</h2>
<p><?= number_format($revenue) ?> RWF</p>
</div>

</div>

<!-- CHART -->
<div class="chartBox">

<canvas id="ordersChart"></canvas>

</div>

</div>

<script>

const ctx = document.getElementById('ordersChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Delivered', 'Cancelled'],
        datasets: [{
            label: 'Orders Status',
            data: [
                <?= $pending ?>,
                <?= $delivered ?>,
                <?= $cancelled ?>
            ],
            backgroundColor: [
                '#f59e0b',
                '#22c55e',
                '#ef4444'
            ]
        }]
    }
});

</script>

</body>
</html>