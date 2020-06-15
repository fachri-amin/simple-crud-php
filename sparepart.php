<?php
if(isset($_POST['t_tambah_sparepart'])){
    $sql = "INSERT  INTO sparepart VALUES ('', :nama_sparepart, :merk_sparepart, :harga_sparepart, :stock_sparepart)";

    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(":nama_sparepart", $_POST['nama_sparepart']);
    $stmt->bindParam(":merk_sparepart", $_POST['merk_sparepart']);
    $stmt->bindParam(":harga_sparepart", $_POST['harga_sparepart']);
    $stmt->bindParam(":stock_sparepart", $_POST['stock_sparepart']);

    $stmt->execute();
    header('location:admin.php?halaman=sparepart');
}

$sql2 = "SELECT * FROM sparepart";

$stmt2 = $koneksi->prepare($sql2);
$stmt2->execute();
?>
<form action="" method="POST">
    <table>
        <tr>
            <td><label for="nama_sparepart">Nama Sparepart</label></td>
            <td><input type="text" id="nama_sparepart" name="nama_sparepart"></td>
        </tr>
        <tr>
            <td><label for="merk_sparepart">Merk Sparepart</label></td>
            <td><input type="text" id="merk_sparepart" name="merk_sparepart"></td>
        </tr>
        <tr>
            <td><label for="harga_sparepart">Harga Sparepart</label></td>
            <td><input type="number" id="harga_sparepart" name="harga_sparepart"></td>
        </tr>
        <tr>
            <td><label for="stock_sparepart">Stock Sparepart</label></td>
            <td><input type="number" id="stock_sparepart" name="stock_sparepart"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="t_tambah_sparepart" value="Tambah"></td>
        </tr>
    </table>
</form>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nama</th>
            <th>Merk</th>
            <th>Harga</th>
            <th>Stock</th>
            <th>Tindakan</th>
        </tr>
        <tbody>
        <?php while($row = $stmt2->fetch()){ ?>
            <tr>
                <td><?php echo $row['id_sparepart']; ?></td>
                <td><?php echo $row['nama_sparepart']; ?></td>
                <td><?php echo $row['merk_sparepart']; ?></td>
                <td><?php echo $row['harga_sparepart']; ?></td>
                <td><?php echo $row['stock_sparepart']; ?></td>
                <td>
                    <a href="hapus_sparepart.php?id=<?php echo $row['id_sparepart']; ?>">Hapus</a>
                    <a href="edit_sparepart.php?id=<?php echo $row['id_sparepart']; ?>">Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>

    </thead>
</table>