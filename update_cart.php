<?php

session_start();

include "config/database.php";


if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}


if(isset($_GET['id']) && isset($_GET['action'])){


$id=$_GET['id'];

$action=$_GET['action'];



if($action=="plus"){


mysqli_query($conn,

"UPDATE cart 
SET quantity = quantity + 1
WHERE id='$id'"

);


}



if($action=="minus"){


mysqli_query($conn,

"UPDATE cart 
SET quantity = quantity - 1
WHERE id='$id' 
AND quantity > 1"

);


}


}


header("Location: cart.php");

exit();


?>