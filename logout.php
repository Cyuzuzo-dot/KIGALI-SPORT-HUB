<?php
session_start();

// destroy session immediately (but we still show UI)
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>

<title>Logging out...</title>

<style>

body{
    margin:0;
    font-family:Segoe UI;
    background:#0B3D91;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

/* CARD */
.card{
    background:white;
    padding:30px;
    border-radius:15px;
    text-align:center;
    width:350px;

    opacity:0;
    transform:translateY(-20px);
    animation:fadeIn 1s forwards;
}

/* ICON */
.card h1{
    color:#0B3D91;
    font-size:22px;
}

.card p{
    color:#555;
}

/* ANIMATION IN */
@keyframes fadeIn{
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* ANIMATION OUT */
.fade-out{
    animation:fadeOut 1s forwards;
}

@keyframes fadeOut{
    to{
        opacity:0;
        transform:translateY(20px);
    }
}

</style>

</head>

<body>

<div class="card" id="card">

<h1>👋 Thank You for Visiting</h1>

<p>You have successfully logged out of <b>KIGALI-SPORT-HUB</b></p>

<p>We appreciate your shopping experience ❤️</p>

<p>Redirecting to login...</p>

</div>

<script>

// after 3 seconds start fade out
setTimeout(()=>{
    document.getElementById("card").classList.add("fade-out");
}, 3000);

// after 4 seconds redirect to login
setTimeout(()=>{
    window.location.href = "login.php";
}, 4000);

</script>

</body>
</html>