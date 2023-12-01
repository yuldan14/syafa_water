<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang Keluar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100&family=Roboto&display=swap" rel="stylesheet">
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
    $dbname = 'syafa'; // Ganti dengan nama database Anda

    $koneksi = new mysqli($host, $user, $pass, $dbname);

    if ($koneksi->connect_error) {
        die("Koneksi ke database gagal: " . $koneksi->connect_error);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $jenis_baru = $_POST['jenis'];
            $tanggal_baru = $_POST['tanggal'];
            $jumlah_baru = $_POST['jumlah'];
            $harga_baru = $_POST['harga'];

            // Query untuk mengupdate data berdasarkan ID
            $query = "UPDATE data_barang_keluar SET jenis = '$jenis_baru', tanggal = '$tanggal_baru', jumlah = $jumlah_baru, harga_jual = '$harga_baru' WHERE id_barang = $id";

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
            $query = "SELECT * FROM data_barang_keluar WHERE id_barang = $id";
            $result = $koneksi->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $jenis = $row['jenis'];
                $tanggal = $row['tanggal'];
                $jumlah = $row['jumlah'];
                $harga = $row['harga_jual'];

                echo "<form method='post'>";
                echo "<div class='form'>
                <div class='isi'>
                <h1>Edit Data Barang Keluar</h1>
                <form method='post'>
                <table>
                <tr>
                    <td><label for='tanggal'>Tanggal</label></td>
                    <td><input type='date' name='tanggal'value='$tanggal' required></td>
                </tr>
                <tr>
                    <td> <label for='jenis'>Jenis </label></td>
                    <td><input type='text' name='jenis' value='$jenis' required></td>
                </tr>
                <tr>
                    <td><label for='jumlah'>Jumlah</label></td>
                    <td><input type='number' name='jumlah' value='$jumlah' required></td>
                </tr>
                <tr>
                    <td><label for='harga'>Harga</label></td>
                    <td><input type='text' name='harga' value='$harga' required></td>
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
            window.location.href = "data_barang_keluar.php";
        }, 2000); // Arahkan ke halaman data_barang_masuk.php setelah 2 detik
    </script>

</body>

</html>