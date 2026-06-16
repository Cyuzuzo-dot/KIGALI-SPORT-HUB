<?php

session_start();

include "config/database.php";


// CHECK LOGIN

if(!isset($_SESSION['user_id'])){

    echo "
    <script>
    alert('Please login first to add products to cart');
    window.location='login.php';
    </script>
    ";

    exit();

}



$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];



// CHECK IF PRODUCT ALREADY IN CART


$check = mysqli_query(
$conn,
"SELECT * FROM cart 
WHERE user_id='$user_id' 
AND product_id='$product_id'"
);



if(mysqli_num_rows($check)>0){


    // UPDATE QUANTITY

    mysqli_query(
    $conn,
    "UPDATE cart 
     SET quantity = quantity + 1
     WHERE user_id='$user_id'
     AND product_id='$product_id'"
    );


}
else{


    // INSERT NEW CART ITEM


    mysqli_query(
    $conn,
    "INSERT INTO cart
    (user_id,product_id,quantity)

    VALUES

    ('$user_id','$product_id',1)"
    );


}



// RETURN HOME


header("Location: home.php");

exit();


?>