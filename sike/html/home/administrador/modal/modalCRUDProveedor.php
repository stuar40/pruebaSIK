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
            <form class="form-horizontal" method="post" id="guardar_Proveedor2" name="guardar_Proveedor2">
                    <!-- Step Form Header -->
                    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                      <!-- Step Form Item -->
                      <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                      
                        <span class="u-shopping-cart-step-form__title">Proveedor</span>  <!-- titulo del formulario en texto-->
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
                                <input  class="form-control form__input" type="text" name="nombreComercial" id="nombreComercial" required
                                        data-msg="Ingrese Nombre Comercial."
                                        minlength="1" maxlength="150"
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
                              NIT del Proveedor
                              <span class="text-danger">*</span>
                              </label>
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="proveedorNIT" id="proveedorNIT" required
                                        minlength="6" maxlength="9"
                                        pattern="[0-9]{6,12}"  title="Numero de NIT (Sin Guion) Tamaño mínimo: 8. Tamaño máximo: 12"
                                        placeholder="Ingrese NIT del proveedor"> <!-- se asignan identificadores y detalles al campo de texto del NIT  comercial del proveedor -->
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
                                Direccion Comercial
                                <span class="h10 small">(opcional)</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="proveedorDireccion" id="proveedorDireccion" 
                                        
                                        data-msg="Por favor ingrese la direccion"
                                        minlength="1" maxlength="150"
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
                                <input class="form-control form__input" type="num" name="telefonoProveedor" id="telefonoProveedor" required
                                       minlength="3" maxlength="12"
                                       pattern="[0-9]{3,12}"  title="Telefono. Tamaño mínimo: 3. Tamaño máximo: 12">  <!-- se asignan identificadores y detalles al campo de texto del No telefono del proveedor -->
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
                                        
                                        data-msg="ingrese una descripcion del Proveedor."
                                        maxlength="150"
                                        pattern="[0-9]{0,150}"  title="Números. Tamaño máximo: 150"
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success"></textarea><!-- se asignan identificadores y detalles al campo de texto de la descripcion del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                            <!-- Input -->
                            
                            <!-- End Input -->
                          </div>
        
        
        
                          <div class="w-100"></div>
                        
                            
                        </div>
                      
                        <!-- Buttons -->
                        <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                          <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="agregar" value="Guardar" id="btnGuardarProveedor" name="insertar"></input>
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

<!-- Modal listar Asesor asociado-->
<div class="modal fade" id="Modal_AsesorAsociado2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelverAsesorAsociado"> </h5>
                    <button type="button" id="cerrar2" class="close" data-dismiss="modal" aria-label="Close"> <span  aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                 <!-- Checkout Form -->
                 
                  <!-- Step Form Header -->
                  <ul id="headerformAsesorAsociado" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                    <!-- Step Form Item -->
                    <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                    
                      <span class="u-shopping-cart-step-form__title">Asesores Asociados </span> <!-- titulo del formulario en texto-->
                    </li>
                  </ul>
                  <!-- End Step Form Header -->
                  <form class="form-horizontal" method="post" id="verAsesorAsociado" name="verAsesorAsociado"><!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->
                
                  <!-- Step Form Content -->
                  <div id="stepFormContentAsesorAsociado">
                    <!-- Customer Info -->
                    <div id="formAsesorAsociado" class="active"> <!-- asigna un id al bloque donde estan los campos de nuevo asesor proveedor-->
                      
                      <!-- Billing Form -->
                      <div class="row">
                        <div class="col-md-6">
                          <!-- Input primer bloque donde selecciona el proveedor al cual asignara el asesor que se ingreseara-->
                          <div class="js-form-message mb-6">
                            <label class="h6 small d-block text-uppercase">  <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                              Nombre del Proveedor
                              <span class="text-danger">*</span>
                            </label>
      
                            <div class="js-focus-state input-group form">
                              <input class="form-control form__input" type="text" name="idProveedorAsociado" id="idProveedorAsociado" disabled > <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                              <input class="form-control form__input" type="text" name="nombreProveedorAsociado" id="nombreProveedorAsociado" placeholder="Nombre Proveedor" disabled > <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                            </div>
                          </div>
                          <!-- End Input -->
                        </div>
      
                        <div class="col-md-6">
                          <!-- Input segundo bloque donde se ingresa el nombre del asesor de algun proveedor-->
                          <div class="js-form-message mb-6">
                            <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el nombre del asesor del proveedor -->
                              Telefono
                              <span class="text-danger">*</span>
                            </label>
                            <div class="js-focus-state input-group form">
                              <input class="form-control form__input" type="text" name="telefonoProveedorAsociado" id="telefonoProveedorAsociado" placeholder="Telefono Proveedor" disabled > <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                            </div>
                          </div>
                          <!-- End Input -->
                        </div>
      
                        <div class="w-100">
                        
                        </div>
                      </div>
                    </div>
                  </div>
      
      
      </form>
      <div class="col-lg-12 order-lg-1 ">
              <div id="myTabContent" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 responsive-mode tab-content-center table-responsive-md justify-center" >
					           <table class="table  table-condensed table-hover table-responsive-md  justify-center " id="tablaAsesoresAsociados">
                                    <thead >
                                      <tr class="bgcolor btn-facebook">									
                                        <th class="text-center">Codigo</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Telefono </th>
                                        <th class="text-center">Estado</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                
                                    </tbody>
                              
                              </table>
                            </div>
                        
                    <!-- End Billing Form -->
               <!-- End Checkout Form -->
          </div> <!--div del modalbody-->
      </div> <!--div del modalcontent-->
    </div> <!--div del modaldialog-->
  </div> <!--div del modal-->
</div>
<!--fin del modal donde se lista el asesor asociado-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>