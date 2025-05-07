<?php
session_start();                    // Memulai session untuk memastikan ada session yang bisa dihancurkan
session_unset();                    // Menghapus semua data dalam session
session_destroy();                  // Menghancurkan session sepenuhnya 
header('Location: login.php');      // Mengarahkan user kembali ke halaman login
exit();                             // Menghentikan eksekusi script setelah redirect
