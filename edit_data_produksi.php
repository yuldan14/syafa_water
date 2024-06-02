<!DOCTYPE html>
<html>

<head>
    <title>Edit Data  Produksi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Gaya popup */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
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

    if (isset($_GET['id_produksi'])) {
        $id_produksi = $_GET['id_produksi'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_baru = $_POST['nama_barang'];
            $tanggal_baru = $_POST['tanggal_produksi'];
            $jumlah_baru = $_POST['jumlah_produksi'];
            $harga_baru = $_POST['harga_produksi'];

            // Query untuk mengupdate data berdasarkan ID
            $query = "UPDATE data_produksi SET nama_barang = '$nama_baru', tanggal_produksi = '$tanggal_baru    ', jumlah_produksi = $jumlah_baru, harga_produksi = '$harga_baru' WHERE id_produksi = $id_produksi";

            if ($koneksi->query($query) === TRUE) {
                // Tampilkan popup "Data berhasil di edit"
                echo '<div class="popup" id="popup">Data berhasil di edit.</div>';
                echo '<script>
                    setTimeout(function() {
                        document.getElementById("popup").style.display = "none";
                        window.location.href = "data_produksi.php";
                    }, 2000); // Arahkan ke halaman data_barang_masuk.php setelah 2 detik
                </script>';
            } else {
                echo "Terjadi kesalahan: " . $koneksi->error;
            }
        } else {
            // Ambil data dari database berdasarkan ID
            $query = "SELECT * FROM data_produksi WHERE id_produksi = $id_produksi";
            $result = $koneksi->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama_barang = $row['nama_barang'];
                $tanggal_produksi = $row['tanggal_produksi'];
                $jumlah_produksi = $row['jumlah_produksi'];
                $harga_produksi = $row['harga_produksi'];
            } else {
                echo "Data tidak ditemukan.";
            }
        }
    } else {
        echo "ID tidak valid.";
    }


echo "<div class='form'>
        <div class='isi'>
            <h1>Edit Data Produksi</h1>
            <form method='post'>
                <table>
                    <tr>
                        <td><label for='tanggal_produksi'>Tanggal</label></td>
                        <td><input type='date' name='tanggal_produksi'   value='$tanggal_produksi'></td>
                    </tr>
                    <tr>
                        <td><label for='nama_barang'>Nama Barang </label></td>
                        <td>
                            <select name='nama_barang' id='nama_barang' onchange='updateIdBarang()' required >";

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_syafa";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query SQL untuk mendapatkan data nama_barang dari stok_barang
$sql = "SELECT nama_barang FROM stok_barang";

$result = $conn->query($sql);

// Memeriksa apakah query berhasil dieksekusi
if ($result === false) {
    die("Error dalam eksekusi query: " . $conn->error);
}

// Mengisi opsi dengan hasil query
while ($row = $result->fetch_assoc()) {
    $nama_barang = $row['nama_barang'];
    echo "<option value='$nama_barang'>$nama_barang</option>";
}

// Menutup hasil query
$result->close();

// Menutup koneksi
$conn->close();

echo "</select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for='jumlah_produksi'>Jumlah</label></td>
                        <td><input type='number' name='jumlah_produksi' value='$jumlah_produksi' required></td>
                    </tr>
                    <tr>
                        <td><label for='harga_produksi'>Harga</label></td>
                        <td><input type='text' name='harga_produksi' id='harga_produksi' required readonly value='$harga_produksi'></td>
                    </tr>
                </table>
                <input type='submit' value='Simpan'>
            </form>
        </div>
    </div>";
?>

    <script>
        // Tampilkan popup jika data berhasil di edit
        setTimeout(function() {
            document.getElementById("popup").style.display = "none";
            window.location.href = "data_produksi.php";
        }, 2000); // Arahkan ke halaman data_barang_masuk.php setelah 2 detik
    </script>
    <script>
        function updateIdBarang() {
            var namaBarang = document.getElementById('nama_barang').value;
            var hargaProduksiInput = document.getElementById('harga_produksi');

            // AJAX request to fetch id_barang and harga_produksi based on selected nama_barang
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);

                    // Update id_barang and harga_produksi fields
                    hargaProduksiInput.value = data.harga_produksi;
                }
            };

            xhr.open('GET', 'get_data.php?nama_barang=' + encodeURIComponent(namaBarang), true);
            xhr.send();
        }
    </script>

</body>

</html>