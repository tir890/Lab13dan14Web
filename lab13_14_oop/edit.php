<?php
include_once 'header.php';

// Ambil ID dari URL
$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = $data['gambar']; // Default pakai gambar lama

    // Cek jika ada gambar baru diupload
    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = $filename;
        }
    }

    $sql = "UPDATE data_barang SET 
            kategori = '{$kategori}', 
            nama = '{$nama}', 
            gambar = '{$gambar}', 
            harga_beli = '{$harga_beli}', 
            harga_jual = '{$harga_jual}', 
            stok = '{$stok}' 
            WHERE id_barang = '{$id}'";
            
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('location: admin.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<h2>Ubah Data Barang</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="input">
        <label>Nama Barang</label>
        <input type="text" name="nama" value="<?php echo $data['nama'];?>">
    </div>
    <div class="input">
        <label>Kategori</label>
        <select name="kategori">
            <option value="Plushie" <?php echo ($data['kategori'] == 'Plushie') ? 'selected' : ''; ?>>Plushie (Nui)</option>
            <option value="Acrylic" <?php echo ($data['kategori'] == 'Acrylic') ? 'selected' : ''; ?>>Acrylic Stand</option>
            <option value="Pin" <?php echo ($data['kategori'] == 'Pin') ? 'selected' : ''; ?>>Can Badge</option>
        </select>
    </div>
    <div class="input">
        <label>Harga Jual</label>
        <input type="number" name="harga_jual" value="<?php echo $data['harga_jual'];?>">
    </div>
    <div class="input">
        <label>Harga Beli</label>
        <input type="number" name="harga_beli" value="<?php echo $data['harga_beli'];?>">
    </div>
    <div class="input">
        <label>Stok</label>
        <input type="number" name="stok" value="<?php echo $data['stok'];?>">
    </div>
    <div class="input">
        <label>File Gambar (Abaikan jika tidak ingin ganti)</label>
        <input type="file" name="file_gambar">
        <br>
        <img src="gambar/<?php echo $data['gambar'];?>" width="100" style="margin-top:10px;">
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-large">
    </div>
</form>

<?php include_once 'footer.php'; ?>