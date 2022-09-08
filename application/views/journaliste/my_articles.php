<?php
require_once 'check_connexion.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Publications</title>
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
        Toutes les 
        <small>publications</small>
      </h1>
			<?php if (!empty($this->session->flashdata('msg'))):?>
				<?php if ($this->session->flashdata('msg') == 'insert_true'):?>
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
					 Effectuée Article enregistré avec succès
					</div>
				<?php elseif ($this->session->flashdata('msg') == 'delete_true'):?>
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Bien Fait!</strong> Action effectuée!!! <a href="#" class="alert-link">Article supprimé avec succès</a>
					</div>
				<?php elseif ($this->session->flashdata('msg') == 'update_true'):?>
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Effectuée</strong> Action modifié avec succès</a>
					</div>
          <?php elseif ($this->session->flashdata('msg') == 'update_false'):?>
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Echec</strong> veuillez reessayer</a>
          </div>
				<?php elseif ($this->session->flashdata('msg') == 'archive_true'):?>
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Bien Fait!</strong> Action effectuée!!! <a href="#" class="alert-link">Article archivé avec succès</a>
					</div>
				<?php elseif ($this->session->flashdata('msg') == 'unarchive_true'):?>
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Bien Fait!</strong> Action effectuée!!! <a href="#" class="alert-link">Article Restoré avec succès</a>
					</div>

				<?php endif?>
			<?php endif?>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
              <!-- TO DO List -->
          <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Publications</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
              <ul class="todo-list">
							<?php foreach ($les_articles as $article):?>
									<li>
										<!-- drag handle -->
										<span class="handle">
													<i class="fa fa-ellipsis-v"></i>
													<i class="fa fa-ellipsis-v"></i>
												</span>
										<!-- checkbox -->
										<!-- <input type="checkbox" value="">-->
										<!-- todo text -->
										<span class="text"><?php echo $article->titre; ?></span>
										<!-- Emphasis label -->
										<small class="label label-danger"><i class="fa fa-clock-o"></i> <?php echo $article->date_pub; ?></small>
										<!-- General tools such as edit or delete-->
										<!-- <div class="tools">
											<a href="<?php echo site_url('journaliste/edit_article/'.$article->id); ?>">Editer</a>
											<a href="<?php echo site_url('journaliste/archive_article/'.$article->id); ?>"><i class="fa fa-trash-o"></i></a>
											<a href="<?php echo site_url('journaliste/delete_article/'.$article->id); ?>"><i class="fa fa-times"></i></a>
										</div> -->
									</li>
								<?php endforeach;?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>
