<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
session_start();
include("enca.php");


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
  <div class="container space-0 space-3-top--lg space-0-bottom--lg">
      <div class="row">
        <div class="col-lg-3 order-lg-2 mb-8 mb-lg-0">
          </div>
        </div>

        <div class="col-lg-12 order-lg-2">
          <!-- Checkout Form -->






          <!-- Inicio del formulario inicial-->


          <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
              <!-- Step Form Item -->
              <li class="list-inline-item u-shopping-cart-step-form__item mb-5">
            
              <h1"><i text-center class="text text-black"></i> NUEVA VENTA </h1>            
        <input type="text" value="<?php  echo $_SESSION['user_id']?>"  hidden>
        <input type="text"  id="sucursal_id" name="sucursal_id" value="<?php  echo $_SESSION['sucursal_id']?>" hidden >

              </li>
            </ul>
		</div>
		<div class="panel-body">
    <?php
	//		include ("modal/buscar_productos.php");
	
		?>
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
       
                      <!--  <input type="text" class="form-control input-sm select2-container--bootstrap4" value="<?php echo $_SESSION['user_name']?>" disabled hidden> -->


						
              <input type="text" class="form-control input-sm" id="idven" name="idven" hidden >
              
               
        
            <div class="col-md-5">
        <div class="js-form-message mb-6 ">
                      <label class="h6 small d-block text-uppercase">
                        Cliente
                        </label>
					  <input type="text" class="form-control input-sm"  id="nombre_cliente" placeholder="Selecciona un cliente" required>
					  <input id="id_cliente"  name="idcliente"  hidden>
          </div>
            </div>

        <div class="col-md-3">
        <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">
                        Fecha
                        </label>
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
              </div>
        </div>

        

        <div class="col-md-4">
        <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">
                        NIT
                        </label>
								<input type="text" class="form-control input-sm" id="nit" placeholder="Nit" readonly>
							</div>
        </div>
        
        <div class="col-md-8">
        <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">
                        Direccion
                        </label>
								<input type="text" class="form-control input-sm" id="direccion" placeholder="Direccion" readonly>
              </div>
        </div>
					
         </div>
         
         <!-- Dato que ayuda a identificar el valor que tendra el producto  asignado a idPrecio-->
					
					<input type="text" name="idPrecio" id="idPrecio" hidden>
						
<!-- Modulos modificados para agregar
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal"  id="btn_productosf" onclick=" fntproductosf()">
             <span class="glyphicon glyphicon-search"></span> Agregar productos

            </button>
                
          
           
						  <span class="glyphicon glyphicon-print"></span> Imprimir
            </button>
                  -->


                      <label class="h6 small d-block text-uppercase">
                        Acciones
                      
            <div id="acciones_compra" >
                    <a href="#" class="btn btn-danger btn-xs text-center" id="btn_anular_venta"> <i class="fa fa-eraser"></i> Anular</a>
                    <a href="#" class="btn btn-success btn-xs text-center" id="btn_procesar_venta" style="display: none;"><i class="fa fa-check"></i> Procesar</a>
 </div>
 </label>
				
		
			</form>
		

<!--Inicio tabla primaria-->
<div id="myTabContent" class="tab-content-center d-flex justify-content-center table-responsive-md">
    <table  class="table table-striped table-borderless table-responsive-md mb-0 justify-center " id="myTabContent" >
    <thead>
        
        <tr>
            <th colspan="6" class="text-center">Codigo del Producto</th>
            <th colspan="4" class="text-center">Existencia</th>
            <th colspan="10" class="text-center">Descripcion</th>
            <th colspan="1" class="text-center">Cantidad</th>
            <th colspan="2" class="text-center">Precio</th>
            <th width="75px" class="text-center">SubTotal</th>
            <th width="100px" class="text-center">Accion</th>
        </tr>
        <tr>
            <td class="text-center" colspan="6" >
              

                    <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="txt_insumo" id="txt_insumo" required>
                        <input class="form-control form__input" type="text" name="txt_idproducto" id="txt_idproducto" hidden>
                              
                      </div>

 </td>

 <td class="text-center" colspan="4" >
              

              <div class="js-focus-state input-group form">
                  <input class="form-control " type="text" name="txt_existencia" id="txt_existencia" disabled
                     >
                        
                </div>

</td>
            
 <td class="text-center" colspan="10" >
              

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
            <div class="col-md-12">
                  <div class="mb-12">
               
                 <select class="custom-select" name="precios" id="precios" disabled>

<option value="1" id="p_venta" >Venta</option>
<option value="2" id="p_promocion" >Promocion</option>
<option value="3" id="p_minimo">Minimo</option>



</select>
                     </div>
                  </div> 
                      
                               
                      </div>
          
               
          </td>


    



            <td  id="txt_precio_total" class="textright"> 0.00 </td>
            <td ><a href="#" id="add_product_venta" class="link_add" > <i class="fas fa-plus"></i> Agregar</a> </td>
        </tr>
        <tr>
            <th  colspan="4" class="text-center">#</th>
            <th colspan="4" class="text-center">Nombre</th>
            <th colspan="4" class="text-center">Descripcion</th>
            <th colspan="4" class="text-center">Presentacion</th>
            <th colspan="4" class="text-center">Marca</th>
            <th class="text-center">Cantidad</th>
            <th  class="text-center" width="100px">Precio</th>
            <th width="200px" class="text-center">SubTotal</th>
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
					

         


                <section class="d-flex justify-content-center responsive-mode" >
                    
	
		<div class="d-flex justify-content-center "  >
			<div class="page-header justify-center">
              <h1 class="text-content"><i class="card navicon"></i>  <small></small></h1>
              
              
			</div>
			</div>
      

	</section>

    </div>
                  
                </div>
            
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
        //     include("modal/editar_Productos.php") ; // modal que permite Guardar el usuario
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
  <script type="text/javascript" src="js/ventas.js">  </script> 
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
  
</body>
</html>
