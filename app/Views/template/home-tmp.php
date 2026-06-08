<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $app['nama_app'] ?> - <?= $title; ?></title>
  <link rel="shortcut icon" href="<?= base_url('img/web/' . $app['logo']); ?>" type="image/x-icon">
  <?= $this->include("essential/header"); ?>
</head>

<body style="background-color: #A5B5C6;">

  <div class="container">
    <?= $this->renderSection('content'); ?>
  </div>

  <?= $this->include("essential/footer"); ?>
</body>

</html>