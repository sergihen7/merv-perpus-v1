<?= $this->extend("template/dashboard-tmp"); ?>

<?= $this->section("content"); ?>

<h1><?= $title; ?></h1>

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



<?= $this->endSection(); ?>