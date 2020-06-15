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
$sql_edit =  "SELECT * FROM pabrikan_motor WHERE id_pabrikan_motor = :id_pabrikan_motor";

$stmt_edit = $koneksi->prepare($sql_edit);
$stmt_edit->bindParam(":id_pabrikan_motor", $id);
$stmt_edit->execute();

$hasil=$stmt_edit->fetch();

if(isset($_POST['t_tambah_pabrikan'])){
    $sql = "UPDATE pabrikan_motor SET nama_pabrikan=:nama_pabrikan, asal_negara=:asal_negara WHERE id_pabrikan_motor=:id_pabrikan_motor";

    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(":nama_pabrikan", $_POST['nama_pabrikan']);
    $stmt->bindParam(":asal_negara", $_POST['asal_negara']);
    $stmt->bindParam(":id_pabrikan_motor", $id);

    $stmt->execute();
    header('location:admin.php?halaman=pabrikan');
}

$sql2 = "SELECT * FROM pabrikan_motor";

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
                    <td><label for="nama_pabrikan">Nama Pabrikan</label></td>
                    <td><input type="text" value="<?php echo $hasil['nama_pabrikan']; ?>" id="nama_pabrikan" name="nama_pabrikan"></td>
                </tr>
                <tr>
                    <td><label for="asal_negara">Asal Negara</label></td>
                    <td><input type="text" value="<?php echo $hasil['asal_negara']; ?>" id="asal_negara" name="asal_negara"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="t_tambah_pabrikan" value="Edit"></td>
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
                            <!-- <a href="hapus_pabrikan.php?id=<?php echo $row['id_pabrikan_motor']; ?>">Hapus</a> -->
                            <a href="edit_pabrikan.php?id=<?php echo $row['id_pabrikan_motor']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </thead>
        </table>
    </div>
</body>
</html>