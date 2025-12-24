<?php
include_once 'header.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    
    // Proses Upload Gambar
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = $filename;
        }
    }

    // Query Insert Data
    $sql = "INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) 
            VALUES ('$kategori', '$nama', '$gambar', '$harga_beli', '$harga_jual', '$stok')";
            
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        header('location: admin.php'); // Redirect ke admin setelah berhasil
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Tambah Barang</h2>
<form action="tambah.php" method="post" enctype="multipart/form-data">
    <div class="input">
        <label>Nama Barang</label>
        <input type="text" name="nama" required>
    </div>
    <div class="input">
        <label>Kategori</label>
        <select name="kategori">
            <option value="Plushie">Plushie (Nui)</option>
            <option value="Acrylic">Acrylic Stand</option>
            <option value="Pin">Can Badge</option>
            <option value="Apparel">Apparel</option>
        </select>
    </div>
    <div class="input">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" required>
    </div>
    <div class="input">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" required>
    </div>
    <div class="input">
        <label>Stok</label>
        <input type="number" name="stok" required>
    </div>
    <div class="input">
        <label>File Gambar</label>
        <input type="file" name="file_gambar">
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Simpan" class="btn btn-large">
    </div>
</form>

<?php include_once 'footer.php'; ?>