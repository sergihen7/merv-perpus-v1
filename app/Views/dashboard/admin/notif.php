<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<?php if (session()->has('system')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->get('system') ?>
  </div>
<?php endif; ?>


<a href="<?= base_url("dashboard/admin/notif/create"); ?>" class="btn btn-primary rounded-0 mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>

<div class="table-responsive">
  <table class="table text-nowrap align-middle m-0" id="tableData">
    <thead class="table-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Judul Pemberitahuan</th>
        <th scope="col">Isi Pemberitahuan</th>
        <th scope="col">Terakhir Diubah</th>
        <th scope="col">Ket</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $num = 1;
      foreach ($notif as $dat) : ?>
        <tr>
          <th scope="row"><?= $num++; ?></th>
          <td><?= $dat['judul']; ?></td>
          <td><?= $dat['isi']; ?></td>
          <td><?= $dat['updated_at']; ?></td>
          <td>
            <div class="d-flex gap-2">
              <a href="<?= base_url('dashboard/admin/notif/edit/' . $dat['id']); ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-pencil-fill"></i></a>
              <form action="<?= base_url("dashboard/admin/notif/delete"); ?>" method="POST">
                <input type="hidden" value="<?= $dat['id']; ?>" name="id">
                <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
              </form>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<?= $this->endSection(); ?>