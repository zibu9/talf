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
  <link href="<?=base_url()?>assets/user/img/favicon.ico" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?=base_url()?>assets/user/lib/bootstrap/css/bootstrap.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?=base_url()?>assets/user/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?=base_url()?>assets/user/css/style.css" rel="stylesheet">

</head>

<body>
  <!-- Page Content
    ================================================== -->
  <!-- Header -->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="<?=site_url('article/')?>"><img src="<?=base_url()?>assets/user/img/talf2.png"></a>
      </div>
      <nav>
        <ul class="nav-menu">
          <li><a href="<?=site_url('Accueil/')?>">Accueil</a></li>
      </nav>
      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-whatsapp"></i></a>
      </nav>
    </div>
  </header>
  <!-- #header -->

    <!-- Actu -->
<?php if (count($les_articles)!=0):?>
    <section class="portfolio" id="portfolio">
        <div class="container text-center">
            <h2 class="text-center"> 
                Blog
              </h2>
          </div>
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
<div style="background-color: #edf6ff;">
    <section class="container">
        <nav>
            <ul class="pagination">
               <?php echo $pagination; ?> 
            </ul>
          </nav>
    </section>
  </div>
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
