<!-- 
File: daftar.php
Description: Halaman untuk pendaftaran beasiswa, berisi formulir pendaftaran untuk pengguna.
Author: Tegar Panggalih
Version: 1.0
Date: 25-07-2024
-->


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Karakter encoding untuk rendering teks yang tepat -->
    <meta charset="UTF-8">
    <!-- Pengaturan viewport untuk desain responsif -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Judul halaman web yang ditampilkan di tab browser -->
    <title>Registrasi Beasiswa</title>
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
    <!-- Bagian header dengan logo dan navigasi -->
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

    <!-- Bagian konten utama -->
    <div class="content">
        <h2>Registrasi Beasiswa</h2>
        <!-- Formulir pendaftaran beasiswa -->
        <form action="proses_daftar.php" method="POST" enctype="multipart/form-data" class="form" id="formregistrasi">
            <!-- Field input untuk NIM (Nomor Induk Mahasiswa) -->
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" required onchange="fetchIpk()">
            </div>
            <!-- Field input untuk Nama -->
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <!-- Field input untuk Email dengan validasi -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required onchange="validEmail()">
                <!-- Span untuk menampilkan pesan kesalahan validasi email -->
                <span id="emailError" class="error"></span>
            </div>
            <!-- Field input untuk Nomor HP dengan validasi -->
            <div class="form-group">
                <label for="no_hp">No HP:</label>
                <input type="number" id="no_hp" name="no_hp" maxlength="13" required onchange="validNoHp()">
                <!-- Span untuk menampilkan pesan kesalahan validasi nomor HP -->
                <span id="noHpError" class="error"></span>
            </div>
            <!-- Dropdown untuk memilih Semester -->
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" required>
                    <!-- Opsi untuk semester -->
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <!-- Field input untuk IPK (Indeks Prestasi Kumulatif), hanya baca -->
            <div class="form-group">
                <label for="ipk">IPK terakhir:</label>
                <input type="number" id="ipk" name="ipk" step="0.1" readonly>
            </div>
            <!-- Dropdown untuk memilih Jenis Beasiswa, awalnya dinonaktifkan -->
            <div class="form-group">
                <label for="pil_bea">Pilihan Beasiswa:</label>
                <select id="pil_bea" name="pil_bea" class="disabled" disabled>
                    <option value="">Pilih Jenis Beasiswa</option>
                    <option value="akademik">Akademik</option>
                    <option value="non akademik">Non Akademik</option>
                </select>
            </div>
            <!-- Field input untuk mengunggah dokumen syarat, awalnya dinonaktifkan -->
            <div class="form-group">
                <label for="file">Upload Berkas Syarat:</label>
                <input type="file" id="file" name="file" class="disabled" disabled onchange="validFile()">
                <!-- Span untuk menampilkan pesan kesalahan validasi file -->
                <span id="fileError" class="error"></span>
            </div>
            <!-- Tombol untuk mengirim formulir dan membatalkan -->
            <button type="submit">Daftar</button>
            <button type="button" onclick="resetForm()" class="bt_batal">Batal</button>
        </form>
    </div>

    <!-- JavaScript untuk validasi formulir dan perilaku dinamis -->
    <script>
        // Fungsi untuk memvalidasi format email
        function validEmail() {
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailValue = emailInput.value;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(emailValue)) {
                emailError.textContent = 'Email tidak valid. Harus menggunakan @ dan .com';
            } else {
                emailError.textContent = '';
            }
        }

        // Fungsi untuk memvalidasi format nomor HP
        function validNoHp() {
            const noHpInput = document.getElementById('no_hp');
            const noHpError = document.getElementById('noHpError');
            const noHpValue = noHpInput.value;
            const noHpPattern = /^[0-9]{12,13}$/;
            if (!noHpPattern.test(noHpValue)) {
                noHpError.textContent = 'Nomor HP tidak valid. Harus berupa angka, minimal 12 dan maksimal 13 karakter.';
            } else {
                noHpError.textContent = '';
            }
        }

        // Fungsi untuk mengambil dan menampilkan IPK berdasarkan NIM
        function fetchIpk() {
            const nim = document.getElementById('nim').value;
            const ipkInput = document.getElementById('ipk');

            if (nim) {
                fetch(`get_ipk.php?nim=${nim}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.ipk !== undefined) {
                            ipkInput.value = data.ipk;
                            validIpk();
                        } else {
                            alert('NIM tidak ditemukan.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching IPK:', error);
                    });
            }
        }

        // Fungsi untuk mengaktifkan/meminimalisir field berdasarkan nilai IPK
        function validIpk() {
            const ipkInput = document.getElementById('ipk');
            const pilBeaSelect = document.getElementById('pil_bea');
            const fileInput = document.getElementById('file');
            const ipkValue = parseFloat(ipkInput.value);

            if (isNaN(ipkValue) || ipkValue < 0) {
                return;
            }

            if (ipkValue < 3) {
                pilBeaSelect.disabled = true;
                pilBeaSelect.classList.add('disabled');
                fileInput.disabled = true;
                fileInput.classList.add('disabled');
            } else {
                pilBeaSelect.disabled = false;
                pilBeaSelect.classList.remove('disabled');
                fileInput.disabled = false;
                fileInput.classList.remove('disabled');
            }
        }

        // Fungsi untuk memvalidasi input file
        function validFile() {
            const fileInput = document.getElementById('file');
            const fileError = document.getElementById('fileError');
            const allowedExtensions = /(\.pdf|\.jpg|\.jpeg|\.png)$/i;

            if (!allowedExtensions.exec(fileInput.value)) {
                fileError.textContent = 'File harus berupa PDF, JPG, atau PNG';
                fileInput.value = '';
                return false;
            } else {
                fileError.textContent = '';
                return true;
            }
        }

        // Fungsi untuk mereset field formulir
        function resetForm() {
            const form = document.getElementById('formregistrasi');
            form.reset();
            const pilBeaSelect = document.getElementById('pil_bea');
            const fileInput = document.getElementById('file');
            pilBeaSelect.disabled = true;
            pilBeaSelect.classList.add('disabled');
            fileInput.disabled = true;
            fileInput.classList.add('disabled');
            document.getElementById('emailError').textContent = '';
            document.getElementById('noHpError').textContent = '';
            document.getElementById('fileError').textContent = '';
        }
    </script>
</body>

</html>