<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<a href="<?= base_url("dashboard/admin/pengguna/create"); ?>" class="btn btn-primary rounded-0 mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>

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

<?php if (isset($anggota)) : ?>
  <div class="table-responsive">
    <table class="table text-nowrap align-middle m-0" id="tableData">
      <thead class="table-dark">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Username</th>
          <th scope="col">Nama Panjang</th>
          <th scope="col">Email</th>
          <th scope="col">Mendaftar Tanggal</th>
          <th scope="col">Terverifikasi?</th>
          <th scope="col">Ket</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $num = 1;
        foreach ($anggota as $a) : ?>
          <tr>
            <th scope="row"><?= $num++; ?></th>
            <td><?= $a['username']; ?></td>
            <td><?= $a['fullname']; ?></td>
            <td><?= $a['email']; ?></td>
            <td><?= $a['created_at']; ?></td>
            <td><?= $a['verif'] == '1' ? 'true' : 'false'; ?></td>
            <td class="d-flex gap-2">
              <button type="button" onclick="msgOpen('<?= $a['username']; ?>')" class="btn btn-sm btn-success rounded-0"><i class="bi bi-envelope-fill"></i></button>
              <a href="<?= base_url('dashboard/admin/pengguna/edit/' . $a['id']); ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-pencil-fill"></i></a>
              <form action="<?= base_url("dashboard/admin/pengguna/delete"); ?>" method="POST">
                <input type="hidden" value="<?= $a['id']; ?>" name="id">
                <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php elseif (isset($admin)) :  ?>
  <div class="table-responsive">
    <table class="table text-nowrap align-middle m-0" id="tableData">
      <thead class="table-dark">
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Username</th>
          <th scope="col">Nama Panjang</th>
          <th scope="col">Email</th>
          <th scope="col">Mendaftar Tanggal</th>
          <th scope="col">Ket</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $num = 1;
        foreach ($admin as $a) : ?>
          <tr>
            <th scope="row"><?= $num++; ?></th>
            <td><?= $a['username']; ?></td>
            <td><?= $a['fullname']; ?></td>
            <td><?= $a['email']; ?></td>
            <td><?= $a['created_at']; ?></td>
            <td class="d-flex gap-2">
              <button type="button" onclick="msgOpen('<?= $a['username']; ?>')" class="btn btn-sm btn-success rounded-0"><i class="bi bi-envelope-fill"></i></button>
              <a href="<?= base_url('dashboard/admin/pengguna/edit/' . $a['id']); ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-pencil-fill"></i></a>
              <form action="<?= base_url("dashboard/admin/pengguna/delete"); ?>" method="POST">
                <input type="hidden" value="<?= $a['id']; ?>" name="id">
                <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<script>
  $(document).ready(function() {
    $('#tableData').DataTable({});
  });
</script>

<?= $this->endSection(); ?>