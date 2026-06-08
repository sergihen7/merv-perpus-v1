<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<?php if (session()->has('system')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->get('system') ?>
  </div>

<?php endif; ?>

<div class="card card-body rounded-0" style="max-width: 30rem;">
  <form method="POST" action="<?= base_url('dashboard/admin/laporan/save'); ?>">
    <?= csrf_field(); ?>

    <div class="mb-3">
      <label for="id_user" class="form-label">Nama Anggota</label>
      <select type="text" id="id_user" class="<?= $validation->hasError('id_user') ? 'is-invalid' : '' ?>" name="id_user" placeholder="Pilih Anggota">
        <option value=""></option>
        <?php foreach ($user as $u) : ?>
          <option value="<?= $u['id']; ?>" <?= old('id_user') == $u['id'] ? 'selected' : '' ?>><?= $u['fullname']; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <div class="invalid-feedback">
        <?= $validation->getError('id_user') ?>
      </div>
    </div>

    <div class="mb-3">
      <label for="id_book" class="form-label">Judul Buku</label>
      <select type="text" id="id_book" class="<?= $validation->hasError('id_buku') ? 'is-invalid' : '' ?>" name="id_buku" placeholder="Pilih Buku">
        <option value=""></option>
        <?php foreach ($buku as $b) : ?>
          <option value="<?= $b['id']; ?>" <?= old('id_buku') == $b['id'] ? 'selected' : '' ?>><?= $b['judul']; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <div class="invalid-feedback">
        <?= $validation->getError('id_buku') ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="duration" class="form-label">Durasi Peminjaman</label>
      <select name="durasi" id="duration" class="<?= $validation->hasError('durasi') ? 'is-invalid' : '' ?>">
        <option value="1" <?= old('durasi') == '1' ? 'selected' : '' ?>>1 Minggu</option>
        <option value="2" <?= old('durasi') == '2' ? 'selected' : '' ?>>2 Minggu</option>
        <option value="3" <?= old('durasi') == '3' ? 'selected' : '' ?>>3 Minggu</option>
      </select>
      <div class="invalid-feedback">
        <?= $validation->getError('durasi') ?>
      </div>
    </div>
    <div class="mb-3">
      <label for="condition" class="form-label">Kondisi Buku</label>
      <select name="kondisi" id="condition" class="<?= $validation->hasError('id_buku') ? 'is-invalid' : '' ?>">
        <option value="1" <?= old('kondisi') == '1' ? 'selected' : '' ?>>Baik</option>
        <option value="0" <?= old('kondisi') == '0' ? 'selected' : '' ?>>Rusak</option>
      </select>
      <div class="invalid-feedback">
        <?= $validation->getError('kondisi') ?>
      </div>
    </div>
    <button type="submit" class="btn btn-primary rounded-0">Tambah</button>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('select').selectize({
      sortField: 'text'
    });
  });
</script>


<?= $this->endSection(); ?>