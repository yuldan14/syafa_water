<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Penjualan</title>
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

    if (isset($_GET['id_jual'])) {
        $id_jual = $_GET['id_jual'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_baru = $_POST['nama_barang'];
            $tanggal_baru = $_POST['tanggal_jual'];
            $jumlah_baru = $_POST['jumlah_jual'];
            $harga_baru = $_POST['harga_jual'];

            // Query untuk mengupdate data berdasarkan ID
            $query = "UPDATE data_penjualan SET nama_barang = '$nama_baru', tanggal_jual = '$tanggal_baru', jumlah_jual = $jumlah_baru, harga_jual = '$harga_baru' WHERE id_jual = $id_jual";

            if ($koneksi->query($query) === TRUE) {
                // Tampilkan popup "Data berhasil di edit"
                echo '<div class="popup" id="popup">Data berhasil di edit.</div>';
                echo '<script>
                    setTimeout(function() {
                        document.getElementById("popup").style.display = "none";
                        window.location.href = "data_penjualan.php";
                    }, 2000); // Arahkan ke halaman data_barang_masuk.php setelah 2 detik
                </script>';
            } else {
                echo "Terjadi kesalahan: " . $koneksi->error;
            }
        } else {
            // Ambil data dari database berdasarkan ID
            $query = "SELECT * FROM data_penjualan WHERE id_jual = $id_jual";
            $result = $koneksi->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama_barang = $row['nama_barang'];
                $tanggal_jual = $row['tanggal_jual'];
                $jumlah_jual = $row['jumlah_jual'];
                $harga_jual = $row['harga_jual'];
            } else {
                echo "Data tidak ditemukan.";
            }
        }
    } else {
        echo "ID tidak valid.";
    }


echo "<div class='form'>
        <div class='isi'>
            <h1>Edit Data Penjualan</h1>
            <form method='post'>
                <table>
                    <tr>
                        <td><label for='tanggal_jual'>Tanggal</label></td>
                        <td><input type='date' name='tanggal_jual'   value='$tanggal_jual'></td>
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
                        <td><label for='jumlah_jual'>Jumlah</label></td>
                        <td><input type='number' name='jumlah_jual' value='$jumlah_jual' required></td>
                    </tr>
                    <tr>
                        <td><label for='harga_jual'>Harga</label></td>
                        <td><input type='text' name='harga_jual' id='harga_jual' required readonly value='$harga_jual'></td>
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
            window.location.href = "data_penjualan.php";
        }, 2000); // Arahkan ke halaman data_barang_masuk.php setelah 2 detik
    </script>
    <script>
        function updateIdBarang() {
            var namaBarang = document.getElementById('nama_barang').value;
            var hargaProduksiInput = document.getElementById('harga_jual');

            // AJAX request to fetch id_barang and harga_jual based on selected nama_barang
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var data = JSON.parse(xhr.responseText);

                    // Update id_barang and harga_jual fields
                    hargaProduksiInput.value = data.harga_jual;
                }
            };

            xhr.open('GET', 'get_data.php?nama_barang=' + encodeURIComponent(namaBarang), true);
            xhr.send();
        }
    </script>

</body>

</html>