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
if (isset($_GET['id_jual'])) {
    $id_jual = $_GET['id_jual'];

    // Query untuk menghapus data berdasarkan `id_barang`
    $query = "DELETE FROM data_penjualan WHERE id_jual = $id_jual";

    if ($koneksi->query($query) === TRUE) {
        // Jika data berhasil dihapus, arahkan kembali ke halaman data_barang_masuk.php
        header("Location: data_penjualan.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . $koneksi->error;
    }
} else {
    echo "ID barang tidak valid.";
}

$koneksi->close();
?>
