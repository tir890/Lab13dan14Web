# Lab13_14Web - Pemrograman Web 2 (Pagination & Pencarian)

**Nama** : Tiara Hayatul Khoir

**NIM** : 312410474

**Kelas** : TI.24.A5

## 📝 Deskripsi

Repository ini berisi hasil **Praktikum 13 & 14** mengenai implementasi fitur **Pagination** dan **Pencarian (Searching)** pada aplikasi web PHP Native. Studi kasus yang digunakan adalah **"Itsunui Store"**, sebuah aplikasi toko *merchandise* anime sederhana.

Proyek ini mencakup fitur lengkap:

1. **CRUD** (Create, Read, Update, Delete) Data Barang.
2. **Upload Gambar** untuk produk.
3. **Pagination** untuk membatasi tampilan data per halaman.
4. **Pencarian Data** berdasarkan nama barang.
5. **Login System** sederhana untuk keamanan halaman admin.

Tampilan antarmuka (UI) dikembangkan menggunakan **CSS Native** dengan tema **Natural Green** yang segar dan responsif.

---

## 📂 Struktur Folder

Berikut adalah struktur file dalam proyek ini:

```text
lab13_14_php/
├── css/
│   └── style.css         # Styling CSS (Tema Hijau/Natural)
├── gambar/               # Folder penyimpanan file foto produk yang diupload
├── koneksi.php           # Konfigurasi koneksi database MySQL
├── index.php             # Halaman Utama (Katalog User - Tampilan Grid)
├── admin.php             # Halaman Admin (Dashboard - Tampilan Tabel & Pagination)
├── login.php             # Halaman Login Admin
├── logout.php            # Proses Logout
├── tambah.php            # Form Tambah Data & Proses Upload Gambar
├── edit.php              # Form Edit Data & Update Gambar
├── delete.php            # Proses Menghapus Data
├── header.php            # Template Header & Navigasi
└── footer.php            # Template Footer

```

---

## 🚀 Fitur & Implementasi

### 1. Halaman Utama (Katalog User)

File: `index.php`

Menampilkan data barang dalam format **Grid/Card** agar menarik bagi pembeli. Dilengkapi dengan form pencarian untuk memudahkan user menemukan barang (Nui/Merch) tertentu.

**Output:**

> *(Ganti dengan screenshot halaman index.php)*

---

### 2. Dashboard Admin (Pagination & Search)

File: `admin.php`

Halaman pengelolaan data yang menggunakan tampilan **Tabel**.

* **Pagination:** Membagi data menjadi beberapa halaman agar tidak menumpuk (menggunakan logika `LIMIT` dan `OFFSET` pada query SQL).
* **Searching:** Menggunakan klausa `WHERE nama LIKE '%keyword%'` untuk memfilter data.

**Kode Pagination (Snippet):**

```php
$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;
$sql .= " LIMIT {$offset}, {$per_page}";

```

**Output:**

> *(Ganti dengan screenshot halaman admin.php)*

---

### 3. Fitur Create & Upload Gambar

File: `tambah.php`

Form untuk menambahkan data barang baru. Fitur ini menangani proses **Upload File** gambar ke folder lokal dan menyimpan nama filenya ke database.

**Kode Upload (Snippet):**

```php
$filename = str_replace(' ', '_', $_FILES['file_gambar']['name']);
$destination = 'gambar/' . $filename;
move_uploaded_file($_FILES['file_gambar']['tmp_name'], $destination);

```

**Output:**

> *(Ganti dengan screenshot halaman tambah.php)*

---

### 4. Fitur Login

File: `login.php`

Mengamankan halaman admin agar hanya user yang terdaftar di tabel `users` yang bisa mengakses fitur pengelolaan barang. Password disimpan menggunakan enkripsi **MD5**.

**Output:**

> *(Ganti dengan screenshot halaman login.php)*

---

## 🎨 Tampilan UI (Layout)

Desain menggunakan **CSS Native** (`style.css`) dengan skema warna **Forest Green**:

* **Header**: Warna Hijau Tua (`#2E7D32`) memberikan kesan profesional dan alami.
* **Navigasi**: Warna Hijau Material (`#4CAF50`) dengan efek hover.
* **Tabel**: Header tabel menggunakan warna hijau sangat muda (`#E8F5E9`) agar data mudah dibaca.
* **Responsif**: Layout menyesuaikan lebar layar, baik tabel maupun grid katalog.

---

## ✅ Kesimpulan

Praktikum ini berhasil mengimplementasikan fitur penting dalam pengembangan web dinamis, yaitu manajemen data yang efisien melalui **Pagination** dan kemudahan akses data melalui **Pencarian**. Penggunaan **Upload Gambar** juga menyempurnakan aplikasi menjadi toko online sederhana yang fungsional.
