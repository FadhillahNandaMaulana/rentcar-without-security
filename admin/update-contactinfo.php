<?php
// Hapus semua proteksi
include('includes/config.php');

$msg= "";

// Proses update langsung tanpa sesi atau validasi
if(isset($_POST['submit'])) {
  $address = $_POST['address'];
  $email = $_POST['email'];
  $contactno = $_POST['contactno'];

  // Query tanpa prepared statement
  $sql = "UPDATE tblcontactusinfo SET Address='$address', EmailId='$email', ContactNo='$contactno'";
  $dbh->query($sql);
  $msg = "Info Updated successfully";
}
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
  <title>RENTCAR</title>
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-social.css">
  <link rel="stylesheet" href="css/bootstrap-select.css">
  <link rel="stylesheet" href="css/fileinput.min.css">
  <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .errorWrap {
      padding: 10px;
      margin: 0 0 20px 0;
      background: #fff;
      border-left: 4px solid #dd3d36;
      box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap {
      padding: 10px;
      margin: 0 0 20px 0;
      background: #fff;
      border-left: 4px solid #5cb85c;
      box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
  </style>
</head>
<body>
  <?php include('includes/header.php'); ?>
  <div class="ts-main-content">
    <?php include('includes/leftbar.php'); ?>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row"><div class="col-md-12">
          <h2 class="page-title">Ubah Informasi Kontak</h2>
          <div class="row"><div class="col-md-10">
            <div class="panel panel-default">
              <div class="panel-heading">Kolom formulir</div>
              <div class="panel-body">
                <form method="post" class="form-horizontal">
                  <?php if($msg){ ?><div class="succWrap"><strong>SUKSES</strong>: <?php echo $msg; ?></div><?php } ?>

                  <?php
                    // Query tanpa prepared statement
                    $sql = "SELECT * FROM tblcontactusinfo";
                    $query = $dbh->query($sql);
                    foreach($query as $result) {
                  ?>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Alamat</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" name="address" required><?php echo $result['Address']; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Email id</label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" name="email" value="<?php echo $result['EmailId']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nomor Kontak</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="contactno" value="<?php echo $result['ContactNo']; ?>" required>
                    </div>
                  </div>
                  <?php } ?>

                  <div class="hr-dashed"></div>
                  <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-4">
                      <button class="btn btn-primary" name="submit" type="submit">Ubah</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div></div>
        </div></div>
      </div>
    </div>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap-select.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <script src="js/Chart.min.js"></script>
  <script src="js/fileinput.js"></script>
  <script src="js/chartData.js"></script>
  <script src="js/main.js"></script>
</body>
</html>