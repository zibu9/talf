<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Talents feminins || reseau des femmes .....</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Favicon -->
  <link href="<?=base_url()?>assets/user/img/talf.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?=base_url()?>assets/user/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?=base_url()?>assets/user/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?=base_url()?>assets/user/css/style.css" rel="stylesheet">

</head>

<body style="background-color: #edf6ff;">
  <!-- Page Content
    ================================================== -->
  <!-- Header -->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <?php if (!empty($article->img_path)){ ?>
        <a href="<?=site_url()?>"><img style="max-height:0%; max-width:0%;"
                             src="<?=base_url()?>/pictures/<?=$article->img_path?>"></a><?php } ?>
        <a href="index.html"><img src="<?=base_url()?>assets/user/img/talf2.png" alt="" title="" /></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Talf</a></h1> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="<?=site_url('Accueil/')?>">Accueil</a></li>
          <li><a href="<?=site_url('article/')?>">Blog</a></li>
          <li><a href="#contact">Commenter</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-whatsapp"></i></a>
      </nav>
    </div>
  </header>
  <!-- #header -->
  <section class="team" id="team">
      <div class="container">
        <?php if ($this->session->flashdata('msg') == 'insert_true'):?>
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Effectuer</strong> Merci pour votre commentaire
          </div>
        <?php elseif ($this->session->flashdata('msg') == 'delete_true'):?>
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>echec</strong> une erreur s'est produite lors de l'envoie reessayer
          </div>
        <?php endif; ?>
        <div class="row">
        <div class=" col-lg-9 col-sm-12 col-md-12 mt-0">
            <div class="text-black"> 
            <div class="col-md-12 col-lg-12 col-sm-12 ">
               <h3 class="col-sm-12 font-weight-bold"><?=$article->titre?></h3>
               <small class="text-muted"><i class="far fa-clock"></i><?=$article->jour.'/'.$article->mois.'/'.$article->annee.' à '.$article->heure.':'. $article->minute?></small> 
            </div>
              <div class="col-sm-12 col-md-8 text-center"><img src="<?=base_url()?>pictures/<?=$article->img_path?>" class="card-img-top"> </div>
                                                                          
                <div class=" col-xs-1 col-sm-12 col-md-12 col-lg-6">
                   <a href="https://api.whatsapp.com/send?media=<?=base_url()?>pictures/<?=$article->img_path?>&text=*<?=$article->titre?>* 
                                        <?=site_url()?><?=uri_string().".html"?>&title=article/details/<?=$article->id?><?=$article->titre?>" class="whatsapp img-circle" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">
                <img src="<?=base_url()?>assets/user/img/whatsapp.png" style="width: 40px; height: 40px;">
              </a>
                 <a href="https://twitter.com/share?url=<?=site_url()?><?=uri_string().".html"?>&text=<?=$article->titre?>&via=VOTRE-NOM-TWITTER" class="twitter img-circle" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">
                <img src="<?=base_url()?>assets/user/img/twitter.png" style="width: 40px; height: 40px;">
              </a>
              <a href="https://www.facebook.com/sharer.php?u=<?=site_url()?><?=uri_string().".html"?>&text=<?=$article->titre?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');return false;">
                <img src="<?=base_url()?>assets/user/img/facebook.png" style="width: 40px; height: 40px;">
              </a>
                <!-- ShareThis BEGIN -->
                <br>
                <div class="sharethis-inline-share-buttons"></div>
                <!-- ShareThis END -->
                </div>
                <div class="card-body"> 
                    <p class="card-text text-justify">
                        <?=ucfirst($article->contenu);?>
                  </p> 
                    <br>
                    </p>
              </div>

          </div>
             
       </div>
       </div>
       <div class="container">
       <?php if (count($commentaires)!=0):?>
       <div class="row">
        <h2 class="text-center"> 
           [<?=count($commentaires);?>]Commentaire<?php if(count($commentaires)>1){echo"s";} ?>
          </h2>
        </div>
        <?php $i = 0; foreach($commentaires as $comment):?>
      
        <div class="media mb-3">
            <img src="<?=base_url()?>assets/user/img/autho.png" style="border-radius: 100%;border: 1px solid #ddecfc;" class="mr-2" width="80px" height="80px">
            <div class="media-body">
              <h5 class="mb-1 mt-0"><?= ucfirst($comment->pseudo)?></h5>
               <small class="text-muted">le <?=$comment->jour?>/<?=$comment->mois?>/<?=$comment->annee?> à <?=$comment->heure?>:<?=$comment->minute?></small><br> 
                <b class="font-weight-bold"><?=$comment->commentaire?></b>

            </div>
          </div>
          <hr>
          <?php $i++; if ($i>9) {
                   break;} endforeach?>
        <?php endif; ?>
       </div>

  </section>
  <!-- @component: footer -->

  <section id="contact">
      <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="section-title">Laisser votre Commentaire</h2>
            </div>
          </div>
      <div class="row">
      <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-7">
          <div class="form">
            <div id="errormessage"></div>

          <?= form_open('commentaire/submit_new_comment') ?>
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" minlength="3" placeholder="Votre nom" required />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="commentaire" rows="5" required placeholder="Commentaire"></textarea>
                       <?=form_input(['type'=>"hidden", 'name'=>'id', 'value'=>$article->id]) ?>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Envoyer</button></div>
          <?= form_close() ?>
          </div>
        </div>
    </div>
</div>
      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="bottom">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-xs-12 text-lg-left text-center">
            <p class="copyright-text">
              &copy; TALF
            </p>
            <div class="credits">
             by  <a href="https://zibu.000webhostapp.com/">Zibu_design</a>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12 text-lg-right text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="index.html">Accueil</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </footer>
  <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>


  <!-- Required JavaScript Libraries -->
  <script src="<?=base_url()?>assets/user/lib/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/superfish/hoverIntent.js"></script>
  <script src="<?=base_url()?>assets/user/lib/superfish/superfish.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/tether/js/tether.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/stellar/stellar.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/counterup/counterup.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/waypoints/waypoints.min.js"></script>
  <script src="<?=base_url()?>assets/user/lib/easing/easing.js"></script>
  <script src="<?=base_url()?>assets/user/lib/stickyjs/sticky.js"></script>
  <script src="<?=base_url()?>assets/user/lib/parallax/parallax.js"></script>
  <script src="<?=base_url()?>assets/user/lib/lockfixed/lockfixed.min.js"></script>

  <!--Specisifc Custom Javascript File -->
  <script src="<?=base_url()?>assets/user/js/custom.js"></script>

  <script src="<?=base_url()?>assets/user/contactform/contactform.js"></script>

</body>
</html>
