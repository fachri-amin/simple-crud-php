<?php

$dbhost = "localhost";
$dbname = "dbtugasuas";
$dbuser = "root";
$dbpass = "";

$koneksi = new PDO("mysql:host=" . $dbhost . "; dbname=".$dbname."",$dbuser,$dbpass);