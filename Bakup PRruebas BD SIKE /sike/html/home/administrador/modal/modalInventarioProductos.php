<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

?>
	
<!-- Modal -->
<div class="modal fade" id="modalVerProductoSinAsignar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelProducoSinAsignar"></h5>
                    <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
            </div>
        
          <div class="modal-body">

            <!-- Checkout Form -->
            <form class="form-horizontal" method="post" id="formVerProductoSinAsignar" name="formVerProductoSinAsignar">
                    <!-- Step Form Header -->
                    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                      <!-- Step Form Item -->
                      <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                      
                        
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
                                Codigo
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="nombreComercial" id="codigoProductoSinAsignar" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                                
                                <input  class="form-control form__input" type="text" name="nombreComercial" id="skuProductoSinAsignar" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              </div> 
                              
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input 2 segundo bloque ingreso de NIT del proveedor -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el NIT comercial del proveedor -->
                              Nombre del Producto
                              <span class="text-danger">*</span>
                              </label>
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="nombreProducto" id="nombreProductoSinAsignar" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                    
        
                          <div class="w-100">
                          
                          </div>

                          
                          
                          <div class="col-md-6">
                            <!-- Input3 bloque de ingreso de direccion del proveedor -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la direccion comercial del proveedor -->
                                Descripcion
                                
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="descripcionProductoSinAsignar" id="descripcionProductoSinAsignar" 
                                        
                                        data-msg="Por favor ingrese la direccion"
                                        minlength="1" maxlength="50"
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
                                Presentacion
                                <span class="h10 small">(opcional)</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="presentacionProductoSinAsignar" id="presentacionProductoSinAsignar" 
                                        
                                        data-msg="Por favor ingrese la direccion"
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
            
                          <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->
        
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Marca
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="marcaProductoSinAsignar" id="marcaProductoSinAsignar" 
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            
                            <!-- End Input -->
                          </div>
        
        
        
                          <div class="w-100"></div>
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Categoria
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="categoriaProductoInventario" id="categoriaProductoInventario" 
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                SubCategoria
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="subcategoriaProductoSinAsignar" id="subcategoriaProductoSinAsignar" 
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
                          <div class="w-100"></div>
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Existencia
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  type="text" name="idPrecioProductoInventario" id="idPrecioProductoInventario"  hidden>
                              <input  class="form-control form__input" type="text" name="existenciaProductoInventario" id="existenciaProductoInventario"required
                                        min="0.5" maxlength="50"
                                        pattern="[0-9]{1,12}"   title="Solo numeros. Existencia mínima: 1 "
                                        step="0.5"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Precio Costo
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="precioCostoProductoInventario" id="precioCostoProductoInventario" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
                          <div class="w-100"></div>

                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Precio Venta
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="precioVentaProductoInventario" id="precioVentaProductoInventario" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Precio Minimo
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="precioMinimoProductoInventario" id="precioMinimoProductoInventario" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
                          <div class="w-100"></div>
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Precio Promocion
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="precioPromocionProductoInventario" id="precioPromocionProductoInventario" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Estado del Producto para esta Sucursal
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <select class="custom-select" name="estadoProductoInventario" id="estadoProductoInventario" > 
                                  <option value="ACTIVO">ACTIVO</option>  
                                  <option value="INACTIVO"  >INACTIVO</option>                     
                                     
                              </select> <!-- se asignan identificadores y detalles al select de proveedores -->

                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
                          <div class="w-100"></div>
                        </div>
                      
                          <!-- Buttons -->
                            <!-- Buttons -->
                        <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                          <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="Guardar" value="Guardar" id="btnGuardarProductoInventario" name="btnGuardarProductoSinAsignar"></input>
                         
                          <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                          <!-- End Checkout Form -->
                          <!-- Buttons -->
                        </div>
                      </div>
                    </div>
                
            </form>


          </div> <!--div del modalbody-->
        </div> <!--div del modalcontent-->
     </div> <!--div del modaldialog-->
    </div>
</div> <!--div del modal-->


<!-- Modal Cargar Datos -->


<div class="modal fade" id="modalGuardarAsignacionProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelProducoSinAsignar"></h5>
                    <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
            </div>
        
          <div class="modal-body">

            <!-- Checkout Form -->
            <form class="form-horizontal" method="post" id="formGuardarProductoSinAsignar" name="formGuardarProductoSinAsignar">
                    <!-- Step Form Header -->
                    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                      <!-- Step Form Item -->
                      <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                      
                        <span class="u-shopping-cart-step-form__title">Asignar Precio</span>  <!-- titulo del formulario en texto-->
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
                                Codigo
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="codigoProductoSinAsignar2" id="codigoProductoSinAsignar2" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                                
                                <input  class="form-control form__input" type="text" name="skuProductoSinAsignar2" id="skuProductoSinAsignar2" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              </div> 
                              
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input 2 segundo bloque ingreso de NIT del proveedor -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el NIT comercial del proveedor -->
                              Nombre del Producto
                              <span class="text-danger">*</span>
                              </label>
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="nombreProductoSinAsignar2" id="nombreProductoSinAsignar2" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                    
        
                          <div class="w-100">
                          
                          </div>

                          
                          
                          <div class="col-md-6">
                            <!-- Input3 bloque de ingreso de direccion del proveedor -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la direccion comercial del proveedor -->
                                Descripcion
                                
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="descripcionProductoSinAsignar2" id="descripcionProductoSinAsignar2" 
                                        
                                        data-msg="Por favor ingrese la direccion"
                                        minlength="1" maxlength="50"
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
                                Presentacion
                                <span class="h10 small">(opcional)</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="presentacionProductoSinAsignar2" id="presentacionProductoSinAsignar2" 
                                        
                                        data-msg="Por favor ingrese la direccion"
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
            
                          <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->
        
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Marca
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="marcaProductoSinAsignar2" id="marcaProductoSinAsignar2" 
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Estado
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="estadoProductoSinAsignar2" id="estadoProductoSinAsignar2" 
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
        
                          <div class="w-100"></div>

                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Usuario Encargado
                              </label>
        
                              <div class="js-focus-state input-group form">
                              
                              <select class="custom-select" name="usaurioProductoSinAsignar2" id="usaurioProductoSinAsignar2" required > 
                              <option value ="" selected="true" disabled="disabled" >Usuario Encargado</option>                     
                              <?php
                                    $sql= "SELECT id,nombre_usuario from usuarios";
                                    $res=mysqli_query($con,$sql);
                                    while ($data=mysqli_fetch_row($res))
                                            {
                                              $idUsuario = $data[0];
                                              $nombreUsuario = $data[1];
                                              
                                    ?>
                                              <option value="<?php echo $idUsuario; ?>"> <?php echo $nombreUsuario; ?></option>
                                    <?php 	} ?>        
                                              
                            </select> <!-- se asignan identificadores y detalles al select de proveedores -->

                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Nueva Existencia
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="number" name="existenciaProductoSinAsignar" id="existenciaProductoSinAsignar" required
                                        min="0.5" maxlength="50"
                                        pattern="[0-9]{1,12}"   title="Solo numeros. Existencia mínima: 1 "
                                        step="0.5"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
                          
                          <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->
        
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Precio Costo del Producto
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="costoProductoSinAsignar" id="costoProductoSinAsignar" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                              Precio Venta del Producto
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="precioVentaProductoSinAsignar" id="precioVentaProductoSinAsignar" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
        
                          
                          <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->
        
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                                Precio Minimo
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="costoMinimoProductoSinAsignar" id="costoMinimoProductoSinAsignar" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                              Precio de Promocion
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="costoPromocionProductoSinAsignar" id="costoPromocionProductoSinAsignar" required
                                        minlength="1" maxlength="50"
                                        pattern="^[0-9]+(\.[0-9]{1,2})?$"  title="Solo numeros. Tamaño mínimo: 0.01 "
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
        
                          <div class="w-100"></div>
                          <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                            <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                              Habilitar producto para esta sucursal
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <select class="custom-select" name="estadoProductoSinAsignar" id="estadoProductoSinAsignar" > 
                                  <option selected="true"  value="ACTIVO">ACTIVO</option>  
                                  <option value="INACTIVO"  >INACTIVO</option>                     
                                     
                              </select> <!-- se asignan identificadores y detalles al select de proveedores -->

                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                              Sucursal
                              </label>
        
                              <div class="js-focus-state input-group form">
                              
                            <select class="custom-select" name="SucursalAsignar" id="SucursalAsignar" > 
                              <option selected="true" disabled="disabled" >Sucursal</option>                     
                              <?php
                                    $sql= "SELECT id,numero,direccion FROM sucursal";
                                    $res=mysqli_query($con,$sql);
                                    while ($data=mysqli_fetch_row($res))
                                            {
                                              $idSucursal = $data[0];
                                              $numeroSucursal = $data[1];
                                              $direccionSucursal = $data[2];
                                    ?>
                                              <option  disabled="disabled" value="<?php echo $idSucursal; ?>"> <?php echo $numeroSucursal.' '.$direccionSucursal; ?></option>
                                    <?php 	} ?>        

                            </select> <!-- se asignan identificadores y detalles al select de proveedores -->

                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
        
                          <div class="w-100"></div>
                            
                        </div>
                      
                        <!-- Buttons -->
                        <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                          <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="Asignar" value="Guardar" id="btnGuardarProductoSinAsignar" name="btnGuardarProductoSinAsignar"></input>
                          <!-- End Checkout Form -->
                          <!-- Buttons -->
                          <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                
            </form>


          </div> <!--div del modalbody-->
        </div> <!--div del modalcontent-->
     </div> <!--div del modaldialog-->
    </div>
  </div> <!--div del modal-->