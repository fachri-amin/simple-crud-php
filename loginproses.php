<?php
session_start();
include "koneksi.php";

if (isset($_POST['t_login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM pengguna 
			WHERE username = :username
			AND password = :password";

	$stmt = $koneksi->prepare($sql);
	$stmt->bindParam(":username", $username);
	$stmt->bindParam(":password", $password);
	$stmt->execute();

    $hasil = $stmt->fetch();

	if($stmt->rowCount() > 0){
        $_SESSION['username']= $hasil['username'];
		header("location:admin.php");
	} else {
        $error = "Login tidak ditemukan!";
        echo $error;
	}
}

?>