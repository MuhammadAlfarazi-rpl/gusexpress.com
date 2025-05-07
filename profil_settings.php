<?php

$default = false;
$no_sidemenu = true;
include '.includes/profil.php';
?>

<?php
$pelangganID = $_SESSION['pelanggan_id'];
$query = "SELECT * FROM pelanggan WHERE pelanggan_id= $pelangganID";
$result = $conn->query($query);
if ($result->num_rows > 0) {
  $pelanggan = $result->fetch_assoc();
} else {
  exit();
}
?>

<div class="card mt-4">
    <div class="card-body pt-4">
          <form method="POST" action="edit_pelanggan.php">
            <div class="row g-6">
              <div class="col-md-6 form-control-validation fv-plugins-icon-container">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" autofocus="" value="<?php echo $pelanggan['username']?>" name="username">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
              <div class="col-md-6 form-control-validation fv-plugins-icon-container">
                <label class="form-label">Nama Asli</label>
                <input class="form-control" type="text" value="<?php echo $pelanggan['nama']?>" name="nama">
              <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
              <div class="col-md-6 mb-4">
                <label class="form-label">Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?php 
                if ($pelanggan['alamat'] == TRUE) {
                  echo $pelanggan['alamat'];
                } else { 
                  echo "Silahkan isi alamatnya terlebih dahulu :D";
                } ?>">
              </div>
              
            <div class="mt-6">
              
            </div>
                        <button
                          type="button"
                          class="btn btn-primary ms-2 w-auto"
                          data-bs-toggle="modal"
                          data-bs-target="#modalCenter1"
                        >
                          Update
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter1" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Yakin Dengan Perubahan?</h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col mb-2">
                                    <div><p>Anda harus Re-Login agar perubahan dapat diterapkan</p></div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary me-3" name="ganti">Simpan</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
          <input type="hidden"></form>
        </div>
    </div>

    <?php if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') { 
    ?>

    <div class="card mt-3">
        <h5 class="card-header">Hapus Akun</h5>
        <div class="card-body">
          <div class="mb-6 col-12 mb-0">
            <div class="alert alert-warning">
              <h5 class="alert-heading mb-1">Anda yakin anda mau menghapus akun?</h5>
              <p class="mb-0">Setelah akun anda dihapus, anda tidak bisa mengembalikannya.</p>
            </div>
          </div>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenter2">Deactivate Account</button>
          <input type="hidden"></form>
        </div>
      </div>
          <div class="modal fade" id="modalCenter2" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Yakin Untuk Menghapus Akun?</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col mb-2">
                              <div><p>Ini Merupakan Kofirmasi Terakhir. Ingat, Tidak Ada Putar Balik Setelah Ini</p></div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                          <form action="edit_pelanggan.php" method="POST">
                          <input type="hidden" name="pelangganID" value="<?php echo $pelanggan['pelanggan_id']?>">
                            <button type="submit" class="btn btn-danger me-3" name="hapus">Hapus</button>
                          </form>
                        </div>
                      </div>
                  </div>
                </div>
</div>

<?php } else {

}

include '.includes/footer.php';
?>