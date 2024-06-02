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
    <style>
        .tabel {
            width: 100%;
        }

        .tabel table#pemasukkan {
            margin-bottom: 100px;
        }
    </style>
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
                    <p>Pemasukan Bulan Ini</p>
                    <p>
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

                        // Ambil tahun dan bulan saat ini
                        $tahun_bulan_ini = date("Y-m");

                        // Query untuk menghitung total pemasukkan dalam bulan ini
                        $query = "SELECT SUM(harga_jual*jumlah_jual) AS total_pemasukkan FROM data_penjualan WHERE DATE_FORMAT(tanggal_jual, '%Y-%m') = '$tahun_bulan_ini'";
                        $result = $koneksi->query($query);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $total_pemasukkan = $row['total_pemasukkan'];
                            echo "+ Rp " . number_format($total_pemasukkan, 2);
                        } else {
                            echo "Rp -";
                        }

                        ?>
                    </p>
                </div>
                <div class="pengeluaran" id="detail">
                    <p>Pengeluaran Bulan Ini</p>
                    <p>
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

                        // Ambil tahun dan bulan saat ini
                        $tahun_bulan_ini = date("Y-m");

                        // Query untuk menghitung total pemasukkan dalam bulan ini
                        $query = "SELECT SUM(harga_produksi*jumlah_produksi) AS total_pengeluaran FROM data_produksi WHERE DATE_FORMAT(tanggal_produksi, '%Y-%m') = '$tahun_bulan_ini'";
                        $result = $koneksi->query($query);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $total_pengeluaran = $row['total_pengeluaran'];
                            echo "- Rp " . number_format($total_pengeluaran, 2);
                        } else {
                            echo "Rp. -";
                        }
                        ?>
                    </p>
                </div>
                <div class="labarugi" id="detail">
                    <p>Laba/Rugi Bulan Ini</p>
                    <p>
                        <?php
                        $laba = $total_pemasukkan - $total_pengeluaran;
                        echo "Rp " . number_format($laba, 2);                        ?>
                    </p>
                </div>
            </div>
            <div class="hasil">
                <div class="daftar">
                    <p>Laporan Laba/Rugi</p>
                </div>
                <div class="tabel">
                    <table id="pemasukkan">
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Total pemasukkan</th>
                        </tr>
                        <?php

                        // Koneksi ke database
                        $koneksi = new mysqli('localhost', 'root', '', 'admin_syafa');

                        if ($koneksi->connect_error) {
                            die("Koneksi ke database gagal: " . $koneksi->connect_error);
                        }

                        // Query untuk mengambil data dari tabel "data_barang_masuk"
                        $query = "SELECT * FROM data_penjualan";
                        $result = $koneksi->query($query);
                        $i = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                $tanggal_jual = date('j M Y', strtotime($row['tanggal_jual']));

                                echo "<td>" . $tanggal_jual . "</td>";
                                echo "<td>" . $row['nama_barang'] . "</td>";
                                echo "<td>" . $row['jumlah_jual'] . "</td>";
                                $total_pemasukan = $row['jumlah_jual'] * $row['harga_jual'];
                                echo "<td>" . $total_pemasukan . "</td>";

                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan=5>";
                            echo "Tidak ada data barang masuk.";
                            echo "</td>";
                            echo "</tr>";
                        }

                        $koneksi->close();
                        ?>
                    </table>
                    <table id="Pengeluaran">
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Total Pengeluaran</th>
                        </tr>
                        <?php

                        // Koneksi ke database
                        $koneksi = new mysqli('localhost', 'root', '', 'admin_syafa');

                        if ($koneksi->connect_error) {
                            die("Koneksi ke database gagal: " . $koneksi->connect_error);
                        }

                        // Query untuk mengambil data dari tabel "data_barang_masuk"
                        $query = "SELECT * FROM data_produksi";
                        $result = $koneksi->query($query);
                        $i = 1;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                $tanggal_produksi = date('j M Y', strtotime($row['tanggal_produksi']));

                                echo "<td>" . $tanggal_produksi . "</td>";
                                echo "<td>" . $row['nama_barang'] . "</td>";
                                echo "<td>" . $row['jumlah_produksi'] . "</td>";
                                $total_pemasukkan = $row['jumlah_produksi'] * $row['harga_produksi'];
                                echo "<td>" . $total_pemasukkan . "</td>";

                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr>";
                            echo "<td colspan=5>";
                            echo "Tidak ada data barang masuk.";
                            echo "</td>";
                            echo "</tr>";
                        }

                        $koneksi->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>