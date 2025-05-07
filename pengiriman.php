<?php

// Meng-include file header (biasanya berisi HTML awal, navbar, atau layout tampilan)
include '.includes/header.php';
// Mengambil ID pelanggan dari session yang sudah login
$pelangganID = $_SESSION['pelanggan_id'];

// Menyusun query untuk mengambil data pelanggan berdasarkan ID yang login
$query = "SELECT * FROM pelanggan WHERE pelanggan_id= $pelangganID";
// Menjalankan query ke database
$result = $conn->query($query);

// Mengecek apakah data pelanggan ditemukan
if ($result->num_rows > 0) {
    // Jika ditemukan, ambil data pelanggan dalam bentuk array asosiatif
    $pelanggan = $result->fetch_assoc();
} else {
    // Jika tidak ditemukan, hentikan eksekusi script
    exit();
}
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="POST" action="proses_pengiriman.php" enctype="multipart/form-data">
                        <!-- Nama Pengirim -->
                         <div class="mb-3">
                            <label for="post_title" class="form-label">Nama Pengirim</label>
                            <div>
                            <?php
                                if (isset($_SESSION["nama"])) {
                                    echo $_SESSION["nama"];
                                } else {
                                    echo "Belum login nih...";
                                }
                            ?>
                            </div>
                         </div>

                         <!-- Lokasi -->
                         <div class="mb-3">
                            <label for="post_title" class="form-label">Alamat</label>
                            <div>
                            <?php
                               if (isset($pelanggan['alamat'])) {
                                echo $pelanggan['alamat'];
                               } else {
                                echo "Mohon isi alamat dahulu";
                               }
                            ?>
                            </div>
                         </div>

                         <!-- Paket -->
                         <label class="form-label">Pilih Paket</label>
                         <select class="form-select" name="paket">
                         <option value="" selected disabled>Pilih Paket</option>
                         <?php
                                require 'config.php'; 
                                $query = "SELECT * FROM paket WHERE pelanggan_id = $user_id";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                      echo "<option value='" . $row["paket_id"] . "'>" . $row["nama_paket"] . "</option>";
                                    }
                                }
                        ?>
                        </select>

                        <!-- Deskripsi -->
                         <div class="mb-3">
                            <label for="content" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi"required></textarea>
                         </div>
                         <!-- Submit -->
                          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
        </div>
    </div>
    </div>
</div>
</div>

<?php
include '.includes/footer.php';
?>