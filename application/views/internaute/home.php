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

<body>
  <!-- Page Content
    ================================================== -->
  <!-- Hero -->

  <section class="hero">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <a class="hero-brand" href="index.html" title="Home"><img alt="Talf Logo" src="<?=base_url()?>assets/user/img/talf1.png"></a>
        </div>
      </div>

      <div class="col-md-12">
        <h1>
            Talents Feminins
          </h1>

        <p class="tagline">
          Pour Promouvoir les talents des femmes qui nous entourent.
        </p>
        <a class="btn btn-full" href="#about">A propos de nous</a>
      </div>
    </div>

  </section>
  <!-- /Hero -->

  <!-- Header -->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="index.html"><img src="<?=base_url()?>assets/user/img/talf2.png" alt="" title="" /></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Talf</a></h1> -->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="#about">Apropos</a></li>
          <li><a href="<?=site_url('article/')?>">Blog</a></li>
          <li><a href="#features">Objectifs</a></li>
          <li><a href="#team">Equipe</a></li>
          <li><a href="#contact">Contactez nous</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-whatsapp"></i></a>
      </nav>
    </div>
  </header>
  <!-- #header -->

    <!-- Actu -->
<?php if (count($les_articles)!=0):?>
    <section class="portfolio" id="portfolio">
            <h2 class="text-center"> 
          A la Une
        </h2>
      <div class="container">
          <div class="portfolio-grid">
            <div class="row">
                <?php foreach ($les_articles as $a):?>
                  <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="card">
                      <a href="<?=site_url('article/details/'.$a->id, $a->annee, time().rand(1, 2020))?>">
                      <img src="<?=base_url()?>pictures/<?=$a->img_path?>" class="card-img-top"></a>
                      <div class="card-body">
                            <div class="row col-lg-12">
                               <p class="card-text"><?=tronque($a->titre,66)?></p>                              
                            </div>
                            <div class="row col-lg-12">
                                <a href="<?=site_url('article/details/'.$a->id, $a->annee, time().rand(1, 2020))?>" class="bt">Lire plus</a> 
                              </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach ?>
        </div>
      </div>
    </div>
    </section>
  <?php endif; ?>
  <?php foreach ($all as $a):?>
    <!-- /About -->
  <section class="about" id="about">
    <div class="container text-center">
      <h2 class="text-center"> 
          Apropos de Talents feminins
        </h2>
        <?=$a->apropos?>
        
    </div>
  </section>
  <!-- /About -->

  <!-- Features -->

  <section class="features" id="features">
    <div class="container">
      <h2 class="text-center">
          Objectifs
        </h2>
        <?=$a->objectifs?>

  </section>
  <!-- /Features -->
<?php endforeach; ?>
  <!-- Team -->
<?php if (count($equipe)!=0):?>
  <section class="team" id="team">
    <div class="container">
      <h2 class="text-center">
          L'Equipe
        </h2>

      <div class="row">
      <?php foreach ($equipe as $a):?>
        <div class="col-sm-4 col-xs-6">
          <div class="card card-block">
            <a href="#"><img alt="" class="team-img" src="<?=base_url()?>pictures/<?=$a->photo?>">
                <div class="card-title-wrap">
                  <span class="card-title"><?=$a->prenom?> <?=$a->nom?></span> <span class="card-text"><?=$a->grade?></span>
                </div>
  
                <div class="team-over">
                  <h4 class="hidden-md-down">
                    Me suivre sur
                  </h4>
  
                  <nav class="social-nav">
                    <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a>
            </nav>
  

              
            
          </div>
          </a>
        </div>
      </div> 
    <?php endforeach ?>    
    </div>
    </div>
  </section>
<?php endif; ?>
  <!-- /Team -->
  <!-- @component: footer -->

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="section-title">Contactez Nous</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-4 col-md-4">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Boulevard Laurent Désiré Kabila<br>Mbujimayi, RDC</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>info@example.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+243 81 42 75 944</p>
            </div>

          </div>
        </div>

        <div class="col-lg-6 col-md-8">
          <div class="form">
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Votre nom" data-rule="minlen:3" data-msg="entrer un nom correct 3lettres minimum" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre Email" data-rule="email" data-msg="entrer un email valide" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Sujet" data-rule="minlen:4" data-msg="mettez un sujet" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="ecrire votre message" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <!-- <div class="text-center"><button type="submit">Envoyer</button></div> -->
            </form>
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
                <a href="">Accueil</a>
              </li>

              <li class="list-inline-item">
                <a href="#about">Apropos</a>
              </li>

              <li class="list-inline-item">
                <a href="#features">objectis</a>
              </li>

              <li class="list-inline-item">
                <a href="#team">Equipe</a>
              </li>
              <li class="list-inline-item">
                <a href="<?=site_url('journaliste/')?>"><i class="fa fa-edit"></i></a>
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
