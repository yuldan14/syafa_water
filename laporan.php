<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
</head>

<body>
    <div class="container">
        <div class="side">
            <div class="head-logo">
                <img src="icon.png" alt="" width=100px>
            </div>
            <ul>
                <li><img src="icon/🦆 icon _home_.png" alt=""><a href="beranda.php">Beranda</a></li>
                <li><img src="icon/🦆 icon _cart_.png" alt=""><a href="data_produksi.php">Data Produksi</a></li>
                <li><img src="icon/🦆 icon _credit card_.png" alt=""><a href="data_penjualan.php">Data Penjualan</a></li>
                <li><img src="icon/Vector.png" alt=""><a href="laporan.php">Laporan</a></li>
                <li><img src="icon/🦆 icon _clipboard_.png" alt=""><a href="stok.php">Stok Barang</a></li>
            </ul>
        </div>
        <div class="main">
            <div class="head">
                <div class="profil">
                    <p>CV SYAFA WATER</p>
                    <p>Admin</p>
                </div>
                <div class="tombol">
                    <a href="login.php">Logout</a>
                </div>
            </div>
            <div class="home-head">
                <h2>Laporan</h2>
            </div>
            <div class="detail">
                <div class="pemasukan" id="detail">
                    <p>Pemasukan</p>
                    <p>
                        +Rp. 15.000.000
                    </p>
                </div>
                <div class="pengeluaran" id="detail">
                    <p>Pengeluaran</p>
                    <p>
                        +Rp. 15.000.000
                    </p>
                </div>
                <div class="labarugi" id="detail">
                    <p>Laba/Rugi</p>
                    <p>
                        +Rp. 15.000.000
                    </p>
                </div>
            </div>
            <div class="hasil">
                <div class="daftar">
                    <p>Laporan Laba/Rugi</p>
                </div>
                <table id="data-barang">
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal</th>
                        <th>Id Barang</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah Barang</th>
                        <th> Harga</th>
                        <th>Total Pemasukkan</th>
                        <th colspan="2">Edit</th>
                    </tr>
                    <?php

                    // Koneksi ke database
                    $koneksi = new mysqli('localhost', 'root', '', 'syafa');

                    if ($koneksi->connect_error) {
                        die("Koneksi ke database gagal: " . $koneksi->connect_error);
                    }

                    // Query untuk mengambil data dari tabel "data_barang_masuk"
                    $query = "SELECT * FROM data_barang_masuk";
                    $result = $koneksi->query($query);
                    $i = 1;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['id_barang'] . "</td>";
                            echo "<td>" . $row['jenis'] . "</td>";
                            echo "<td>" . $row['jumlah'] . "</td>";
                            echo "<td>" . $row['harga'] . "</td>";
                            $total_pemasukkan = $row['jumlah'] * $row['harga'];
                            echo "<td>" . $total_pemasukkan . "</td>";
                            echo "<td><a href='edit_data_masuk.php?id=" . $row['id_barang'] . "'>Edit</a></td>";
                            echo "<td><a href='proses_hapus_masuk.php?id=" . $row['id_barang'] . "'>Hapus</a></td>";

                            echo "</tr>";
                            $i++;
                        }
                    } else {
                        echo "Tidak ada data barang masuk.";
                    }

                    $koneksi->close();
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>