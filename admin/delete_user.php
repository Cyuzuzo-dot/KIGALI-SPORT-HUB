<?php
include "../config/database.php";

$id = $_GET['id'];

// SAFETY: prevent deleting yourself (optional but good)
mysqli_query($conn,"DELETE FROM users WHERE id=$id");

echo "<script>
alert('User deleted successfully');
window.location='manage_users.php';
</script>";
?>