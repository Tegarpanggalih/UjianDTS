<?php
// Menghubungkan file koneksi ke database
require_once '../includes/koneksi.php';

// Mengecek apakah parameter 'nim' ada di query string
if (isset($_GET['nim'])) {
    // Mengambil nilai NIM dari query string
    $nim = $_GET['nim'];

    // Query untuk mengambil IPK berdasarkan NIM
    $sql = "SELECT ipk FROM ipk WHERE nim = ?";

    // Menyiapkan statement untuk eksekusi query
    $stmt = $conn->prepare($sql);

    // Mengikat parameter NIM ke statement
    $stmt->bind_param('s', $nim);

    // Menjalankan statement
    $stmt->execute();

    // Mengambil hasil query
    $result = $stmt->get_result();

    // Mengecek apakah ada hasil yang ditemukan
    if ($result->num_rows > 0) {
        // Mengambil data IPK dari hasil query
        $row = $result->fetch_assoc();

        // Mengembalikan hasil sebagai JSON dengan key 'ipk'
        echo json_encode(['ipk' => $row['ipk']]);
    } else {
        // Mengembalikan pesan error jika NIM tidak ditemukan
        echo json_encode(['error' => 'NIM tidak ditemukan']);
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi ke database
$conn->close();
