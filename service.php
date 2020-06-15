<?php

if(isset($_POST['t_tambah'])){
    $sql_pelanggan = "INSERT INTO pelanggan VALUES ('', :nama_pelanggan, :alamat_pelanggan)";
    $stmt_pelanggan = $koneksi->prepare($sql_pelanggan);
    $stmt_pelanggan->bindParam(":nama_pelanggan", $_POST['nama_pelanggan']);
    $stmt_pelanggan->bindParam(":alamat_pelanggan", $_POST['alamat_pelanggan']);
    $stmt_pelanggan->execute();
    $id_pelanggan = $koneksi->lastInsertId();

    $sql_cek_kendaraan = "SELECT * FROM kendaraan WHERE plat_nomor=:plat_nomor";
    $stmt_cek_kendaraan = $koneksi->prepare($sql_cek_kendaraan);
    $stmt_cek_kendaraan->bindParam(":plat_nomor", $_POST['plat_nomor']);
    $stmt_cek_kendaraan->execute();
    $status_kendaraan = $stmt_cek_kendaraan->fetch();

    if($stmt_cek_kendaraan->rowCount()>0){
        $id_kendaraan = $status_kendaraan['id_kendaraan'];
    }
    else{
        $sql_kendaraan ="INSERT INTO kendaraan VALUES ('', :plat_nomor, :nama_kendaraan, :id_pabrikan_motor, :id_pelanggan)";
        $stmt_kendaraan = $koneksi->prepare($sql_kendaraan);
        $stmt_kendaraan->bindParam(":plat_nomor", $_POST['plat_nomor']);
        $stmt_kendaraan->bindParam(":nama_kendaraan", $_POST['nama_kendaraan']);
        $stmt_kendaraan->bindParam(":id_pabrikan_motor", $_POST['id_pabrikan_motor']);
        $stmt_kendaraan->bindParam(":id_pelanggan", $id_pelanggan);
        $stmt_kendaraan->execute();
        $id_kendaraan = $koneksi->lastInsertId();
    }


    $sql_service = "INSERT INTO service VALUES ('', :id_pelanggan, :id_kendaraan, :id_sparepart, :jenis_service, :tanggal_service, :biaya_service)";
    $stmt_service = $koneksi->prepare($sql_service);
    $stmt_service->bindParam(":id_pelanggan", $id_pelanggan);
    $stmt_service->bindParam(":id_kendaraan", $id_kendaraan);
    $stmt_service->bindParam(":id_sparepart", $_POST['id_sparepart']);
    $stmt_service->bindParam(":jenis_service", $_POST['jenis_service']);
    $stmt_service->bindParam(":tanggal_service", $_POST['tanggal_service']);
    $stmt_service->bindParam(":biaya_service", $_POST['biaya_service']);
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

<form action="" method="POST">
    <table>
        <tr>
            <td><label for="nama_pelanggan">Nama Pelanggan</label></td>
            <td><input type="text" id="nama_pelanggan" name="nama_pelanggan"></td>
        </tr>
        <tr>
            <td><label for="alamat_pelanggan">Alamat Pelanggan</label></td>
            <td><textarea name="alamat_pelanggan" id="alamat_pelanggan" cols="30" rows="5"></textarea></td>
        </tr>
        <tr>
            <td><label for="nama_kendaraan">Nama Kendaraan</label></td>
            <td><input type="text" id="nama_kendaraan" name="nama_kendaraan"></td>
        </tr>
        <tr>
            <td><label for="plat_nomor">Plat Nomor</label></td>
            <td><input type="text" id="plat_nomor" name="plat_nomor"></td>
        </tr>
        <tr>
            <td><label for="id_pabrikan_motor">Pabrikan</label></td>
            <td>
                <select name="id_pabrikan_motor" id="id_pabrikan_motor">
                    <?php while($row = $stmt_pabrikan->fetch()){ ?>
                        <option value="<?php echo $row['id_pabrikan_motor']; ?>"><?php echo $row['nama_pabrikan']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="id_sparepart">Sparepart</label></td>
            <td>
                <select name="id_sparepart" id="id_sparepart">
                    <?php while($row = $stmt_sparepart->fetch()){ ?>
                        <option value="<?php echo $row['id_sparepart']; ?>"><?php echo $row['nama_sparepart']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="jenis_service">Jenis Service</label></td>
            <td>
                <select name="jenis_service" id="jenis_service">
                <option value="ringan">Ringan</option>
                    <option value="berat">Berat</option>
                    <option value="modifikasi">Modifikasi</option>
                    <option value="aksesoris">Aksesoris</option>
                    <option value="lain-lain">Lain-lain</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="tanggal_service">Tanggal Service</label></td>
            <td><input type="date" id="tanggal_service" name="tanggal_service"></td>
        </tr>
        <tr>
            <td><label for="biaya_service">Biaya Service</label></td>
            <td><input type="number" id="biaya_service" name="biaya_service"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="t_tambah" value="Tambah"></td>
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
            <a href="hapus_service.php?id_service=<?php echo $row['id_service']; ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>