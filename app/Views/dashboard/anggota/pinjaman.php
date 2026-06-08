<?= $this->extend('template/dashboard-tmp'); ?>

<?= $this->section('content'); ?>

<h2 class="mb-3"><?= $title; ?></h2>
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

<div class="row row-cols-1 row-cols-md-3">
  <?php foreach ($pinjaman as $p) : ?>
    <div class="col mb-3">
      <div class="card h-100 rounded-0">
        <div class="card-body">
          <p>Book Name : <?= $p['judul']; ?></p>
          <p>Author : <?= $p['nm_pengarang']; ?></p>
          <p>Status :
            <?php if ($p['status'] == 1) : ?>
              <span class="badge bg-success">Dipinjam</span>
            <?php elseif ($p['status'] == 2) : ?>
              <span class="badge bg-primary">Dikembalikan</span>
            <?php else : ?>
              <span class="badge bg-secondary">Not Active Yet</span>
            <?php endif; ?>
          </p>
          <p>
            <?php
            if ($p['batas_pinjam'] !== NULL && $p['status'] != 2) {
              echo 'Batas : ';
              echo (date('Y-m-d H:i:s') > $p['batas_pinjam']) ? '<span class="badge bg-danger">' . date_format(date_create($p['batas_pinjam']), 'M, d Y') . '</span>' : '<span class="badge bg-success">' . date_format(date_create($p['batas_pinjam']), 'M, d Y') . '</span>';
            }

            ?>
          </p>
          <p>
            <?php
            if ($p['denda'] !== NULL) {
              echo 'Denda : ';
              echo '<span class="badge bg-danger">IDR ' . $p['denda'] . '</span>';
              echo "<p>";
              echo 'Status Denda : ';
              echo $p['denda_status'] == 1 ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-danger">Belum Lunas</span>';
              echo "</p>";
            }

            ?>
          </p>
        </div>
        <div class="card-footer text-end">
          <?php if ($p['status'] == 0) : ?>
            <form action="" method="post">
              <input type="hidden" value="<?= $p['id']; ?>" name="id">
              <button class="btn btn-danger rounded-0" type="submit">Cancel</button>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>


  <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>