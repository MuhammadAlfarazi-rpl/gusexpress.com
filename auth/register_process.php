<?php
// Memasukkan file konfigurasi database
require_once("../config.php");
// Memulai sesi 
session_start();

// Mengecek apakah request yang diterima adalah POST 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Mengambil data dari form input
    $username = $_POST["username"];
    $name = $_POST["nama"];
    $password = $_POST["password"];
    $alamat = $_POST["alamat"];

    // Mengenkripsi password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query SQL untuk menyimpan data ke tabel pelanggan
    $sql = "INSERT INTO pelanggan (username, nama, password, alamat) VALUES ('$username', '$name', '$hashedPassword', '$alamat')";

    // Mengeksekusi query dan mengecek apakah berhasil
    if($conn->query($sql) === TRUE) {
        // Jika berhasil, simpan notifikasi sukses 
        $_SESSION["notification"] = [
            'type' => 'primary',
            'message' => 'Registrasi berhasil!'
        ];
    } else {
        // Jika gagal, simpan notifikasi error 
        $_SESSION["notification"] = [
            'type' => 'danger',
            'message' => 'Registrasi gagal!' . mysqli_error($conn)
        ];
    }

    // Redirect ke halaman login setelah proses selesai
    header("Location: login.php");
    exit();
}

// Menutup koneksi database
$conn->close();
?>
