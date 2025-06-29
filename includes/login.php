<?php
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT EmailId, Password, FullName FROM tblusers WHERE EmailId='$email' AND Password='$password'";

    try {
        $query = $dbh->query($sql);
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            $_SESSION['login'] = $_POST['email'];
            $user = $results[0];
            $_SESSION['fname'] = $user->FullName;

            $currentpage = $_SERVER['REQUEST_URI'];
            // Tambahkan parameter id=1 ke URL
            echo "<script type='text/javascript'> 
                var url = '$currentpage';
                url += (url.indexOf('?') >= 0) ? '&id=1' : '?id=1';
                document.location = url;
            </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<div class="modal fade" id="loginform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Login</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email address*">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password*">
                </div>
                <div class="form-group checkbox">
                  <input type="checkbox" id="remember">
                </div>
                <div class="form-group">
                  <input type="submit" name="login" value="Login" class="btn btn-block">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Tidak punya akun? <a href="#signupform" data-toggle="modal" data-dismiss="modal">Daftar Disini</a></p>
        <p><a href="#forgotpassword" data-toggle="modal" data-dismiss="modal">Lupa Password ?</a></p>
      </div>
    </div>
  </div>
</div>