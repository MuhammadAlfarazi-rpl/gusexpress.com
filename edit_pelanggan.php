<?php
// Menghubungkan file konfigurasi kedalam file
include("config.php");
// Memulai sesi
session_start();

// if statment untuk memeriksa apakah button submit ditekan
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ganti'])) {

    $pelangganID = $_SESSION['pelanggan_id']; // Mengambil data pelanggan dari sesi
    $username = $_POST['username'];           // Mengambil username berdasarkan inputan user
    $nama = $_POST['nama'];                   // Mengambil nama berdasarkan inputan user
    $alamat = $_POST['alamat'];               // Mengambil alamat berdasarkan inputan user

    // Query sql untuk menjalankan proses update data pelanggan
    $query = "UPDATE pelanggan SET username = '$username', nama = '$nama', alamat = '$alamat' WHERE pelanggan_id = '$pelangganID'";
    
    // Menggunakan if untuk memeriksa apakah query dijalankan dan 
    // memberikan notifikasi jika berhasil atau gagal
    if($conn->query($query) === TRUE){
        // Jika berhasil
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Berhasil memperbarui data akun!'
        ];

    }else {
        // Jika gagal
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui akun :('
        ];
    }
    header('Location: auth/logout.php');


} else {

}

// Memeriksa apakah button hapus akun pelanggan atau deactivate ditekan
if (isset($_POST['hapus'])) {
    $pelangganID = $_POST['pelangganID']; // Mengambil data pelanggan dari sesi

    // Query sql hapus
    $sql = "DELETE FROM pelanggan WHERE pelanggan_id = '$pelangganID'";
    $result = $conn->query($sql);

    // Memeriksa apakah query dijalankan dan
    // Memberikan notifikasi gagal atau berhasil
    if($result){
        // Jika berhasil
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Berhasil deactivate akun!'
        ];

    }else {
        // Jika gagal
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Deactivate akun gagal.'
        ];
    }
    header('Location: auth/login.php');
}