<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

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


<form method="POST" action="<?= base_url('dashboard/admin/setting/save'); ?>" class="row row-cols-1 row-cols-lg-2 g-4" enctype="multipart/form-data">
  <div class="col">
    <div class="card card-body rounded-0">
      <div class="mb-3">
        <div class="card">
          <div class="card-body">
            <img src="<?= base_url('img/web/' . $app['foto']); ?>" class="d-block mx-auto m-3" alt="<?= $app["nama_app"] ?> foto" style="max-width: 140px;" id="fotoApp">
            <input class="form-control <?= $validation->hasError('foto_app') ? 'is-invalid' : '' ?>" type="file" name="foto_app" onchange="onImage('#fotoApp', this)">
            <div class="invalid-feedback">
              <?= $validation->getError('foto_app') ?>
            </div>
            <br>
            <p class="mb-0 small">Hanya menerima gambar berjenis jpg, jpeg, gif, png</p>
          </div>
          <div class="card-footer">
            If you won't change your pic, just leave it empty
          </div>
        </div>
      </div>
      <div class="mb-3">
        <div class="card">
          <div class="card-body">
            <img src="<?= base_url('img/web/' . $app['logo']); ?>" class="d-block mx-auto m-3" alt="<?= $app["nama_app"] ?> logo" style="max-width: 140px;" id="logoApp">
            <input class="form-control <?= $validation->hasError('logo_app') ? 'is-invalid' : '' ?>" type="file" name="logo_app" onchange="onImage('#logoApp', this)">
            <div class="invalid-feedback">
              <?= $validation->getError('logo_app') ?>
            </div>
            <br>
            <p class="mb-0 small">Hanya menerima gambar berjenis jpg, jpeg, gif, png</p>
          </div>
          <div class="card-footer">
            If you won't change your pic, just leave it empty
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card card-body rounded-0">
      <div class="mb-3">
        <label for="nama_app" class="form-label">Nama Aplikasi</label>
        <input type="text" class="form-control <?= $validation->hasError('nama_app') ? 'is-invalid' : ''; ?>" id="nama_app" name="nama_app" value="<?= old('nama_app') ?? $app['nama_app']; ?>">
      </div>
      <div class="mb-3">
        <label for="alamat_app" class="form-label">Alamat</label>
        <input type="text" class="form-control <?= $validation->hasError('alamat_app') ? 'is-invalid' : ''; ?>" id="alamat_app" name="alamat_app" value="<?= old('alamat_app') ?? $app['alamat_app']; ?>">
      </div>
      <div class="mb-3">
        <label for="email_app" class="form-label">Email</label>
        <input type="text" class="form-control <?= $validation->hasError('email_app') ? 'is-invalid' : ''; ?>" id="email_app" name="email_app" value="<?= old('email_app') ?? $app['email_app']; ?>">
      </div>
      <div class="mb-3">
        <label for="nomor_hp" class="form-label">Telepon</label>
        <input type="text" class="form-control <?= $validation->hasError('nomor_hp') ? 'is-invalid' : ''; ?>" id="nomor_hp" name="nomor_hp" value="<?= old('nomor_hp') ?? $app['nomor_hp']; ?>">
      </div>
      <div class="mb-3">
        <label for="copyright" class="form-label">Copyright</label>
        <input type="text" class="form-control" id="copyright" name="copyright" value="<?= $app['copyright']; ?>" disabled>
      </div>
      <button type="submit" class="btn btn-primary rounded-0">Save</button>
    </div>
  </div>
</form>

<script>
  function onImage(target, src) {
    const images = document.querySelector(target);
    console.log(images);
    const [imagesFile] = src.files;
    images.src = URL.createObjectURL(imagesFile);
  }
</script>



<?= $this->endSection(); ?>