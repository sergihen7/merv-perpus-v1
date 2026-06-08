<?= $this->extend('template/home-tmp'); ?>

<?= $this->section('content'); ?>

<div class="row">
  <div class="col-11 col-md-6 col-lg-4 mx-auto mt-5">
    <?php if (session()->has('success')) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->get('success'); ?>
      </div>
    <?php endif; ?>
    <?php if (session()->has('error')) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->get('error'); ?>
      </div>
    <?php endif; ?>
    <div class="card card-body rounded-0 border-0">
      <form action="<?= base_url('auth/login'); ?>" method="POST">
        <h3 class="text-center pt-3"><?= $app['nama_app']; ?></h3>
        <img src="<?= base_url('img/web/' . $app['foto']); ?>" class="mx-auto d-block mb-5 mt-5" style="width: 100%; max-width: 150px;" alt="Logo">
        <input type="text" class="form-control mb-1 rounded-0" placeholder="Your Username or Email" name="username" value="<?= old('username'); ?>">
        <input type="password" class="form-control mb-3 rounded-0" placeholder="Your Password" name="password">
        <button type="submit" class="btn btn-primary rounded-0 w-100"><i class="bi bi-person-fill"></i> Sign in</button>
        <h6 class="text-muted text-center m-3">-OR-</h6>
        <a href="<?= base_url('sign-up'); ?>" class="btn btn-success rounded-0 w-100"><i class="bi bi-person-fill-add"></i> Sign up as new Member</a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>