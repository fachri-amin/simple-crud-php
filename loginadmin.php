<?php

include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AnakBike</title>
</head>
<body>
    <form action="loginproses.php" method="POST">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" id="username" name="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" placeholder="Password" name="password" id="password"></td>
            </tr>
            <tr>
                <td colsapan="2"><input type="submit" name="t_login" value="Login"></td>
            </tr>
        </table>
    </form>
</body>
</html>