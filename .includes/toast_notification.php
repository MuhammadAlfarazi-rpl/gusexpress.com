<!-- Bootstrap Toast -->
<!-- Mengecek apakah variabel $notification memiliki nilai
Jika $notification ada nilainya, maka, kode di dalam blok if akan dieksekusi -->
<?php if ($notification): ?>
  <div id="notifikasi" class="bs-toast toast fade bg-<?= $notification['type'] ?> position-absolute m-3 end-0" role="alert" data-bs-autohide="true">
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <!-- Menampilkan judul notifikasi, jika tidak ada, tampilkan 'Notifikasi' -->
      <strong class="me-auto"><?= $notification['title'] ?? 'Notifikasi' ?></strong> 
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      <!-- Menampilkan pesan notifikasi -->
      <?= $notification['message'] ?>
    </div>
  </div>
<?php endif; ?>

<!-- JavaScript untuk menampilkan notifikasi pada laman -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.getElementById('notifikasi');
    if (toastEl) {
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }
  });
</script>