<!-- 
File: detail.php
Description: Halaman untuk menampilkan detail pendaftaran beasiswa berdasarkan NIM. 
Author: Tegar Panggalih
Version: 1.0
Date: 25-07-2024
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftaran Beasiswa</title>
    <!-- Menghubungkan stylesheet CSS eksternal untuk styling -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Tautan ke pustaka ikon eksternal (Ionicons) -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <!-- Preconnect untuk mengoptimalkan pemuatan font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Tautan ke Google Fonts untuk styling font kustom -->
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Bagian header dengan logo dan menu navigasi -->
    <header>
        <div>
            <!-- Logo atau nama merek -->
            <a href="#" class="firstname">Si</a>
            <a href="#" class="lastname">Bea</a>
        </div>
        <!-- Menu navigasi -->
        <nav class="navigation">
            <a href="index.php">Home</a>
            <a href="daftar.php">Daftar</a>
            <a href="hasil.php">Hasil</a>
        </nav>
    </header>

    <!-- Bagian konten utama untuk menampilkan detail pendaftaran -->
    <div class="content">
        <h2>Detail Pendaftaran Beasiswa</h2>
        <?php
        // Menghubungkan ke file koneksi database
        require_once '../includes/koneksi.php'; 


        // Memeriksa apakah parameter NIM tersedia di URL
        if (isset($_GET['nim'])) {
            $nim = $_GET['nim'];

            // Query untuk mengambil data mahasiswa berdasarkan NIM
            $sql_mahasiswa = "SELECT * FROM mahasiswa WHERE nim = ?";
            $stmt_mahasiswa = $conn->prepare($sql_mahasiswa);
            $stmt_mahasiswa->bind_param('s', $nim);
            $stmt_mahasiswa->execute();
            $result_mahasiswa = $stmt_mahasiswa->get_result();

            // Jika data mahasiswa ditemukan
            if ($result_mahasiswa->num_rows > 0) {
                $mahasiswa = $result_mahasiswa->fetch_assoc();

                // Query untuk mengambil data IPK berdasarkan NIM
                $sql_ipk = "SELECT ipk FROM ipk WHERE nim = ?";
                $stmt_ipk = $conn->prepare($sql_ipk);
                $stmt_ipk->bind_param('s', $nim);
                $stmt_ipk->execute();
                $result_ipk = $stmt_ipk->get_result();

                // Mengambil IPK jika tersedia
                $ipk = $result_ipk->num_rows > 0 ? $result_ipk->fetch_assoc()['ipk'] : 'Tidak tersedia';

                // Menampilkan detail pendaftaran mahasiswa
                echo "<p><strong>NIM:</strong> {$mahasiswa['nim']}</p>";
                echo "<p><strong>Nama:</strong> {$mahasiswa['nama']}</p>";
                echo "<p><strong>Email:</strong> {$mahasiswa['email']}</p>";
                echo "<p><strong>No HP:</strong> {$mahasiswa['no_hp']}</p>";
                echo "<p><strong>Semester:</strong> {$mahasiswa['semester']}</p>";
                echo "<p><strong>IPK:</strong> {$ipk}</p>";
                echo "<p><strong>Jenis Beasiswa:</strong> {$mahasiswa['jns_bea']}</p>";
                echo "<p><strong>Status:</strong> {$mahasiswa['status_ajuan']}</p>";

                // Menampilkan link untuk mengunduh file jika ada
                if ($mahasiswa['file']) {
                    echo "<p><strong>File:</strong> <a href='uploads/{$mahasiswa['file']}' download>Download</a></p>";
                } else {
                    echo "<p><strong>File:</strong> Tidak ada file yang diupload</p>";
                }
            } else {
                // Menampilkan pesan jika data tidak ditemukan
                echo "<p>Data tidak ditemukan.</p>";
            }

            // Menutup statement dan koneksi
            $stmt_mahasiswa->close();
            $stmt_ipk->close();
        } else {
            // Menampilkan pesan jika parameter NIM tidak tersedia
            echo "<p>Parameter NIM tidak tersedia.</p>";
        }

        // Menutup koneksi database
        $conn->close();
        ?>

        <!-- Tombol untuk kembali ke halaman hasil -->
        <p><a href="hasil.php" class="bt_kembali">Kembali</a></p>
    </div>
</body>

</html>