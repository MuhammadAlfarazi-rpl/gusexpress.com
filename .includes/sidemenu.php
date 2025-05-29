<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-sidemenu-theme">
  <div class="app-brand demo">
    <a href="./dashboard.php" class="app-brand-link">
      <img class="card-img-top" src="./assets/img/illustrations/gus-ex-logo-new.png" alt="Kamu sedang offline...">
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pemesanan</span></li>
    <div class="menu-item">
      <a href="history.php" class="menu-link">
        <i class="bx bx-history me-2 menu-icon icon-base"></i>History
      </a>
    </div>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon icon-base bx bx-box"></i>
        <div data-i18n="Posts">Paket</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="pengiriman.php" class="menu-link">
            <div data-i18n="Basic Inputs">Pengiriman</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="paket.php" class="menu-link">
            <div data-i18n="Input groups">Paket</div>
          </a>
        </li>
        </li>
      </ul>
    </li>


    <!-- Admin Only -->
    <!--Mengecek apakah variabel 'username' belum diset di sesi atau jika role bukan 'admin' 
    Jika salah satu kondisi ini benar, maka kode di dalam blok if akan dieksekusi -->
    <?php if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') { ?>

      <!-- Null -->
      <!-- Tidak menampilkan bagian ini karena hanya khusus user dengan role admin -->

      <!-- Kode dibawah akan dieksekusi jika pengguna sudah login dan role-nya adalah 'admin' -->
    <?php } else {  ?> 
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin Only</span></li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon icon-base bx bx-key"></i>
          <div data-i18n="Posts">Admin Page</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item">
            <a href="list_user.php" class="menu-link">
              <div data-i18n="Basic Inputs">List User</div>
            </a>
          </li>
        </ul>
      </li>
  </ul>
  <?php } ?>
</aside>
<!-- / Menu -->
