<?php
// Asumsi: $dbh adalah koneksi PDO yang sudah aktif
if(isset($_POST['signup'])) {
    $fname = $_POST['fullname'];
    $email = $_POST['emailid']; 
    $mobile = $_POST['mobileno'];
    $password = $_POST['password']; 
    $dob = $_POST['dob'];

    $address = $_POST['address'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $ktp_file = $_FILES['ktp']['name'];
    $ktp_tmp = $_FILES['ktp']['tmp_name'];

    $ktp_newname = time() . "_" . basename($ktp_file);
    $ktp_folder = "ktp_uploads/" . $ktp_newname;

    if (!is_dir("ktp_uploads")) {
        mkdir("ktp_uploads", 0777, true);
    }

    move_uploaded_file($ktp_tmp, $ktp_folder);

    try {
        $sql = "INSERT INTO tblusers(FullName,EmailId,ContactNo,Password,Address,City,Country,KtpImage,dob) 
                VALUES('$fname','$email','$mobile','$password','$address','$city','$country','$ktp_newname', '$dob')";
        $result = $dbh->exec($sql);

        if($result) {
            echo "<script>alert('Registration successful. Now you can login');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<style>
.modal-body {
  max-height: 70vh;
  overflow-y: auto;
}
.modal-dialog {
  max-width: 600px;
}
</style>

<script>
function checkAvailability() {
    $("#loaderIcon").show();
    jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#emailid").val(),
        type: "POST",
        success: function(data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function () {}
    });
}

function validatePassword() {
    var password = document.getElementById("passwordField").value.trim();
    if (password.length < 8) {
        alert("Password harus minimal 8 karakter");
        return false;
    }
    return true;
}
</script>

<!-- Modal Signup -->
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h3 class="modal-title">Daftar</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="signup_wrap">
          <div class="col-md-12 col-sm-6">
            <form method="post" name="signup" onsubmit="return validatePassword()" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Nama Lengkap" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="dob" placeholder="Tanggal Lahir (dd/mm/yyyy)" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="Alamat" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="city" placeholder="Kota" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="country" placeholder="Negara" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="mobileno" placeholder="Nomor Handphone" maxlength="15" required>
              </div>

              <div class="form-group">
                <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email" required>
                <span id="user-availability-status" style="font-size:12px;"></span>
              </div>

              <div class="form-group">
                <input type="password" class="form-control" name="password" id="passwordField" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label for="ktp">Upload Foto KTP</label>
                <input type="file" name="ktp" class="form-control" accept="image/*" required>
              </div>

              <div class="form-group checkbox">
                <input type="checkbox" id="terms_agree" required checked>
                <label for="terms_agree">Saya setuju dengan <a href="#">Syarat dan Ketentuan</a></label>
              </div>

              <div class="form-group">
                <input type="submit" value="Sign Up" name="signup" class="btn btn-block btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal-footer text-center">
        <p>Sudah punya akun? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Disini</a></p>
      </div>

    </div>
  </div>
</div>