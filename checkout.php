<?php

session_start();

include "config/database.php";


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


$user_id = $_SESSION['user_id'];


// GET USER INFORMATION

$user_query = mysqli_query($conn,

"SELECT * FROM users WHERE id='$user_id'"

);

$user = mysqli_fetch_assoc($user_query);



$total = 0;



?>

<!DOCTYPE html>

<html>

<head>

<title>Checkout - Kigali Sports Hub</title>


<style>


body{

font-family:Segoe UI,Arial;

margin:0;

background:#F4F7FB;

}


/* NAVBAR */

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



/* MAIN */

.container{

padding:30px;

display:flex;

gap:25px;

justify-content:center;

flex-wrap:wrap;

}



/* BOX */

.box{

background:white;

padding:25px;

border-radius:15px;

width:420px;

box-shadow:0 4px 15px rgba(0,0,0,.1);

}



h2{

color:#00695C;

}



/* INPUT */

input,select{

width:100%;

padding:12px;

margin:8px 0;

border:1px solid #ddd;

border-radius:8px;

font-size:14px;

}



label{

font-weight:bold;

font-size:14px;

}



/* PRODUCTS */


.product{

display:flex;

justify-content:space-between;

padding:12px 0;

border-bottom:1px solid #ddd;

}



.product-name{

font-weight:bold;

}


.price{

color:#00695C;

font-weight:bold;

}



/* TOTAL */

.total{

font-size:22px;

font-weight:bold;

color:#00695C;

text-align:right;

margin-top:20px;

}



/* BUTTON */

button{

width:100%;

padding:14px;

border:none;

border-radius:25px;

background:#FF9800;

color:white;

font-size:16px;

cursor:pointer;

margin-top:20px;

}



button:hover{

background:#EF6C00;

}



/* MOBILE */

@media(max-width:700px){

.container{

padding:15px;

}


.box{

width:100%;

}

}



</style>


</head>


<body>


<div class="navbar">


<div class="logo">

🏆 KIGALI SPORTS HUB

</div>


<a href="cart.php">

← Back to Cart

</a>


</div>





<div class="container">



<!-- CUSTOMER DETAILS -->

<div class="box">


<h2>
Delivery Information
</h2>



<form method="POST" action="place_order.php">



<label>
Full Name
</label>


<input 
type="text"
value="<?= $user['fullname']?>"
readonly>



<label>
Phone Number
</label>


<input 
type="text"
name="phone"
value="<?= $user['phone']?>"
required>



<label>
Delivery Address
</label>


<input 
type="text"
name="address"
value="<?= $user['address']?>"
required>



<label>
Payment Method
</label>


<select name="payment_method" required>


<option value="">
Select Payment
</option>


<option value="Cash on Delivery">
Cash on Delivery
</option>


<option value="Mobile Money">
Mobile Money
</option>


<option value="Bank Payment">
Bank Payment
</option>



</select>



<button>

Confirm Order

</button>



</form>


</div>





<!-- ORDER SUMMARY -->

<div class="box">


<h2>
Order Summary
</h2>



<?php


$cart=mysqli_query($conn,


"SELECT 

cart.quantity,

products.name,

products.price


FROM cart


JOIN products


ON cart.product_id=products.id


WHERE cart.user_id='$user_id'"

);



if(mysqli_num_rows($cart)>0){



while($row=mysqli_fetch_assoc($cart)){



$item_total=$row['price']*$row['quantity'];


$total += $item_total;


?>


<div class="product">


<div>


<div class="product-name">

<?=$row['name']?>

</div>


Quantity:

<?=$row['quantity']?>


</div>



<div class="price">

<?=$item_total?> RWF

</div>


</div>


<?php

}


}else{

?>

<p>
Your cart is empty
</p>

<?php

}

?>



<div class="total">

Total:
<?=$total?> RWF

</div>



</div>




</div>



</body>

</html>