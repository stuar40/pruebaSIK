<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

?>
	
<!-- Modal -->
<div class="modal fade" id="modalDevolucionesProductosSimilar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelProducoSinAsignar"></h5>
                    <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
            </div>
        
          <div class="modal-body">

            <!-- Checkout Form -->
            <form class="form-horizontal" method="post" id="formDevolucionesProductosSimilar" name="formDevolucionesProductosSimilar">
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
                                No de Factura
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="facturaCambioProducto" id="facturaCambioProducto" required
                                        
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
                              Codigo Producto y Producto a Cambiar
                              <span class="text-danger">*</span>
                              </label>
                             
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="CodProducto" id="CodProducto" required
                                          
                                          minlength="1" maxlength="25"
                                          data-error-class="u-has-error"
                                          data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              
                                <input  class="form-control form__input" type="text" name="nombreProductoCambio" id="nombreProductoCambio" required
                                        
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
                                Cantidad Cambiada
                                
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="cantidadProductoCambiado" id="cantidadProductoCambiado" 
                                        
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
                                Precio y Total
                                <span class="h10 small">(opcional)</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="precioProductoCambiado" id="precioProductoCambiado" 
                                        
                                        data-msg="Por favor ingrese la direccion"
                                        minlength="1" maxlength="50"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"> <!-- se asignan identificadores y detalles al campo de texto de la direccion comercial del proveedor -->
                              
                              <input  class="form-control form__input" type="text" name="totalProductoCambiado" id="totalProductoCambiado" 
                                    
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
                                Motivo Devolucion
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="motivoDevolucionCambio" id="motivoDevolucionCambio" 
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
                                Fecha
                              </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="text" name="fechaCambioProducto" id="fechaCambioProducto" 
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
                                Cliente
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
                        </div>
                      
                          <!-- Buttons -->
                            <!-- Buttons -->
                        <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                          <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="Guardar" value="Guardar" id="btnGuardarCambioProducto" name="btnGuardarCambioProducto"></input>
                         
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


<div class="modal fade" id="modalIntercambiarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelProducoSinAsignar"></h5>
                    <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
            </div>
        
          <div class="modal-body">

            <!-- Checkout Form -->
            <form class="form-horizontal" method="post" id="formGuardarIntercambioProducto" name="formGuardarIntercambioProducto">
                    <!-- Step Form Header -->
                    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                      <!-- Step Form Item -->
                      <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                      
                        <span class="u-shopping-cart-step-form__title">Intercambiar Producto</span>  <!-- titulo del formulario en texto-->
                      </li>
                    </ul>
                    <!-- End Step Form Header -->
        
                    <!-- Step Form Content -->
                    <div id="stepFormContent">
                      <!-- Customer Info -->
                      <div id="intercambiarProducto" class="active">  <!-- asigna un id al bloque donde estan los campos de nuevo proveedor-->
                        
                        <!-- Billing Form -->
                        <div class="row">
                          
                          <div class="col-md-6">
                            <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                Numero Factura
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                             
                                <input  class="form-control form__input" type="text" name="numFacturaIntercambiar" id="numFacturaIntercambiar" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              
                              </div> 
                              
                            </div>
                            <!-- End Input -->
                          </div>
                          <div class="col-md-6">
                            <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                Cliente
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="ClienteIntercambio" id="ClienteIntercambio" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              
                              </div> 
                              
                            </div>
                            <!-- End Input -->
                          </div>
        
                         
                         
        
                          <div class="w-100"></div>

                          <div class="col-md-6">
                            <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                Fecha de Compra
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="fechaIntercambio" id="fechaFacturaIntercambio" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              
                              </div> 
                              
                            </div>
                            <!-- End Input -->
                          </div>

                          <div class="col-md-6">
                            <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                Total de la Factura
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="totalFacturaIntercambio" id="totalFacturaIntercambio" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                              
                              </div> 
                              
                            </div>
                            <!-- End Input -->
                          </div>


                          <div id="contenedorTablaDetalleVentas" style="display: block"  class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >
                          
                            <table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaDetallesVentas">
                              <thead >
                                  <tr class="bgcolor btn-facebook">									
                                    
                                      <th class="text-center">Cod. Detalle</th>
                                      <th class="text-center">Producto</th>
                                      <th class="text-center">Precio </th>
                                      <th class="text-center">Cantidad</th>
                                      <th class="text-center">Acciones</th>
                                    
                                  </tr>
                              </thead>
                              
                              <tbody>
                                
                              </tbody>
                                                    
                            </table>
                          </div>

                          <div id="contenedorFormIntercambio" style="display: none" class="col-lg-12 col-md-12 col-sm-12 col-xs-12" class="tab-content-center d-flex justify-content-center " >
                          <div class="row">
                              <div class="col-md-6">
                                <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                                <div class="js-form-message mb-6">
                                  <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                    Producto
                                    <span class="text-danger">*</span>
                                  </label>
            
                                  <div class="js-focus-state input-group form">
                                  <input  class="form-control form__input" type="text" name="codProductoIntercambiar" id="codProductoIntercambiar" required
                                        
                                        minlength="1" maxlength="25"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              
                                    <input  class="form-control form__input" type="text" name="productoIntercambiar" id="productoIntercambiar" required
                                            
                                            minlength="1" maxlength="25"
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                                  
                                  
                                  </div> 
                                  
                                </div>
                                <!-- End Input -->
                              </div>
                              <div class="col-md-6">
                                <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                                <div class="js-form-message mb-6">
                                  <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                    Precio
                                    <span class="text-danger">*</span>
                                  </label>
            
                                  <div class="js-focus-state input-group form">
                                    <input  class="form-control form__input" type="text" name="precioIntercambio" id="precioIntercambio" required
                                            
                                            minlength="1" maxlength="25"
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                                  
                                  
                                  </div> 
                                  
                                </div>
                                <!-- End Input -->
                              </div>
        
                         
                           <div class="w-100"></div>

                           <div class="col-md-6">
                                <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                                <div class="js-form-message mb-6">
                                  <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                    Cantidad
                                    <span class="text-danger">*</span>
                                  </label>
            
                                  <div class="js-focus-state input-group form">
                                    <input  class="form-control form__input" type="text" name="cantidadIntercambiar" id="cantidadIntercambiar" required
                                            
                                            minlength="1" maxlength="25"
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                                  
                                  
                                  </div> 
                                  
                                </div>
                                <!-- End Input -->
                              </div>
                              <div class="col-md-6">
                                <!-- Input  primer bloque ingresa el nombre comercial del proveedor  -->
                                <div class="js-form-message mb-6">
                                  <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                                    Motivo
                                    <span class="text-danger">*</span>
                                  </label>
            
                                  <div class="js-focus-state input-group form">
                                    <input  class="form-control form__input" type="text" name="motivoIntercambio" id="motivoIntercambio" required
                                            
                                            minlength="1" maxlength="25"
                                            data-error-class="u-has-error"
                                            data-success-class="u-has-success">  <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                                  
                                  
                                  </div> 
                                  
                                </div>
                                <!-- End Input -->
                              </div>
        
                         
                           <div class="w-100"></div>
                                 
                                
                           </div> <!--Fin del ROW-->
                           <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                                  <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="Asignar" value="Guardar" id="btnGuardarProductoSinAsignar" name="btnGuardarProductoSinAsignar"></input>
                                  <!-- End Checkout Form -->
                                  <!-- Buttons -->
                                  <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                                    <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
                                  </div>
                                </div>
                          </div><!--Contenedor de Form para Intercambiar-->
                            
                        </div>
                      
                        <!-- Buttons -->
                        
                      </div>
                    </div>
                
            </form>


          </div> <!--div del modalbody-->
        </div> <!--div del modalcontent-->
     </div> <!--div del modaldialog-->
    </div>
  </div> <!--div del modal-->