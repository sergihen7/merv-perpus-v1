<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<a href="<?= base_url("dashboard/admin/masterdata/kategori/create"); ?>" class="btn btn-primary rounded-0 mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>

<?php if (session()->has('system')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->get('system') ?>
  </div>
<?php endif; ?>


<div class="table-responsive">
  <table class="table text-nowrap align-middle m-0" id="tableData">
    <thead class="table-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Kategori</th>
        <th scope="col">Dibuat Tgl</th>
        <th scope="col">Ket</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $num = 1;
      foreach ($kategori as $dat) : ?>
        <tr>
          <th scope="row"><?= $num++; ?></th>
          <td><?= $dat['kategori']; ?></td>
          <td><?= date_format(date_create($dat['created_at']), "M, d Y"); ?></td>
          <td class="d-flex gap-1">
            <a href="<?= base_url('dashboard/admin/masterdata/kategori/edit/' . $dat['id']); ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-pencil-fill"></i></a>
            <form action="<?= base_url("dashboard/admin/masterdata/kategori/delete"); ?>" method="POST">
              <input type="hidden" value="<?= $dat['id']; ?>" name="id">
              <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#tableData').DataTable({});
  });
</script>

<?= $this->endSection(); ?>