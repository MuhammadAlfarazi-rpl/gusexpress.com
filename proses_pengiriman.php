<?php
// Menghubungkan file konfigurasi
include 'config.php';
// Memulai sesi
session_start();

// Memeriksa apakah tombol simpan ditekan
if(isset($_POST['simpan'])) {

    $pelangganId = $_SESSION["pelanggan_id"]; // Mengambil pelanggan dari sesi
    $paket = $_POST["paket"];                 // Mengambil data paket berdasarkan id
    $desc = $_POST["deskripsi"];              // Mengambil data deskripsi dari form

    // Query insert untuk memasukkan data pengiriman ke dalam database
    $query = "INSERT INTO pengiriman (pelanggan_id, paket_id, deskripsi, tanggal_pengiriman) VALUES ('$pelangganId','$paket','$desc',NOW())";
    // Eksekusi query dan notifikasi
    if ($conn->query($query) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Berhasil menambahkan pengiriman.'
        ];

    }else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Pengiriman gagal ditambahkan'
        ];
    }
    // Redirect ke laman dashboard
    header('Location: dashboard.php');
}

// Memeriksa apakah tombol delete ditekan
if(isset($_POST['delete'])) {
    $pengirimanID = $_POST['pengirimanID']; // Mengambil id pengiriman yang akan dihapus
    // Query delete
    $exec = mysqli_query($conn, "DELETE FROM pengiriman WHERE pengiriman_id = '$pengirimanID'");
    // Eksekusi delete dan notifikasi
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Paket berhasil dihapus.'
        ];

    }else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Paket gagal ditambahkan'
        ];
    }
    // Redirect ke laman dashboard
    header('Location: dashboard.php');
}

// Memeriksa apakah tombol selesai/paket diterima ditekan
if (isset($_POST['selesai'])) {
    $pengirimanID = $_POST['pengirimanID']; // Mengambil id pengiriman dari sesi
    // Query sql untuk mengubah status pengiriman
    $queryHistory = "UPDATE pengiriman SET status = 'selesai' WHERE pengiriman_id = '$pengirimanID'";
    $result = $conn->query($queryHistory);
    //Eksekusi dan notifikasi
    if ($result) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Paket telah sampai tujuan.'
        ];

    }else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Paket belum sampai'
        ];
    }
    // Redirect ke dashboard
    header('Location: dashboard.php');
}

// Memeriksa apakah tombol delete?hapus history ditekan
if(isset($_POST['deleteHistory'])) {
    $pengirimanID = $_POST['pengirimanID']; // Mengambil id pengiriman dari sesi
    $exec = mysqli_query($conn, "DELETE FROM pengiriman WHERE pengiriman_id = '$pengirimanID' AND status = 'selesai'");
    // Eksekusi query dan notifikasi
    if ($exec) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'History berhasil dihapus.'
        ];

    }else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menghapus history.'
        ];
    }
    // Redirect ke laman dashboard
    header('Location: dashboard.php');
}
