<?php
// Menghubungkan konfigurasi
include("config.php");
// Memulai sesi
session_start();

// Memeriksa apakah tombol simpan ditekan
if (isset($_POST['simpan'])) {

    $namaBarang = $_POST['nama_barang'];      // mengambil nama barang dari form
    $beratBarang = $_POST['berat'];           // mengambil jumlah berat
    $satuan = $_POST['satuan_id'];            // Mengambil satuan berat
    $tujuan = $_POST['tujuan'];               // Mengambil tujuan
    $biaya = $_POST['biaya'];                 // Mengambil harga 
    $detail = $_POST['detail'];               // Mengambil detail 
    $pelangganID = $_SESSION["pelanggan_id"]; // Mengambil data pelanggan dari sesi

    // Query sql untuk memasukkan data paket ke database
    $query = "INSERT INTO paket (nama_paket, berat, satuan_id, tujuan, biaya, detail, pelanggan_id) VALUES ('$namaBarang','$beratBarang','$satuan','$tujuan','$biaya','$detail','$pelangganID')";
    // Menjalankan perintah sql dan memberikan notifikasi 
    if($conn->query($query) === TRUE) {
        $_SESSION["notification"] = [
            'type' => 'primary',
            'message' => 'Paket berhasil ditambahkan.'
        ];

    } else {
        $_SESSION["notification"] = [
            'type' => 'danger',
            'message' => 'Paket gagal ditambahkan'
        ];
    }
    header('Location: dashboard.php');
}

// Memeriksa apakah tombol delete ditekan
if (isset($_POST["delete"])) {
    $paketId = $_POST['paket_id']; // Mengambil id dari paket yang akan dihapus
    $deleteQuery = "DELETE FROM paket WHERE paket_id='$paketId'"; // Query delete

    // Eksekusi query dan memberikan notifikasi jika berhasil atau gagal
    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Paket berhasil dihapus.'
        ];

    }else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal menghapus paket'
        ];
    }
    header('Location: profil_default.php');
}

// Memeriksa apakah tombol update ditekan
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {

    // Mengambil data dari form
    $paketId = $_POST['id_paket']; 
    $namaBarang = $_POST['nama_barang'];
    $beratBarang = $_POST['berat'];
    $satuan = $_POST['satuan_id'];
    $tujuan = $_POST['tujuan'];
    $biaya = $_POST['biaya'];
    $detail = $_POST['detail'];
    $pelangganID = $_SESSION["pelanggan_id"]; // Mengambil id pelanggan dari sesi
    // Query sql update
    $queryUpdate = "UPDATE paket SET nama_paket = '$namaBarang', berat = '$beratBarang', satuan_id = '$satuan', tujuan = '$tujuan', biaya = '$biaya', pelanggan_id = '$pelangganID', detail = '$detail' WHERE paket_id = '$paketId'";
    // Eksekusi query edit dan notifikasi
    if($conn->query($queryUpdate) === TRUE){
        $_SESSION['notification'] = [
            'type' => 'primary',
            'message' => 'Paket berhasil diperbarui.'
        ];

    }else {
        $_SESSION['notification'] = [
            'type' => 'danger',
            'message' => 'Gagal memperbarui paket'
        ];
    }
    header('Location: profil_default.php');
  
}

$conn->close();
?>