<?php

session_start();

include "config/database.php";


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id=$_SESSION['user_id'];

$total=0;


?>


<!DOCTYPE html>

<html>

<head>

<title>My Cart - Kigali Sports Hub</title>


<style>

body{

font-family:Segoe UI,Arial;

margin:0;

background:#F5F7FA;

}


.navbar{

background:#00695C;

color:white;

padding:15px 25px;

display:flex;

justify-content:space-between;

align-items:center;

}


.logo{

font-size:20px;

font-weight:bold;

}


.navbar a{

color:white;

text-decoration:none;

}



.container{

padding:30px;

}



h1{

text-align:center;

color:#00695C;

}



.cart-box{

background:white;

padding:20px;

border-radius:12px;

box-shadow:0 4px 12px rgba(0,0,0,.1);

}



table{

width:100%;

border-collapse:collapse;

}



th{

background:#00695C;

color:white;

padding:12px;

}



td{

padding:12px;

text-align:center;

border-bottom:1px solid #ddd;

}



.product-img{

width:70px;

height:70px;

object-fit:cover;

border-radius:8px;

}



.price{

color:#00695C;

font-weight:bold;

}



/* QUANTITY */

.quantity{

display:flex;

justify-content:center;

align-items:center;

gap:8px;

}



.qty-btn{

background:#00695C;

color:white;

padding:5px 12px;

border-radius:50%;

text-decoration:none;

font-weight:bold;

}



.qty-btn:hover{

background:#004D40;

}



.qty-number{

font-weight:bold;

font-size:16px;

}



/* REMOVE */

.remove{

background:#E53935;

color:white;

padding:7px 12px;

border-radius:15px;

text-decoration:none;

font-size:12px;

}



.remove:hover{

background:#B71C1C;

}




.total-box{

margin-top:20px;

background:white;

padding:20px;

border-radius:12px;

text-align:right;

box-shadow:0 4px 12px rgba(0,0,0,.1);

}



.checkout{

background:#FF9800;

color:white;

padding:12px 25px;

border-radius:25px;

text-decoration:none;

}



.checkout:hover{

background:#EF6C00;

}



.empty{

text-align:center;

font-size:20px;

color:#777;

padding:30px;

}


@media(max-width:700px){

table{

font-size:12px;

}


.container{

padding:10px;

}

}


</style>


</head>



<body>



<div class="navbar">


<div class="logo">

🏆 KIGALI SPORTS HUB

</div>


<a href="home.php">

Continue Shopping

</a>


</div>





<div class="container">


<h1>

🛒 My Shopping Cart

</h1>





<div class="cart-box">



<table>


<tr>

<th>Image</th>

<th>Product</th>

<th>Category</th>

<th>Price</th>

<th>Quantity</th>

<th>Total</th>

<th>Action</th>

</tr>



<?php


$sql="

SELECT 

cart.id AS cart_id,

cart.quantity,

products.name,

products.price,

products.image,

categories.name AS category


FROM cart


JOIN products

ON cart.product_id=products.id


LEFT JOIN categories

ON products.category_id=categories.id


WHERE cart.user_id='$user_id'

";



$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)>0){



while($row=mysqli_fetch_assoc($result)){


$item_total=$row['price']*$row['quantity'];

$total += $item_total;



?>



<tr>


<td>

<img class="product-img"

src="uploads/<?=$row['image']?>">

</td>



<td>

<?=$row['name']?>

</td>



<td>

<?=$row['category']?>

</td>



<td class="price">

<?=$row['price']?> RWF

</td>



<td>


<div class="quantity">


<a class="qty-btn"

href="update_cart.php?id=<?=$row['cart_id']?>&action=minus">

−

</a>



<span class="qty-number">

<?=$row['quantity']?>

</span>



<a class="qty-btn"

href="update_cart.php?id=<?=$row['cart_id']?>&action=plus">

+

</a>



</div>


</td>




<td class="price">


<?=$item_total?> RWF


</td>



<td>


<a class="remove"

href="remove_cart.php?id=<?=$row['cart_id']?>"

onclick="return confirm('Remove this item?')">

Remove

</a>


</td>



</tr>



<?php

}


}else{


?>


<tr>

<td colspan="7" class="empty">

Your cart is empty

</td>

</tr>


<?php

}


?>



</table>



</div>





<div class="total-box">


<h2>

Total:
<?=$total?> RWF

</h2>


<a href="checkout.php" class="checkout">

Proceed Checkout

</a>


</div>




</div>



</body>

</html>