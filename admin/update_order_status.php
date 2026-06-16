<?php

include "../config/database.php";

session_start();


if(!isset($_SESSION['role']) || $_SESSION['role']!="admin"){

    header("Location: ../login.php");
    exit();

}



if(isset($_GET['id']) && isset($_GET['status'])){


$order_id = $_GET['id'];

$status = $_GET['status'];



// GET USER WHO MADE ORDER

$order_query=mysqli_query($conn,

"SELECT user_id FROM orders WHERE id='$order_id'"

);


$order=mysqli_fetch_assoc($order_query);


$user_id=$order['user_id'];




// UPDATE ORDER STATUS


mysqli_query($conn,

"

UPDATE orders

SET status='$status'

WHERE id='$order_id'

"

);




// CREATE NOTIFICATION MESSAGE


$message="Your order #$order_id status has been changed to $status";



mysqli_query($conn,

"

INSERT INTO notifications

(user_id,order_id,message)

VALUES

('$user_id','$order_id','$message')

"

);



header("Location: manage_orders.php");


}



?>