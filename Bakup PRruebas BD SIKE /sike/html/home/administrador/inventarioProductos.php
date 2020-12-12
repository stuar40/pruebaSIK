<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

include("enca.php");

// consultas
$query_select = mysqli_query($con,"select id,sku,nombre,marca from producto WHERE id NOT IN (SELECT producto_idproducto FROM precios WHERE sucursal_idsucursal = 1 )");
$num_rows = mysqli_num_rows($query_select);

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

<!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main">
  <div class="container space-2 space-3-top--lg space-2-bottom--lg">
      <div class="row">
        <div class="col-lg-2 order-lg-3 mb-10 mb-lg-2">
          </div>
        </div>

        <div class="col-lg-12 order-lg-1">
          <!-- Checkout Form -->

              
            <!-- Step Form Header -->
            <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
              <!-- Step Form Item -->
              <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
               
                <span class="u-shopping-cart-step-form__title">Inventario de Precio de Productos</span>
              </li>
            </ul>
            <!-- End Step Form Header -->

            <!-- Step Form Content -->
            <div id="stepFormContent">
              <!-- Customer Info -->
              <div id="newuser" class="active">
                
                <!-- Billing Form -->
              <div class="row">

              <div class="col-md-6">
                    <!-- Input primer bloque donde selecciona el proveedor al cual asignara el asesor que se ingreseara-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">  <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                        Inventario de Productos por Sucursal
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                      <select class="custom-select" name="SeleccionSucursalAsignar" id="SeleccionSucursalAsignar" > 
                        <option selected="true" disabled="disabled" >Seleccione la Sucursal</option>                     
                           
                              <?php
                              $sql= "SELECT id,numero,direccion FROM sucursal";
                              $res=mysqli_query($con,$sql);
                              while ($data=mysqli_fetch_row($res))
                                      {
                                        $idSucursal = $data[0];
                                        $numeroSucursal = $data[1];
                                        $direccionSucursal = $data[2];
                              ?>
                                        <option value="<?php echo $idSucursal; ?>"> <?php echo $numeroSucursal.' '.$direccionSucursal; ?></option>
                              <?php 	} ?>            
                      </select> <!-- se asignan identificadores y detalles al select de proveedores -->

                      </div>
                    </div>
                    <!-- End Input -->
                  </div>  <!-- fin del div col 6-->

                  <div class="col-md-6">
                    <!-- Input segundo bloque donde se ingresa el nombre del asesor de algun proveedor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el nombre del asesor del proveedor -->
                        Sucursal Seleccionada
                        <span class="text-danger">*</span>
                      </label>
                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" disabled="disabled" name="nombreSucursalSinAsignar" id="nombreSucursalSinAsignar" required
                               placeholder="Sucursal"
                               data-msg="Sucursal Seleccionada."
                               minlength="1" maxlength="150"
                               title="Sucursal Tamaño máximo: 150 Caracteres"
                               data-error-class="u-has-error"
                               data-success-class="u-has-success">   <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div><!-- fin del div col 6-->




                  <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >
					
                    <table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaRecargaInventario">
                        <thead >
                            <tr class="bgcolor btn-facebook">									
                              
                            
                                <th class="text-center">Empresa</th>
                                <th class="text-center">Saldo Disponible</th>
                                
                              
                            </tr>
                        </thead>
                        
                        <tbody> 
                              
                        </tbody>
                                              
                    </table>
                  </div>

                


          



              <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >
					
                    <table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaProductosSinAsignar">
                        <thead >
                            <tr class="bgcolor btn-facebook">									
                               
                                <th class="text-center">ID</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">descripcion</th>
                                <th class="text-center">Presentacion</th>
                                <th class="text-center">Marca</th>
                                <th class="text-center">Existencia</th>
                                <th class="text-center">Acciones</th>
                               
                            </tr>
                        </thead>
                        
                        <tbody> 
                              
                        </tbody>
                                              
                    </table>
              </div>


                <section class="d-flex justify-content-center responsive-mode" >
                    
	
		<div class="d-flex justify-content-center "  >
			<div class="page-header justify-center">
              <h1 class="text-content"><i class="card navicon"></i>  <small></small></h1>
              
              
			</div>
			</div>
      
      <div class="container-fluid ">
			<div class="row">
				<div class="container ">

       
        
  
        </div>
        
      </div>
      
			</div>
	</section>

  
                  
                </div>
            


          <!-- End Checkout Form -->
        </div>
      </div>
  </main>
  
  
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- ========== LLama a ventanas Modales ========== -->
        <?php
             include("modal/modalInventarioProductos.php") ; // modal que permite Guardar el usuario
        ?>
        


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

  <!-- Importar archivos JS que se utilizar  -->
  <script type="text/javascript" src="js/jquery.min.js">  </script> 
  <script type="text/javascript" src="js/inventarioProductos.js">  </script> 

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
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
 
<!-- End Skippy -->
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
