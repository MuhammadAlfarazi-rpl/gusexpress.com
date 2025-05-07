<?php
// Menghubungkan file konfigurasi
include 'config.php';
// Memulai sesi
session_start();

// Memeriksa apakah tombol untuk promosi admin ditekan
if (isset($_POST["promote"])) {
    $pelangganID = $_POST['pelanggan_id']; // Mengambil id pelanggan 
    // Query sql untuk mengubah role
    $query = "UPDATE pelanggan SET role = 'admin' WHERE pelanggan_id = '$pelangganID'";
    // Eksekusi query dan notifikasi
    if($conn->query($query) === TRUE) {
        $_SESSION["notification"] = [
            'type' => 'primary',
            'message' => 'Admin berhasil di tambahkan.'
        ];
    
    } else {
        $_SESSION["notification"] = [
            'type' => 'danger',
            'message' => 'Admin gagal ditambahkan'
        ];
    }
    // Redirect ke laman list user
    header('Location: list_user.php');
}

// Memeriksa apakah tombol untuk mengubah role menjadi user ditekan
if (isset($_POST["demote"])) {
    $pelangganID = $_POST['pelanggan_id']; // Mengambil id pelanggan
    // Query sql untuk mengubah role menjadi user
    $sql = "UPDATE pelanggan SET role = 'user' WHERE pelanggan_id = '$pelangganID'";
    $result = $conn->query($sql);
    // Eksekusi query dan notifikasi
    if($result) {
        $_SESSION["notification"] = [
            'type' => 'primary',
            'message' => 'Demosi admin berhasil.'
        ];
    
    } else {
        $_SESSION["notification"] = [
            'type' => 'danger',
            'message' => 'Gagal mendemosi admin.'
        ];
    }
    // Redirect ke laman list user
    header('Location: list_user.php');
}

// Memeriksa apakah tombol delete akun ditekan
if (isset($_POST["delete"])) {
    $pelangganID = $_POST['pelanggan_id']; // Mengambil id pelanggan 
    // Query sql untuk melihat pelanggan
    $cekAdmnQuery = "SELECT role FROM pelanggan WHERE pelanggan_id = '$pelangganID'";
    $cekResult = $conn->query($cekAdmnQuery);
    // Melakukan pengecekan apakah yang akan dihapus adalah admin atau bukan
    // Jika admin, maka akun tersebut tidak bisa dihapus
    if ($cekResult && $cekResult->num_rows > 0) {
        $cekAdmn = $cekResult->fetch_assoc();
        if ($cekAdmn['role'] == 'admin') {
            $_SESSION["notification"] = [
                'type' => 'danger',
                'message' => 'Tidak bisa menghapus akun admin.'
            ];
            // Redirect ke lis user
            header('Location: list_user.php');
    } else {
        // Jika akun tersebut bukan admin, maka akan menjalankan kode berikut
        // Query sql untuk menghapus akun
        $sql = "DELETE FROM pelanggan WHERE pelanggan_id = '$pelangganID'";
        $result = $conn->query($sql);
        // Eksekusi query dan notifikasi
        if($result) {
            $_SESSION["notification"] = [
                'type' => 'primary',
                'message' => 'Akun berhasil dihapus.'
            ];
        
        } else {
            $_SESSION["notification"] = [
                'type' => 'danger',
                'message' => 'Gagal menghapus akun.'
            ];
        }
        // Redirect ke laman list user
        header('Location: list_user.php');
    }
    }
}