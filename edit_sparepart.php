<?php

session_start();
include "koneksi.php";

if(!isset($_SESSION['username'])){
    header('location:index.php');
}
else{
    $username = $_SESSION['username'];
}


$id = $_GET['id'];

$sql_edit = "SELECT * FROM sparepart WHERE id_sparepart = :id_sparepart";

$stmt_edit = $koneksi->prepare($sql_edit);
$stmt_edit->bindParam(":id_sparepart", $id);
$stmt_edit->execute();

$hasil = $stmt_edit->fetch();

if(isset($_POST['t_tambah_sparepart'])){
    $sql = "UPDATE sparepart SET nama_sparepart=:nama_sparepart, merk_sparepart=:merk_sparepart, harga_sparepart=:harga_sparepart, stock_sparepart=:stock_sparepart WHERE id_sparepart=:id_sparepart";

    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(":nama_sparepart", $_POST['nama_sparepart']);
    $stmt->bindParam(":merk_sparepart", $_POST['merk_sparepart']);
    $stmt->bindParam(":harga_sparepart", $_POST['harga_sparepart']);
    $stmt->bindParam(":stock_sparepart", $_POST['stock_sparepart']);
    $stmt->bindParam(":id_sparepart", $id);

    $stmt->execute();
    header('location:admin.php?halaman=sparepart');
}

$sql2 = "SELECT * FROM sparepart";

$stmt2 = $koneksi->prepare($sql2);
$stmt2->execute();
?>

<!DOCTYPE html>
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
                    <td><label for="nama_sparepart">Nama Sparepart</label></td>
                    <td><input type="text" value="<?php echo $hasil['nama_sparepart']; ?>" id="nama_sparepart" name="nama_sparepart"></td>
                </tr>
                <tr>
                    <td><label for="merk_sparepart">Merk Sparepart</label></td>
                    <td><input type="text" value="<?php echo $hasil['merk_sparepart']; ?>" id="merk_sparepart" name="merk_sparepart"></td>
                </tr>
                <tr>
                    <td><label for="harga_sparepart">Harga Sparepart</label></td>
                    <td><input type="number" value="<?php echo $hasil['harga_sparepart']; ?>" id="harga_sparepart" name="harga_sparepart"></td>
                </tr>
                <tr>
                    <td><label for="stock_sparepart">Stock Sparepart</label></td>
                    <td><input type="number" value="<?php echo $hasil['stock_sparepart']; ?>" id="stock_sparepart" name="stock_sparepart"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="t_tambah_sparepart" value="Edit"></td>
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
                            <!-- <a href="hapus_sparepart.php?id=<?php echo $row['id_sparepart']; ?>">Hapus</a> -->
                            <a href="edit_sparepart.php?id=<?php echo $row['id_sparepart']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </thead>
        </table>
    </div>
</body>
</html>