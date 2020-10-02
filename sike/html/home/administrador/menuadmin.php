


<!DOCTYPE html>

<html lang="es">
<head>
  <!-- Title -->
  <title>SIKE</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../../../favicon.ico">

  <!-- Google Fonts -->
  <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="../../../assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" href="../../../assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="../../../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
  <link rel="stylesheet" href="../../../assets/vendor/custombox/dist/custombox.min.css">
  <link rel="stylesheet" href="../../../assets/vendor/animate.css/animate.min.css">
  <link rel="stylesheet" href="../../../assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="../../../assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="../../../assets/vendor/cubeportfolio/css/cubeportfolio.min.css">

  <!-- CSS Space Template -->
  <link rel="stylesheet" href="../../../assets/css/theme.css">
</head>

<?php
include("enca.php");
if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1
      AND $_SESSION['idrol'] == '1') {

include ("encabezados/administrador.php");
    exit;
        }
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1
        AND $_SESSION['idrol'] == '2') {

  include ("encabezados/gerente.php");
      exit;
          }
          if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1
      AND $_SESSION['idrol'] == '3') {

include ("encabezados/vendedor.php");
    exit;
        }


?>
<body class="responsive-mode">
  <!-- Skippy -->
  <a id="skippy" class="sr-only sr-only-focusable u-skippy" href="#content">
    <div class="container">
      <span class="u-skiplink-text">Skip to main content</span>
    </div>
  </a>
  <!-- End Skippy -->
 <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">

          <!-- Services Content -->
    <div id="servicesSection" class="container space-0 space-4-top--lg space-1-bottom--lg">
      <p class="mb-0"></p>
      <div class="card-deck d-block d-lg-flex card-lg-gutters-1">
  <div class="card card-frame mb-7">
    <!-- Listing -->
    <a class="card-body p-4" href="newuser.php">
      <div class="media">
        <img class="max-width-12 mb-2" src="../../img/add-group.svg" alt="Image Description">
        <div class="media-body px-3">
          <h4 class="h6 text-dark mb-2">Usuarios</h4>
          <p class="mb-0">Nuevo Usuario</p>
        </div>
      </div>
    </a>
    <!-- End Listing -->
  </div>

  <div class="card card-frame mb-7">
    <!-- Listing -->
    <a class="card-body p-4" href="#">
      <div class="media">
        <img class="max-width-12 mb-2" src="../../img/clients-color.svg" alt="Image Description">
        <div class="media-body px-3">
          <h4 class="h6 text-dark mb-1">Clientes</h4>
          <p>Nuevo Cliente</p>
        </div>
      </div>
    </a>
    <!-- End Listing -->
  </div>

  <div class="card card-frame mb-7">
    <!-- Listing -->
    <a class="card-body p-4" href="#">
      <div class="media">
        <img class="max-width-12 mb-2" src="../../img/edificios.svg" alt="Image Description">
        <div class="media-body px-3">
          <h4 class="h6 text-dark mb-1">Empresa</h4>
          <p>Nueva Empresa Proveedora</p>
        </div>
      </div>
    </a>
    <!-- End Listing -->
  </div>


 

</div>
    </div>
    <!-- End Services Content -->

  
    <div id="servicesSection" class="container space-0">
      <div class="card-deck d-block d-lg-flex card-lg-gutters-1">


      <div class="card card-frame mb-7">
    <!-- Listing -->
    <a class="card-body p-4" href="#">
      <div class="media">
        <img class="max-width-12 mb-2" src="../../img/maletin.svg" alt="Image Description">
        <div class="media-body px-3">
          <h4 class="h6 text-dark mb-1">Asesor</h4>
          <p>Nuevo Asesor de Empresa</p>
        </div>
      </div>
    </a>
    <!-- End Listing -->
  </div>


  <div class="card card-frame mb-7">
    <!-- Listing -->
    <a class="card-body p-4" href="#">
      <div class="media">
        <img class="max-width-12 mb-2" src="../../img/telefono-inteligente.svg" alt="Image Description">
        <div class="media-body px-3">
          <h4 class="h6 text-dark mb-1">Saldo</h4>
          <p>Comprar Saldo</p>
        </div>
      </div>
    </a>
    <!-- End Listing -->
  </div>

  <div class="card card-frame mb-7">
    <!-- Listing -->
    <a class="card-body p-4" href="#">
      <div class="media">
        <img class="max-width-12 mb-2" src="../../img/new-product.svg" alt="Image Description">
        <div class="media-body px-3">
          <h4 class="h6 text-dark mb-1">Productos</h4>
          <p>Comprar Productos</p>
        </div>
      </div>
    </a>
    <!-- End Listing -->
  </div>


</div>
    </div>


    <!-- End Specialty Content -->
  </main>
  <!-- ========== END MAIN CONTENT ========== -->





  <!-- ========== ARCHIVOS NECESARIOS PARA EL FUNCIONAMIENTO ========== -->
  <a class="js-go-to u-go-to" href="javascript:;"
    data-position='{"bottom": 15, "right": 15 }'
    data-type="fixed"
    data-offset-top="400"
    data-compensation="#header"
    data-show-effect="slideInUp"
    data-hide-effect="slideOutDown">
    <span class="fa fa-arrow-up u-go-to__inner"></span>
  </a>
  <!-- End Go to Top -->

  <!-- JS Global Compulsory -->
  <script src="../../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../../assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
  <script src="../../../assets/vendor/popper.js/dist/umd/popper.min.js"></script>
  <script src="../../../assets/vendor/bootstrap/bootstrap.min.js"></script>

  <!-- JS Implementing Plugins -->
  <script src="../../../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="../../../assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
  <script src="../../../assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="../../../assets/vendor/custombox/dist/custombox.min.js"></script>
  <script src="../../../assets/vendor/custombox/dist/custombox.legacy.min.js"></script>
  <script src="../../../assets/vendor/slick-carousel/slick/slick.js"></script>
  <script src="../../../assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
  <script src="../../../assets/vendor/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="../../../assets/vendor/player.js/dist/player.min.js"></script>

  <!-- JS Space -->
  <script src="../../../assets/js/hs.core.js"></script>
  <script src="../../../assets/js/components/hs.header.js"></script>
  <script src="../../../assets/js/components/hs.unfold.js"></script>
  <script src="../../../assets/js/components/hs.validation.js"></script>
  <script src="../../../assets/js/helpers/hs.focus-state.js"></script>
  <script src="../../../assets/js/components/hs.malihu-scrollbar.js"></script>
  <script src="../../../assets/js/components/hs.modal-window.js"></script>
  <script src="../../../assets/js/components/hs.show-animation.js"></script>
  <script src="../../../assets/js/components/hs.slick-carousel.js"></script>
  <script src="../../../assets/js/components/hs.cubeportfolio.js"></script>
  <script src="../../../assets/js/components/hs.video-player.js"></script>
  <script src="../../../assets/js/components/hs.go-to.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(window).on('load', function () {
      // initialization of HSMegaMenu component
      $('.js-mega-menu').HSMegaMenu({
        event: 'hover',
        pageContainer: $('.container'),
        breakpoint: 991,
        hideTimeOut: 0
      });
    });

    $(document).on('ready', function () {
      // initialization of header
      $.HSCore.components.HSHeader.init($('#header'));

      // initialization of unfold component
      $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
        afterOpen: function () {
          if (!$('body').hasClass('IE11')) {
            $(this).find('input[type="search"]').focus();
          }
        }
      });

      // initialization of form validation
      $.HSCore.components.HSValidation.init('.js-validate', {
        rules: {
          confirmPassword: {
            equalTo: '#password'
          }
        }
      });

      // initialization of forms
      $.HSCore.helpers.HSFocusState.init();

      // initialization of malihu scrollbar
      $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

      // initialization of autonomous popups
      $.HSCore.components.HSModalWindow.init('[data-modal-target]', '.js-signup-modal', {
        autonomous: true
      });

      // initialization of show animations
      $.HSCore.components.HSShowAnimation.init('.js-animation-link');

      // initialization of slick carousel
      $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

      // initialization of cubeportfolio
      $.HSCore.components.HSCubeportfolio.init('.cbp');

      // initialization of video player
      $.HSCore.components.HSVideoPlayer.init('.js-inline-video-player');

      // initialization of go to
      $.HSCore.components.HSGoTo.init('.js-go-to');
    });

  </script>
  <!-- ========== FIN DE ARCHIVOS NECESARIOS ========== -->
</body>
</html>
