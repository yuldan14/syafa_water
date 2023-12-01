<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV SYAFA MINERAL</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>


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
            <div class="content">
                <div class="first">
                    <div class="left">
                        <p>Data Produksi</p>
                    </div>
                    <div class="right">
                        <div class="tombol">
                            <a href="tambah_produksi.php">Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="ringkasan">
                    <div class="hari" id="sum">
                        <div class="judul">
                            <p>Total Produksi Hari Ini</p>
                        </div>
                        <div class="isi">
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

                            // Ambil tanggal saat ini dalam format yyyy-mm-dd
                            $tanggal_hari_ini = date("Y-m-d");

                            // Query untuk menghitung total pemasukkan hari ini
                            $query = "SELECT SUM(harga_produksi * jumlah_produksi) AS total_produksi FROM data_produksi WHERE tanggal_produksi = '$tanggal_hari_ini'";
                            $result = $koneksi->query($query);

                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                $total_produksi = $row['total_produksi'];
                                echo "Rp " . number_format($total_produksi, 2);
                            } else {
                                echo "Belum ada produksi hari ini.";
                            }

                            $koneksi->close();
                            ?>

                        </div>
                    </div>
                    <div class="bulan" id="sum">
                        <div class="judul">
                            <p>Total Produksi Bulan Ini</p>
                        </div>
                        <div class="isi">
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
                            $query = "SELECT SUM(harga_produksi*jumlah_produksi) AS total_pemasukkan FROM data_produksi WHERE DATE_FORMAT(tanggal_produksi, '%Y-%m') = '$tahun_bulan_ini'";
                            $result = $koneksi->query($query);

                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                $total_pemasukkan = $row['total_pemasukkan'];
                                echo "Rp " . number_format($total_pemasukkan, 2);
                            } else {
                                echo "Belum ada pemasukkan dalam bulan ini.";
                            }

                            $koneksi->close();
                            ?>
                        </div>
                    </div>
                    <div class="tahun" id="sum">
                        <div class="judul">
                            <p>Total Produksi Tahun Ini</p>
                        </div>
                        <div class="isi">
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
                            $tahun_bulan_ini = date("Y");

                            // Query untuk menghitung total pemasukkan dalam bulan ini
                            $query = "SELECT SUM(harga_produksi*jumlah_produksi) AS total_pemasukkan FROM data_produksi WHERE DATE_FORMAT(tanggal_produksi, '%Y') = '$tahun_bulan_ini'";
                            $result = $koneksi->query($query);

                            if ($result->num_rows == 1) {
                                $row = $result->fetch_assoc();
                                $total_pemasukkan = $row['total_pemasukkan'];
                                echo "Rp " . number_format($total_pemasukkan, 2);
                            } else {
                                echo "Belum ada pemasukkan dalam bulan ini.";
                            }

                            $koneksi->close();
                            ?>
                        </div>
                    </div>
                </div>
                <div class="hasil">
                    <div class="daftar">
                        <p>Daftar Produksi</p>
                    </div>
                    <?php
                    // Koneksi ke database
                    $koneksi = new mysqli('localhost', 'root', '', 'admin_syafa');

                    if ($koneksi->connect_error) {
                        die("Koneksi ke database gagal: " . $koneksi->connect_error);
                    }

                    // Tentukan jumlah item per halaman
                    $itemsPerHalaman = 5;

                    // Tentukan halaman saat ini
                    $halamanSaatIni = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

                    // Hitung offset untuk query database
                    $offset = ($halamanSaatIni - 1) * $itemsPerHalaman;

                    // Query untuk mengambil data dari tabel "data_barang_keluar" dengan batasan per halaman
                    $query = "SELECT * FROM data_produksi ORDER BY tanggal_produksi DESC LIMIT $itemsPerHalaman OFFSET $offset ";
                    $result = $koneksi->query($query);

                    $i = 1 + ($halamanSaatIni - 1) * $itemsPerHalaman; // Nomor item dimulai dari 1 untuk setiap halaman
                    ?>

                    <table>
                        <tr>
                            <th>No</th>
                            <th width='200px' ;>Tanggal</th>
                            <th>Id Barang</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga</th>
                            <th>Total Produksi</th>
                            <th colspan="2">Edit</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $i . "</td>";

                            // Ubah format tampilan tanggal
                            $tanggal = date('j M Y', strtotime($row['tanggal_produksi']));
                            echo "<td>" . $tanggal . "</td>";

                            echo "<td>" . $row['id_barang'] . "</td>";
                            echo "<td>" . $row['nama_barang'] . "</td>";
                            echo "<td>" . $row['jumlah_produksi'] . "</td>";
                            echo "<td>" ."Rp". number_format($row['harga_produksi']) . "</td>";

                            $total_pengeluaran = $row['jumlah_produksi'] * $row['harga_produksi'];
                            echo "<td>" . "Rp".number_format($total_pengeluaran) . "</td>";

                            echo "<td><a href='edit_data_produksi.php?id=" . $row['id_barang'] . "'><i data-feather='edit'></i></a></td>";
                            echo "<td><a href='proses_hapus_produksi.php?id=" . $row['id_barang'] . "'><i data-feather='trash'></i></a></td>";
                            echo "</tr>";
                            $i++;
                        }
                        echo "</table>";
                        ?>


                        <div id="pagination">
                            <?php
                            $queryTotalItems = "SELECT COUNT(*) as total FROM data_produksi";
                            $resultTotalItems = $koneksi->query($queryTotalItems);
                            $totalItems = $resultTotalItems->fetch_assoc()['total'];
                            $totalHalaman = ceil($totalItems / $itemsPerHalaman);
                            ?>

                            <button onclick="prevPage(event)">Prev</button>
                            <div class="info-halaman">
                                Halaman <span id="currentPage"><?= $halamanSaatIni ?></span> / <?= $totalHalaman ?>
                            </div>
                            <button onclick="nextPage(event)">Next</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Definisikan JavaScript untuk mengatur halaman
    var currentPage = <?= $halamanSaatIni ?>;
    var totalPage = <?= $totalHalaman ?>;

    function nextPage(event) {
        event.preventDefault(); // Mencegah perilaku default tombol
        if (currentPage < totalPage) {
            currentPage++;
            window.location.href = '?halaman=' + currentPage;
        }
    }

    function prevPage(event) {
        event.preventDefault(); // Mencegah perilaku default tombol
        if (currentPage > 1) {
            currentPage--;
            window.location.href = '?halaman=' + currentPage;
        }
    }
    // Fungsi untuk mengatur posisi scroll
    function setScrollPosition() {
        var currentPosition = window.scrollY || document.documentElement.scrollTop;
        window.scrollTo(0, currentPosition);
    }

    // Jalankan fungsi setScrollPosition saat halaman selesai dimuat
    window.onload = function() {
        setScrollPosition();
    };
</script>
    <?php
    $koneksi->close();
    ?>
    <script>
        feather.replace();
    </script>
</body>

</html>