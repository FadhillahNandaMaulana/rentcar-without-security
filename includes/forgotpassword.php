<?php
if(isset($_POST['update']))
  {
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$newpassword= $_POST['newpassword'];

$sql ="SELECT EmailId FROM tblusers WHERE EmailId='$email' and ContactNo='$mobile'";
$query= $dbh -> prepare($sql);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblusers set Password='$newpassword' where EmailId='$email' and ContactNo='$mobile'";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
}
}
?>

<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

<div class="modal fade" id="forgotpassword">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Pemulihan Password</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="forgotpassword_wrap">
            <div class="col-md-12">
              <form name="chngpwd" method="post" onSubmit="return valid();">
                <div class="form-group">
                  <input type="email" name="email" class="form-control" placeholder="Your Email address*" required="">
                </div>
                <div class="form-group">
                  <input type="text" name="mobile" class="form-control" placeholder="Your Reg. Mobile*" required="">
                </div>
                <div class="form-group">
                  <input type="password" name="newpassword" class="form-control" placeholder="New Password*" required="">
                </div>
                <div class="form-group">
                  <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password*" required="">
                </div>
                <div class="form-group">
                  <input type="submit" value="Reset My Password" name="update" class="btn btn-block">
                </div>
              </form>
              <div class="text-center">
                <p class="gray_text">Untuk keamanan, kami tidak menyimpan kata sandi Anda. Kata sandi Anda akan direset dan kata sandi baru akan dikirimkan kepada Anda.</p>
                <p><a href="#loginform" data-toggle="modal" data-dismiss="modal"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Kembali ke Login</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>