<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['username'])){
    header('location:index.php');
}
else{
    $username = $_SESSION['username'];
}


$id_service = $_GET['id_service'];
$sql_id = "SELECT id_service, id_pelanggan, id_kendaraan FROM service WHERE id_service=:id_service";
$stmt_id = $koneksi->prepare($sql_id);
$stmt_id->bindParam(":id_service", $id_service);
$stmt_id->execute();
$hasil_id= $stmt_id->fetch();

$id_pelanggan = $hasil_id['id_pelanggan'];
$id_kendaraan = $hasil_id['id_kendaraan'];

$sql_edit_pelanggan = "SELECT * FROM pelanggan WHERE id_pelanggan = :id_pelanggan";
$stmt_edit_pelanggan = $koneksi->prepare($sql_edit_pelanggan);
$stmt_edit_pelanggan->bindParam(":id_pelanggan", $id_pelanggan);
$stmt_edit_pelanggan->execute();
$hasil_edit_pelanggan = $stmt_edit_pelanggan->fetch();

$sql_edit_kendaraan = "SELECT * FROM kendaraan WHERE id_kendaraan = :id_kendaraan";
$stmt_edit_kendaraan = $koneksi->prepare($sql_edit_kendaraan);
$stmt_edit_kendaraan->bindParam(":id_kendaraan", $id_kendaraan);
$stmt_edit_kendaraan->execute();
$hasil_edit_kendaraan = $stmt_edit_kendaraan->fetch();

$sql_edit_service = "SELECT * FROM service WHERE id_service = :id_service";
$stmt_edit_service = $koneksi->prepare($sql_edit_service);
$stmt_edit_service->bindParam(":id_service", $id_service);
$stmt_edit_service->execute();
$hasil_edit_service = $stmt_edit_service->fetch();

if(isset($_POST['t_tambah'])){
    $sql_pelanggan = "UPDATE pelanggan SET nama_pelanggan=:nama_pelanggan, alamat_pelanggan=:alamat_pelanggan WHERE id_pelanggan=:id_pelanggan";
    $stmt_pelanggan = $koneksi->prepare($sql_pelanggan);
    $stmt_pelanggan->bindParam(":nama_pelanggan", $_POST['nama_pelanggan']);
    $stmt_pelanggan->bindParam(":alamat_pelanggan", $_POST['alamat_pelanggan']);
    $stmt_pelanggan->bindParam(":id_pelanggan", $id_pelanggan);
    $stmt_pelanggan->execute();

    $sql_kendaraan ="UPDATE kendaraan SET plat_nomor=:plat_nomor, nama_kendaraan=:nama_kendaraan, id_pabrikan_motor=:id_pabrikan_motor WHERE id_kendaraan=:id_kendaraan";
    $stmt_kendaraan = $koneksi->prepare($sql_kendaraan);
    $stmt_kendaraan->bindParam(":plat_nomor", $_POST['plat_nomor']);
    $stmt_kendaraan->bindParam(":nama_kendaraan", $_POST['nama_kendaraan']);
    $stmt_kendaraan->bindParam(":id_pabrikan_motor", $_POST['id_pabrikan_motor']);
    $stmt_kendaraan->bindParam(":id_kendaraan", $id_kendaraan);
    $stmt_kendaraan->execute();
    
    $sql_service = "UPDATE service SET id_sparepart=:id_sparepart, jenis_service=:jenis_service, tanggal_service=:tanggal_service, biaya_service=:biaya_service WHERE id_service=:id_service";
    $stmt_service = $koneksi->prepare($sql_service);
    $stmt_service->bindParam(":id_sparepart", $_POST['id_sparepart']);
    $stmt_service->bindParam(":jenis_service", $_POST['jenis_service']);
    $stmt_service->bindParam(":tanggal_service", $_POST['tanggal_service']);
    $stmt_service->bindParam(":biaya_service", $_POST['biaya_service']);
    $stmt_service->bindParam(":id_service", $id_service);
    $stmt_service->execute();

    header("location:admin.php?halaman=service");
}

$sql_data = "SELECT id_service, nama_pelanggan, alamat_pelanggan, plat_nomor, nama_kendaraan, jenis_service, tanggal_service, biaya_service FROM service INNER JOIN pelanggan USING (id_pelanggan) INNER JOIN kendaraan USING (id_kendaraan) ORDER BY id_service DESC";
$stmt_data = $koneksi->prepare($sql_data);
$stmt_data->execute();

$sql_pabrikan = "SELECT * FROM pabrikan_motor";
$stmt_pabrikan = $koneksi->prepare($sql_pabrikan);
$stmt_pabrikan->execute();

$sql_sparepart = "SELECT *FROM sparepart";
$stmt_sparepart = $koneksi->prepare($sql_sparepart);
$stmt_sparepart->execute();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AnakBike</title>
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
</head>
<body>
    <!-- <h1>Selamat datang di halaman admin</h1> -->
    <div class="menu">
        <a class="nav" href="admin.php">Home</a>
        <a class="nav" href="admin.php?halaman=sparepart">Sparepart</a>
        <a class="nav" href="admin.php?halaman=pabrikan">Pabrikan</a>
        <a class="nav" href="admin.php?halaman=service">Service</a>
        <a class="nav" href="logout.php">Logout</a>
    </div>
    <div class="isi">
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="nama_pelanggan">Nama Pelanggan</label></td>
                    <td><input value="<?php echo $hasil_edit_pelanggan['nama_pelanggan']; ?>" type="text" id="nama_pelanggan" name="nama_pelanggan"></td>
                </tr>
                <tr>
                    <td><label for="alamat_pelanggan">Alamat Pelanggan</label></td>
                    <td><textarea name="alamat_pelanggan" id="alamat_pelanggan" cols="30" rows="5"><?php echo $hasil_edit_pelanggan['alamat_pelanggan']; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="nama_kendaraan">Nama Kendaraan</label></td>
                    <td><input value="<?php echo $hasil_edit_kendaraan['nama_kendaraan']; ?>" type="text" id="nama_kendaraan" name="nama_kendaraan"></td>
                </tr>
                <tr>
                    <td><label for="plat_nomor">Plat Nomor</label></td>
                    <td><input value="<?php echo $hasil_edit_kendaraan['plat_nomor']; ?>" type="text" id="plat_nomor" name="plat_nomor"></td>
                </tr>
                <tr>
                    <td><label for="id_pabrikan_motor">Pabrikan</label></td>
                    <td>
                        <select name="id_pabrikan_motor" id="id_pabrikan_motor">
                            <?php while($row = $stmt_pabrikan->fetch()){ ?>
                                <option value="<?php echo $row['id_pabrikan_motor']; ?>" <?=$hasil_edit_kendaraan['id_pabrikan_motor']==$row['id_pabrikan_motor']?'selected':null; ?>><?php echo $row['nama_pabrikan']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="id_sparepart">Sparepart</label></td>
                    <td>
                        <select name="id_sparepart" id="id_sparepart">
                            <?php while($row = $stmt_sparepart->fetch()){ ?>
                                <option value="<?php echo $row['id_sparepart']; ?>" <?= $hasil_edit_service['id_sparepart']==$row['id_sparepart']? 'selected':null; ?>><?php echo $row['nama_sparepart']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="jenis_service">Jenis Service</label></td>
                    <td>
                        <select name="jenis_service" id="jenis_service">
                            <option value="ringan" <?= $hasil_edit_service['jenis_service']=='ringan'?'selected':null; ?>>Ringan</option>
                            <option value="berat" <?= $hasil_edit_service['jenis_service']=='berat'?'selected':null; ?>>Berat</option>
                            <option value="modifikasi" <?= $hasil_edit_service['jenis_service']=='modifikasi'?'selected':null; ?>>Modifikasi</option>
                            <option value="aksesoris" <?= $hasil_edit_service['jenis_service']=='aksesoris'?'selected':null; ?>>Aksesoris</option>
                            <option value="lain-lain" <?= $hasil_edit_service['jenis_service']=='lain-lain'?'selected':null; ?>>Lain-lain</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="tanggal_service">Tanggal Service</label></td>
                    <td><input value="<?php echo $hasil_edit_service['tanggal_service']; ?>" type="date" id="tanggal_service" name="tanggal_service"></td>
                </tr>
                <tr>
                    <td><label for="biaya_service">Biaya Service</label></td>
                    <td><input value="<?php echo $hasil_edit_service['biaya_service']; ?>" type="number" id="biaya_service" name="biaya_service"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="t_tambah" value="Edit"></td>
                </tr>
            </table>
        </form>
        <br>
        <table>
            <tr>
                <th>Id Service</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>Plat Nomor</th>
                <th>Nama Kendaraan</th>
                <th>Jenis Service</th>
                <th>Tanggal Service</th>
                <th>Biaya Service</th>
                <th>Tindakan</th>
            </tr>
            <?php while($row = $stmt_data->fetch()){ ?>
            <tr>
                <td><?php echo $row['id_service']; ?></td>
                <td><?php echo $row['nama_pelanggan']; ?></td>
                <td><?php echo $row['alamat_pelanggan']; ?></td>
                <td><?php echo $row['plat_nomor']; ?></td>
                <td><?php echo $row['nama_kendaraan']; ?></td>
                <td><?php echo $row['jenis_service']; ?></td>
                <td><?php echo $row['tanggal_service']; ?></td>
                <td><?php echo $row['biaya_service']; ?></td>
                <td>
                    <a href="edit_service.php?id_service=<?php echo $row['id_service']; ?>">Edit</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>