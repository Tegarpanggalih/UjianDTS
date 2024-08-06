<!-- 
File: hasil.php
Deskripsi: Halaman untuk menampilkan hasil pendaftaran beasiswa.
Penulis: Tegar Panggalih
Versi: 1.0
Tanggal: 25-07-2024
-->

<?php
// Koneksi ke database
require_once '../includes/koneksi.php'; // Memasukkan file koneksi database

// Query untuk mengambil data pendaftaran beasiswa dari database
$sql = "SELECT m.nim, m.nama, m.email, m.no_hp, m.semester, m.jns_bea, m.file, m.status_ajuan, i.ipk
        FROM mahasiswa m
        LEFT JOIN ipk i ON m.nim = i.nim"; // Mengambil data dari tabel mahasiswa dan tabel ipk dengan JOIN
$result = $conn->query($sql); // Menjalankan query dan menyimpan hasilnya
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran Beasiswa</title>
    <!-- Menghubungkan stylesheet CSS eksternal untuk styling -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet"> <!-- Ikon dari Ionicons -->
    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Preconnect ke Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- Preconnect ke Google Fonts dengan CORS -->
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet"> <!-- Font untuk styling -->
</head>

<body>

    <!-- Bagian header dengan logo dan menu navigasi -->
    <header>
        <div>
            <!-- Logo atau nama merek -->
            <a href="#" class="firstname">Si</a> <!-- Nama depan merek -->
            <a href="#" class="lastname">Bea</a> <!-- Nama belakang merek -->
        </div>
        <!-- Menu navigasi -->
        <nav class="navigation">
            <a href="index.php">Home</a> <!-- Menu Home -->
            <a href="daftar.php">Daftar</a> <!-- Menu Daftar -->
            <a href="hasil.php">Hasil</a> <!-- Menu Hasil -->
        </nav>
    </header>

    <!-- Bagian konten utama untuk menampilkan hasil pendaftaran -->
    <div class="content">
        <h2>Hasil Pendaftaran Beasiswa</h2>
        <!-- Tabel untuk menampilkan data pendaftaran -->
        <table>
            <thead>
                <tr>
                    <th>NIM</th> <!-- Kolom NIM -->
                    <th>Nama</th> <!-- Kolom Nama -->
                    <th>Email</th> <!-- Kolom Email -->
                    <th>No HP</th> <!-- Kolom No HP -->
                    <th>Semester</th> <!-- Kolom Semester -->
                    <th>IPK</th> <!-- Kolom IPK -->
                    <th>Jenis Beasiswa</th> <!-- Kolom Jenis Beasiswa -->
                    <th>File</th> <!-- Kolom File -->
                    <th>Status Ajuan</th> <!-- Kolom Status Ajuan -->
                    <th>Detail</th> <!-- Kolom Detail -->
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nim']) ?></td> <!-- Menampilkan NIM -->
                            <td><?= htmlspecialchars($row['nama']) ?></td> <!-- Menampilkan Nama -->
                            <td><?= htmlspecialchars($row['email']) ?></td> <!-- Menampilkan Email -->
                            <td><?= htmlspecialchars($row['no_hp']) ?></td> <!-- Menampilkan No HP -->
                            <td><?= htmlspecialchars($row['semester']) ?></td> <!-- Menampilkan Semester -->
                            <td><?= htmlspecialchars($row['ipk']) ?></td> <!-- Menampilkan IPK -->
                            <td><?= htmlspecialchars($row['jns_bea']) ?></td> <!-- Menampilkan Jenis Beasiswa -->
                            <td>
                                <?php if ($row['file']) : ?>
                                    <a href="../uploads/<?= htmlspecialchars($row['file']) ?>" target="_blank">Lihat File</a> <!-- Link untuk melihat file -->
                                <?php else : ?>
                                    Tidak ada file <!-- Menampilkan pesan jika tidak ada file -->
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['status_ajuan']) ?></td> <!-- Menampilkan Status Ajuan -->
                            <td>
                                <a class="bt_detail" href="detail.php?nim=<?= urlencode($row['nim']) ?>">Detail</a> <!-- Link untuk melihat detail pendaftaran -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10">Tidak ada data pendaftaran.</td> <!-- Pesan jika tidak ada data -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Tutup koneksi
$conn->close(); // Menutup koneksi database
?>