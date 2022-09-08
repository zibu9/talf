<?php
	if(isset($_SESSION['id'], $_SESSION['username'], $_SESSION['usertype'])) {
		if ($_SESSION['usertype'] == 'admin') {
			redirect('admin/');
		}elseif ($_SESSION['usertype'] == 'journaliste') {
			redirect('journaliste/');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | oeil du peuple</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/dist/css/skins/_all-skins.min.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url()?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav login-page">
  <div class="wrapper">
    <header class="main-header">
        <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
            <a href="./" class="navbar-brand"><b>Oeil du peuple </b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
            </div>
            <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                <!-- Menu toggle button -->
                <a href="<?=site_url('article/index')?>" >
                    <i class="glyphicon glyphicon-home"></i>Revenir au Site
                </a>
                </li>
            </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
        </nav>
    </header>
    
    <!-- Full Width Column -->
    <div class="content-wrapper">
            <div class="container">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
            <section class="content">
                <div class="login-box">
                    <!-- /.login-logo -->
                    <div class="login-box-body">
                        <p class="login-box-msg">Authentifiez-vous pour démarrer votre session</p>
                       
                          <?=form_open('journaliste/login') ?>
                            <div class="form-group has-feedback">
                                <?= form_input([ 'type'=>"text", 'class'=>"form-control", 'placeholder'=>"Pseudo", 'style'=>"border-radius:40px;", 'name'=>"login", 'value'=>set_value('login')])?>
                                
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <?= form_input([ 'type'=>"password", 'class'=>"form-control", 'placeholder'=>"Mot de passe", 'style'=>"border-radius:40px;", 'name'=>"password", 'value'=>set_value('password')])?>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                              <?php if(isset($error)):?>
                                <p class="text-danger" style="text-align:center;">Identifiant ou Mot de passe Incorrect!</p>
                              <?php endif?>
                            </div>
                            <div class="form-group has-feedback" >
                                <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius:40px;">Connexion</button>
                            </div>
                                          
                          <?= form_close()?>

                        <div class="social-auth-links text-center">
                        <p>- Ou -</p>
                        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat" style="border-radius:40px;"><i class="fa fa-facebook"></i>Connexion avec Facebook</a>
                        <a href="#" class="btn btn-block btn-social btn-google btn-flat" style="border-radius:40px;"><i class="fa fa-google-plus"></i>Connexio avec Google+</a>
                        </div>
                        <!-- /.social-auth-links -->

                        <a href="#" class="">Mot de passe oublié?</a><br>

                    </div>
                    <!-- /.login-box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
            </div>
            <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
            <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="">Team 50</a>.</strong> All rights
            reserved.
            </div>
            <!-- /.container -->
    </footer>
  </div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets/admin/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="<?=base_url()?>assets/admin/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=base_url()?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
</body>
</html>
