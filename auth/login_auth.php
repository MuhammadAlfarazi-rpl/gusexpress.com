<?php
// Memulai sesi untuk menyimpan data pengguna dan notifikasi
session_start();
// Menghubungkan ke database melalui file konfigurasi
require_once("../config.php");

// Mengecek apakah request yang diterima adalah POST (dari form login)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil input username dan password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query untuk mencari data pelanggan berdasarkan username
    $sql = "SELECT * FROM pelanggan WHERE username = '$username'";
    $result = $conn->query($sql);

    // Mengecek apakah data user ditemukan
    if ($result->num_rows > 0) {
        // Mengambil data user dalam bentuk array asosiatif yakni
        // tipe data yang menyimpan data dalam bentuk pasangan kunci-nilai
        $row = $result->fetch_assoc();

        // Mengecek apakah password yang dimasukkan cocok dengan yang di-database
        if (password_verify($password, $row["password"])) {
            // Jika cocok, simpan data penting yang akan digunakan lagi ke dalam session
            $_SESSION["username"] = $username;
            $_SESSION["nama"] = $row["nama"];
            $_SESSION["pelanggan_id"] = $row["pelanggan_id"];
            $_SESSION["role"] = $row["role"];

            // Notifikasi sukses login
            $_SESSION['notification'] = [
                'type' => 'primary',
                'message' => 'Selamat Datang Kembali'
            ];

            // Arahkan user ke dashboard setelah login berhasil
            header("Location: ../dashboard.php");
            exit();
        } else {
            // Jika password salah, kirim notifikasi error
            $_SESSION["notification"] = [
                'type' => 'danger',
                'message' => 'Password salah!'
            ];
        }
    } else {
        // Jika username tidak ditemukan, kirim notifikasi error
        $_SESSION["notification"] = [
            'type' => 'danger',
            'message' => 'Username salah!'
        ];
    }

    // Kembali ke halaman login setelah proses selesai
    header("Location: login.php");
    exit();
}

// Menutup koneksi database
$conn->close();
?>
