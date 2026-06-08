<?php if (session()->get('role') == 'admin') : ?>
  <div class="p-0 dashboard-navbar" id="dashboardNavbar">
    <div class="dashboard-header justify-content-center">
      <span class="mob-close-sidebar position-absolute" id="navToggle" style="right: 10px;" onclick="mySidebar()">
        <i class="bi bi-x-lg"></i>
      </span>
      <h4 class="m-0"><img src="<?= base_url('img/web/' . $app['logo']); ?>" alt="logo" style="width: 100%; max-width: 35px;"> <?= $app['nama_app']; ?></h4>
    </div>
    <ul class="navbar-nav">
      <li class="nav-item pt-3 pb-3 d-flex align-items-center">
        <img src="<?= base_url('img/profile/' . $user_login['foto']); ?>" class="img-profile" alt="">
        <div class="ms-2">
          <p class="m-0"><small><?= $user_login['fullname'] ?></small></p>
          <p class="m-0 opacity-75" style="font-size: 12px;"><?= $user_login['role'] ?></p>
        </div>
      </li>

      <li class="nav-item-divider">
        <a class="nav-link">Menu</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url("dashboard/admin"); ?>"><i class="bi bi-house-fill"></i> Beranda</a>
      </li>

      <li class="nav-item">
        <div class="nav-link d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#masterData" aria-expanded="false" aria-controls="collapseExample">
          <p class="m-0"><i class="bi bi-folder-fill"></i> Master Data </p>
          <i class="bi bi-caret-down-fill"></i>
        </div>
      </li>
      <div class="collapse" id="masterData">
        <ul class="navbar-nav ps-2">
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/pengguna/anggota"); ?>" class="nav-link" style="font-size: 14px;">Data Anggota</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/pengguna/admin"); ?>" class="nav-link" style="font-size: 14px;">Data Admin</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/buku/"); ?>" class="nav-link" style="font-size: 14px;">Buku</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/masterdata/rak_buku"); ?>" class="nav-link" style="font-size: 14px;">Rak Buku</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/masterdata/kategori"); ?>" class="nav-link" style="font-size: 14px;">Kategori</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/masterdata/pengarang"); ?>" class="nav-link" style="font-size: 14px;">Pengarang</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url("dashboard/admin/masterdata/penerbit"); ?>" class="nav-link" style="font-size: 14px;">Penerbit</a>
          </li>
        </ul>
      </div>

      <li class="nav-item">
        <div class="nav-link d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#report" aria-expanded="false" aria-controls="collapseExample">
          <p class="m-0"><i class="bi bi-graph-up-arrow"></i> Laporan Perpustakaan</p>
          <i class="bi bi-caret-down-fill"></i>
        </div>
      </li>
      <div class="collapse" id="report">
        <ul class="navbar-nav ps-2">
          <li class="nav-item">
            <a href="<?= base_url('dashboard/admin/laporan/pinjaman'); ?>" class="nav-link" style="font-size: 14px;">Laporan Peminjaman</a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dashboard/admin/laporan/pengembalian'); ?>" class="nav-link" style="font-size: 14px;">Laporan Pengembalian</a>
          </li>
        </ul>
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/admin/buku/katalog'); ?>"><i class="bi bi-layers-fill"></i> Katalog Buku</a>
      </li>

      <li class="nav-item-divider">
        <a class="nav-link">Lain-lain</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/admin/setting') ?>"><i class="bi bi-gear-fill"></i> Setelan Aplikasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/admin/notif') ?>"><i class="bi bi-info-lg"></i> Pemberitahuan</a>
      </li>
      <li class="nav-item">
        <div class="nav-link d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#msg" aria-expanded="false" aria-controls="collapseExample">
          <p class="m-0"><i class="bi bi-envelope-fill"></i> Pesan <?= ($pesan_ttl == 0) ? '' : '<span class="badge text-bg-danger">' . $pesan_ttl . '</span>'; ?></p>
          <i class="bi bi-caret-down-fill"></i>
        </div>
      </li>
      <div class="collapse" id="msg">
        <ul class="navbar-nav ps-2">
          <li class="nav-item">
            <a href="<?= base_url('dashboard/pesan'); ?>" class="nav-link" style="font-size: 14px;">Pesan masuk <?= ($pesan_ttl == 0) ? '' : '<span class="badge text-bg-danger">' . $pesan_ttl . '</span>'; ?></a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dashboard/pesan/terkirim'); ?>" class="nav-link" style="font-size: 14px;">Terkirim</a>
          </li>
        </ul>
      </div>

      <li class="nav-item-divider">
        <a class="nav-link">Lanjutan</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/profile'); ?>"><i class="bi bi-person-circle"></i> Setelan Akun</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>"><i class="bi bi-door-open-fill"></i> Keluar</a>
      </li>

      <li class="nav-item-divider">
        <a class="nav-link text-center"><small>Copyright &copy; <?= date('Y') ?> <?= $app['copyright'] ?>. All Rights Reserved</small></a>
      </li>

    </ul>
  </div>
<?php else : ?>
  <div class="p-0 dashboard-navbar" id="dashboardNavbar">
    <div class="dashboard-header justify-content-center">
      <span class="mob-close-sidebar position-absolute" id="navToggle" style="right: 10px;" onclick="mySidebar()">
        <i class="bi bi-x-lg"></i>
      </span>
      <h4 class="m-0"><img src="<?= base_url('img/web/' . $app['logo']); ?>" alt="logo" style="width: 100%; max-width: 35px;"> <?= $app['nama_app']; ?></h4>
    </div>
    <ul class="navbar-nav">
      <li class="nav-item pt-3 pb-3 d-flex align-items-center">
        <img src="<?= base_url('img/profile/' . $user_login['foto']); ?>" class="img-profile" alt="">
        <div class="ms-2">
          <p class="m-0"><small><?= $user_login['fullname'] ?></small></p>
          <p class="m-0 opacity-75" style="font-size: 12px;"><?= $user_login['role'] ?></p>
        </div>
      </li>

      <li class="nav-item-divider">
        <a class="nav-link">Menus</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/anggota'); ?>"><i class="bi bi-house-fill"></i> Beranda</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/anggota/buku/katalog'); ?>"><i class="bi bi-layers-fill"></i> Katalog Buku</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/anggota/buku/pinjaman'); ?>"><i class="bi bi-bookmark-fill"></i> Laporan Pinjaman</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/anggota/buku/histori'); ?>"><i class="bi bi-clock-history"></i> Histori</a>
      </li>

      <li class="nav-item-divider">
        <a class="nav-link">Lain-lain</a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/anggota/notif'); ?>"><i class="bi bi-info-lg"></i> Pemberitahuan</a>
      </li>

      <li class="nav-item">
        <div class="nav-link d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#report" aria-expanded="false" aria-controls="collapseExample">
          <p class="m-0"><i class="bi bi-envelope-fill"></i> Pesan <?= ($pesan_ttl == 0) ? '' : '<span class="badge text-bg-danger">' . $pesan_ttl . '</span>'; ?></p>
          <i class="bi bi-caret-down-fill"></i>
        </div>
      </li>
      <div class="collapse" id="report">
        <ul class="navbar-nav ps-2">
          <li class="nav-item">
            <a href="<?= base_url('dashboard/pesan'); ?>" class="nav-link" style="font-size: 14px;">Pesan masuk <?= ($pesan_ttl == 0) ? '' : '<span class="badge text-bg-danger">' . $pesan_ttl . '</span>'; ?></a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dashboard/pesan/terkirim'); ?>" class="nav-link" style="font-size: 14px;">Terkirim</a>
          </li>
        </ul>
      </div>

      <li class="nav-item-divider">
        <a class="nav-link">Lanjutan</a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/profile'); ?>"><i class="bi bi-person-circle"></i> Setelan Akun</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>"><i class="bi bi-door-open-fill"></i> Keluar</a>
      </li>

      <li class="nav-item-divider">
        <a class="nav-link text-center"><small>Copyright &copy; <?= date('Y') ?> <?= $app['copyright'] ?>. All Rights Reserved</small></a>
      </li>


    </ul>
  </div>
<?php endif; ?>