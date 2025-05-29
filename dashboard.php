<?php

// Meng-include file 'header.php' dari folder '.includes'
include '.includes/header.php';

?>

<?php 
// Mengecek apakah user yang login bukan berperan sebagai 'admin', 
// jika bukan, <!-- #User Dashboard --> akan di tampilkan
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') { 
?>
  
  <!-- #User Dashboard -->
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3><strong>Semua Paket</strong></h3>
        </div>
        <div class="card-body">
            <?php

            // Membuat query untuk mengambil data pengiriman dari database
            $query = "SELECT 
                    pengiriman.*, 
                    pelanggan.nama as user_name,
                    pelanggan.alamat,
                    paket.nama_paket, 
                    paket.tujuan, 
                    paket.berat, 
                    paket.satuan_id, 
                    paket.detail,
                    satuan.satuan_nama,
                    paket.biaya,
                    ekspedisi.nama_harga,
                    ekspedisi.nama_harga_ekspedisi,
                    pengiriman.status
                    FROM pengiriman
                    INNER JOIN pelanggan ON pengiriman.pelanggan_id = pelanggan.pelanggan_id
                    LEFT JOIN paket ON pengiriman.paket_id = paket.paket_id
                    LEFT JOIN satuan ON paket.satuan_id = satuan.satuan_id
                    LEFT JOIN ekspedisi ON paket.biaya = ekspedisi.biaya
                    WHERE pengiriman.pelanggan_id = $user_id AND pengiriman.status = 'mengirim'";
                    // Hanya mengambil pengiriman yang memiliki 'pelanggan_id' sesuai dengan user yang sedang login
                    // Dan pengiriman yang masih berstatus mengirim

            // Menjalankan $query ke database menggunakan koneksi ($conn)
            // Hasil eksekusinya disimpan dalam variabel $exec
            $exec = mysqli_query($conn, $query);

            // Mengecek apakah hasil eksekusi query ($exec) memiliki lebih dari 0 baris data
            if (mysqli_num_rows($exec) > 0) {
                // Jika data ada, lakukan perulangan untuk mengambil setiap baris data (fetch_assoc)
                while ($pengiriman = mysqli_fetch_assoc($exec)) {
                    // Menyimpan nilai 'pengiriman_id' dari baris data yang sedang diproses ke dalam variabel
                    $pengiriman_id = $pengiriman["pengiriman_id"];
                    echo '
                    <!-- Membuat card untuk setiap pengiriman -->
                    <div class="card border border-2 rounded-3 mb-3">
                    <div class="accordion-item border-0 mb-0 shadow-none active" id="fl-'.$pengiriman_id.'">
                      <div class="accordion-header" id="fleetHeader'.$pengiriman_id.'">
                        <div role="button" class="accordion-button shadow-none align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#fleet'.$pengiriman_id.'" aria-expanded="true" aria-controls="fleet'.$pengiriman_id.'">
                            <div class="d-flex align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded-circle bg-label-secondary w-px-40 h-px-40">
                                            <i class="icon-base bx bxs-truck icon-lg"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="d-flex flex-column gap-1">
                                    <span class="text-heading fw-bold fs-7"><strong>'.$pengiriman["nama_paket"].'</strong></span>
                                    <span class="text-body">Tujuan : '.$pengiriman["tujuan"].'</span>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div id="fleet'.$pengiriman_id.'" class="accordion-collapse collapse" data-bs-parent="#fleet">
                        <div class="accordion-body">
                            <!-- Menampilkan detail informasi pengiriman -->
                            <span class="d-flex flex-column gap-1">
                                    <span class="text-body fw-bold fs-4"><strong>Detail :</strong></span>
                                    <span class="text-body"><strong>STATUS PAKET : </strong>'.$pengiriman["status"].'</span>
                                    <span class="text-body"><strong>ID Pengiriman : </strong>'.$pengiriman["pengiriman_id"].'</span>
                                    <span class="text-body"><strong>Tipe Ekspedisi : </strong>'.$pengiriman["nama_harga"].'</span>
                                    <span class="text-body"><strong>Asal Paket : </strong>'.$pengiriman["alamat"].'</span>
                                    <span class="text-body"><strong>Tanggal Pengiriman : </strong>'.$pengiriman["tanggal_pengiriman"].'</span>
                                    <span class="text-body"><strong>Berat Barang : </strong>'.$pengiriman["berat"]." ". $pengiriman["satuan_nama"].'</span>
                                    <span class="text-body mb-2"><strong>Detail Barang : </strong>'.$pengiriman["detail"].'</span>
                                    <span class="text-body mb-3"><strong>Total Harga : </strong>'.$pengiriman["nama_harga_ekspedisi"].' </span>
                            </span>
                            
                            <form method="POST" action="proses_pengiriman.php">
                            <input type="hidden" name="pengirimanID" value="'.$pengiriman['pengiriman_id'].'">
                            <button name="delete" type="submit" class="btn btn-outline-danger">Batalkan Pengiriman</button>
                            </form>                           
                        </div>
                        </div>
                      </div>
                    </div>';
                }
            } else {
                // Menampilkan pesan jika tidak ada data yang dieksekusi
                echo '<p class="text-center text-muted">No data found.</p>';
            }

            ?>
        </div>
    </div>
</div>
</div>

<!-- Jika user adalah admin, maka adminDashboard akan dijalankan -->
<!-- #adminDashboard -->
<?php } else { ?>

    <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0 mt-0"><strong>Admin Info</strong></h3>
            </div>
            <div class="dropdown-divider"></div>
        <!-- Card Widget untuk info admin -->
        <div class="card-widget-separator-wrapper">
            <div class="card-body card-widget-separator">
                <div class="row gy-4 gy-sm-1">
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                            <div class="avatar me-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="icon-base bx bx-package icon-26px"></i>
                                </span>
                            </div>
                            <div class="ms-4">
                                <!-- Menampilkan jumlah total paket yang ada di database -->
                                <h4 class="mb-0"><?php 
                                // Membuat query untuk mengambil semua data dari tabel 'paket'
                                $Q_paket = "SELECT * FROM paket";
                                // Menjalankan query ke database menggunakan koneksi $conn
                                $excPak = mysqli_query($conn, $Q_paket);       
                                // Menghitung jumlah baris (paket) yang berhasil diambil
                                $jmlPaket = mysqli_num_rows($excPak);        
                                // Menampilkan jumlah total paket ke dalam elemen <h4>
                                echo $jmlPaket 
                                ?></h4>
                                <p class="mb-0">Total Paket</p>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                            <div class="avatar me-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="icon-base bx bxs-truck icon-26px"></i>
                                </span>
                            </div>
                            <div class="ms-4">
                                <!-- Menampilkan jumlah total pengiriman yang ada di database -->
                                <h4 class="mb-0"><?php 
                                $Q_pengiriman = "SELECT * FROM pengiriman WHERE status = 'mengirim'";
                                $excPeng = mysqli_query($conn, $Q_pengiriman);
                                // Menghitung jumlah baris (pengiriman) yang berhasil diambil
                                $jmlPengiriman = mysqli_num_rows($excPeng);
                                // Menampilkan jumlah total pengiriman ke dalam elemen <h4>
                                echo $jmlPengiriman?></h4>
                                <p class="mb-0">Total Pengiriman</p>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex align-items-center card-widget-1 border-end pb-4 pb-sm-0">
                            <div class="avatar me-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="icon-base bx bx-shield-quarter icon-26px"></i>
                                </span>
                            </div>
                            <div class="ms-4">
                                <!-- Menampilkan jumlah total user dengan role admin yang ada di database -->
                                <h4 class="mb-0"><?php
                                // Membuat query untuk mengambil semua data dari tabel 'pelanggan'
                                // dengan role admin
                                $Q_admn = "SELECT * FROM pelanggan WHERE role = 'admin'";
                                // Menjalankan query ke database menggunakan koneksi $conn
                                $excAdmn = mysqli_query($conn, $Q_admn);
                                // Menghitung jumlah baris pelanggan dengan role admin
                                // yang berhasil diambil
                                $jmlAdmn = mysqli_num_rows($excAdmn);
                                // Menampilkan jumlah total admin ke dalam elemen <h4>
                                echo $jmlAdmn?></h4>
                                <p class="mb-0">Total Admin</p>
                            </div>
                        </div>
                        <hr class="d-none d-sm-block d-lg-none me-6">
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="d-flex align-items-center pb-4 pb-sm-0">
                            <div class="avatar me-6">
                                <span class="avatar-initial rounded bg-label-secondary text-heading">
                                    <i class="icon-base bx bxs-user-rectangle icon-26px"></i>
                                </span>
                            </div>
                            <div class="ms-4">
                                <!-- Menampilkan jumlah total user yang ada di database -->
                                <h4 class="mb-0"><?php
                                // Membuat query untuk mengambil semua data dari tabel 'pelanggan'
                                $Q_user = "SELECT * FROM pelanggan";
                                // Menjalankan query ke database menggunakan koneksi $conn
                                $excUsr = mysqli_query($conn, $Q_user);
                                // Menghitung jumlah baris (pelanggan/user) yang berhasil diambil
                                $jmlUsr = mysqli_num_rows($excUsr);
                                // Menampilkan jumlah total user ke dalam elemen <h4>
                                echo $jmlUsr?></h4></h4>
                                <p class="mb-0">Total Pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <?php ?>
        
    <div class="card">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3><strong>Semua Paket</strong></h3>
        </div>
        <div class="card-body">
            <?php

                $query = "SELECT 
                        pengiriman.*, 
                        pelanggan.nama as user_name,
                        pelanggan.alamat, 
                        paket.nama_paket, 
                        paket.tujuan, 
                        paket.berat, 
                        paket.satuan_id, 
                        paket.detail,
                        satuan.satuan_nama,
                        paket.biaya,
                        ekspedisi.nama_harga,
                        ekspedisi.nama_harga_ekspedisi
                        FROM pengiriman
                        INNER JOIN pelanggan ON pengiriman.pelanggan_id = pelanggan.pelanggan_id
                        LEFT JOIN paket ON pengiriman.paket_id = paket.paket_id
                        LEFT JOIN satuan ON paket.satuan_id = satuan.satuan_id
                        LEFT JOIN ekspedisi ON paket.biaya = ekspedisi.biaya
                        WHERE pengiriman.status = 'mengirim'";

            // Menjalankan $query ke database menggunakan koneksi ($conn)
            // Hasil eksekusinya disimpan dalam variabel $exec
            $exec = mysqli_query($conn, $query);

            // Mengecek apakah hasil eksekusi query ($exec) memiliki lebih dari 0 baris data
            if (mysqli_num_rows($exec) > 0) {
                // Jika data ada, lakukan perulangan untuk mengambil setiap baris data (fetch_assoc)
                while ($pengiriman = mysqli_fetch_assoc($exec)) {
                    // Menyimpan nilai 'pengiriman_id' dari baris data yang sedang diproses ke dalam variabel
                    $pengiriman_id = $pengiriman["pengiriman_id"];
                    echo '
                    <!-- Membuat card untuk setiap pengiriman -->
                    <div class="card-hover border border-2 rounded-3 mb-3">
                    <div class="accordion-item border-0 mb-0 shadow-none active" id="fl-'.$pengiriman_id.'">
                      <div class="accordion-header" id="fleetHeader'.$pengiriman_id.'">
                        <div role="button" class="accordion-button shadow-none align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#fleet'.$pengiriman_id.'" aria-expanded="true" aria-controls="fleet'.$pengiriman_id.'">
                            <div class="d-flex align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial rounded-circle bg-label-secondary w-px-40 h-px-40">
                                            <i class="icon-base bx bxs-truck icon-lg"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="d-flex flex-column gap-1">
                                    <span class="text-heading fw-bold fs-7"><strong>'.$pengiriman["nama_paket"].'</strong></span>
                                    <span class="text-body">Tujuan : '.$pengiriman["tujuan"].'</span>
                                </span>
                            </div>
                        </div>
                      </div>
                      <div id="fleet'.$pengiriman_id.'" class="accordion-collapse collapse" data-bs-parent="#fleet">
                        <div class="accordion-body">
                            <!-- Menampilkan detail informasi pengiriman -->
                            <span class="d-flex flex-column gap-1">
                                    <span class="text-body fw-bold fs-4"><strong>Detail :</strong></span>
                                    <span class="text-body"><strong>STATUS PAKET : </strong>'.$pengiriman["status"].'</span>
                                    <span class="text-body"><strong>ID Pengiriman : </strong>'.$pengiriman["pengiriman_id"].'</span>
                                    <span class="text-body"><strong>Tipe Ekspedisi : </strong>'.$pengiriman["nama_harga"].'</span>
                                    <span class="text-body"><strong>Asal Paket : </strong>'.$pengiriman["alamat"].'</span>
                                    <span class="text-body"><strong>Tanggal Pengiriman : </strong>'.$pengiriman["tanggal_pengiriman"].'</span>
                                    <span class="text-body"><strong>Berat Barang : </strong>'.$pengiriman["berat"]." ". $pengiriman["satuan_nama"].'</span>
                                    <span class="text-body mb-2"><strong>Detail Barang : </strong>'.$pengiriman["detail"].'</span>
                                    <span class="text-body mb-3"><strong>Total Harga : </strong>'.$pengiriman["nama_harga_ekspedisi"].' </span>
                            </span>
                            
                            <form method="POST" action="proses_pengiriman.php">
                            <input type="hidden" name="pengirimanID" value="'.$pengiriman['pengiriman_id'].'">
                            <button name="delete" type="submit" class="btn btn-outline-danger me-2">Batalkan Pengiriman</button>
                            <button name="selesai" type="submit" class="btn btn-outline-success">Selesaikan Pengiriman</button>
                            </form>                           
                        </div>
                        </div>
                      </div>
                    </div>';
                }
            } else {
                // Menampilkan pesan jika tidak ada data yang dieksekusi
                echo '<p class="text-center text-muted">No data found.</p>';
            }

            ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<!-- Meng-include file footer.php untuk bagian footer halaman -->
<?php include '.includes/footer.php'; ?>
