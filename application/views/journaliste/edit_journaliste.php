<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Editer Journaliste</title>
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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  
  <?php
    include_once("head.php");
    include_once("leftpanel.php");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editer
        <small>Journaliste</small>
      </h1>
      <?php if (!empty($this->session->flashdata('msg'))):?>
		<?php if ($this->session->flashdata('msg') == 'update_true'):?>
			<div class="alert alert-dismissible alert-success">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Bien Fait!</strong> Action effectuée!!! <a href="#" class="alert-link">Vos coordonnées ont été modifiées avec succès</a>
			</div>
		<?php endif?>
	<?php endif?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> dashboard</a></li>
        <li class="active">Edition</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Edition
                <small></small>
              </h3>
            </div>
            <!-- /.box-header -->
            <?=form_open('journaliste/submit_update_journaliste_him_self') ?>
              <div class="box-body pad">
				<div class="col-md-12">
					<div class="form-group">
							<label for="exampleInputEmail1">Mot de passe</label>
							<?=form_input([ 'type'=>"password", 'class'=>"form-control", 'id'=>"exampleInputEmail1", 'name'=>"password"])?>
							<?=form_error('password', '<p class="text-danger">', '</p>')?>
					</div>
					<?=form_input([ 'type'=>"hidden", 'name'=>"id", 'value'=>$update_data->id])?>
				</div>
              <div class="box-footer">
                  <button type="reset" class="btn btn-default">Annuler</button>
                  <button type="submit" class="btn btn-primary pull-right">Modifier</button>
              </div>
			<?= form_close()?>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    include_once("footer.php");
    include_once("controlsidebar.php");
  ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
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
