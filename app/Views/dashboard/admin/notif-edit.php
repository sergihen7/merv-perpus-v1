<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<div class="card card-body rounded-0" style="max-width: 60rem;">
  <form method="POST" action="<?= base_url("dashboard/admin/notif/save") ?>">
    <input type="hidden" name="id" value="<?= $notif['id'] ?>">
    <div class="mb-3">
      <label for="judul" class="form-label">Judul Pemberitahuan</label>
      <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" id="judul" name="judul" value="<?= old("judul") ?? $notif['judul']  ?>">
    </div>
    <div class="mb-3">
      <label for="isi" class="form-label">Isi Pemberitahuan</label>
      <textarea name="isi" id="isi" class="form-control  <?= ($validation->hasError('isi')) ? 'is-invalid' : '' ?>" cols="30" rows="10"><?= old("isi") ?? $notif['isi'] ?></textarea>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select name="status" id="stauts" class="form-select <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
        <option selected value disabled>Pilih Status</option>
        <option <?= (old("status") ?? $notif['status'] == '0') ? 'selected' : '' ?> value="0">Tidak Aktif</option>
        <option <?= (old("status") ?? $notif['status'] == '1') ? 'selected' : '' ?> value="1">Aktif</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Level Akses</label>
      <select name="level_akses" id="level_akses" class="form-select <?= ($validation->hasError('level_akses')) ? 'is-invalid' : '' ?>">
        <option selected value disabled>Pilih Akses</option>
        <option <?= (old("level_akses") ?? $notif['level_akses'] == '0') ? 'selected' : '' ?> value="0">Semua</option>
        <option <?= (old("level_akses") ?? $notif['level_akses'] == '1') ? 'selected' : '' ?> value="1">Admin</option>
        <option <?= (old("level_akses") ?? $notif['level_akses'] == '2') ? 'selected' : '' ?> value="1">Member</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary rounded-0">Save</button>
  </form>
</div>

<?= $this->endSection(); ?>