<?php

if(isset($_POST['t_cari'])){
    $plat_nomor = $_POST['plat_nomor'];
    
    header("location:riwayat_service.php?plat_nomor=".$plat_nomor);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AnakBike</title>
</head>
<body>
    <form action="" method="POST">
        <input placeholder="Masukkan Plat nomor" type="text" name="plat_nomor">
        <input type="submit" name="t_cari" value="Cari">
    </form>
    <p>jika anda adalah admin silahkan login <a href="loginadmin.php">disini</a></p>
</body>
</html>