<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<div class="card card-body rounded-0" style="max-width: 30rem;">
  <form method="POST" action="<?= base_url('dashboard/admin/masterdata/pengarang/'); ?>">
    <?= csrf_field(); ?>
    <div class="mb-3">
      <input type="hidden" name="id" value="<?= $pengarang['id']; ?>">
      <label for="pengarang" class="form-label">Nama Pengarang</label>
      <input type="text" class="form-control <?= $validation->hasError('pengarang') ? 'is-invalid' : '' ?>" id="pengarang" name="pengarang" value="<?= $pengarang["pengarang"] ?>">
    </div>
    <button type="submit" class="btn btn-primary rounded-0">Edit Pengarang</button>
  </form>
</div>

<?= $this->endSection(); ?>