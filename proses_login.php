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

// Ambil data dari formulir login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa kredensial pengguna
$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
$result = $koneksi->query($query);

if ($result->num_rows == 1) {
    // Login berhasil
    session_start();
    $_SESSION['username'] = $username; // Simpan username dalam sesi
    header('Location: beranda.php'); // Arahkan ke halaman data_barang_masuk.php
    exit;
} else {
    // Login gagal
    header('Location: login.php?login_error=true'); // Arahkan kembali ke halaman login.php dengan parameter login_error
}

$koneksi->close();
?>
