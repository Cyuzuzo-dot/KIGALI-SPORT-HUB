<?php

include "../config/database.php";
session_start();


if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){

    header("Location: ../login.php");
    exit();

}


?>

<!DOCTYPE html>

<html>

<head>

<title>Manage Orders</title>


<style>

body{

font-family:Segoe UI,Arial;

margin:0;

background:#F3F6FB;

}


.container{

margin-left:240px;

padding:25px;

}


h1{

color:#0B3D91;

}



/* TABLE */


table{

width:100%;

border-collapse:collapse;

background:white;

border-radius:12px;

overflow:hidden;

box-shadow:0 5px 15px rgba(0,0,0,.08);

}



th{

background:#0B3D91;

color:white;

padding:12px;

}



td{

padding:12px;

border-bottom:1px solid #eee;

font-size:14px;

text-align:center;

}




/* STATUS */


.status{

padding:6px 12px;

border-radius:20px;

color:white;

font-size:12px;

font-weight:bold;

}



.Pending{

background:#f59e0b;

}


.Approved{

background:#2563eb;

}


.Processing{

background:#7c3aed;

}


.Delivered{

background:#16a34a;

}


.Cancelled{

background:#dc2626;

}



/* ACTION BUTTONS */


.action{

padding:7px 12px;

border-radius:20px;

color:white;

text-decoration:none;

font-size:12px;

margin:3px;

display:inline-block;

}



.approve{

background:#16a34a;

}



.process{

background:#2563eb;

}



.deliver{

background:#059669;

}



.cancel{

background:#dc2626;

}



.action:hover{

opacity:.8;

}



.empty{

text-align:center;

padding:20px;

color:#777;

}



</style>


</head>



<body>



<div class="container">


<h1>
🧾 Manage Orders
</h1>



<table>


<tr>

<th>ID</th>

<th>Customer</th>

<th>Total</th>

<th>Payment</th>

<th>Status</th>

<th>Date</th>

<th>Actions</th>

</tr>



<?php



$sql="

SELECT orders.*, users.fullname

FROM orders

JOIN users

ON orders.user_id=users.id

ORDER BY orders.id DESC

";



$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)>0){



while($row=mysqli_fetch_assoc($result)){


?>



<tr>


<td>

<?=$row['id']?>

</td>



<td>

<?=$row['fullname']?>

</td>



<td>

<?=$row['total']?> RWF

</td>



<td>

<?=$row['payment_method']?>

</td>




<td>


<span class="status <?=$row['status']?>">

<?=$row['status']?>

</span>


</td>




<td>

<?=$row['created_at']?>

</td>





<td>


<a class="action approve"

href="update_order.php?id=<?=$row['id']?>&status=Approved">

Approve

</a>



<a class="action process"

href="update_order.php?id=<?=$row['id']?>&status=Processing">

Processing

</a>



<a class="action deliver"

href="update_order.php?id=<?=$row['id']?>&status=Delivered">

Delivered

</a>



<a class="action cancel"

href="update_order.php?id=<?=$row['id']?>&status=Cancelled"

onclick="return confirm('Cancel this order?')">

Cancel

</a>


</td>



</tr>



<?php


}


}else{


?>


<tr>

<td colspan="7" class="empty">

No orders available

</td>

</tr>


<?php


}


?>



</table>


</div>



</body>

</html>