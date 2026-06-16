<?php

include "../config/database.php";

session_start();


/* CHECK ADMIN */

if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){

    header("Location: ../login.php");
    exit();

}



/* CHECK DATA */

if(isset($_GET['id']) && isset($_GET['status'])){


$order_id = $_GET['id'];

$status = $_GET['status'];



// FIND USER WHO MADE THIS ORDER

$order_query = mysqli_query(
$conn,
"SELECT user_id FROM orders WHERE id='$order_id'"
);



$order = mysqli_fetch_assoc($order_query);



if($order){


$user_id = $order['user_id'];



// UPDATE ORDER STATUS


mysqli_query(
$conn,
"

UPDATE orders

SET status='$status'

WHERE id='$order_id'

"

);




// CREATE USER NOTIFICATION


$message = "Your order #$order_id has been updated. Current status: $status";



mysqli_query(
$conn,
"

INSERT INTO notifications

(user_id,order_id,message)

VALUES

('$user_id','$order_id','$message')

"

);



}



// RETURN TO ORDERS PAGE


header("Location: manage_orders.php");

exit();



}


else{


header("Location: manage_orders.php");

exit();


}


?>