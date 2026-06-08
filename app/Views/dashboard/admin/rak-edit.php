<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<div class="card card-body rounded-0" style="max-width: 30rem;">
  <form method="POST" action="<?= base_url('dashboard/admin/masterdata/rak_buku/'); ?>">
    <?= csrf_field(); ?>
    <div class="mb-3">
      <input type="hidden" name="id" value="<?= $rak['id']; ?>">
      <label for="rak" class="form-label">Nama Rak Buku</label>
      <input type="text" class="form-control <?= $validation->hasError('rak') ? 'is-invalid' : '' ?>" id="rak" name="rak" value="<?= $rak["rak"] ?>">
    </div>
    <button type="submit" class="btn btn-primary rounded-0">Edit Rak Buku</button>
  </form>
</div>

<?= $this->endSection(); ?>