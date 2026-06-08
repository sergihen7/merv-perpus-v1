<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $app['nama_app'] ?> - <?= $title; ?></title>
  <link rel="shortcut icon" href="<?= base_url('img/web/' . $app['logo']); ?>" type="image/x-icon">
  <?= $this->include("essential/header"); ?>
</head>

<body>

  <?php if (session()->has('msg-failed')) : ?>
    <script>
      Swal.fire({
        icon: 'info',
        text: 'Send Message Failed, Username not Found',
        showConfirmButton: false,
        timer: 2500
      })
    </script>
  <?php endif; ?>

  <?php if (session()->has('msg-success')) : ?>
    <script>
      Swal.fire({
        icon: 'success',
        text: 'Message Sent',
        showConfirmButton: false,
        timer: 2500
      })
    </script>
  <?php endif; ?>

  <div class="d-flex">
    <?= $this->include("essential/sidebar"); ?>

    <div class="dashboard-body" id="dashboardContent">
      <div class="dashboard-header" style="background-color: rgba(0, 0, 0, 0.05);">
        <h1 class="m-0 ms-2" id="navToggle"><i class="bi bi-list" onclick="mySidebar()"></i></h1>
      </div>
      <div class="container-fluid mt-3 mb-4">
        <?= $this->renderSection("content"); ?>
      </div>
    </div>
  </div>

  <msg-div>
    <div class="header d-flex justify-content-between align-items-center" onclick="msgOpen()">
      <h6 class="m-0 ms-4">Message Someone</h6>
      <i class="bi bi-caret-up-fill me-4"></i>
    </div>
    <form action="<?= base_url('dashboard/pesan/send'); ?>" method="post">
      <div class="body" id="msg-body">
        <div class="d-flex gap-3 align-items-center mt-3 mb-3">
          <label class="form-label">From</label>
          <input type="text" class="form-control rounded-pill" value="<?= $user_login['username']; ?>" disabled>
        </div>
        <div class="d-flex gap-3 align-items-center mb-3">
          <label class="form-label">To</label>
          <input type="text" class="form-control rounded-pill" placeholder="Username" name="username" id="username" value="<?= old('username'); ?>">
        </div>
        <div class="d-flex gap-3 align-items-center mb-3">
          <label class="form-label">Subject</label>
          <input type="text" class="form-control rounded-pill" name="title" autocomplete="off" value="<?= old('title'); ?>">
        </div>
        <textarea id="summernote" name="content"><?= old('content'); ?></textarea>
      </div>
      <div class="footer" id="msg-footer">
        <button type="submit" class="btn btn-primary rounded-0">Send</button>
      </div>
    </form>
  </msg-div>

  <script>
    var MsgOpened = false;

    function msgOpen(username) {
      if (MsgOpened == true) {
        $('#msg-body').hide();
        $('#msg-footer').hide();
        MsgOpened = false;
      } else {
        $('#username').val(username);
        $('#msg-body').show();
        $('#msg-footer').show();
        MsgOpened = true;
      }
    }

    $('#summernote').summernote({
      placeholder: 'Write a message here',
      tabsize: 2,
      height: 140,
      tabDisable: true,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link']],
      ]
    });
  </script>

  <?= $this->include("essential/footer"); ?>
</body>

</html>