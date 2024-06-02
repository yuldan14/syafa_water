<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,100&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <h2>Stok Barang</h2>
            </div>
            <div class="welcome">
                <div class="text-welcome">
                    <img src="icon/User.png" alt="">
                    <p>Selamat datang <span>CV SYAFA WATER</span></p>
                </div>
            </div>
            <div class="stok-container">

                <!--Total Item-->
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

                // Kueri untuk mengambil jumlah data dari tabel stok_barang
                $queryStokBarang = "SELECT COUNT(*) AS total_item FROM stok_barang";
                $resultStokBarang = $conn->query($queryStokBarang);
                $rowStokBarang = $resultStokBarang->fetch_assoc();
                $totalItem = $rowStokBarang['total_item'];



                //TotalStok
                // Query untuk mengambil jumlah produksi
                $queryProduksiStok = "SELECT SUM(jumlah_produksi) AS total_produksi_stok FROM data_produksi";
                $resultProduksiStok = $conn->query($queryProduksiStok);
                $rowProduksiStok = $resultProduksiStok->fetch_assoc();
                $jumlahProduksiStok = $rowProduksiStok['total_produksi_stok'];

                // Query untuk mengambil jumlah penjualan
                $queryPenjualanStok = "SELECT SUM(jumlah_jual) AS total_penjualan_stok FROM data_penjualan";
                $resultPenjualanStok = $conn->query($queryPenjualanStok);
                $rowPenjualanStok = $resultPenjualanStok->fetch_assoc();
                $jumlahPenjualanStok = $rowPenjualanStok['total_penjualan_stok'];

                // Hitung sisa stok (jumlah produksi - jumlah penjualan)
                $sisaStok = $jumlahProduksiStok - $jumlahPenjualanStok;



                
                // Query untuk mengambil jumlah produksi
                $queryProduksiGalon = "SELECT SUM(jumlah_produksi) AS total_produksi_galon FROM data_produksi WHERE nama_barang = 'Galon'";
                $resultProduksiGalon = $conn->query($queryProduksiGalon);
                $rowProduksiGalon = $resultProduksiGalon->fetch_assoc();
                $jumlahProduksiGalon = $rowProduksiGalon['total_produksi_galon'];

                // Query untuk mengambil jumlah penjualan
                $queryPenjualanGalon = "SELECT SUM(jumlah_jual) AS total_penjualan_galon FROM data_penjualan WHERE nama_barang = 'Galon'";
                $resultPenjualanGalon = $conn->query($queryPenjualanGalon);
                $rowPenjualanGalon = $resultPenjualanGalon->fetch_assoc();
                $jumlahPenjualan = $rowPenjualanGalon['total_penjualan_galon'];

                // Hitung sisa stok (jumlah produksi - jumlah penjualan)
                $sisaStokGalon = $jumlahProduksiGalon - $jumlahPenjualan;


                //cup
                // Query untuk mengambil jumlah produksi
                $queryProduksiCup = "SELECT SUM(jumlah_produksi) AS total_produksi_cup FROM data_produksi WHERE nama_barang = 'Cup'";
                $resultProduksiCup = $conn->query($queryProduksiCup);
                $rowProduksiCup = $resultProduksiCup->fetch_assoc();
                $jumlahProduksiCup = $rowProduksiCup['total_produksi_cup'];

                // Query untuk mengambil jumlah penjualan
                $queryPenjualanCup = "SELECT SUM(jumlah_jual) AS total_penjualan_cup FROM data_penjualan WHERE nama_barang = 'Cup'";
                $resultPenjualan = $conn->query($queryPenjualanCup);
                $rowPenjualanCup = $resultPenjualan->fetch_assoc();
                $jumlahPenjualanCup = $rowPenjualanCup['total_penjualan_cup'];

                // Hitung sisa stok (jumlah produksi - jumlah penjualan)
                $sisaStokCup = $jumlahProduksiCup - $jumlahPenjualanCup;



                //Botol 330
                // Query untuk mengambil jumlah produksi
                $queryProduksiBotol330 = "SELECT SUM(jumlah_produksi) AS total_produksi_botol330 FROM data_produksi WHERE nama_barang = 'Botol 330 ml'";
                $resultProduksiBotol330 = $conn->query($queryProduksiBotol330);
                $rowProduksiBotol330 = $resultProduksiBotol330->fetch_assoc();
                $jumlahProduksiBotol330 = $rowProduksiBotol330['total_produksi_botol330'];

                // Query untuk mengambil jumlah penjualan
                $queryPenjualanBotol330 = "SELECT SUM(jumlah_jual) AS total_penjualan_botol330 FROM data_penjualan WHERE nama_barang = 'Botol 330 ml'";
                $resultPenjualanBotol330 = $conn->query($queryPenjualanBotol330);
                $rowPenjualanBotol330 = $resultPenjualanBotol330->fetch_assoc();
                $jumlahPenjualanBotol330 = $rowPenjualanBotol330['total_penjualan_botol330'];

                // Hitung sisa stok (jumlah produksi - jumlah penjualan)
                $sisaStokBotol330 = $jumlahProduksiBotol330 - $jumlahPenjualanBotol330;




                //botol 600
                // Query untuk mengambil jumlah produksi
                $queryProduksiBotol600 = "SELECT SUM(jumlah_produksi) AS total_produksi_botol600 FROM data_produksi WHERE nama_barang = 'Botol 600 ml'";
                $resultProduksiBotol600 = $conn->query($queryProduksiBotol600);
                $rowProduksiBotol600 = $resultProduksiBotol600->fetch_assoc();
                $jumlahProduksiBotol600 = $rowProduksiBotol600['total_produksi_botol600'];

                // Query untuk mengambil jumlah penjualan
                $queryPenjualanBotol600 = "SELECT SUM(jumlah_jual) AS total_penjualan_botol600 FROM data_penjualan WHERE nama_barang = 'Botol 600 ml'";
                $resultPenjualanBotol600 = $conn->query($queryPenjualanBotol600);
                $rowPenjualanBotol600 = $resultPenjualanBotol600->fetch_assoc();
                $jumlahPenjualan = $rowPenjualanBotol600['total_penjualan_botol600'];

                // Hitung sisa stok (jumlah produksi - jumlah penjualan)
                $sisaStokBotol600 = $jumlahProduksiBotol600 - $jumlahPenjualan;


                // Jika sisaStok kurang dari 0, masukkan ke dalam jumlah rejected
                if ($sisaStok < 0) {
                    $jumlahRejectedStok = abs($sisaStok); // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStok
                    $sisaStok = 0; // Set $sisaStok menjadi 0 agar tidak menampilkan nilai negatif
                } else{
                    $jumlahRejectedStok = 0; // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStok
                } 
                if ($sisaStokGalon < 0) {
                    $jumlahRejectedGalon = abs($sisaStokGalon); // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokGalon
                    $sisaStokGalon = 0; // Set $sisaStok menjadi 0 agar tidak menampilkan nilai negatif
                } else {
                    $jumlahRejectedGalon = 0; // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokGalon
                }
                
                if ($sisaStokCup < 0) {
                    $jumlahRejectedCup = abs($sisaStokCup); // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokCup
                    $sisaStokCup = 0; // Set $sisaStok menjadi 0 agar tidak menampilkan nilai negatif
                } else{
                    $jumlahRejectedCup = 0; // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokCup
                } 
                if ($sisaStokBotol330 < 0) {
                    $jumlahRejectedBotol330 = abs($sisaStokBotol330); // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokBotol330
                    $sisaStokBotol330 = 0; // Set $sisaStok menjadi 0 agar tidak menampilkan nilai negatif
                } else{
                    $jumlahRejectedBotol330 = 0; // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokBotol330
                } 
                if ($sisaStokBotol600 < 0) {
                    $jumlahRejectedBotol600 = abs($sisaStokBotol600); // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokBotol600
                    $sisaStokBotol600 = 0; // Set $sisaStok menjadi 0 agar tidak menampilkan nilai negatif
                } else{
                    $jumlahRejectedBotol600 = 0; // Menggunakan abs() untuk mendapatkan nilai absolut dari $sisaStokBotol600
                } 
                

                $rejected = $jumlahRejectedGalon + $jumlahRejectedCup+$jumlahRejectedBotol330+$jumlahRejectedBotol600;


                // Tutup koneksi
                $conn->close();

                ?>
                <div class="stok" id="total-item">
                    <div class="gambar">
                        <img src="icon/Vector-3.png" alt="" width="50px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $totalItem; ?></p>
                        <p>Total Items</p>
                    </div>
                </div>
                <div class="stok" id="total-stok">
                    <div class="gambar">
                        <img src="icon/Vector-2.png" alt="" width="50px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $sisaStok; ?></p>
                        <p>Total Stok</p>
                    </div>
                </div>
                    <!-- <div class="stok" id="approved">
                        <div class="gambar">
                            <img src="icon/Vector.png" alt="" width="40px">
                        </div>
                        <div class="keterangan">
                            <p id="jumlah">17</p>
                            <p>Approved</p>
                        </div>
                    </div> -->
                <div class="stok" id="rejected">
                    <div class="gambar">
                        <img src="icon/Vector-1.png" alt="" width="40px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $rejected;?></p>
                        <p>Rejected</p>
                    </div>
                </div>
                <div class="stok" id="galon">
                    <div class="gambar">
                        <img src="icon/🦆 icon _water bottle_.png" alt="" width="30px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $sisaStokGalon ?></p>
                        <p>Galon</p>
                    </div>
                </div>
                <div class="stok" id="cup">
                    <div class="gambar">
                        <img src="icon/🦆 emoji _cup with straw_.png" alt="" width="35px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $sisaStokCup; ?></p>
                        <p>Cup</p>
                    </div>
                </div>
                <div class="stok" id="botol-330">
                    <div class="gambar">
                        <img src="icon/🦆 icon _food water bottle_.png" alt="" width="23px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $sisaStokBotol330; ?></p>
                        <p>Botol 330 ml</p>
                    </div>
                </div>
                <div class="stok" id='botol-600'>
                    <div class="gambar">
                        <img src="icon/Vector-4.png" alt="" width="23px">
                    </div>
                    <div class="keterangan">
                        <p id="jumlah"><?php echo $sisaStokBotol600; ?></p>
                        <p>Botol 600</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>