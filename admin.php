<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['username'])){
    header('location:index.php');
}
else{
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .nav{
            background-color: green;
            padding: 10px;
            text-decoration: None;
            color: white;
        }
        .nav:hover{
            box-shadow: grey 3px 3px 3px;
        }
        .menu{
            margin-top: 30px;
            margin-bottom: 30px;
        }
    </style>
    <title>AnakBike</title>
</head>
<body>
    <!-- <h1>Hai <?php echo $username ?> Selamat datang di halaman admin</h1> -->
    <div class="menu">
        <a class="nav" href="admin.php">Home</a>
        <a class="nav" href="admin.php?halaman=sparepart">Sparepart</a>
        <a class="nav" href="admin.php?halaman=pabrikan">Pabrikan</a>
        <a class="nav" href="admin.php?halaman=service">Service</a>
        <a class="nav" href="logout.php">Logout</a>
    </div>
    <div class="isi">
        <?php
        if (isset($_GET['halaman'])){
            include $_GET['halaman'].'.php';
        }
        else{
            echo "<h1 style='margin-top:250px; text-align:center;'>Hai ".$username.", Selamat datang di Sistem Informasi Service bengkel AnakBike</h1>";
        }
        ?>
    </div>
</body>
</html>