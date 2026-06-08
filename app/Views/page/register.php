<?= $this->extend('template/home-tmp'); ?>

<?= $this->section('content'); ?>


<div class="row">
  <div class="col-11 col-md-6 col-lg-4  mx-auto mt-5">
    <?php if ($validation->hasError('password2')) : ?>
      <div class="alert alert-danger" role="alert">
        Password Not Match
      </div>
    <?php endif; ?>
    <div class="card card-body rounded-0 border-0">
      <form action="<?= base_url('auth/register'); ?>" method="POST">
        <h3 class="text-center pt-3"><?= $app['nama_app']; ?></h3>

        <img src="<?= base_url('img/web/' . $app['foto']); ?>" class="mx-auto d-block mb-5 mt-5" style="width: 100%; max-width: 150px;" alt="Logo">

        <input type="text" class="form-control mb-1 rounded-0 <?= $validation->hasError('username') ? 'is-invalid' : ''; ?>" value="<?= old('username'); ?>" placeholder="Username" name="username">
        <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>

        <input type="text" class="form-control mb-1 rounded-0 <?= $validation->hasError('fullname') ? 'is-invalid' : ''; ?>" value="<?= old('fullname'); ?>" placeholder="Full Name" name="fullname">
        <div class="invalid-feedback"><?= $validation->getError('fullname'); ?></div>

        <input type="text" class="form-control mb-1 rounded-0 <?= $validation->hasError('email') ? 'is-invalid' : ''; ?>" value="<?= old('email'); ?>" placeholder="Email" name="email">
        <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>

        <input type="password" class="form-control rounded-0 <?= $validation->hasError('password') ? 'is-invalid' : ''; ?>" placeholder="Password" name="password">
        <div class="invalid-feedback"><?= $validation->getError('password'); ?></div>

        <input type="password" class="form-control mt-3 rounded-0" placeholder="Retry Password" name="password2">

        <button type="submit" class="btn btn-success rounded-0 w-100 mt-3"><i class="bi bi-person-fill-add"></i> Sign up as new Member</button>
        <h6 class="text-muted text-center m-3">-OR-</h6>
        <a href="<?= base_url('sign-in'); ?>" class="btn btn-primary rounded-0 w-100"><i class="bi bi-person-fill"></i> Sign in</a>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>