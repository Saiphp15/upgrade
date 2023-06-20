<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in | ZenoHealth</title>  
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/sweetalert.css" />
  <!-- Animate CSS & JS -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/animate.css" />
  <!-- Loader CSS -->
  <link rel="stylesheet" href="<?php echo SERVER_ROOT_PATH_ASSETS; ?>css/style.css" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">    
    <img src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>dist/img/logo.png" alt="Logo" class="brand-image img-responsive elevation-3" style="opacity: .8width:auto;min-width:360px;max-width:360px;">
  </div>  
  <!-- /.login-logo -->
  <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign In </p>
        
        <form method="POST" action="<?php echo base_url('login-auth'); ?>" name="chk_login" id="chk_login" enctype="multipart/form-data">
          <input name="<?php echo $this->security->get_csrf_token_name(); ?>" type="hidden" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <div class="input-group mb-3">
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" data-error=".error1">
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                </div>                
            </div>
            <span class="error1"></span>   
            <div class="input-group mb-3">
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password*" data-error=".error2">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>              
            </div>
            <span class="error2"></span>
            <div class="row">  
              <div class="col-4">
              </div>       
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block text-center">Sign In</button>
              </div>
              <div class="col-4">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>dist/js/adminlte.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/wow.min.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/sweetalert.min.js"></script>
<!-- form validate js -->
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/jquery-validate.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/form-validation.js"></script>
<script src="<?php echo SERVER_ROOT_PATH_ASSETS; ?>js/ajax-call.js"></script>
<!-- Bootstrap JS -->
<!-- Popper Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>
</html>
