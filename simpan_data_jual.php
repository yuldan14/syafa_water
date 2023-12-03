<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_syafa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangkap nilai dari formulir
$tanggal_jual = $_POST['tanggal_jual'];
$id_barang= $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$jumlah_jual = $_POST['jumlah_jual'];
$harga_jual = $_POST['harga_jual'];

// Query SQL untuk menyimpan data ke dalam tabel data_jual
$sql = "INSERT INTO data_penjualan (tanggal_jual,id_barang, nama_barang, jumlah_jual, harga_jual) VALUES ('$tanggal_jual','$id_barang', '$nama_barang', '$jumlah_jual', '$harga_jual')";

// Menjalankan query
if ($conn->query($sql) === TRUE) {
    // Data berhasil disimpan, menampilkan popup dan mengarahkan ke halaman data_barang_masuk.php
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location.href = 'data_penjualan.php';
          </script>";
    exit();
} else {
    // Terjadi kesalahan saat menyimpan data
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
