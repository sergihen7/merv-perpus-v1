<?= $this->extend('template/dashboard-tmp'); ?>

<?= $this->section('content'); ?>
<h2 class="mb-3">Dashboard</h2>
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

<div class="mb-5">
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-4">
    <div class="col">
      <div class="card text-bg-secondary rounded-0 border-0 h-100">
        <div class="card-body">
          <h2 class="card-title"><?= $peminjaman_ttl; ?></h2>
          <p class="card-text">Peminjaman Buku</p>
        </div>
        <a href="<?= base_url("dashboard/anggota/buku/pinjaman"); ?>" class="text-light text-decoration-none">
          <div class="card-footer text-center border-0" style="background-color: rgba(0,0,0,0.2);">
            <small>More info <i class="bi bi-arrow-right-circle-fill"></i>
            </small>
          </div>
        </a>
      </div>
    </div>
    <div class="col">
      <div class="card text-bg-danger rounded-0 border-0 h-100">
        <div class="card-body">
          <h2 class="card-title"><?= $pengembalian_ttl; ?></h2>
          <p class="card-text">Pengembalian Buku</p>
        </div>
        <a href="<?= base_url("dashboard/anggota/buku/histori"); ?>" class="text-light text-decoration-none">
          <div class="card-footer text-center border-0" style="background-color: rgba(0,0,0,0.2);">
            <small>More info <i class="bi bi-arrow-right-circle-fill"></i>
            </small>
          </div>
        </a>
      </div>
    </div>
  </div>

  <h4>Pemberitahuan <i class="bi bi-bell-fill"></i></h4>

  <?php foreach ($notif as $n) :
  ?>
    <div class="alert alert-success rounded-0">
      <h4 class="mb-4">
        <?= $n['judul'];
        ?>
      </h4>
      <notif-content>
        <?= $n['isi'];
        ?>
      </notif-content>
      <notif-footer>
        <small class="text-end opacity-75 d-block">Last Updated at <?= date_format(date_create($n['updated_at']), 'M, d Y'); ?></small>
      </notif-footer>
    </div>
  <?php endforeach;
  ?>
</div>



<?= $this->endSection(); ?>