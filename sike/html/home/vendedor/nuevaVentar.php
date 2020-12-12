<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
session_start();
include("encabezado.php");
$usuario = $_SESSION['user_id'];

// consulta para llenar tabla 
$query_select = mysqli_query($con,"SELECT v.idventarecarga,v.fecha,v.status,v.totalventa,v.descripcion,v.factura,u.nombre_usuario,CONCAT(s.numero,' ',s.direccion) AS sucursal,
v.numero, v.empresa FROM ventarecarga v
INNER JOIN usuarios u ON v.usuarios_idusuarios = u.id
INNER JOIN sucursal s ON v.sucursal_idsucursal = s.id 
WHERE u.id = $usuario");
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
               
                <span class="u-shopping-cart-step-form__title">Nueva Recarga</span>
                <input type="text" value="<?php echo $_SESSION['user_id'] ?>" hidden>
                <input type="text" value="<?php echo $_SESSION['sucursal_id'] ?>" hidden>
              </li>
            </ul>
            <!-- End Step Form Header -->

            <!-- Step Form Content -->
            <div id="stepFormContent">
              <!-- Customer Info -->
              <div id="newuser" class="active">
                
<form action="#"  id="form_comprar" name="form_comprar" method="POST">
                <!-- Billing Form -->
              <div class="row">


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
                       Empresa
                       <span class="text-danger">*</span>
                     </label>
                 <select class="custom-select" name="empresa" id="empresa"  >
<option value="" selected ="selected" disabled ="disabled">Seleccione Empresa</option>
                 <?php

		$sql= "SELECT empresa.id,empresa.nombre FROM recarga INNER JOIN  empresa ON recarga.empresa_id = empresa.id ";
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
                      TIPO DE RECARGA
                       <span class="text-danger">*</span>
                     </label>
                 <select class="custom-select" name="trecarga" id="trecarga" >
                   <option selected="selected" disabled= "disabled">Tipo de recarga </option>

    <option value="Saldo">Saldo</option>
    <option value="Internet">Internet
    <option value="Mensajes">Mensajes</option>
    <option value="Redes Sociales">Redes Sociales</option>
    </option>


</select>
                     </div>
                     </div> 

            


                 

            

                  <div class="w-100"></div>

                  <div class="col-md-3">
                    <!-- Input -->
                    <div class="js-form-message mb-3">
                      <label class="h6 small d-block text-uppercase">
                        MONTO
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="monto" id="monto" required
                             
                               aria-label="00000"
                               data-msg="Por favor ingrese ingrese monto."
                               data-error-class="u-has-error"
                               data-success-class="u-has-success">
                      </div>

                      
                    </div>
                    <!-- End Input -->
                  </div>


                  <div class="col-md-3">
                    <!-- Input -->
                    <div class="js-form-message mb-3">
                      <label class="h6 small d-block text-uppercase">
                        NÚMERO DE TELEFONO
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="telefono" id="telefono" required
                             
                               aria-label="00000"
                               data-msg="Por favor ingrese ingrese monto."
                               data-error-class="u-has-error"
                               data-success-class="u-has-success">
                      </div>

                      
                    </div>
                    <!-- End Input -->
                  </div>




                  <div class="col-md-3">
                    <!-- Input -->
                    <div class="js-form-message mb-3">
                      <label class="h6 small d-block text-uppercase">
                        Saldo Disponible
                        <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="saldod" id="saldod" disabled>
                      </div>

                      
                    </div>
                    <!-- End Input -->
                  </div>



<input type="text" name="action" id="action" value="nuevar" hidden>



                  <div class="col-md-2" >
                     <div class="mb-2" >
                     <label class="h6 small d-block text-uppercase">
                       ACCIONES
                       <span class="text-danger">*</span>
                     </label>
                
                        <input class="btn btn-success  text-center" type="submit" value="Procesar"  id="procesar" name="procesar" style="display: none;">
 </div>
 </div>   

       
  
                  
                </div>
            

                                    </form>

          <!-- End Checkout Form -->
        </div>
        <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center ">

<table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaVentasr">
  <thead>
    <tr class="bgcolor btn-facebook">

      <th class="text-center">Id</th>
      <th class="text-center">Fecha</th>
      <th class="text-center">Estado</th>
      <th class="text-center">Venta</th>
      <th class="text-center">Descripcion</th>
      <th class="text-center">Factura</th>
      <th class="text-center">Usuario</th>
      <th class="text-center">Sucursal</th>
      <th class="text-center">Numero</th>
      <th class="text-center">Empresa</th>



    </tr>
  </thead>

  <tbody>
    <?php
    if ($num_rows > 0) {
      # code...

      while ($row = mysqli_fetch_assoc($query_select)) {


    ?>

        <tr>
          <td class="text-center"><?php echo $row['idventarecarga'] ?></td>
          <td><?php echo $row['fecha'] ?></td>
          <td><?php echo $row['status'] ?></td>
          <td><?php echo $row['totalventa'] ?> </td>
          <td><?php echo $row['descripcion'] ?> </td>
          <td><?php echo $row['factura'] ?> </td>
          <td><?php echo $row['nombre_usuario'] ?> </td>
          <td><?php echo $row['sucursal'] ?> </td>
          <td><?php echo $row['numero'] ?> </td>
          <td><?php echo $row['empresa'] ?> </td>




</div>
</div>
</td>


</tr>
<?php }
    } else {

      echo "notData";
    }
?>
</tbody>

</table>
</div>


      </div>
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
  <script type="text/javascript" src="js/jquery-ui.js">  </script> 
  <script type="text/javascript" src="js/jquery-ui.css">  </script>
  <script type="text/javascript" src="js/ventasr.js">  </script> 

  <!-- JS Global Compulsory -->

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
