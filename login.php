<?php 
session_start();
require 'config/functions.php'; 

if(isset($_POST['submit'])){
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];

  $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$uname' ");

  if( mysqli_num_rows($cek) ){
    $row = mysqli_fetch_assoc($cek);

    if(password_verify($pass, $row['password'])){
      // set session
      $_SESSION['login'] = true;
      $_SESSION['uid'] = $row['id_user'];
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['uname'] = ucwords($row['username']);


      // set cookie
      if(isset($_POST['remember'])){
        setcookie('id', $row['id_user'], time() + 60);
        setcookie('key', hash('sha256', $row['username']), time() + 60);
      }
        header("Location: admin/?hal=");
      exit;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BimLaundry's | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="assets/adminlte/index2.html"><b>Bim</b>Laundry's</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="uname">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="pass">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>


      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>