<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

?>
	
	<!-- Modal -->
	<div class="modal fade" id="Modal_Nuevo_Proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-xl">
		<div class="modal-header">
            <h5 class="modal-title" id="modalLabelProveedores"></h5>
            <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
		</div>
		    <div class="modal-body">
    
    <!-- Checkout Form -->
    <!--<form class="form-horizontal" method="post" id="guardar_Proveedor" name="guardar_Proveedor">-->  <!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->
    <form class="form-horizontal" method="post" id="guardar_Proveedor2" name="guardar_Proveedor2">  
              <!-- Step Form Header -->
              <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                <!-- Step Form Item -->
                <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                 
                  <span class="u-shopping-cart-step-form__title">Nuevo Proveedor</span>  <!-- titulo del formulario en texto-->
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
                          Nombre Comercial
                          <span class="text-danger">*</span>
                        </label>
  
                        <div class="js-focus-state input-group form">
                          <input class="form-control form__input" type="text" name="nombreComercial" id="nombreComercial" required
                                 placeholder="Ingrese Nombre Comercial del proveedor"
                                 data-msg="Ingrese Nombre Comercial."
                                 data-error-class="u-has-error"
                                 data-success-class="u-has-success">     <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                        </div> 
                      </div>
                      <!-- End Input -->
                    </div>
  
                    <div class="col-md-6">
                      <!-- Input 2 segundo bloque ingreso de NIT del proveedor -->
                      <div class="js-form-message mb-6">
                        <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el NIT comercial del proveedor -->
                        NIT del Proveedor
                        <span class="text-danger">*</span>
                        </label>
                        <div class="js-focus-state input-group form">
                          <input class="form-control form__input" 
                          type="text" name="proveedorNIT" id="proveedorNIT" required
                          pattern="[0-9]{8,12}"                                 
                                 placeholder="Ingrese NIT del proveedor"> <!-- se asignan identificadores y detalles al campo de texto del NIT  comercial del proveedor -->
                        </div>
                      </div>
                      <!-- End Input -->
                    </div>
  
              
  
                    <div class="w-100"></div>
                    
                    <div class="col-md-6">
                      <!-- Input3 bloque de ingreso de direccion del proveedor -->
                      <div class="js-form-message mb-6">
                        <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la direccion comercial del proveedor -->
                          Direccion Comercial
                          <span class="h10 small">(opcional)</span>
                        </label>
  
                        <div class="js-focus-state input-group form">
                          <input class="form-control form__input" type="text" name="proveedorDireccion" id="proveedorDireccion" 
                                 placeholder="Ingrese Direccion comercial del proveedor"
                                 data-msg="Por favor ingrese la direccion"
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
                          Telefono del Proveedor
                          <span class="h10 small">(opcional)</span>
                        </label>
  
                        <div class="js-focus-state input-group form">
                          <input class="form-control form__input" type="tel" name="telefonoProveedor" id="telefonoProveedor" minlength="3" maxlength="12"
                                 placeholder="Ingrese No. de Telefono"> <!-- se asignan identificadores y detalles al campo de texto del No telefono del proveedor -->
                        </div>
                      </div>
                      <!-- End Input -->
                    </div>
  
  
      
                    <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->
  
                    <div class="col-md-6">   <!--Bloque de Columna son 2 columnas por fila -->
                      <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                      <div class="js-form-message mb-6">
                        <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                          Descripcion
                        </label>
  
                        <div class="js-focus-state input-group form">
                          <textarea class="form-control form__input" type="text" name="descripcionProveedor" id="descripcionProveedor" 
                                 placeholder="Descripcion del Proveedor"
                                 data-msg="ingrese una descripcion del Proveedor."
                                 data-error-class="u-has-error"
                                 data-success-class="u-has-success">
                             </textarea> <!-- se asignan identificadores y detalles al campo de texto de la descripcion del proveedor -->
                        </div>
                      </div>
                      <!-- End Input -->
                    </div>
  
                    <div class="col-md-6">
                      <!-- Input -->
                      
                      <!-- End Input -->
                    </div>
  
  
  
                    <div class="w-100"></div>
                  
                  <div class="w-100"></div>
                      
                  </div>
                  <!-- End Billing Form 
                  <input  type="text" name="action" id="action" value="agregar_Proveedor" hidden>
                  <input  type="text" name="intencion" id="intencion" value="intencion" hidden>
                 -->
                  <!-- Buttons -->
                  <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                  <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="agregar" value="Guardar" id="btnGuardarProveedor" name="insertar"></input>
   
                  
              
                  <!-- End Checkout Form -->
      
                  
                  <!-- Buttons -->
                  
                  <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                  
                  <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
				  
			</form>


		</div>
	  </div>
	</div>
