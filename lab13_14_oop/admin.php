<?php
// admin.php
include("koneksi.php");

// 1. Logika Pencarian & Pagination
$q = "";
$sql_where = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE nama LIKE '%{$q}%'"; 
}

$title = 'Halaman Admin';
$sql = 'SELECT * FROM data_barang';
$sql_count = "SELECT COUNT(*) FROM data_barang";

if (!empty($sql_where)) {
    $sql .= $sql_where;
    $sql_count .= $sql_where;
}

$result_count = mysqli_query($conn, $sql_count);
$count = 0;
if ($result_count) {
    $r_data = mysqli_fetch_row($result_count);
    $count = $r_data[0];
}

$per_page = 5; // Ubah angka ini untuk mengatur jumlah baris per halaman
$num_page = ceil($count / $per_page);
$limit = $per_page;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $offset = ($page - 1) * $per_page;
} else {
    $offset = 0;
    $page = 1;
}

$sql .= " LIMIT {$offset}, {$limit}";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Itsunui Store</title>
    <link rel="stylesheet" href="css/style.css"> </head>
<body>
    <div class="container">
        <header>
            <h1>Admin Itsunui Store</h1>
        </header>
        
        <nav>
            <a href="index.php">Lihat Toko (Home)</a>
            <a href="admin.php">Admin Panel</a>
            <a href="logout.php">Logout</a>
        </nav>
        
        <br>
        
        <a href="tambah.php" class="btn btn-large">Tambah Barang</a>
        
        <form action="" method="get" class="search-box">
            <label for="q">Cari data: </label>
            <input type="text" id="q" name="q" value="<?php echo $q; ?>" placeholder="Nama Nui...">
            <input type="submit" name="submit" value="Cari" class="btn btn-primary">
        </form>

        <?php if ($result): ?>
        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($result)): ?>
            <tr>
                <td>
                    <img src="gambar/<?php echo $row['gambar']; ?>" alt="Nui" width="50">
                </td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['kategori']; ?></td>
                <td>Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                <td><?php echo $row['stok']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id_barang']; ?>" class="btn btn-edit">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id_barang']; ?>" class="btn btn-delete" onclick="return confirm('Yakin hapus?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <?php endif; ?>

        <ul class="pagination">
            <?php for ($i = 1; $i <= $num_page; $i++) {
                $link = "?page={$i}";
                if (!empty($q)) $link .= "&q={$q}";
                $class = ($page == $i ? 'active' : '');
                echo "<li><a class=\"{$class}\" href=\"{$link}\">{$i}</a></li>";
            } ?>
        </ul>
        
        <footer>
            &copy; 2024 - Itsunui Store (Praktikum Web)
        </footer>
    </div>
</body>
</html>