<?php
// Koneksi ke database
$host = 'localhost'; // Ganti dengan nama host database Anda
$user = 'root'; // Ganti dengan nama pengguna database Anda
$pass = ''; // Ganti dengan kata sandi database Anda
$dbname = 'admin_syafa'; // Ganti dengan nama database Anda

$koneksi = new mysqli($host, $user, $pass, $dbname);

if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Periksa apakah parameter `id` ada dalam URL
if (isset($_GET['id_produksi'])) {
    $id_produksi = $_GET['id_produksi'];

    // Query untuk menghapus data berdasarkan `id_produksi`
    $query = "DELETE FROM data_produksi WHERE id_produksi = $id_produksi";

    if ($koneksi->query($query) === TRUE) {
        // Jika data berhasil dihapus, arahkan kembali ke halaman data_barang_keluar.php
        header("Location: data_produksi.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $koneksi->error;
    }
} else {
    echo "ID barang tidak valid.";
}

$koneksi->close();
?>
