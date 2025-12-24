<?php
session_start();
include_once 'koneksi.php';

// Jika sudah login, alihkan ke halaman admin
if (isset($_SESSION['is_login'])) {
    header('location: admin.php');
}

$message = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Enkripsi password dengan MD5 (sesuai data dummy SQL)

    $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $_SESSION['is_login'] = true;
        $_SESSION['user'] = $data['nama_lengkap'];
        header('location: admin.php'); // Redirect ke admin jika sukses
    } else {
        $message = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Itsunui Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <h2 style="text-align:center;">Login Admin</h2>
        <?php if($message): ?>
            <p style="color:red; text-align:center;"><?php echo $message; ?></p>
        <?php endif; ?>
        
        <form action="" method="post">
            <div class="input">
                <label>Username</label>
                <input type="text" name="username" style="width: 100%; box-sizing: border-box;" required>
            </div>
            <div class="input">
                <label>Password</label>
                <input type="password" name="password" style="width: 100%; box-sizing: border-box;" required>
            </div>
            <div class="submit" style="text-align: center; margin-top: 20px;">
                <input type="submit" name="submit" value="Login" class="btn btn-large">
            </div>
        </form>
        <p style="text-align: center;"><a href="index.php">Kembali ke Home</a></p>
    </div>
</body>
</html>