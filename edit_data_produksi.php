<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang Masuk</title>
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
            $query = "UPDATE data_produksi SET nama_barang = '$nama_baru', tanggal_produksi = '$tanggal_baru', jumlah_produksi = $jumlah_baru, harga_produksi = '$harga_baru' WHERE id_produksi = $id_produksi";

            if ($koneksi->query($query) === TRUE) {
                // Tampilkan popup "Data berhasil di edit"
                echo '<div class="popup" id="popup">Data berhasil di edit.</div>';
                echo '<script>
                    setTimeout(function() {
                        document.getElementById("popup").style.display = "none";
                        window.location.href = "data_barang_masuk.php";
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

                echo"<div class='form'>
                <div class='isi'>
                <h1>Edit Data Barang Masuk</h1>
                <form method='post'>
                <table>
                <tr>
                    <td><label for='tanggal_produksi'>Tanggal</label></td>
                    <td><input type='date' name='tanggal_produksi'value='$tanggal_produksi' required></td>
                </tr>
                <tr>
                    <td> <label for='nama_barang'>Nama Barang </label></td>
                    <td><input type='text' name='nama' value='$nama_barang' required></td>
                </tr>
                <tr>
                    <td><label for='jumlah_produksi'>Jumlah</label></td>
                    <td><input type='number' name='jumlah_produksi' value='$jumlah_produksi' required></td>
                </tr>
                <tr>
                    <td><label for='harga_produksi'>Harga</label></td>
                    <td><input type='text' name='harga_produksi' value='$harga_produksi' required></td>
                </tr>
                </table>
                <input type='submit' value='Simpan'>
                </form>
                </div>
                </div>";
            } else {
                echo "Data tidak ditemukan.";
            }
        }
    } else {
        echo "ID tidak valid.";
    }

    $koneksi->close();
    ?>
    <script>
    // Tampilkan popup jika data berhasil di edit
    setTimeout(function() {
        document.getElementById("popup").style.display = "none";
        window.location.href = "data_produksi.php";
    }, 2000); // Arahkan ke halaman data_barang_masuk.php setelah 2 detik
    </script>

</body>
</html>
