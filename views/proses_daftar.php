<?php
// Koneksi ke database
require_once '../includes/koneksi.php'; 

// Ambil data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$semester = $_POST['semester'];
$pil_bea = $_POST['pil_bea'];

// Validasi IPK
if (!is_numeric($_POST['ipk']) || $_POST['ipk'] < 0) {
    die("IPK tidak valid");
}
$ipk = $_POST['ipk'];

// Validasi file upload
$file = $_FILES['file'];
$fileName = basename($file['name']);
$fileTmpName = $file['tmp_name'];
$fileSize = $file['size'];
$fileError = $file['error'];
$fileType = $file['type'];

// Tentukan folder upload
$uploadDir = '../uploads/';
$uploadFile = $uploadDir . $fileName;

// Cek apakah IPK valid untuk memilih beasiswa dan upload file
if ($ipk >= 3) {
    if ($fileError === UPLOAD_ERR_OK) {
        if (move_uploaded_file($fileTmpName, $uploadFile)) {
            $fileStatus = "File berhasil diupload.";
        } else {
            $fileStatus = "Gagal mengupload file.";
        }
    } else {
        $fileStatus = "Tidak ada file yang diupload.";
    }
} else {
    $fileStatus = "IPK di bawah 3. Pilihan beasiswa dan upload file dinonaktifkan.";
}

// Periksa apakah NIM sudah ada di tabel ipk
$sql_check_ipk = "SELECT * FROM ipk WHERE nim = ?";
$stmt_check_ipk = $conn->prepare($sql_check_ipk);
$stmt_check_ipk->bind_param('s', $nim);
$stmt_check_ipk->execute();
$result_check_ipk = $stmt_check_ipk->get_result();

if ($result_check_ipk->num_rows > 0) {
    // Jika NIM ada di tabel ipk, lanjutkan dengan insert ke tabel mahasiswa
    $status_ajuan = 'belum di verifikasi'; // Menetapkan status
    $sql_insert_mahasiswa = "INSERT INTO mahasiswa (nim, nama, email, no_hp, semester, jns_bea, file, status_ajuan)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE nama = VALUES(nama), email = VALUES(email), no_hp = VALUES(no_hp), semester = VALUES(semester), jns_bea = VALUES(jns_bea), file = VALUES(file), status_ajuan = VALUES(status_ajuan)";
    $stmt_insert_mahasiswa = $conn->prepare($sql_insert_mahasiswa);
    $stmt_insert_mahasiswa->bind_param('ssssssss', $nim, $nama, $email, $no_hp, $semester, $pil_bea, $fileName, $status_ajuan);

    if ($stmt_insert_mahasiswa->execute()) {
        // Redirect ke halaman hasil setelah berhasil ditambahkan atau diperbarui
        header('Location: hasil.php');
        exit();
    } else {
        echo "Error: " . $stmt_insert_mahasiswa->error;
    }

    $stmt_insert_mahasiswa->close();
} else {
    echo "NIM tidak ditemukan di tabel ipk.";
}

$stmt_check_ipk->close();
$conn->close();
