<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    require 'config/dbconnect.php';
    require 'template/header.php';
    ?>
</head>
<body class="hold-transition login-page" style="background-image: url('images/background.jpg');background-size:cover;">
<div class="login-box">
  <div class="login-logo">
    <img src="images/banner01.png">
  </div>
  <!-- /.login-logo -->
  <?php
  if (isset($_GET['statuslogin'])) {
    if  ($_GET['statuslogin']==0) {
    ?>
       <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>FAILED!</strong> <?php echo $_GET['pesan'];?>
        </div> 
      <?php
     }
     if ($_GET['statuslogin']==2) {
    ?>
        <div class="alert alert-info alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>INFO!</strong> <?php echo $_GET['pesan'];?>
        </div>    
  <?php
      } 
  }
  ?>
  <div class="login-box-body">
    <p class="login-box-msg">Login to Integrated Manpower System</p>

    <form action="controller/loginmethod.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="passwd" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <a href="controller/forgotpasswd.php">I forgot my password</a><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php
require "template/footer.php";
?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
