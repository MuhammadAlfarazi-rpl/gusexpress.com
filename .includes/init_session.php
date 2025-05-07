<?php
// Memulai sesi untuk menyimpan dan mengakses data session
session_start();

// Mengambil data dari sesi yang sudah disimpan sebelumnya
$username = $_SESSION["username"];   // Username dari sesi
$role = $_SESSION["role"];           // Role (peran) pengguna dari sesi
$nama = $_SESSION["nama"];           // Nama pengguna dari sesi
$user_id = $_SESSION["pelanggan_id"]; // ID pelanggan dari sesi

// Mengambil notifikasi jika ada di sesi, atau set null jika tidak ada
$notification = $_SESSION['notification'] ?? null;
// Jika ada notifikasi dalam sesi, hapus setelah diambil
if ($notification) {
    unset($_SESSION['notification']);
}

// Mengecek apakah user belum login (data kosong)
// Jika iya, beri notifikasi dan redirect ke halaman login
if (empty($_SESSION["username"]) || empty($_SESSION["role"])) {
    $_SESSION['notification'] = [
        'type' => 'danger',
        'message' => 'Silakan login terlebih dahulu!'
    ];
    header('Location: ./auth/login.php');
    exit();
}