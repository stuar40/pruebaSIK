<?php 
require_once ("../config/db.php"); // llama las variables de la BD
require_once ("../config/conexion.php"); // genera la conexion de la BD 

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
          <form class="form-horizontal" method="post" id="Formguardar_Proveedor" name="Formguardar_Proveedor">  <!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->
              
            <!-- Step Form Header -->
            <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
              <!-- Step Form Item -->
              <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
               
                <span class="u-shopping-cart-step-form__title">Nuevo Proveedor</span>  <!-- titulo del formulario en texto-->
              </li>
            </ul>
            <!-- End Step Form Header -->

            <!-- Step Form Content -->
            <div id="stepFormContent">
              <!-- Customer Info -->
              <div id="newproveedor" class="active">  <!-- asigna un id al bloque donde estan los campos de nuevo proveedor-->
                
                <!-- Billing Form -->
                <div class="row">
                  
                  <div class="col-md-6">
                    <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                        Nombre Comercial
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="nombreComercial" id="nombreComercial" required 
                               placeholder="Ingrese Nombre Comercial del proveedor"
                               data-msg="Ingrese Nombre Comercial."
                               minlength="1" maxlength="99"
                               data-error-class="u-has-error"
                               data-success-class="u-has-success">     <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                      </div> 
                    </div>
                    <!-- End Input -->
                  </div>

                  <div class="col-md-6">
                    <!-- Input 2 segundo bloque ingreso de NIT del proveedor -->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el NIT comercial del proveedor -->
                      NIT del Proveedor
                      <span class="text-danger">*</span>
                      </label>
                      <div class="js-focus-state input-group form">
                        <input  class="form-control form__input" type="text" name="proveedorNIT" id="proveedorNIT" required
                                minlength="8" maxlength="9"
                                pattern="[0-9]{8,12}"  title="Numero de NIT (Sin Guion) Tamaño mínimo: 8. Tamaño máximo: 12"
                                placeholder="Ingrese NIT del proveedor"> <!-- se asignan identificadores y detalles al campo de texto del NIT  comercial del proveedor -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>

            

                  <div class="w-100"></div>
                  
                  <div class="col-md-6">
                    <!-- Input3 bloque de ingreso de direccion del proveedor -->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la direccion comercial del proveedor -->
                        Direccion Comercial
                        <span class="h10 small">(opcional)</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="proveedorDireccion" id="proveedorDireccion" 
                               placeholder="Ingrese Direccion comercial del proveedor"
                               data-msg="Por favor ingrese la direccion"
                               title="Direccion del Proveedor"
                               minlength="1" maxlength="150"
                               data-error-class="u-has-error"
                               data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


                  <div class="col-md-6">
                    <!-- Input bloque de ingreso de numero de telefono del proveedor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa el numero del proveedor -->
                        Telefono del Proveedor
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input  class="form-control form__input" type="num" name="telefonoProveedor" id="telefonoProveedor" required
                                minlength="3" maxlength="12"
                                pattern="[0-9]{3,12}"  title="Telefono solo numeros. Tamaño mínimo: 3 máximo: 12"
                                placeholder="Ingrese No. de Telefono"> <!-- se asignan identificadores y detalles al campo de texto del No telefono del proveedor -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


    
                  <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->

                  <div class="col-md-12">   <!--Bloque de Columna son 2 columnas por fila -->
                    <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                        Descripcion
                      </label>

                      <div class="js-focus-state input-group form">
                        <textarea class="form-control form__input" type="text" name="descripcionProveedor" id="descripcionProveedor" 
                               placeholder="ingrese una descripcion del Proveedor"
                               data-msg="ingrese una descripcion del Proveedor."
                               maxlength="150"
                               pattern="[0-9]{0,150}"  title="Descripcion. Texto máximo: 150"
                               data-error-class="u-has-error"
                               data-success-class="u-has-success"></textarea> <!-- se asignan identificadores y detalles al campo de texto de la descripcion del proveedor -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>

                  <div class="col-md-6">
                    <!-- Input -->
                    
                    <!-- End Input -->
                  </div>



                  <div class="w-100"></div>
                
                <div class="w-100"></div>
                    
                </div>
                <!-- End Billing Form -->
                <input  type="text" name="action" id="action" value="agregar_Proveedor" hidden>
                <input  type="text" name="intencion" id="intencion" value="intencion" hidden>
                <!-- Buttons -->
                <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="agregar" value="Agregar" name="insertar"></input>
 

          </form>
          <!-- End Checkout Form -->
        </div>
      </div>
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

  <!-- Aqui se llaman a los archivos jquery con la funcion ready para poder ejecutar los archivos ajax  -->
  <script type="text/javascript" src="js/jquery.min.js">  </script> 
   <script type="text/javascript" src="js/usuarios.js">  </script> 
   <script type="text/javascript" src="js/proveedores.js">  </script> 

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
  
  <!-- Libreria DataTables para talbas -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
  
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
 
  
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- ========== FIN DE ARCHIVOS NECESARIOS ========== -->
</body>
</html>
