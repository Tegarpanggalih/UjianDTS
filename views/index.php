<!--
File: index.php
Deskripsi: Tampilan awal pada web, berisi informasi umum tentang portal beasiswa.
Penulis: Tegar Panggalih
Versi: 1.0
Tanggal: 25-07-2024
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tautan ke stylesheet CSS eksternal untuk styling umum -->
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

    <!-- Bagian header/navbar -->
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

    <!-- Bagian content -->
    <div class="content">
        <h1>Selamat Datang di Portal Informasi Beasiswa</h1>
        <p>Portal ini menyediakan informasi lengkap mengenai berbagai jenis beasiswa yang tersedia untuk mahasiswa.
            Beasiswa ini bertujuan untuk membantu mahasiswa yang berprestasi maupun mahasiswa yang membutuhkan bantuan
            finansial dalam menyelesaikan pendidikan mereka. Kami menyediakan berbagai macam beasiswa, mulai dari beasiswa akademik hingga non-akademik.</p>
        <h2>Jenis-Jenis Beasiswa</h2>
        <br>
        <ul>
            <li><strong>Beasiswa Akademik:</strong> Diberikan kepada mahasiswa yang memiliki prestasi akademik yang luar biasa.
                Syarat utama untuk beasiswa ini adalah IPK minimal 3.0.</li>
            <li><strong>Beasiswa Non-Akademik:</strong> Diberikan kepada mahasiswa yang memiliki prestasi di bidang non-akademik
                seperti olahraga, seni, dan kegiatan sosial.</li>
        </ul>
        <br>
        <p>Untuk mendaftar beasiswa, silakan klik menu "Daftar" di atas. Jika sudah mendaftar, Anda bisa melihat status ajuan beasiswa Anda di halaman "Hasil".</p>
    </div>

</body>

</html>