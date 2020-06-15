<?php

include "koneksi.php";

$sql="DELETE FROM service WHERE id_service = :id_service";
$stmt = $koneksi->prepare($sql);
$stmt->bindParam(":id_service", $_GET['id_service']);
$stmt->execute();

header("location:admin.php?halaman=service");

?>