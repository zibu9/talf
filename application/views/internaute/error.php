
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>404 Page Not Found</title>
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
          <li><a href="<?=site_url('article/')?>">Blog</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-whatsapp"></i></a>
      </nav>
    </div>
  </header>

  <div>

    <div class="container text-center error">
                <h1 class="mb-0" style="color: #199EB8;">Erreur</h1>
               <span class="text-center mt-0">4<span style="color: #E04F00;">0</span>4</span> 
               <h2 class="text-center">
                    La page que vous cherchez n'existe pas elle est soit déplacée, supprimée,
                    renomée ou peut être n'a jamais existé.  <br><a class="btn btn-full" href="<?=site_url('accueil/')?>">Accueil</a>
               </h2>
    </div>
    </div>
    <style>
        .error span {
            color:  #199EB8;
            font-size: 220px;
            font-weight: 900;
        }
    </style>
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
