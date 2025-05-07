<?php

// Menyimpan informasi koneksi database
$host = "localhost";        // Host database
$username = "root";         // Username untuk login ke database
$password = "";             // Password untuk login ke database
$database = "gusexpress";   // Nama database yang akan diakses

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Mengecek apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika terjadi error, tampilkan pesan error dan berhenti eksekusi program
    die("Database Gagal terkoneksi: " .  $conn->connect_error);
}

?>