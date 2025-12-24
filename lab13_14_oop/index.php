<?php
include_once 'header.php';

// Logika Pencarian Sederhana untuk User
$q = "";
$where = "";
if (isset($_GET['submit']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $where = " WHERE nama LIKE '%{$q}%'";
}

$sql = "SELECT * FROM data_barang {$where}";
$result = mysqli_query($conn, $sql);
?>

<h2 style="margin: 20px 0;">Katalog Barang</h2>

<form action="" method="get" class="search-box">
    <input type="text" name="q" value="<?php echo $q; ?>" placeholder="Cari Nui...">
    <input type="submit" name="submit" value="Cari" class="btn btn-primary">
</form>

<div class="grid-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_array($result)): ?>
            <div class="card" style="border: 1px solid #ddd; padding: 15px; width: 200px; text-align: center; background: #fff;">
                <img src="gambar/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama']; ?>" 
     style="width: 100%; height: 200px; object-fit: cover; margin-bottom: 10px;">
                <h3 style="font-size: 16px; margin: 10px 0;"><?php echo $row['nama']; ?></h3>
                <p style="color: #428bca; font-weight: bold;">Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></p>
                <p style="font-size: 12px; color: #666;"><?php echo $row['kategori']; ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Barang tidak ditemukan.</p>
    <?php endif; ?>
</div>

<?php include_once 'footer.php'; ?>