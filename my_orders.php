<?php

session_start();

include "config/database.php";


if(!isset($_SESSION['user_id'])){

header("Location: login.php");
exit();

}


$user_id=$_SESSION['user_id'];

?>

<!DOCTYPE html>

<html>

<head>

<title>My Orders - Kigali Sports Hub</title>


<style>

body{

font-family:Segoe UI,Arial;

background:#f4f7fb;

margin:0;

}


.navbar{

background:#00695C;

color:white;

padding:15px;

display:flex;

justify-content:space-between;

}


.navbar a{

color:white;

text-decoration:none;

}


.container{

padding:30px;

}



.order{

background:white;

border-radius:15px;

padding:20px;

margin-bottom:20px;

box-shadow:0 4px 12px rgba(0,0,0,.1);

}



.status{

padding:8px 15px;

border-radius:20px;

font-weight:bold;

}



.Pending{

background:#fff3cd;

color:#856404;

}


.Approved{

background:#d4edda;

color:#155724;

}


.Processing{

background:#cfe2ff;

color:#084298;

}


.Completed{

background:#b7e4c7;

color:#1b4332;

}


.Cancelled{

background:#f8d7da;

color:#842029;

}



table{

width:100%;

border-collapse:collapse;

margin-top:15px;

}


th{

background:#00695C;

color:white;

padding:10px;

}


td{

padding:10px;

text-align:center;

border-bottom:1px solid #ddd;

}



</style>

</head>


<body>


<div class="navbar">

<div>
🏆 KIGALI SPORTS HUB
</div>


<a href="home.php">
Home
</a>


</div>



<div class="container">


<h1>
📦 My Orders
</h1>



<?php


$sql=mysqli_query($conn,

"

SELECT * FROM orders

WHERE user_id='$user_id'

ORDER BY id DESC

"

);



while($order=mysqli_fetch_assoc($sql)){


?>


<div class="order">


<h2>

Order #<?=$order['id']?>

</h2>



<p>

Date:
<?=$order['created_at']?>

</p>



<p>

Payment:
<?=$order['payment_method']?>

</p>



<p>

Total:

<b>

<?=$order['total']?> RWF

</b>

</p>



<p>

Status:

<span class="status <?=$order['status']?>">

<?=$order['status']?>

</span>


</p>



<table>


<tr>

<th>Product</th>

<th>Quantity</th>

<th>Price</th>

</tr>



<?php


$items=mysqli_query($conn,

"

SELECT 

products.name,

order_items.quantity,

order_items.price


FROM order_items


JOIN products


ON order_items.product_id=products.id


WHERE order_id='{$order['id']}'

"

);



while($item=mysqli_fetch_assoc($items)){


?>


<tr>

<td>
<?=$item['name']?>
</td>


<td>
<?=$item['quantity']?>
</td>


<td>
<?=$item['price']?> RWF
</td>


</tr>


<?php } ?>


</table>


</div>


<?php } ?>


</div>


</body>

</html>