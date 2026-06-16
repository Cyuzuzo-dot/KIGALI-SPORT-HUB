<?php
include "../config/database.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Users</title>

<style>

body{
    font-family:Segoe UI;
    margin:0;
    background:#F3F6FB;
}

.container{
    margin-left:240px;
    padding:20px;
}

h1{
    color:#0B3D91;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

th{
    background:#0B3D91;
    color:white;
    padding:10px;
    font-size:14px;
}

td{
    padding:10px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

.status{
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    color:white;
}

.user{background:#3b82f6;}
.admin{background:#ef4444;}

.btn{
    padding:5px 10px;
    border-radius:6px;
    color:white;
    text-decoration:none;
    font-size:12px;
}

.delete{
    background:#ef4444;
}

.delete:hover{
    background:#dc2626;
}

</style>

</head>

<body>

<div class="container">

<h1>👤 Manage Users</h1>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Role</th>
<th>Created</th>
<th>Action</th>
</tr>

<?php

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?= $row['id'] ?></td>
<td><?= $row['fullname'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['phone'] ?></td>

<td>
<span class="status <?= $row['role'] ?>">
<?= $row['role'] ?>
</span>
</td>

<td><?= $row['created_at'] ?></td>

<td>
<a class="btn delete"
href="delete_user.php?id=<?= $row['id'] ?>"
onclick="return confirm('Delete this user?')">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>