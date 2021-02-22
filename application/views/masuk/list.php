<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>assets/admin/index2.html"><h1><?php echo $title ?></h1></a>
  </div>
    <p class="login-box-msg">Masukkan Username dan Password</p>
    
<?php 
// notifikasi error
echo validation_errors('<div class="alert alert-success">','</div>');

// notifikasi error login
if($this->session->flashdata('warning')) {
  echo '<div class="alert alert-warning">';
  echo $this->session->flashdata('warning');
  echo '</div>';
}

// notif logout
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}
// form open login pelanggan
echo form_open(base_url('masuk'));
?>
     <table class="table">
  <br> 
   <tbody>
       <tr>
           <td width="40%">Email (Username) </td>
           <td><input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email')?>" required></td>
       </tr>
       <tr>
           <td>Password</td>
           <td><input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password')?>" required></td>
       </tr>
       
       <tr>
          <td></td>
        <td>
          <div class="col-xs-6">
              <button class="btn btn-primary btn-block btn-sm" type="submit">
                  <i class="fa fa-login"></i>Login
              </button>
          </div>
         
        </td>
       </tr>
   </tbody>
</table>
<br><br>
<p>Belum memiliki akun? Silahkan <a href="<?php echo base_url('registrasi') ?>" class="btn btn-info btn-sm">Registrasi Disini</a></p>
<?php echo form_close(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
