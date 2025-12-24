<?php
include_once 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Proses Delete
$sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);

// Redirect kembali ke admin
header('location: admin.php');
?>