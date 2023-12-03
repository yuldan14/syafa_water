<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <div class="home-head">
                <h2>Beranda</h2>
            </div>
            <div class="welcome">
                <div class="text-welcome">
                    <img src="icon/User.png" alt="">
                    <p>Selamat datang <span>CV SYAFA WATER</span></p>
                </div>
            </div>
            <div class="detail">
                <div class="pemasukan" id="detail">
                    <p>Pemasukan</p>
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
                        $tahun_bulan_ini = date("Y");

                        // Query untuk menghitung total pemasukkan dalam bulan ini
                        $query = "SELECT SUM(harga_jual*jumlah_jual) AS total_pemasukkan FROM data_penjualan WHERE DATE_FORMAT(tanggal_jual, '%Y') = '$tahun_bulan_ini'";
                        $result = $koneksi->query($query);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $total_pemasukkan = $row['total_pemasukkan'];
                            echo "+ Rp " . number_format($total_pemasukkan, 2);
                        } else {
                            echo "Belum ada pemasukkan dalam bulan ini.";
                        }

                        $koneksi->close();
                        ?> </p>
                </div>
                <div class="pengeluaran" id="detail">
                    <p>Pengeluaran</p>
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
                        $tahun_bulan_ini = date("Y");

                        // Query untuk menghitung total pemasukkan dalam bulan ini
                        $query = "SELECT SUM(harga_produksi*jumlah_produksi) AS total_pengeluaran FROM data_produksi WHERE DATE_FORMAT(tanggal_produksi, '%Y') = '$tahun_bulan_ini'";
                        $result = $koneksi->query($query);

                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            $total_pengeluaran = $row['total_pengeluaran'];
                            echo "- Rp " . number_format($total_pengeluaran, 2);
                        } else {
                            echo "Belum ada pengeluaran dalam tahun ini.";
                        }

                        $koneksi->close();
                        ?>
                    </p>
                </div>
                <div class="labarugi" id="detail">
                    <p>Laba/Rugi</p>
                    <p>
                        <?php
                        $penjualan = $total_pemasukkan;
                        $produksi = $total_pengeluaran;
                        $laba = $penjualan - $produksi;

                        echo "Rp " . number_format($laba,2);
                        ?>


                    </p>
                </div>
                <!-- Sertakan perpustakaan jQuery -->
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                <div class="stok" id="detail">
                    <p>Stok Barang di Gudang</p>
                    <p id="dropdown" onclick="toggleDropdown()">
                        <i data-feather='chevron-down'></i>
                    </p>
                    <div id="dropdownContent" style="display: none;">
                        <!-- Konten dropdown akan diisi secara dinamis di sini -->
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        var dropdownContent = $("#dropdownContent");

                        if (dropdownContent.is(":hidden")) {
                            // Ambil data dari server dan isi dropdown
                            fetchDataAndPopulateDropdown();
                            dropdownContent.show();
                        } else {
                            dropdownContent.hide();
                        }
                    }

                    function fetchDataAndPopulateDropdown() {
                        // Gunakan AJAX untuk mengambil data dari server
                        $.ajax({
                            url: 'fetch_data.php', // Ganti dengan path ke fetch_data.php
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                // Isi dropdown dengan data yang diambil
                                populateDropdown(data);
                            },
                            error: function() {
                                alert('Error mengambil data dari server.');
                            }
                        });
                    }

                    function populateDropdown(data) {
                        var dropdownContent = $("#dropdownContent");
                        dropdownContent.empty(); // Hapus konten yang sudah ada

                        // Loop melalui data dan buat item dropdown
                        for (var i = 0; i < data.length; i++) {
                            var item = $("<p>").text(data[i].nama_barang);
                            dropdownContent.append(item);
                        }
                    }
                </script>

            </div>
            <div class="summary">
                <div class="tabel" id="summary">
                    <table id="tbl">
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>12</td>
                            <td>Galon</td>
                            <td>12000</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>12</td>
                            <td>Galon</td>
                            <td>12000</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>12</td>
                            <td>Galon</td>
                            <td>12000</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>12</td>
                            <td>Galon</td>
                            <td>12000</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>12</td>
                            <td>Galon</td>
                            <td>12000</td>
                            <td>-</td>
                        </tr>
                    </table>
                </div>
                <div class="graf" id="summary">
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

                    // Kueri untuk mengambil data pemasukan dari tabel data_penjualan
                    // Kueri untuk mengambil jumlah harga_jual pada bulan yang sama selama 6 bulan terakhir
                    $queryPemasukan = "SELECT MONTH(tanggal_jual) as bulan_jual, SUM(harga_jual*jumlah_jual) as total_jual FROM data_penjualan WHERE tanggal_jual >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY MONTH(tanggal_jual) ORDER BY tanggal_jual ASC";

                    $resultPemasukan = $conn->query($queryPemasukan);

                    // Kueri untuk mengambil data pengeluaran dari tabel data_produksi
                    $queryPengeluaran = "SELECT MONTH(tanggal_produksi) as bulan_produksi, SUM(harga_produksi*jumlah_produksi) as total_produksi FROM data_produksi WHERE tanggal_produksi>= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY MONTH(tanggal_produksi) ORDER BY tanggal_produksi ASC";
                    $resultPengeluaran = $conn->query($queryPengeluaran);

                    // Kueri untuk mengambil data pengeluaran dari tabel data_produksi
                    $queryBulan = "SELECT MONTH(tanggal_produksi) as INTERVAL 6 MONTH) GROUP BY MONTH(tanggal_produksi) ORDER BY tanggal_produksi DESC";
                    $resultBulan = $conn->query($queryPengeluaran);

                    // Ambil data pemasukan dan pengeluaran dari hasil kueri
                    $dataPemasukan = [];
                    $labels = [];
                    while ($rowPemasukan = $resultPemasukan->fetch_assoc()) {
                        $dataPemasukan[] = $rowPemasukan['total_jual'];
                        $labels[] = date('F', mktime(0, 0, 0, $rowPemasukan['bulan_jual'], 1, date('Y')));
                    }

                    $dataPengeluaran = [];
                    while ($rowPengeluaran = $resultPengeluaran->fetch_assoc()) {
                        $dataPengeluaran[] = $rowPengeluaran['total_produksi'];
                    }

                    // Tutup koneksi
                    $conn->close();
                    ?>

                    <canvas id="myBarChart" width="400" height="200"></canvas>
                </div>

            </div>
        </div>


        <script src="script.js"></script>
        <script>
            // Inisialisasi konteks canvas
            var ctx = document.getElementById('myBarChart').getContext('2d');

            // Inisialisasi diagram batang dengan dua set data
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                            label: 'Pemasukan',
                            data: <?php echo json_encode($dataPemasukan); ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna isi batang biru
                            borderColor: 'rgba(75, 192, 192, 1)', // Warna garis batang biru
                            borderWidth: 1,
                        },
                        {
                            label: 'Pengeluaran',
                            data: <?php echo json_encode($dataPengeluaran); ?>,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)', // Warna isi batang merah
                            borderColor: 'rgba(255, 99, 132, 1)', // Warna garis batang merah
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Rincian 6 Bulan Terakhir'
                        }
                    }
                }
            });
        </script>
        <script>
            feather.replace();
        </script>

</body>

</html>