<?php
include "../config/database.php";
session_start();

if(isset($_POST['add'])){

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$stock = $_POST['stock'];
$description = $_POST['description'];

// IMAGE UPLOAD
$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

if(!empty($image)){
    move_uploaded_file($tmp,"../uploads/".$image);
}

// INSERT PRODUCT
$sql = "INSERT INTO products
(category_id,name,description,price,image,stock)
VALUES
('$category','$name','$description','$price','$image','$stock')";

$result = mysqli_query($conn,$sql);

if($result){
    echo "<script>
        alert('Product added successfully');
        window.location='manage_products.php';
    </script>";
}else{
    echo "Error: " . mysqli_error($conn);
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Product</title>

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
    width:420px;
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
    cursor:pointer;
}

button:hover{
    background:#FF6B00;
}

</style>

</head>

<body>

<div class="container">

<h1>➕ Add Product</h1>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Product Name" required>

<select name="category" required>

<option value="">Select Category</option>

<?php
$cat = mysqli_query($conn,"SELECT * FROM categories");
while($c = mysqli_fetch_assoc($cat)){
?>

<option value="<?= $c['id'] ?>">
<?= $c['name'] ?>
</option>

<?php } ?>

</select>

<input type="number" name="price" placeholder="Price" required>

<input type="number" name="stock" placeholder="Stock" required>

<textarea name="description" placeholder="Description"></textarea>

<input type="file" name="image">

<button name="add">Add Product</button>

</form>

</div>

</body>
</html>