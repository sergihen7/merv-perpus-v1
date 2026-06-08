<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<div class="card card-body rounded-0" style="max-width: 30rem;">
  <form method="POST" action="<?= base_url('dashboard/admin/masterdata/penerbit/'); ?>">
    <div class="mb-3">
      <label for="penerbit" class="form-label">Nama Penerbit</label>
      <input type="text" class="form-control <?= $validation->hasError('penerbit') ? 'is-invalid' : '' ?>" id="penerbit" name="penerbit">
    </div>
    <div class="mb-3">
      <label for="kode_penerbit" class="form-label">Kode Penerbit</label>
      <input type="text" class="form-control <?= $validation->hasError('kode_penerbit') ? 'is-invalid' : '' ?>" id="kode_penerbit" name="kode_penerbit">
    </div>
    <button type="submit" class="btn btn-primary rounded-0">Tambah Penerbit</button>
  </form>
</div>

<?= $this->endSection(); ?>