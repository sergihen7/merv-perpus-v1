<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

<?php if (session()->has('system')) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->get('system') ?>
  </div>
<?php endif; ?>


<a href="<?= base_url("dashboard/admin/buku/create"); ?>" class="btn btn-primary rounded-0 mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>

<div class="table-responsive">
  <table class="table text-nowrap align-middle m-0" id="tableData">
    <thead class="table-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Judul Buku</th>
        <th scope="col">Penerbit</th>
        <th scope="col">Pengarang</th>
        <th scope="col">Kategori</th>
        <th scope="col">Jumlah Buku</th>
        <th scope="col">Rak</th>
        <th scope="col">Ket</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $num = 1;
      foreach ($buku as $dat) : ?>
        <tr>
          <th scope="row"><?= $num++; ?></th>
          <td><?= $dat['judul']; ?></td>
          <td><?= $dat['nm_penerbit']; ?></td>
          <td><?= $dat['nm_pengarang']; ?></td>
          <td><?= $dat['nm_kategori']; ?></td>
          <td><?= $dat['stock']; ?></td>
          <td><?= $dat['nm_rak']; ?></td>
          <td class="d-flex gap-1">
            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#books-read-<?= $dat['id']; ?>" class="btn btn-sm btn-success rounded-0"><i class="bi bi-eye-fill"></i></a>
            <a href="<?= base_url('dashboard/admin/buku/edit/' . $dat['id']); ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-pencil-fill"></i></a>
            <form action="<?= base_url("dashboard/admin/buku/delete"); ?>" method="POST">
              <input type="hidden" value="<?= $dat['id']; ?>" name="id">
              <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
            </form>
          </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="books-read-<?= $dat['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $dat['judul']; ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="d-flex justify-content-center">
                  <img src="<?= base_url("img/cover/" . $dat['sampul']); ?>" alt="Cover Books" class="cover-books">
                </div>
                <div class="mt-3 text-center">
                  <h4><?= $dat['judul']; ?></h4>
                  <h5><span class="badge bg-success"><?= $dat['nm_pengarang']; ?></span></h5>
                  <div class="d-flex gap-1 justify-content-center">
                    <p class="m-0"><?= $dat['nm_kategori']; ?></p>
                  </div>
                  <h6><?= $dat['nm_penerbit']; ?> - <?= $dat['tahun_terbit']; ?></h6>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

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