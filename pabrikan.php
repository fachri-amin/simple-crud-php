<?php
if(isset($_POST['t_tambah_pabrikan'])){
    $sql = "INSERT  INTO pabrikan_motor VALUES ('', :nama_pabrikan, :asal_negara)";

    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(":nama_pabrikan", $_POST['nama_pabrikan']);
    $stmt->bindParam(":asal_negara", $_POST['asal_negara']);

    $stmt->execute();
    header('location:admin.php?halaman=pabrikan');
}

$sql2 = "SELECT * FROM pabrikan_motor";

$stmt2 = $koneksi->prepare($sql2);
$stmt2->execute();
?>
<form action="" method="POST">
    <table>
        <tr>
            <td><label for="nama_pabrikan">Nama Pabrikan</label></td>
            <td><input type="text" id="nama_pabrikan" name="nama_pabrikan"></td>
        </tr>
        <tr>
            <td><label for="asal_negara">Asal Negara</label></td>
            <td><input type="text" id="asal_negara" name="asal_negara"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="t_tambah_pabrikan" value="Tambah"></td>
        </tr>
    </table>
</form>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Asal Negara</th>
            <th>Tindakan</th>
        </tr>
        <tbody>
        <?php while($row = $stmt2->fetch()){ ?>
            <tr>
                <td><?php echo $row['id_pabrikan_motor']; ?></td>
                <td><?php echo $row['nama_pabrikan']; ?></td>
                <td><?php echo $row['asal_negara']; ?></td>
                <td>
                    <a href="hapus_pabrikan.php?id=<?php echo $row['id_pabrikan_motor']; ?>">Hapus</a>
                    <a href="edit_pabrikan.php?id=<?php echo $row['id_pabrikan_motor']; ?>">Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </thead>
</table>