
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

  <!-- ========== HEADER ========== -->
  <header id="header" class="u-header u-header--modern u-header--bordered u-header--sticky-top-lg"
  data-header-fix-moment="500"
          data-header-fix-effect="slide">  
  <div class="u-header__section">
      <div id="logoAndNav" class="container-fluid">
        <!-- Nav -->
        <nav class="js-mega-menu navbar navbar-expand-lg u-header__navbar">
          <!-- Logo -->
          <div class="u-header__navbar-brand-wrapper">
            <a class="navbar-brand u-header__navbar-brand" href="menuadmin.php" aria-label="Sike">
              <img class="u-header__navbar-brand-default" src="../../img/kairos.png" alt="Logo">
              <img class="u-header__navbar-brand-mobile" src="../../img/sike.png" alt="Logo">
            </a>
          </div>
          <!-- End Logo -->

          <!-- Responsive Toggle Button -->
          <button type="button" class="navbar-toggler btn u-hamburger u-header__hamburger"
                  aria-label="Toggle navigation"
                  aria-expanded="false"
                  aria-controls="navBar"
                  data-toggle="collapse"
                  data-target="#navBar">
            <span class="d-none d-sm-inline-block">Menu</span>
            <span id="hamburgerTrigger" class="u-hamburger__box ml-3">
              <span class="u-hamburger__inner"></span>
            </span>
          </button>
          <!-- End Responsive Toggle Button -->

          <!-- Navigation -->
          <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse py-0">
            <ul class="navbar-nav u-header__navbar-nav">
              
              
              <!-- Usuarios -->
              <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="usuarioMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="usuarioSubMenu">
                  Usuarios
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Usuarios - Submenu -->
                <ul id="usuarioSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="usuarioMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="newuser.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/user.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Nuevo</span>
                          <small class="d-block">Crear Usuario</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="user.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/setting.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuración</span>
                          <small class="d-block">Editar/Desactivar/Activar</small>
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
                <a id="proveedorMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="proveedorSubMenu">
                  Proveedores
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Proveedores - Submenu -->
                <ul id="proveedorSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 220px;"
                    aria-labelledby="proveedorMegaMenu">

              <li class="dropdown-item hs-has-sub-menu">
                    <a id="navLinkproveedorClassic" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                       aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuproveedorClassic">
                       Proveedores
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                    </a>

                    <!-- Submenu (level 2) -->
                    <ul id="navSubmenuproveedorClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkproveedorClassic">
                        <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevoProveedor.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/provider.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Empresa</span>
                          <small class="d-block">Nuevo Proveedor</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="verProveedores.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/configuracion.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuracion</span>
                          <small class="d-block">Buscar/Ver/Editar</small>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                    <!-- End Submenu (level 2) -->
          </li>

                   <li class="dropdown-item hs-has-sub-menu">
                    <a id="navLinkproveedorClassic" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                       aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuproveedorClassic">
                       Asesores
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                    </a>

                    <!-- Submenu (level 2) ASESORES -->
                    <ul id="navSubmenuproveedorClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkproveedorClassic">
                        <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevoAsesor.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/adviser.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Asesor</span>
                          <small class="d-block">Asociar Nuevo Asesor</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="verAsesor.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/config-asesor.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuracion</span>
                          <small class="d-block">Buscar/Ver/Editar/Eliminar</small>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                    <!-- End Submenu (level 2) -->
                  </li>
                </ul>
            </li>
              <!-- End Proveedores -->


                <!-- Clientes -->
             <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="clientesMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="clientesSubMenu">
                  Clientes
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>
                <!-- Clientes - Submenu -->
                <ul id="clientesSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="clientesMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="newCliente.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/client.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Nuevo</span>
                          <small class="d-block">Crear Cliente</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="verCliente.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/clients.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuración</span>
                          <small class="d-block">Editar/Desactivar/Activar</small>
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
                <a id="productosMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="productosSubMenu">
                  Productos
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>
                <!-- Productos - Submenu -->
                <ul id="productosSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="productosMegaMenu">
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevaRecarga.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/recharge.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Saldo</span>
                          <small class="d-block">Asignar Saldo</small>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevoProducto.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/products.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Producto</span>
                          <small class="d-block">Nuevo Producto</small>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="verRecargas.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/setting-recharge.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuración Saldo</span>
                          <small class="d-block">Editar/Desactivar/Activar</small>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="verProductos.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/setting-book.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Configuración Productos</span>
                          <small class="d-block">Editar/Desactivar/Activar</small>
                        </div>
                      </div>
                    </a>
                  </li>

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="asignarPrecios.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/asignar.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Asignar Precios</span>
                          <small class="d-block">Asignar Precios a Productos</small>
                        </div>
                      </div>
                    </a>
                  </li>

                </ul>
              </li>
              <!-- End Productos -->


                <!-- Movimientos -->
                <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                    <a id="MovimientosMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="MovimientosSubMenu">
                  Movimientos
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Movimientos - Submenu -->
                <ul id="MovimientosSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 220px;"
                    aria-labelledby="MovimientosMegaMenu">
                    <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevoDia.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/comienzo.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Inicio</span>
                          <small class="d-block">Inicio del día</small>
                        </div>
                      </div>
                    </a>
                  </li>
              <li class="dropdown-item hs-has-sub-menu">
                    <a id="navLinkMovimientosClassic" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                       aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuMovimientosClassic">
                      Compras
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                    </a>

                    <!-- Submenu (level 2) -->
                    <ul id="navSubmenuproveedorClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkMovimientosClassic">
                        <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevaComprar.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/recharge-purchase.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Saldo</span>
                          <small class="d-block">Compra de Saldo</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevaCompra.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/purchase-product.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Productos</span>
                          <small class="d-block">Compra de Productos</small>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                    <!-- End Submenu (level 2) -->
                  </li>

                  <li class="dropdown-item hs-has-sub-menu">
                    <a id="navLinkMovimientosClassic" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                       aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuMovimientosClassic">
                      Ventas
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                    </a>

                    <!-- Submenu (level 2) -->
                    <ul id="navSubmenuproveedorClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkMovimientosClassic">
                        <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevaVentar.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/recharge-sold.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Recargas</span>
                          <small class="d-block">Ventas de Recargas</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevaVenta.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/sold-product.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Productos</span>
                          <small class="d-block">Venta de Productos</small>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                    <!-- End Submenu (level 2) -->
                  </li>

                  <li class="dropdown-item hs-has-sub-menu">
                    <a id="navLinkMovimientosClassic" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                       aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuMovimientosClassic">
                      Egresos
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                    </a>

                    <!-- Submenu (level 2) -->
                    <ul id="navSubmenuproveedorClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkMovimientosClassic">
                        <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="nuevoEgresoEconomico.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/gastos.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Egreso</span>
                          <small class="d-block">Nuevo Egreso</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="#">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/list-gastos.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Listado</span>
                          <small class="d-block">Listado de egresos diario</small>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                    <!-- End Submenu (level 2) -->
                  </li>
                </ul>
            </li>
              <!-- End Movimientos -->

              <!-- Reportes -->
              <li class="nav-item hs-has-sub-menu u-header__nav-item"
                  data-event="hover"
                  data-animation-in="fadeInUp"
                  data-animation-out="fadeOut">
                <a id="ReportesMegaMenu" class="nav-link u-header__nav-link" href="javascript:;"
                   aria-haspopup="true"
                   aria-expanded="false"
                   aria-labelledby="docsSubMenu">
                  Reportes
                  <span class="fa fa-angle-down u-header__nav-link-icon"></span>
                </a>

                <!-- Reportes - Submenu -->
                <ul id="ReportesSubMenu" class="list-inline hs-sub-menu u-header__sub-menu mb-0" style="min-width: 260px;"
                    aria-labelledby="ReportesMegaMenu">

                    <li class="dropdown-item hs-has-sub-menu">
                    <a id="navLinkMovimientosClassic" class="nav-link u-header__sub-menu-nav-link" href="javascript:;"
                       aria-haspopup="true"
                       aria-expanded="false"
                       aria-controls="navSubmenuMovimientosClassic">
                       Ventas
                      <span class="fa fa-angle-right u-header__sub-menu-nav-link-icon"></span>
                    </a>

                    <!-- Submenu (level 2) -->
                    <ul id="navSubmenuproveedorClassic" class="hs-sub-menu list-unstyled u-header__sub-menu u-header__sub-menu-offset" style="min-width: 220px;"
                        aria-labelledby="navLinkMovimientosClassic">

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="ventasProductos.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/libreria.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Productos</span>
                          <small class="d-block">Ventas de Productos</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="ventasRecargas.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/recargas.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Recarga</span>
                          <small class="d-block">Ventas de Recargas</small>
                        </div>
                      </div>
                    </a>
                  </li>
                    </ul>
                    <!-- End Submenu (level 2) -->
                  </li>

                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="kardex.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/kardex.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Kardex</span>
                          <small class="d-block">Movimientos de Productos</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="inventarioProductos.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/stock.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Inventario</span>
                          <small class="d-block">Inventario en Tiendas</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="dropdown-item u-header__sub-menu-list-item py-0">
                    <a class="nav-link d-block u-header__sub-menu-nav-link" href="cuadreDiario.php">
                      <div class="media align-items-center">
                        <img class="max-width-5 mr-3" src="../../img/cuadre.svg" alt="Image Description">
                        <div class="media-body">
                          <span class="d-block text-dark font-weight-medium">Cuadre </span>
                          <small class="d-block">Cuadre de caja diario</small>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- End Reportes -->

            </ul>
          </div>
          <!-- End Navigation -->

          <ul class="navbar-nav flex-row u-header__secondary-nav">
            <li class="nav-item u-header__navbar-icon u-header__navbar-v-divider">
            <!-- Button -->
            <li class="nav-item u-header__navbar-icon-wrapper u-header__navbar-icon align-content-center">
            <a class="btn btn-xs btn-icon btn-text-dark"  href="../classes/logout.php" role="button">
                  <span class="fa fa-sign-in-alt"></span>
                </a>
            </li>
            <!-- End Button -->
          </li>
          </ul>
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
