<?php
include "../config/database.php";
session_start();

$id = $_GET['id'];

// GET PRODUCT
$product = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM products WHERE id=$id"
));

// UPDATE PRODUCT
if(isset($_POST['update'])){

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$description = $_POST['description'];

// IMAGE CHECK
if(!empty($_FILES['image']['name'])){

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp,"../uploads/".$image);

mysqli_query($conn,
"UPDATE products SET
name='$name',
category_id='$category',
price='$price',
stock='$stock',
description='$description',
image='$image'
WHERE id=$id"
);

}else{

mysqli_query($conn,
"UPDATE products SET
name='$name',
category_id='$category',
price='$price',
stock='$stock',
description='$description'
WHERE id=$id"
);

}

echo "<script>alert('Product updated successfully');window.location='manage_products.php';</script>";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Product</title>

<style>

body{
    font-family:Segoe UI;
    background:#F3F6FB;
    margin:0;
}

.container{
    margin-left:240px;
    padding:20px;
}

form{
    background:white;
    padding:20px;
    width:400px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input,select,textarea{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ddd;
    border-radius:6px;
}

button{
    width:100%;
    padding:10px;
    background:#0B3D91;
    color:white;
    border:none;
    border-radius:6px;
}

button:hover{
    background:#FF6B00;
}

img{
    width:80px;
    border-radius:6px;
}

</style>

</head>

<body>

<div class="container">

<h1>✏️ Edit Product</h1>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" value="<?= $product['name'] ?>" required>

<select name="category">

<?php
$cat = mysqli_query($conn,"SELECT * FROM categories");
while($c = mysqli_fetch_assoc($cat)){
?>

<option value="<?= $c['id'] ?>"
<?= $product['category_id']==$c['id']?'selected':'' ?>>
<?= $c['name'] ?>
</option>

<?php } ?>

</select>

<input type="number" name="price" value="<?= $product['price'] ?>" required>

<input type="number" name="stock" value="<?= $product['stock'] ?>" required>

<textarea name="description"><?= $product['description'] ?></textarea>

<p>Current Image:</p>
<img src="../uploads/<?= $product['image'] ?>">

<input type="file" name="image">

<button name="update">Update Product</button>

</form>

</div>

</body>
</html>