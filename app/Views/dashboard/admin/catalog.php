<?= $this->extend('template/dashboard-tmp'); ?>

<?= $this->section('content'); ?>

<div class="d-flex align-items-center mb-3">
  <h2><?= $title; ?></h2>
  <h5 class="ms-2 text-primary" style="cursor: pointer;"><i class="bi bi-question-circle-fill" data-bs-toggle="modal" data-bs-target="#exampleModal"></i></h5>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Di halaman ini kamu bisa melakukan permintaan izin pinjam buku, yang nantinya perlu di acc oleh admin
      </div>
    </div>
  </div>
</div>

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

<a href="<?= base_url('dashboard/admin/buku/katalog/') ?>" type="button" class="btn btn-secondary btn-sm rounded-pill mb-3">Semua</a>
<?php foreach ($kategori as $k) : ?>
  <a href="<?= base_url('dashboard/admin/buku/katalog/' . $k['kategori']) ?>" type="button" class="btn btn-secondary btn-sm rounded-pill mb-3"><?= $k['kategori']; ?></a>
<?php endforeach; ?>


<div class="row row-cols-1 row-cols-md-3">
  <?php foreach ($buku as $b) : ?>
    <div class="col mb-3">
      <div class="card h-100 rounded-0">
        <div class="card-header">
          <?= $b['judul']; ?> oleh <?= $b['pengarang']; ?>
          <div class="text-end">

          </div>
        </div>
        <div class="card-body">
          <img class="cover-books mx-auto d-block" src="<?= base_url('img/cover/' . $b['sampul']); ?>" alt="Cover" style="height: 100%;">
        </div>
        <div class="card-footer text-end">
          <button class="btn btn-primary rounded-0" type="button" data-bs-toggle="modal" data-bs-target="#req-<?= $b['id']; ?>">
            Request
          </button>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="req-<?= $b['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $b['judul']; ?> by <?= $b['pengarang']; ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="card border-0">
            <div class="row g-0">
              <div class="col-3">
                <img src="<?= base_url('img/cover/' . $b['sampul']); ?>" class="cover-books" alt="...">
              </div>
              <div class="col-9">
                <div class="card-body">
                  <h5 class="card-title"></h5>
                  <p class="card-text"><small class="text-muted">Publisher : <?= $b['penerbit']; ?></small></p>
                  <p class="card-text"><small class="text-muted">Published Year : <?= $b['tahun_terbit']; ?></small></p>
                  <p>
                  <p class="card-text"><small class="text-muted">bookshelf Code : <?= $b['rak']; ?></small></p>
                  <p>

                  </p>
                </div>
              </div>
            </div>
          </div>
          <form action="<?= base_url('dashboard/anggota/buku/req'); ?>" class="modal-footer" method="post">
            <input type="hidden" value="<?= $b['id']; ?>" name="buku_id">
            <select class="form-select mb-3" name="durasi">
              <option selected disabled>Select Duration</option>
              <option value="1">1 Week</option>
              <option value="2">2 Weeks</option>
              <option value="3">3 Weeks</option>
            </select>
            <button type="button" class="btn btn-danger rounded-0" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary rounded-0">Send a Request</button>
          </form>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?= $this->endSection(); ?>