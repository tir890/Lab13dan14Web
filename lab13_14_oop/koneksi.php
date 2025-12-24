<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "itsunui_store";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn == false) {
    die("Koneksi ke server gagal.");
}
?>