<?php

session_start();

include "config/database.php";


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];


// GET USER DETAILS

$user_query = mysqli_query($conn,
"SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($user_query);



$total = 0;


// CALCULATE CART TOTAL

$cart_query = mysqli_query($conn,

"SELECT cart.*, products.price 
FROM cart
JOIN products
ON cart.product_id = products.id
WHERE cart.user_id='$user_id'"

);



while($item=mysqli_fetch_assoc($cart_query)){

    $total += $item['price'] * $item['quantity'];

}



$address = $_POST['address'];

$phone = $_POST['phone'];

$payment_method = $_POST['payment_method'];



// INSERT ORDER


$order_sql = "

INSERT INTO orders

(user_id,total,address,phone,payment_method,status)

VALUES

('$user_id','$total','$address','$phone','$payment_method','Pending')

";


mysqli_query($conn,$order_sql);



$order_id = mysqli_insert_id($conn);



// INSERT ORDER ITEMS


$cart_query = mysqli_query($conn,

"SELECT cart.*, products.price 
FROM cart

JOIN products

ON cart.product_id = products.id

WHERE cart.user_id='$user_id'"

);



while($item=mysqli_fetch_assoc($cart_query)){



$product_id = $item['product_id'];

$quantity = $item['quantity'];

$price = $item['price'];



mysqli_query($conn,

"

INSERT INTO order_items

(order_id,product_id,quantity,price)

VALUES

('$order_id','$product_id','$quantity','$price')

"

);


// UPDATE STOCK

mysqli_query($conn,

"

UPDATE products

SET stock = stock - $quantity

WHERE id='$product_id'

"

);



}



// CLEAR CART


mysqli_query($conn,

"DELETE FROM cart WHERE user_id='$user_id'"

);



?>


<!DOCTYPE html>
<html>

<head>

<title>Order Success</title>


<style>

body{

font-family:Segoe UI;

background:#f4f6fb;

display:flex;

height:100vh;

justify-content:center;

align-items:center;

}


.card{

background:white;

padding:40px;

border-radius:15px;

text-align:center;

box-shadow:0 5px 20px rgba(0,0,0,.15);

animation:show .5s;

}


h1{

color:#16a34a;

}


@keyframes show{

from{

transform:scale(.5);

opacity:0;

}

to{

transform:scale(1);

opacity:1;

}

}


</style>


<meta http-equiv="refresh" content="4;url=home.php">


</head>


<body>


<div class="card">


<h1>
✅ Order Placed Successfully
</h1>


<p>
Thank you for shopping at
<b>KIGALI SPORTS HUB</b>
</p>


<p>
Returning to KIGALI SPORTS HUB home page...
</p>


</div>


</body>

</html>