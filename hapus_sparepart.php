<?php

include "koneksi.php";

$sql="DELETE FROM sparepart WHERE id_sparepart = :id_sparepart";
$stmt = $koneksi->prepare($sql);
$stmt->bindParam(":id_sparepart", $_GET['id']);
$stmt->execute();

header("location:admin.php?halaman=sparepart");

?>