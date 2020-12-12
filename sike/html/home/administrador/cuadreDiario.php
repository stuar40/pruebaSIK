<?php

require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

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

            <span class="u-shopping-cart-step-form__title">Inventario</span>
          </li>
        </ul>
        <!-- End Step Form Header -->
        <form action="#" method="POST">
        <!-- Step Form Content -->
        <div id="stepFormContent">
          <!-- Customer Info -->
          <div id="newuser" class="active">

            <!-- Billing Form -->
            <div class="row">




              <!-- Busqueda -->
              <div class="col-md-3">
                    <div class="mb-6">
                     <label class="h6 small d-block text-uppercase">
                      Sucursal
                       <span class="text-danger">*</span>
                     </label>
                 <select class="form-control input-sm" name="sucursal" id="sucursal"  >

             <option value="0" disabled ="true" selected = "selected">Seleccionar</option>
               
             <?php
		
		$sql= "SELECT * FROM sucursal";
		$res=mysqli_query($con,$sql);
			while ($data=mysqli_fetch_array($res))
										{

											$d1 = $data['id'];
											$d2 = $data['numero'];
                      $d3 = $data['direccion'];
?>

<option value="<?php echo $d1; ?>"> <?php echo $d2, ' ', $d3 ; ?></option>
<?php
										}
												?>

</select>
                     </div>


                    </div>


                    <div class="col-md-3">
                    <div class="mb-6">
                     <label class="h6 small d-block text-uppercase">
                      Fecha
                       <span class="text-danger">*</span>
                     </label>
                        <input class="form-control form__input" type="date" name="fecha" id="fecha" >
        


                    </div>

                    </div>
           





                  <div class="col-md-6">
                    <div class="mb-6">
                     <label class="h6 small d-block text-uppercase">
                      Acciones
                       <span class="text-danger">*</span>
                     </label>

                     <div >


<input type="submit" class="btn btn-success text-center" data-next-step="agregar" value="Buscar" name="busqueda" id="busqueda" hidden>
                  </div>


                  </div>

                  </div>

                  </form>

<?php 
if ($_POST) {

  $Intid = $_POST['sucursal'];
  $fecha = $_POST['fecha'];

  // consulta para llenar tabla recargas
$query_select = mysqli_query($con, "SELECT count(fecha) AS cantidad, SUM(totalcompra) AS totalrecarga FROM comprarecarga WHERE DATE(fecha) = '$fecha' AND sucursal_idsucursal = $Intid ");
$num_rows = mysqli_num_rows($query_select);
if ($num_rows > 0) {
  # code...

  while ($row = mysqli_fetch_assoc($query_select)) {
    $cantidad1= $row['cantidad'] ;
    $total1 =$row['totalrecarga'] ;

  }
}

// Consulta llenar tabla productos

$query_select2 = mysqli_query($con, "SELECT count(fecha) AS cantidad, SUM(totalcompra) AS totalcompra FROM encabezado_compra WHERE DATE(fecha) = '$fecha' AND sucursal_idsucursal = $Intid ");
$num_rows2 = mysqli_num_rows($query_select2);

if ($num_rows2 > 0) {
  # code...

  while ($row2 = mysqli_fetch_assoc($query_select2)) {
    $cantidad2= $row2['cantidad'] ;
    $total2 =$row2['totalcompra'] ;


  }}


$query_select3 = mysqli_query($con, "SELECT count(fecha) AS cantidad, SUM(monto) AS totalmonto FROM egresos WHERE DATE(fecha) = '$fecha' AND sucursal_id = $Intid  ");
$num_rows3 = mysqli_num_rows($query_select3);

if ($num_rows3 > 0) {
  # code...

  while ($row3 = mysqli_fetch_assoc($query_select3)) {
    $cantidad3= $row3['cantidad'] ;
    $total3 =$row3['totalmonto'] ;

  }}

$query_select4 = mysqli_query($con, "SELECT count(fecha) AS cantidad,SUM(totalventa) AS totalventar from ventarecarga WHERE DATE(fecha) = '$fecha' AND sucursal_idsucursal = $Intid    ");
$num_rows4 = mysqli_num_rows($query_select4);

if ($num_rows4 > 0) {
  # code...

  while ($row3 = mysqli_fetch_assoc($query_select4)) {
    $cantidad4= $row3['cantidad'] ;
    $total4 =$row3['totalventar'] ;

  }}



$query_select5 = mysqli_query($con, "SELECT count(fecha) AS cantidad, SUM(totalfactura) AS totalproductos from encabezado_venta WHERE DATE(fecha) = '$fecha' AND sucursal_idsucursal = $Intid    ");
$num_rows5 = mysqli_num_rows($query_select5);

if ($num_rows5 > 0) {
  # code...

  while ($row5 = mysqli_fetch_assoc($query_select5)) {
    $cantidad5= $row5['cantidad'] ;
    $total5 =$row5['totalproductos'] ;

  }}



$query_select6 = mysqli_query($con, "SELECT count(fecha) AS cantidad, SUM(totalfactura) AS totalinicio from encabezado_venta WHERE DATE(fecha) = '$fecha' AND sucursal_idsucursal = $Intid    ");
$num_rows6 = mysqli_num_rows($query_select6);
if ($num_rows6 > 0) {
  # code...

  while ($row6 = mysqli_fetch_assoc($query_select6)) {
    $cantidad6= $row6['cantidad'] ;
    $total6 =$row6['totalinicio'] ;

  }}

?>


<h1>EGRESOS</h1>


              <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >

                <table class="table  table-condensed table-hover table-responsive-md  justify-center ">
                  <thead>
                    <tr class="bgcolor btn-facebook">

                      <th class="text-center">Fecha</th>
                      <th class="text-center">Descripcion</th>
                      <th class="text-center">Total </th>
                      
                    </tr>
                  </thead>

                  <tbody>
                  <tr>
                    
                    <td class="text-center"><?php echo $cantidad1?></td>
                    <td class="text-center">Compras Recargas</td>
                    <td class="text-center"><?php echo $total1?></td>
                

      </tr>
      
      <tr>
                    
                    <td class="text-center"><?php echo $cantidad2?></td>
                    <td class="text-center">Compras Productos</td>
                    <td class="text-center"><?php echo $total2?></td>
                

      </tr>


      <tr>
    
    <td class="text-center"><?php echo $cantidad3 ?></td>
    <td class="text-center">Gastos Varios</td>
    <td class="text-center"><?php echo $total3 ?></td>


</tr>

        </tbody>

        </table>
          </div>





<h1>INGRESOS</h1>



<div id="myTabContent2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >

                <table class="table  table-condensed table-hover table-responsive-md  justify-center ">
                  <thead>
                    <tr class="bgcolor btn-facebook">

                      <th class="text-center">Fecha</th>
                      <th class="text-center">Descripcion</th>
                      <th class="text-center">Total </th>
                      
                    </tr>
                  </thead>

                  <tbody>
                  <tr>
                    
                    <td class="text-center"><?php echo $cantidad4?></td>
                    <td class="text-center">Ventas Recargas</td>
                    <td class="text-center"><?php echo $total4?></td>
                

      </tr>
      
      <tr>
                    
                    <td class="text-center"><?php echo $cantidad5?></td>
                    <td class="text-center">Ventas Productos</td>
                    <td class="text-center"><?php echo $total5?></td>
                

      </tr>


      <tr>
    
    <td class="text-center"><?php echo $cantidad6 ?></td>
    <td class="text-center">Inicio del dia</td>
    <td class="text-center"><?php echo $total6 ?></td>


</tr>

        </tbody>

        </table>
          </div>













<?php 
}
?>













          <section class="d-flex justify-content-center responsive-mode">


            <div class="d-flex justify-content-center ">
              <div class="page-header justify-center">
                <h1 class="text-content"><i class="card navicon"></i> <small></small></h1>


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





  <!-- ========== ARCHIVOS NECESARIOS PARA EL FUNCIONAMIENTO ========== -->
  <a class="js-go-to u-go-to" href="javascript:;" data-position='{"bottom": 15, "right": 15 }' data-type="fixed" data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
    <span class="fa fa-arrow-up u-go-to__inner"></span>
  </a>
  <!-- End Go to Top -->

  <script type="text/javascript" src="js/jquery.min.js"> </script>
  <script type="text/javascript" src="js/inventario.js"> </script>

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

  <!-- End Skippy -->
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