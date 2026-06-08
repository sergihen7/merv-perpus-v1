<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>


<div class="mb-5">
  <h2><?= $title; ?></h2>

  <a href="<?= base_url("dashboard/admin/laporan/create"); ?>" class="btn btn-primary rounded-0 mb-3"><i class="bi bi-plus-lg"></i> Tambah</a>
  <a href="<?= base_url("dashboard/admin/laporan/pinjaman"); ?>" class="btn btn-success rounded-0 mb-3">Pinjaman</a>
  <a href="<?= base_url("dashboard/admin/laporan/izin"); ?>" class="btn btn-danger rounded-0 mb-3">Permintaan</a>

  <h6>Date : <?= date("M, d Y") ?></h6>

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

  <?php if (isset($pinjaman)) : ?>

    <div class="table-responsive">
      <table class="table text-nowrap align-middle m-0" id="tableData">
        <thead class="table-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Kondisi Buku Sebelumnya</th>
            <th scope="col">Tanggal Peminjaman</th>
            <th scope="col">Batas Waktu</th>
            <th scope="col">Status</th>
            <th scope="col">Ket</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $num = 1;
          foreach ($pinjaman as $p) : ?>
            <tr>
              <th scope="row"><?= $num++; ?></th>
              <td><?= $p['fullname']; ?></td>
              <td><?= $p['judul']; ?></td>
              <td>
                <?php if ($p['kondisi_sebelum'] !== NULL) : ?>
                  <?= ($p['kondisi_sebelum'] == 1) ? '<span class="badge bg-success">Baik</span>' : '<span class="badge bg-danger">Rusak</span>'; ?>
                <?php endif; ?>
              </td>
              <td><?= date_format(date_create($p['created_at']), "M, d Y"); ?></td>
              <td><?= date_format(date_create($p['batas_pinjam']), "M, d Y"); ?></td>
              <td><?= ($p['status'] == 1) ? '<span class="badge bg-success">Dipinjam</span' : ''; ?></td>
              <td class="d-flex gap-1">
                <a href="#" onclick="msgOpen('<?= $p['username']; ?>')" type="button" class="btn btn-sm btn-success rounded-0"><i class="bi bi-envelope-fill"></i></i></a>

                <form action="<?= base_url("dashboard/admin/laporan/pinjaman"); ?>" method="POST">
                  <input type="hidden" value="<?= $p['id']; ?>" name="id">
                  <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
                </form>

                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#edit-status-<?= $p['id']; ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-check2-square"></i></a>

              </td>
            </tr>

            <div class="modal fade" id="edit-status-<?= $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form action="<?= base_url('dashboard/admin/laporan/returnsection'); ?>" method="POST">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Pengembalian Buku - <?= $p['fullname']; ?></h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <h6>Judul Buku : <?= $p['judul']; ?></h6>
                        <input type="hidden" name="id" value="<?= $p['id']; ?>">
                        <label for="condition" class="form-label">kondisi Buku Saat di Kembalikan</label>
                        <select name="kondisi" class="form-control">
                          <option value="" selected disabled>-- Select Condition --</option>
                          <option value="1">Baik</option>
                          <option value="0">Rusak</option>
                          <option value="2">Hilang</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary rounded-0" data-bs-dismiss="modal">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php elseif (isset($permintaan)) : ?>

    <div class="table-responsive">
      <table class="table text-nowrap align-middle m-0" id="tableData">
        <thead class="table-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Fullname</th>
            <th scope="col">Books</th>
            <th scope="col">Duration</th>
            <th scope="col">Perkiraan Batas</th>
            <th scope="col">Status</th>
            <th scope="col">Etc</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $num = 1;
          foreach ($permintaan as $p) : ?>
            <tr>
              <th scope="row"><?= $num++; ?></th>
              <td><?= $p['fullname']; ?></td>
              <td><?= $p['judul']; ?></td>
              <td><?= $p['durasi']; ?> Minggu</td>
              <td><?php

                  $time = strtotime(date('Y-m-d H:i:s'));
                  $time = $time + ($p['durasi'] * 604800);
                  echo date('M, d Y', $time);

                  ?></td>
              <td><?= ($p['status'] == 0) ? '<span class="badge bg-warning">Pending</span>' : ''; ?></td>
              <td class="d-flex gap-1">
                <form action="<?= base_url("dashboard/admin/laporan/pinjaman"); ?>" method="POST">
                  <input type="hidden" value="<?= $p['id']; ?>" name="id">
                  <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
                </form>
                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#edit-status-<?= $p['id']; ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-check2-square"></i></a>
              </td>
            </tr>

            <div class="modal fade" id="edit-status-<?= $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form action="<?= base_url('dashboard/admin/laporan/save'); ?>" method="POST">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Permintaan - <?= $p['fullname']; ?></h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <input type="hidden" value="<?= $p['id']; ?>" name="id">
                        <input type="hidden" value="<?= $p['durasi']; ?>" name="durasi">
                        <input type="hidden" value="<?= $p['user_id']; ?>" name="id_user">
                        <input type="hidden" value="<?= $p['buku_id']; ?>" name="id_buku">
                        <h6>Judul Buku : <?= $p['judul']; ?></h6>
                        <label for="condition" class="form-label">Kondisi Kesehatan Buku</label>
                        <select name="kondisi" class="form-control">
                          <option value="" selected disabled>-- Pilih Kesehatan Buku --</option>
                          <option value="1">Baik</option>
                          <option value="0">Rusak</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary rounded-0" data-bs-dismiss="modal">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  <?php elseif (isset($pengembalian)) : ?>
    <div class="">
      <table class="table text-nowrap align-middle m-0" id="tableData">
        <thead class="table-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Peminjam</th>
            <th scope="col">Judul Buku</th>
            <th scope="col">Kondisi Buku Sebelumnya</th>
            <th scope="col">Kondisi Buku Sesudahnya</th>
            <th scope="col">Tanggal Peminjaman</th>
            <th scope="col">Status</th>
            <th scope="col">Denda</th>
            <th scope="col">Status Denda</th>
            <th scope="col">Ket</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $num = 1;
          foreach ($pengembalian as $p) : ?>
            <tr>
              <th scope="row"><?= $num++; ?></th>
              <td><?= $p['fullname']; ?></td>
              <td><?= $p['judul']; ?></td>
              <td>
                <?php if ($p['kondisi_sebelum'] !== NULL) : ?>
                  <?= ($p['kondisi_sebelum'] == 1) ? '<span class="badge bg-success">Baik</span>' : '<span class="badge bg-warning">Rusak</span>'; ?>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($p['kondisi_sesudah'] !== NULL) : ?>
                  <?= ($p['kondisi_sesudah'] == 1) ? '<span class="badge bg-success">Baik</span>' : ($p['kondisi_sesudah'] == 2 ? '<span class="badge bg-danger">Hilang</span>' :  '<span class="badge bg-warning">Rusak</span>'); ?>
                <?php endif; ?>
              </td>
              <td><?= date_format(date_create($p['created_at']), "M, d Y"); ?></td>
              <td><?= ($p['status'] == 2) ? '<span class="badge bg-primary">Dikembalikan</span>' : ''; ?></td>
              <td>
                <?php if ($p['denda'] !== NULL) : ?>
                  <span class="badge bg-danger">IDR <?= $p['denda']; ?></span>
                <?php endif; ?>
              </td>
              <td>
                <?= $p['denda_status'] != NULL ? ($p['denda_status'] == 1 ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-danger">Belum Lunas</span>') : '' ?>
              </td>
              <td class="d-flex gap-1">
                <a href="#" onclick="msgOpen('<?= $p['username']; ?>')" type="button" class="btn btn-sm btn-success rounded-0"><i class="bi bi-envelope-fill"></i></i></a>
                <form action="<?= base_url("dashboard/admin/laporan/pinjaman"); ?>" method="POST">
                  <input type="hidden" value="<?= $p['id']; ?>" name="id">
                  <button type="submit" class="btn btn-sm btn-danger rounded-0"><i class="bi bi-trash-fill"></i></button>
                </form>
                <?php if ($p['denda_status'] != NULL) : ?>
                  <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#edit-status-<?= $p['id']; ?>" class="btn btn-sm btn-primary rounded-0"><i class="bi bi-check2-square"></i></a>
                <?php endif; ?>

              </td>
            </tr>

            <div class="modal fade" id="edit-status-<?= $p['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form action="<?= base_url('dashboard/admin/laporan/denda'); ?>" method="POST">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Denda - <?= $p['fullname']; ?></h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" value="<?= $p['id']; ?>" name="id">
                      <div class="mb-3">
                        <h6>Judul Buku : <?= $p['judul']; ?></h6>
                        <label for="condition" class="form-label">Status Denda</label>
                        <select name="denda_status" class="form-control">
                          <option value="" selected disabled>-- Pilih Status Denda --</option>
                          <option value="1" <?= ($p['denda_status'] == 1 ? 'selected' : '') ?>>Lunas</option>
                          <option value="0" <?= ($p['denda_status'] == 0 ? 'selected' : '') ?>>Belum Lunas</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary rounded-0" data-bs-dismiss="modal">Save</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>


<script>
  $(document).ready(function() {
    $('#tableData').DataTable({});
  });
</script>


<?= $this->endSection(); ?>