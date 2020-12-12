<?php
require_once("../config/db.php"); // llama las variables de la BD
require_once("../config/conexion.php"); // genera la conexion de la BD 

include("enca.php"); // llama al encabezado de la pagina NavBar
?>

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


<body class="responsive-mode">
  <!-- Skippy -->
  <a id="skippy" class="sr-only sr-only-focusable u-skippy" href="#content">
    <div class="container">
      <span class="u-skiplink-text">Skip to main content</span>
    </div>
  </a>
  <!-- End Skippy -->
  <!-- ========== MAIN CONTENT contenido principal del formulario nueva empresa ========== -->
  <main id="content" role="main">
    <div class="container space-2 space-3-top--lg space-2-bottom--lg">
      <div class="row">
        <div class="col-lg-2 order-lg-3 mb-10 mb-lg-2">
        </div>
      </div>

      <div class="col-lg-12 order-lg-1">
        <!-- Checkout Form -->
        <form class="form-horizontal js-validate" method="post" id="guardar_producto" name="guardar_producto">
          <!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->

          <!-- Step Form Header -->
          <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
            <!-- Step Form Item -->
            <li class="list-inline-item u-shopping-cart-step-form__item mb-3">

              <span class="u-shopping-cart-step-form__title">Nuevo Cliente </span> <!-- titulo del formulario en texto-->
            </li>
          </ul>
          <!-- End Step Form Header -->

          <!-- Step Form Content -->
          <div id="stepFormContent">
            <!-- Customer Info -->
            <div id="newproveedor" class="active">
              <!-- asigna un id al bloque donde estan los campos de nuevo proveedor-->


              <!-- Billing Form -->
              <div class="row">
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Nombres
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="nombresCliente" id="nombresCliente" required 
                      placeholder="Ingrese Nombre(s) del Cliente"
                      data-msg-minlength="Los nombres deben contener al menos 2 letras"
                      data-msg-maxlength="Los nombres no deben contener más de 50 letras"
                      data-msg="Por favor ingrese los nombres del cliente." 
                      data-error-class="u-has-error"
                      data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Apellidos
                      <span class="text-danger">*</span>
                    </label>
                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="apellidosCliente" id="apellidosCliente"required
                       placeholder="Ingrese apellido(s) del Cliente"
                       data-rule-required="true"
                      minlength="2"
                      maxlength="50"
                      data-msg-minlength="Los apellidos deben contener al menos 2 letras"
                      data-msg-maxlength="Los apellidos no deben contener más de 50 letras"
                      data-msg="Por favor ingrese los apellidos del cliente." 
                      data-error-class="u-has-error" 
                      data-success-class="u-has-success"
                       >
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      NIT
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="nitCliente" id="nitCliente" required placeholder="Ingrese NIT del Cliente"
                      data-rule-required="true"
                      minlength="3"
                      maxlength="13"
                       data-msg="Por favor ingrese un NIT válido" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Telefono
                      <span class="h10 small">(opcional)</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="telefonoCliente" id="telefonoCliente"
                       placeholder="Ingrese Telefono o Celular del Cliente"
                      minlength="8"
                      maxlength="8"
                      data-msg-minlength="El número debe contener al menos 8 digitos"
                      data-msg-maxlength="El número no debe contener más de 8 digitos">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Dirección
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="direccionCliente" id="direccionCliente" required 
                      placeholder="Ingrese dirección del Cliente" 
                      data-rule-required="true"
                      minlength="6"
                      maxlength="40"
                      data-msg="Por favor ingrese una dirección válida" 
                      data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Correo
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" name="emailCliente" id="emailCliente" type="email"
                      placeholder="Ingrese Email del Cliente" 
                      data-rule-email="true"
                      data-msg-email="Por favor ingrese un email válido" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="w-100"></div>
                <div class="w-100"></div>
                <div class="w-100"></div>
              </div>
              <!-- End Billing Form -->
              <input type="text" name="action" id="action" value="insertar2" hidden>

              <!-- Buttons -->
              <div class="d-sm-flex justify-content-sm-center align-items-sm-center">


                <input type="submit" class="btn btn-success text-center" data-next-step="agregar" value="Agregar" name="insertar"></input>


        </form>
        <!-- End Checkout Form -->
      </div>
    </div>
  </main>
  <!-- ========== END MAIN CONTENT ========== -->




  <!-- ========== ARCHIVOS NECESARIOS PARA EL FUNCIONAMIENTO ========== -->
  <a class="js-go-to u-go-to" href="javascript:;" data-position='{"bottom": 15, "right": 15 }' data-type="fixed" data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
    <span class="fa fa-arrow-up u-go-to__inner"></span>
  </a>
  <!-- End Go to Top -->

  <!-- Aqui se llaman a los archivos jquery con la funcion ready para poder ejecutar los archivos ajax  -->
  <script type="text/javascript" src="js/jquery.min.js"> </script>
  <script type="text/javascript" src="js/client.js"> </script>




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
  <!-- Libreria DataTables para talbas -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css" />
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>




  <!-- JS Plugins Init. -->
  <script>
    $(window).on('load', function() {
      // initialization of HSMegaMenu component
      $('.js-mega-menu').HSMegaMenu({
        event: 'hover',
        pageContainer: $('.container'),
        breakpoint: 991,
        hideTimeOut: 0
      });
    });

    $(document).on('ready', function() {

      // initialization of header
      $.HSCore.components.HSHeader.init($('#header'));

      // initialization of unfold component
      $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
        afterOpen: function() {
          if (!$('body').hasClass('IE11')) {
            $(this).find('input[type="search"]').focus();
          }
        }
      });

      // initialization of form validation
      $.HSCore.components.HSValidation.init('.js-validate', {
        rules: {
          nombresCliente: {
            equalTo: '#apellidoCliente'
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- ========== FIN DE ARCHIVOS NECESARIOS ========== -->
  <script src="js/bootstrap-validate.js"></script>
  <!-- <script src="js/validar.js"></script>  -->

</body>

</html>