<?php

include "koneksi.php";
$plat_nomor = $_GET['plat_nomor'];

$sql_kendaraan = "SELECT * FROM kendaraan WHERE plat_nomor=:plat_nomor";
$stmt_kendaraan = $koneksi->prepare($sql_kendaraan);
$stmt_kendaraan->bindParam(":plat_nomor", $plat_nomor);
$stmt_kendaraan->execute();
$hasil_kendaraan=$stmt_kendaraan->fetch();

$id_kendaraan=$hasil_kendaraan[0][0];

$sql_data_service = "SELECT * FROM service WHERE id_kendaraan=:id_kendaraan ORDER BY tanggal_service DESC";
$stmt_data_service = $koneksi->prepare($sql_data_service);
$stmt_data_service->bindParam(":id_kendaraan", $id_kendaraan);
$stmt_data_service->execute();

$i = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Service | AnakBike</title>
</head>
<body>
    <h1>Riwayat Service kendaraan dengan plat nomor <?php echo $_GET['plat_nomor'] ?></h1>

    <table>
        <tr>
            <th>No.</th>
            <th>Tanggal Service</th>
            <th>Jenis Service</th>
            <th>Biaya Service</th>
        </tr>
        <?php while ($row = $stmt_data_service->fetch()){?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['tanggal_service']; ?></td>
            <td><?php echo $row['jenis_service']; ?></td>
            <td><?php echo $row['biaya_service']; ?></td>
        </tr>
            <?php $i++; ?>
        <?php } ?>
    </table>
</body>
</html>