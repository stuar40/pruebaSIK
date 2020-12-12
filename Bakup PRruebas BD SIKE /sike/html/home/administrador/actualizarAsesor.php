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
          <form class="form-horizontal" method="post" id="editar_asesor" name="editar_asesor"><!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->
              
            <!-- Step Form Header -->
            <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
              <!-- Step Form Item -->
              <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
               
                <span class="u-shopping-cart-step-form__title">Actualizar datos del Asesor Proveedor</span> <!-- titulo del formulario en texto-->
              </li>
            </ul>
            <!-- End Step Form Header -->

            <!-- Step Form Content -->
            <div id="stepFormContent">
              <!-- Customer Info -->
              <div id="formEditarAsesor" class="active"> <!-- asigna un id al bloque donde estan los campos de nuevo asesor proveedor-->
                
                <!-- Billing Form -->
                <div class="row">
                  <div class="col-md-6">
                    <!-- Input primer bloque donde selecciona el proveedor al cual asignara el asesor que se ingreseara-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">  <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                        Seleccione Proveedor
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                      <select class="custom-select" name="idProveedor" id="idProveedor"> 
                        <option selected="true" disabled="disabled">Seleccione Proveedor</option>                     
                           
                              <?php
                              $sql= "SELECT id, nombre FROM  sike.empresa";
                              $res=mysqli_query($con,$sql);
                              while ($data=mysqli_fetch_row($res))
                                      {
                                        $d1 = $data[0];
                                        $d2 = $data[1];
                              ?>
                                        <option value="<?php echo $d1; ?>"> <?php echo $d2; ?></option>
                              <?php 	} ?>            
                        </select> <!-- se asignan identificadores y detalles al select de proveedores -->

                      </div>
                    </div>
                    <!-- End Input -->
                  </div>

                  <div class="col-md-6">
                    <!-- Input segundo bloque donde se ingresa el nombre del asesor de algun proveedor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el nombre del asesor del proveedor -->
                        Nombre completo del Asesor
                        <span class="text-danger">*</span>
                      </label>
                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="nombreAsesor" id="nombreAsesor"
                               placeholder="Ingrese Nombre Completo"> <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>

            

                  <div class="w-100"></div>
                  
                  <div class="col-md-6">
                    <!-- Input tercer bloque donde se ingresa el telefono del asesor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el numero de telefono del asesor del proveedor -->
                       Telefono
                      <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="telefonoAsesor" id="telefonoAsesor" required
                               placeholder="Ingrese No Telefono"
                               data-msg="Ingrese No Telefono."
                               data-error-class="u-has-error"
                               data-success-class="u-has-success"> <!-- se asignan identificadores y detalles a la caja de texto del numero del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


                  <div class="col-md-6">
                    <!-- Input cuarto bloque donde se ingres al correo del asesor -->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">
                        Correo Electronico
                        <span class="h10 small">(opcional)</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="email" name="correoAsesor" id="correoAsesor"
                               placeholder="Ingrese Correo Electronico del Asesor"><!-- se asignan identificadores, validaciones  y detalles a la caja de texto del correoEelctronico del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


    
                  <div class="w-100"></div>


                  <div class="col-md-6">
                    <!-- Input quinto bloque donde se selecciona el estado del asesor si aun esta activo o inactivo-->
                    <div class="mb-6">
                      <label class="h6 small d-block text-uppercase">
                      Estado de actividad del Asesor
                        <span class="text-danger">*</span>
                      </label>
                        <select class="custom-select" name="estadoAsesor" id="estadoAsesor"> 
                        <option selected="true" disabled="disabled">Seleccione Estado del Asesor</option>                     
                            <option value="1">ACTIVO</option>
                            <option value="0">INACTIVO</option>               
                        </select> <!-- se asignan identificadores y detalles al selector de estado de actividad del asesor de proveedores -->
                      </div>
                    <!-- End Input -->
                  </div>


                  <div class="col-md-6">
                                    <!-- Input tercer bloque donde se ingresa el ID del asesor-->
                                    <div class="js-form-message mb-6">
                                    <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el numero de ID del asesor del proveedor -->
                                    ID
                                    <span class="text-danger">*</span>
                                    </label>

                                    <div class="js-focus-state input-group form">
                                        <input class="form-control form__input" type="text" name="idAsesor" id="idAsesor" required
                                            placeholder=""
                                            data-msg="Ingrese idAsesor."
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success"> <!-- se asignan identificadores y detalles a la caja de texto del numero del idAsesor asesor de proveedores -->
                                    </div>
                                    </div>
                                    <!-- End Input -->
                  </div>
  

                <div class="w-100"></div>
                 
                  
                </div>
                <!-- End Billing Form -->
                <input  type="text" name="action" id="action" value="editar_Asesor" hidden>
                <input  type="text" name="intencion" id="intencion" value="intencion" hidden>
                <!-- Buttons -->
                <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="editarAsesor" value="Editar Asesor" name="editarAsesor"></input>
 

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

  <script type="text/javascript" src="js/jquery.min.js">  </script> 

  <script type="text/javascript" src="js/proveedores.js">  </script>    <!--agrega loa archivos a los que mandara informacion en el js -->

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- ========== FIN DE ARCHIVOS NECESARIOS ========== -->
</body>
</html>
