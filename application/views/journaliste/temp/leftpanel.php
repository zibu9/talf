 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url()?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Oeil du peuple</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION PRINCIPALE</li>
        <li class="active">
          <a href="<?php echo site_url('journaliste/index');?>">
            <i class="fa fa-dashboard"></i> <span>Accueil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('journaliste/new_article_page');?>">
            <i class="fa fa-plus"></i> <span>Nouveau</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?php echo site_url('journaliste/all_article_page');?>">
            <i class="fa fa-list"></i> <span>Mes Publications</span>
          </a>
        </li>
        <li>
          <a href="#<?php echo site_url('article/all_article_page');?>">
            <i class="fa fa-list"></i> <span>Articles Vidéos</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow"><?php if(isset($cpt_art)) {echo $cpt_art;}?></small>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
