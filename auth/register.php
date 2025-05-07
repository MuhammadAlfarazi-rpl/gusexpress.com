<?php include(".layouts/header.php"); ?>
<!-- Register Card -->
<div class="card">
  <div class="card-body">
    <!-- Logo -->
    <div>
      <img class="card-img-top img-fluid w-50 mx-auto d-block" src="../assets/img/illustrations/gus-ex-logo-new.png" alt="Kamu sedang offline...">
    </div>
    <!-- /Logo -->
    <form action="register_process.php" class="mb-3" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" autofocus/>
      </div>
      <div class="mb-3">
        <label for="emai" class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" />
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Alamat</label>
        <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat" />
      </div>
      <div class="mb-3 form-password-toggle">
        <label class="form-label" for="password">Password</label>
        <div class="input-group input-group-merge">
          <input type="password" class="form-control" name="password"
          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
      </div>
      <button class="btn btn-dark d-grid w-100">Daftar</button>
    </form>
    <p class="text-center">
      <span>Sudah memiliki akun?</span><a href="login.php"><span> Masuk</span></a>
    </p>
  </div>
</div>
<!-- Register Card -->
<?php include(".layouts/footer.php"); ?>