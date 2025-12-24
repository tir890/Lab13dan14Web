<?php
session_start();
session_destroy();
header('location: login.php'); // Kembali ke halaman login
?>