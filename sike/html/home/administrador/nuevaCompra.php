<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
session_start();
include("enca.php");

// consulta para llenar tabla 
$query_select = mysqli_query($con,"SELECT p.id,p.nombre,p.descripcion,p.presentacion,p.marca,c.nombre as categoria,s.nombre as subcategoria, e.estado FROM producto p
INNER JOIN subcategoria s ON p.subcategoria_id = s.id
INNER JOIN categoria c ON c.id = s.categoria_id
INNER JOIN estado_prod e ON e.id = p.estado_prod_id ORDER BY id DESC");
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
               
                <span class="u-shopping-cart-step-form__title">Administración de Productos</span>
                <input type="text" value="<?php echo $_SESSION['user_id'] ?>" hidden>
          
              </li>
            </ul>
            <!-- End Step Form Header -->

            <!-- Step Form Content -->
            <div id="stepFormContent">
              <!-- Customer Info -->
              <div id="newuser" class="active">
                
                <!-- Billing Form -->
              <div class="row">


<!-- Label Iniciales -->

<div class="col-md-4">
                    <!-- Input -->
                    <div class="js-form-message mb-3">
                      <label class="h6 small d-block text-uppercase">
                        NUMERO DE FACTURA
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="nfactura" id="nfactura" required
                             
                               aria-label="00000"
                               data-msg="Por favor ingrese factura."
                               data-error-class="u-has-error"
                               data-success-class="u-has-success">
                      </div>

                      
                    </div>
                    <!-- End Input -->
                  </div>

                <div class="col-md-4">
                  <div class="mb-3">
                     <label class="h6 small d-block text-uppercase">
                       PROVEEDOR
                       <span class="text-danger">*</span>
                     </label>
                 <select class="custom-select" name="proveedor" id="proveedor">
<option value="" selected ="selected" disabled ="disabled">Seleccione Proveedor</option>
                 <?php

		$sql= "SELECT * FROM empresa";
		$res=mysqli_query($con,$sql);
			while ($data=mysqli_fetch_row($res))
										{

                    $d1 = $data[0];
                    $d2 = $data[1];
										
?>
<option value="<?php echo $d1; ?>"> <?php echo ($d2); ?></option>
<?php
										}
												?>

</select>
                     </div>
                  </div> 
      
                  <div class="col-md-4">
                  <div class="mb-3">
                     <label class="h6 small d-block text-uppercase">
                       SUCURSAL
                       <span class="text-danger">*</span>
                     </label>
                 <select class="custom-select" name="sucursal" id="sucursal" onchange="sucursal()">
                   <option selected="selected" disabled= "disabled">Seleccione Sucursal</option>

                 <?php

		$sql= "SELECT * FROM sucursal";
		$res=mysqli_query($con,$sql);
			while ($data=mysqli_fetch_row($res))
										{

                    $d0 = $data[0];
                    $d1 = $data[1];
                    $d2 = $data[2];
                
										
?>
<option value="<?php echo $d0; ?>"> <?php echo ($d1); echo "- " ; echo ($d2);   ?></option>
<?php
										}
												?>

</select>
                     </div>
                     <div id="acciones_compra">
                    <a href="#" class="btn btn-danger btn-xs text-center" id="btn_anular_compra"> <i class="fa fa-eraser"></i> Anular</a>
                    <a href="#" class="btn btn-success btn-xs text-center" id="btn_procesar_compra" style="display: none;"><i class="fa fa-check"></i> Procesar</a>
 </div>
                  </div> 


                  <input type="text" name="idsucursal" id="idsucursal" hidden>

<!--Fin de la tabla de productos -->





<!--Inicio tabla primaria-->
<div id="myTabContent" class="tab-content-center d-flex justify-content-center table-responsive-sm">
    <table  class="table table-striped table-borderless table-responsive-sm mb-0 justify-center " id="myTabContent">
    <thead>
        
        <tr>
            <th colspan="6" class="text-center">Codigo del Producto</th>
            <th colspan="14" class="text-center">Descripcion</th>
            <th colspan="1" class="text-center">Cantidad</th>
            <th colspan="2" class="text-center">Precio</th>
            <th width="75px" class="text-center">SubTotal</th>
            <th width="100px" class="text-center">Accion</th>
        </tr>
        <tr>
            <td class="text-center" colspan="6" >
              

                    <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="txt_insumo" id="txt_insumo" required>
                        <input class="form-control form__input" type="text" name="txt_idproducto" id="txt_idproducto" hidden >
                              
                      </div>

 </td>
            
 <td class="text-center" colspan="14" >
              

                    <div class="js-focus-state input-group form">
                        <input class="form-control " type="text" name="txt_descripcion" id="txt_descripcion" disabled
                           >
                              
                      </div>

 </td>

            <td class="text-center" colspan="1" >
              
            <div class="js-focus-state input-group form" >
            <input class="form-control form__input"  type="text" name="txt_cantidad" id="txt_cantidad" value="0" nin="1" disabled
        >
            </div>
          
          </td>
            <td class="text-center" colspan="2" >
            <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="number" step="0.01" name="txt_precio" id="txt_precio" 
                     
                       disabled  >
                               
                      </div>
          
          
          
          </td>
            <td  id="txt_precio_total" class="text-center">Q 0.00 </td>
            <td ><a href="#" id="add_product_compra" class="link_add"> <i class="fas fa-plus"></i> Agregar</a> </td>
        </tr>
        <tr>
            <th  colspan="4" class="text-center">#</th>
            <th colspan="4" class="text-center">Nombre</th>
            <th colspan="4" class="text-center">Descripcion</th>
            <th colspan="4" class="text-center">Presentacion</th>
            <th colspan="4" class="text-center">Marca</th>
            <th class="text-center">Cantidad</th>
            <th  class="text-center">Precio</th>
            <th width="75px" class="text-center">SubTotal</th>
            <th width="100px" class="text-center">Accion</th>
        </tr>
    </thead>
 <!-- desde ajax tabla detale producto -->

<tbody id="detalle_compra">


    
</tbody>




    <tfoot id="detalle_totales"> 
      

    </tfoot>


    </table>
    </div>



<!--Fin de tabla primaria -->

<!--Tabal de productos2 -->









          



              <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >
					

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
        </div>
  </div>
  </main>

  
  <!-- ========== END MAIN CONTENT ========== -->

  <!-- ========== LLama a ventanas Modales ========== -->
        <?php
             include("modal/editar_Productos.php") ; // modal que permite Guardar el usuario
            // include("modal/modalAsesorAsociado.php") ;
        
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

  <script type="text/javascript" src="js/jquery.min.js">  </script> 
  <script type="text/javascript" src="js/jquery-ui.js">  </script> 
  <script type="text/javascript" src="js/jquery-ui.css">  </script>
  <script type="text/javascript" src="js/productos.js">  </script> 
   <script type="text/javascript" src="js/compras.js">  </script> 
   <script type="text/javascript" src="js/searchinsumo.js">  </script> 

  <!-- JS Global Compulsory -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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


$(document).ready(function(){
 
 var usuarioid = "<?php echo $_SESSION['user_id'];?>";
 $('#idven').val(usuarioid);
 
       serchForDetalle(usuarioid);

});

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
  <script src="js/bootstrap-validate.js"></script>
  <!-- <script src="js/validar.js"></script> -->
  <script>
  bootstrapValidate('#nfactura','numeric:Este campo solo acepta numeros')
  bootstrapValidate('#txt_insumo','alphanum:Ingrese el código correcto')
  bootstrapValidate('#txt_cantidad','numeric:Ingrese una cantidad correcta')
  bootstrapValidate('#txt_precio','numeric:Ingrese una precio correcto')
  // TODO: Buscar Regex para Telefono 
  </script>
</body>
</html>
