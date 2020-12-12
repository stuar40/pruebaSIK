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
              <div class="col-md-6">
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

  // consulta para llenar tabla recargas
$query_select = mysqli_query($con, "SELECT s.saldo, emp.nombre FROM saldo s INNER JOIN recarga r ON s.recarga_id = r.idrecarga
INNER JOIN empresa emp ON emp.id = r.empresa_id WHERE s.sucursal_id = $Intid");
$num_rows = mysqli_num_rows($query_select);

// Consulta llenar tabla productos

$query_select2 = mysqli_query($con, "SELECT p.sku,p.nombre,p.descripcion,p.presentacion,p.marca,cat.nombre as categoria, pr.existencia FROM producto p
INNER JOIN precios pr ON p.id = pr.producto_idproducto inner join subcategoria sub ON sub.id = p.subcategoria_id
INNER JOIN categoria cat ON cat.id = sub.categoria_id WHERE pr.sucursal_idsucursal = $Intid");
$num_rows2 = mysqli_num_rows($query_select2);


?>



              <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >

                <table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaRecargas">
                  <thead>
                    <tr class="bgcolor btn-facebook">

                      <th class="text-center">Saldo</th>
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
                    
                          <td class="text-center"><?php echo $row['saldo'] ?></td>
                          <td class="text-center"><?php echo $row['nombre'] ?></td>
                      


            </tr>
        <?php }
                    } else {

                   
                    }
        ?>
        </tbody>

        </table>
          </div>





          <div id="myTabContent2" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >

<table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaProductos">
  <thead>
    <tr class="bgcolor btn-facebook">

      <th class="text-center">Codigo</th>
      <th class="text-center">Nombre</th>
      <th class="text-center">Descripcion</th>
      <th class="text-center">presentacion</th>
      <th class="text-center">Marca</th>
      <th class="text-center">Categoria</th>
      <th class="text-center">Existencia</th>
    </tr>
  </thead>

  <tbody>
    <?php
    if ($num_rows2 > 0) {
      # code...

      while ($row2 = mysqli_fetch_assoc($query_select2)) {


    ?>

        <tr>
    
          <td><?php echo $row2['sku'] ?></td>
          <td><?php echo $row2['nombre'] ?></td>
          <td><?php echo $row2['presentacion'] ?></td>
          <td><?php echo $row2['descripcion'] ?></td>
          <td><?php echo $row2['marca'] ?></td>
           <td><?php echo $row2['categoria'] ?></td>
           <td><?php echo $row2['existencia'] ?></td>


</tr>
<?php }
    } else {

    
    }
?>
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