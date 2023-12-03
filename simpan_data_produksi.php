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
$tanggal_produksi = $_POST['tanggal_produksi'];
$id_barang= $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$jumlah_produksi = $_POST['jumlah_produksi'];
$harga_produksi = $_POST['harga_produksi'];

// Query SQL untuk menyimpan data ke dalam tabel data_produksi
$sql = "INSERT INTO data_produksi (tanggal_produksi,id_barang, nama_barang, jumlah_produksi, harga_produksi) VALUES ('$tanggal_produksi','$id_barang', '$nama_barang', '$jumlah_produksi', '$harga_produksi')";

// Menjalankan query
if ($conn->query($sql) === TRUE) {
    // Data berhasil disimpan, menampilkan popup dan mengarahkan ke halaman data_barang_masuk.php
    echo "<script>
            alert('Data berhasil disimpan!');
            window.location.href = 'data_produksi.php';
          </script>";
    exit();
} else {
    // Terjadi kesalahan saat menyimpan data
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
