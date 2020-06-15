<?php

include "koneksi.php";

$sql="DELETE FROM pabrikan_motor WHERE id_pabrikan_motor = :id_pabrikan_motor";
$stmt = $koneksi->prepare($sql);
$stmt->bindParam(":id_pabrikan_motor", $_GET['id']);
$stmt->execute();

header("location:admin.php?halaman=pabrikan");

?>