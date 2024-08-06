<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'beasiswa';

// Buat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
