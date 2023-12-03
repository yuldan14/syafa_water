<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_syafa";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Kueri untuk mengambil data nama_barang dari tabel stok_barang
$query = "SELECT nama_barang FROM stok_barang";
$result = $conn->query($query);

// Ambil data dan kirim sebagai respons JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Tutup koneksi
$conn->close();

// Mengirim respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
