<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(!$_SESSION['alogin']) {	
    header('location:index.php');
} else {
    if(isset($_REQUEST['eid'])) {
        $eid = $_GET['eid'];
        $status = "0";
        $sql = "UPDATE tbltestimonial SET status='$status' WHERE id='$eid'";
        $query = $dbh->query($sql);
        $msg = "Testimonial Successfully Inacrive";
    }

    if(isset($_REQUEST['aeid'])) {
        $aeid = $_GET['aeid'];
        $status = "1";
        $sql = "UPDATE tbltestimonial SET status='$status' WHERE id='$aeid'";
        $query = $dbh->query($sql);
        $msg = "Testimonial Successfully Active";
    }
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

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
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Kelola Testimoni</h2>

                        <div class="panel panel-default">
                            <div class="panel-heading">Pengguna Testimoni</div>
                            <div class="panel-body">
                                <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo $error; ?> </div><?php } 
                                else if($msg){?><div class="succWrap"><strong>SUKSES</strong>:<?php echo $msg; ?> </div><?php }?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Testimoni</th>
                                            <th>Posting Tanggal</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $sql = "SELECT tblusers.FullName, tbltestimonial.UserEmail, tbltestimonial.Testimonial, tbltestimonial.PostingDate, tbltestimonial.status, tbltestimonial.id FROM tbltestimonial JOIN tblusers ON tblusers.Emailid=tbltestimonial.UserEmail";
                                    $query = $dbh->query($sql);
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if($query->rowCount() > 0)
                                    {
                                        foreach($results as $result)
                                        { ?>	
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $result->FullName; ?></td>
                                                <td><?php echo $result->UserEmail; ?></td>
                                                <td><?php echo $result->Testimonial; ?></td>
                                                <td><?php echo $result->PostingDate; ?></td>
                                                <td>
                                                <?php if($result->status=="" || $result->status==0) { ?>
                                                    <a href="testimonials.php?aeid=<?php echo $result->id; ?>" onclick="return confirm('Do you really want to Active')">Inactive</a>
                                                <?php } else { ?>
                                                    <a href="testimonials.php?eid=<?php echo $result->id; ?>" onclick="return confirm('Do you really want to Inactive')">Active</a>
                                                <?php } ?>
                                                </td>
                                            </tr>
                                    <?php $cnt++; } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
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
<?php } ?>