<?php

$conn = mysqli_connect("localhost", "root", "", "kigali_sports_hub_db");

if(!$conn){
    die("Database connection failed: " . mysqli_connect_error());
}

?>