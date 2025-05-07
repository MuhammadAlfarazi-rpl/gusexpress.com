<?php

$default = true;
$no_sidemenu = true;
include '.includes/profil.php';

?>

<div class="flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Semua Paket</h4>
            </div>
            <div class="card-body">
                <?php

                $query = "SELECT
                paket.*,
                satuan.satuan_nama,
                ekspedisi.nama_harga
                FROM paket
                LEFT JOIN satuan ON paket.satuan_id = satuan.satuan_id
                LEFT JOIN ekspedisi ON paket.biaya = ekspedisi.biaya
                WHERE paket.pelanggan_id = $user_id";

                $exec = mysqli_query($conn, $query);

                if (mysqli_num_rows($exec) > 0) {
                    while ($paket = mysqli_fetch_assoc($exec)) {
                        $paket_id = $paket["paket_id"];
                        echo '
                        <div class="card border border-2 rounded-3 mb-3">
                        <div class="accordion-item border-0 mb-0 shadow-none active" id="fl-'.$paket_id.'">
                          <div class="accordion-header" id="fleetHeader'.$paket_id.'">
                            <div role="button" class="accordion-button shadow-none align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#fleet'.$paket_id.'" aria-expanded="true" aria-controls="fleet'.$paket_id.'">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-4">
                                            <span class="avatar-initial rounded-circle bg-label-secondary w-px-40 h-px-40">
                                                <i class="icon-base bx bx-cube icon-lg"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <span class="d-flex flex-column gap-1">
                                        <span class="text-heading fw-bold fs-7"><strong>'.$paket["nama_paket"].'</strong></span>
                                        <span class="text-body">Paket ID : '.$paket["paket_id"].'</span>
                                    </span>
                                </div>
                            </div>
                          </div>
                          <div id="fleet'.$paket_id.'" class="accordion-collapse collapse" data-bs-parent="#fleet">
                            <div class="accordion-body">
                                <span class="d-flex flex-column gap-1">
                                        <span class="text-body fw-bold fs-4"><strong>Detail :</strong></span>
                                        <span class="text-body"><strong>ID Pengiriman : </strong>'.$paket["paket_id"].'</span>
                                        <span class="text-body"><strong>Tujuan : </strong>'.$paket["tujuan"].'</span>
                                        <span class="text-body"><strong>Berat Barang : </strong>'.$paket["berat"]." ". $paket["satuan_nama"].'</span>
                                        <span class="text-body mb-3"><strong>Tipe Ekspedisi : </strong>'.$paket["nama_harga"].'</span>
                                        <span class="text-body mb-3"><strong>Pelanggan ID : </strong>'.$paket["pelanggan_id"].'</span>
                                        <span class="text-body mb-3"><strong>Detail Barang : </strong>'.$paket["detail"].'</span>
                                </span>

                                <span class="text-end pt-6 demo-inline-spacing">  
                                        <form method="POST" action="proses_paket.php">
                                            <input type="hidden" name="paket_id" value="'.$paket['paket_id'].'">
                                        <button name="delete" type="submit" class="btn btn-outline-danger"> <i class="bx bx-trash" ></i> Hapus Paket</button>
                                        <a href="edit_paket.php?id_paket= '.$paket['paket_id'].'"><button type="button" class="btn btn-primary"><i class="bx bx-edit-alt"></i>Edit</button></a>
                                        </form>  
                                </span>
                                
                            </div>
                            </div>
                          </div>
                        </div>';
                    }
                } else {
                    echo '<p class="text-center text-muted">No data found.</p>';
                }

                ?>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</div>

<?php
include '.includes/footer.php';
?>