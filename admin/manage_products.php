<?php
include "../config/database.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Products</title>

<style>

/* GLOBAL */
body{
    font-family:Segoe UI;
    margin:0;
    background:#F3F6FB;
    color:#222;
}

/* CONTAINER */
.container{
    margin-left:240px;
    padding:20px;
}

/* TITLE */
h1{
    color:#0B3D91;
    margin-bottom:15px;
}

/* ADD BUTTON */
.add{
    background:#22c55e;
    color:white;
    padding:10px 14px;
    display:inline-block;
    border-radius:8px;
    text-decoration:none;
    margin-bottom:15px;
    font-weight:bold;
}

.add:hover{
    background:#16a34a;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

th{
    background:#0B3D91;
    color:white;
    padding:12px;
    font-size:14px;
}

td{
    padding:10px;
    border-bottom:1px solid #eee;
    font-size:14px;
    text-align:center;
}

/* IMAGE */
td img{
    width:60px;
    height:50px;
    object-fit:cover;
    border-radius:6px;
}

/* BUTTONS */
.btn{
    padding:6px 10px;
    border-radius:6px;
    text-decoration:none;
    font-size:12px;
    color:white;
    margin:2px;
    display:inline-block;
}

.edit{
    background:#f59e0b;
}

.delete{
    background:#ef4444;
}

.edit:hover{
    background:#d97706;
}

.delete:hover{
    background:#dc2626;
}

/* ROW HOVER */
tr:hover{
    background:#f9fafb;
    transition:0.2s;
}

</style>

</head>

<body>

<div class="container">

<h1>📦 Manage Products</h1>

<a class="add" href="add_product.php">➕ Add New Product</a>

<table>

<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
<th>Actions</th>
</tr>

<?php

$sql = "
SELECT products.*, categories.name AS category_name
FROM products
LEFT JOIN categories
ON products.category_id = categories.id
ORDER BY products.id DESC
";

$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?= $row['id'] ?></td>

<td>
<img src="../uploads/<?= $row['image'] ?>">
</td>

<td><?= $row['name'] ?></td>

<td><?= $row['category_name'] ?></td>

<td><?= number_format($row['price']) ?> RWF</td>

<td><?= $row['stock'] ?></td>

<td>

<a class="btn edit" href="edit_product.php?id=<?= $row['id'] ?>">
Edit
</a>

<a class="btn delete" href="delete_product.php?id=<?= $row['id'] ?>"
onclick="return confirm('Are you sure you want to delete this product?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>