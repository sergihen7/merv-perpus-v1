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

<?php if (isset($pesan[0])) : ?>
  <?php foreach ($pesan as $p) : ?>
    <a href="<?= base_url('dashboard/pesan/baca_terkirim/' . $p['id']); ?>" style="text-decoration: none; color: black;">
      <div class="msg-list">
        <div class="d-flex align-items-center gap-2">
          <div class="msg-list-img">
            <img src="<?= base_url('img/profile/' . $p['foto']); ?>" alt="" class="img-profile">
          </div>
          <div class="msg-list-info">
            <p class="m-0 <?= ($p['status'] == 0) ? 'fw-bolder' : 'fw-light'; ?>"><?= $p['judul']; ?></p>
            <h6 class="m-0">From You to @<?= $p['username']; ?></h6>
          </div>
        </div>
      </div>
    </a>
  <?php endforeach; ?>
<?php elseif (!empty($pesan)) : ?>
  <div class="card">
    <div class="card-header">
      <h5 class="p-0"><?= $pesan['judul']; ?> - <?= ($pesan['status'] == 0) ? 'Delivered' : 'Seen'; ?></h5>
    </div>
    <div class="card-body">
      <?= $pesan['isi']; ?>
    </div>
    <div class="card-footer d-flex justify-content-between align-items-center">
      <h6 class="p-0">to @<?= $pesan['username']; ?></h6>
      <small class="text-muted"><?= date_format(date_create($pesan['created_at']), 'M, d Y'); ?></small>
    </div>
  </div>
<?php endif; ?>


<?= $this->endSection(); ?>