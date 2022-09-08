
  <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>assets/user/img/talf.png" class="img-circle" alt="User Image"> </span><i class="fa fa-circle text-success"></i> <span style="color: white;">En ligne
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li>
          <a href="<?php echo site_url('journaliste/index');?>">
            <i class="fa fa-dashboard"></i> <span>Accueil</span>
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
        </li>
        <li>
          <a href="<?php echo site_url('journaliste/all_article_page');?>">
            <i class="fa fa-list"></i> <span>Publications</span>
          </a>
        </li>
        <li class="header">AUTRES OPTIONS</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-home text-red"></i>
            <span>Accueil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url('journaliste/apropos');?>">
              <i class="fa fa-edit text-yellow"></i> Apropos
              <span class="pull-right-container">
              <small class="label pull-right bg-green">Editer</small>
            </span>
            </a>
              </li>
            <li><a href="<?php echo site_url('journaliste/objectifs');?>"><i class="fa fa-edit text-aqua"></i>Objectifs
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Editer</small>
            </span></a></li>
          </ul>
        </li>
                <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-green"></i>
            <span>Equipe</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        <ul class="treeview-menu">
          <?php foreach ($equipe as $e): ?>
              
                <li><a href="<?php echo site_url('journaliste/equipe/'.$e->id);?>"><i class="fa fa-edit text-aqua"></i><?php echo($e->prenom); ?>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green">Editer</small>
                </span></a>
              </li>
                        
          <?php endforeach; ?>
           </ul> 
        </li>

      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>
