<?php
include "../config/database.php";

$id = $_GET['id'];

// OPTIONAL: delete image file (advanced but safe)
$product = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT image FROM products WHERE id=$id"
));

if($product){

$imagePath = "../uploads/".$product['image'];

if(file_exists($imagePath)){
unlink($imagePath);
}

}

// DELETE PRODUCT
mysqli_query($conn,"DELETE FROM products WHERE id=$id");

echo "<script>
alert('Product deleted successfully');
window.location='manage_products.php';
</script>";

?>