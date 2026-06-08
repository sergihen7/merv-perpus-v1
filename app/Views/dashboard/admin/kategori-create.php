<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<div class="card card-body rounded-0" style="max-width: 30rem;">
  <form method="POST" action="<?= base_url('dashboard/admin/masterdata/kategori/'); ?>">
    <div class="mb-3">
      <label for="category" class="form-label">Nama Kategori</label>
      <input type="text" class="form-control <?= $validation->hasError('category') ? 'is-invalid' : '' ?>" id="category" name="category">
    </div>
    <button type="submit" class="btn btn-primary rounded-0">Tambah Kategori</button>
  </form>
</div>

<?= $this->endSection(); ?>