<?php include(".layouts/header.php"); ?>
<!-- Register -->
<div class="card-hover">
  <div class="card-body">
    <!-- Logo -->
    <div>
      <img class="card-img-top" src="../assets/img/illustrations/gus-ex-logo-new.png" alt="Kamu sedang offline...">
    </div>
    <!-- /Logo -->
    
    <form class="mb-3" action="login_auth.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" name="username"
          placeholder="Enter your username" autofocus required />
      </div>
      <div class="mb-3 form-password-toggle">
        <div class="d-flex justify-content-between">
          <label class="form-label" for="password">Password</label>
        </div>
        <div class="input-group input-group-merge">
          <input type="password" class="form-control" name="password"
            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
            aria-describedby="password" />
          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
        </div>
      </div>
      <div class="mb-3">
        <button class="btn btn-dark d-grid w-100" type="submit">Masuk</button>
      </div>
    </form>
    <p class="text-center">
      <span>Belum punya akun?</span><a href="register.php"><span> Daftar</span></a>
    </p>
  </div>
</div>
<!-- /Register -->
<?php include(".layouts/footer.php"); ?>