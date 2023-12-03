<?php
// get_data.php

// Your database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_syafa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected 'nama_barang' from the request
$namaBarang = $_GET['nama_barang'];

// Prepare and execute a query to get data based on the selected 'nama_barang'
$sql = "SELECT id_barang, harga_jual FROM stok_barang WHERE nama_barang = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $namaBarang);
$stmt->execute();

// Check for errors in the query
if ($stmt->error) {
    die("Error in query: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Prepare the data to be sent as JSON
    $data = array(
        'id_barang' => $row['id_barang'],
        'harga_jual' => $row['harga_jual']
    );

    // Send the data as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    // If no rows are found, you may want to handle this case accordingly
    echo "No data found for the selected nama_barang.";
}

// Close the connections
$stmt->close();
$conn->close();
?>
