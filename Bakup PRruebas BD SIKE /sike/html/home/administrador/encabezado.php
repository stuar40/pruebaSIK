
<!DOCTYPE html>

<html lang="en">
<html lang="en">
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

  <!-- ========== HEADER ========== -->
  <header id="header" class="u-header u-header--modern u-header--bordered u-header--sticky-top-lg responsive-mode">
    <div class="u-header__section responsive-mode">
      <div id="logoAndNav" class="container-fluid">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-lg responsive-mode u-header__navbar">
          <!-- Logo -->
          <div class="u-header__navbar-brand-wrapper responsive-mode">
            <a class="navbar-brand u-header__navbar-brand"  aria-label="Space">
              <img class="u-header__navbar-brand-default" src="../../img/kairos.png" >
            </a>
          </div>
          <!-- End Logo -->

    
          <!-- Navigation -->
          <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse py-0">
            <ul class="navbar-nav u-header__navbar-nav">
              <!-- Home -->
              <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="homeMegaMenu" class="nav-link u-header__nav-link" href="../../home/menuprincipal.php" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="homeSubMenu">
                  Inicio                 
                </a>
              </li>
           

         <!-- Usuarios -->
              <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Usuarios
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Usuarios - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/user.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Nuevo Usuario</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/setting.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuración</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Usuarios -->
              

         <!-- Proveedores -->
         <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Proveedores
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

         

                <!-- Proveedores - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item hs-has-sub-menu">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" 
                    aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuHomeClassic">
                       <img class="max-width-5 mr-3" src="../../img/provider.svg" alt="Image Description">
                       Nuevo Proveedor 
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                     
                    </a>
                    <ul id="navSubmenuHomeClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkHomeClassic">
                        <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/warehouse.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Empresa</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                      <li class="dropdown-item u-header__sub-menu-list-item">
                        <a class="nav-link u-header__sub-menu-nav-link" href="classic-agency.html">Agency</a>
                      </li>
                      <li class="dropdown-item u-header__sub-menu-list-item">
                        <a class="nav-link u-header__sub-menu-nav-link" href="classic-business.html">Business</a>
                      </li>
                      <li class="dropdown-item u-header__sub-menu-list-item">
                        <a class="nav-link u-header__sub-menu-nav-link" href="classic-start-up.html">Start-Up</a>
                      </li>
                    </ul>
                  </li>

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/house-repair.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuración</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Proveedores -->
              


         <!-- Clientes -->
         <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Clientes
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Clientes - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Crear Cliente</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/customer.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado de Clientes</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Clientes -->
              



         <!-- Productos -->
         <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Productos
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Productos - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Crear Cliente</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/customer.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado de Clientes</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Productos -->


                 <!-- Compras -->
         <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Compras
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Compras - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Crear Cliente</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/customer.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado de Clientes</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Compras -->

              <!-- Ventas -->
                <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Ventas
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Ventas - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Crear Cliente</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/customer.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado de Clientes</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Ventas -->


                 <!-- Egresos -->
         <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Egresos
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Egresos - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Crear Cliente</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/customer.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado de Clientes</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Egresos -->




                 <!-- Reportes -->
         <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="docsMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Reportes
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Reportes - Submenu -->
                <ul id="docsSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="docsMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../home/usuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Crear Cliente</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="../../home/nusuarios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../images/menupanaderia/customer.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado de Clientes</span>
                        </div>  
                      </div>
                    </a>
                  </li>
                  
                </ul>
              </li>
                <!-- End Reportes -->





              <li class="nav-item u-header__navbar-icon u-header__navbar-v-divider">
           

              <!-- Button -->
              <li class="nav-item u-header__nav-item-btn">
                <a class="btn btn-sm btn-outline-dark btn-xs" href="../../home/login/logout.php " role="button">
                  <span class="fa fa-sign-out-alt mr-1"></span>
                  Abandonar
                </a>
              </li>
              </li>
              <!-- End Button -->

            </ul>
          </div>
          <!-- End Navigation -->

       
        </nav>
        <!-- End Nav -->
      </div>
    </div>
  </header>
  <!-- ========== END HEADER ========== -->



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