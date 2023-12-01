<!DOCTYPE html>
<html>

<head>
    <title>Input Data Produksi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #id {
            display: none;
        }

        .form .isi select {
            padding: 10px;
            border-radius: 10px;
        }

        .isi form .simpan {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            width: 100%;

        }

        .isi form input[type='submit'] {
            background-color: var(--judul);
            color: var(--font);
            font-weight: 700;
            border: none;
            padding: 15px;
            font-size: 18px;
            cursor: pointer;
        }

        .form-head {
            display: flex;
            height: 50px;
            align-items: center;
            background-color: var(--tombol);
        }

        .form-head .back {
            padding: 11px 23px;
            margin-right: 20px;
        }

        .form-head .back:hover {
            background-color: var(--judul);
            transition: .4s;
        }

        .form-head .back a {
            color: black;
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>

</head>

<body>
    <div class="form-head">
        <div class="back">
            <a href="data_produksi.php"><i data-feather='chevron-left'></i></a>
        </div>
        <div class="judul">
            <h3>Input Data Produksi</h3>
        </div>
    </div>
    <div class="form">
        <div class="isi">
            <form method="post" action="simpan_data_produksi.php">
                <table>
                    <tr>
                        <td><label for="tanggal_produksi">Tanggal Produksi</label></td>
                        <td><input type="date" name="tanggal_produksi" required></td>
                    </tr>
                    <tr id="id_barang">
                        <td> <label for="id_barang">Id </label></td>
                        <td>
                            <!-- autocomplete -->
                            <input type="text" name="id_barang" id="id_barang_input" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td> <label for="nama_barang">Nama </label></td>
                        <td>
                            <select name="nama_barang" id="nama_barang" onchange="updateIdBarang()" required>
                                <?php
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
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="jumlah_produksi">Jumlah</label></td>
                        <td><input type="number" name="jumlah_produksi" required></td>
                    </tr>
                    <tr>
                        <td><label for="harga_produksi">Harga</label></td>
                        <td><input type="text" name="harga_produksi" id="harga_produksi" required readonly></td>
                    </tr>
                </table>
                <div class="simpan">
                    <input type="submit" value="Simpan">
                </div>
                <script>
                    function updateIdBarang() {
                        var namaBarang = document.getElementById('nama_barang').value;
                        var idBarangInput = document.getElementById('id_barang_input');
                        var hargaProduksiInput = document.getElementById('harga_produksi');

                        // AJAX request to fetch id_barang and harga_produksi based on selected nama_barang
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                var data = JSON.parse(xhr.responseText);

                                // Update id_barang and harga_produksi fields
                                idBarangInput.value = data.id_barang;
                                hargaProduksiInput.value = data.harga_produksi;
                            }
                        };

                        xhr.open('GET', 'get_data.php?nama_barang=' + encodeURIComponent(namaBarang), true);
                        xhr.send();
                    }
                </script>
            </form>
        </div>
    </div>
    <script>
        feather.replace();
    </script>
</body>

</html>