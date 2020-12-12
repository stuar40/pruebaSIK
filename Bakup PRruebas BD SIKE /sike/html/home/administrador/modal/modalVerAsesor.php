<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

// consulta para llenar tabla 
$query_select = mysqli_query($con,"SELECT * FROM asesor");
$num_rows = mysqli_num_rows($query_select);
?>
	
	<!-- Modal VER / EDITAR Asesor-->
	<div class="modal fade" id="Modal_Ver_Asesor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-xl">
		<div class="modal-header">
            <h5 class="modal-title" id="modalLabelverAsesor"></h5>
            <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
		</div>
		    <div class="modal-body">
    
                <!-- Checkout Form -->
          <form class="form-horizontal" method="post" id="ListarAsesor" name="ListarAsesor"><!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->
              
            <!-- Step Form Header -->
            <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
              <!-- Step Form Item -->
              <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
               
                <span class="u-shopping-cart-step-form__title">Asesores</span> <!-- titulo del formulario en texto-->
              </li>
            </ul>
            <!-- End Step Form Header -->

            <!-- Step Form Content -->
            <div id="stepFormContent">
              <!-- Customer Info -->
              <div id="formNuevoAsesor" class="active"> <!-- asigna un id al bloque donde estan los campos de nuevo asesor proveedor-->
                
                <!-- Billing Form -->
                <div class="row">
                  
                <div class="col-md-6">
                    <!-- Input primer bloque donde selecciona el proveedor al cual asignara el asesor que se ingreseara-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">  <!-- etiqueta del campo de texto  donde se almacena el nombre comercial del proveedor -->
                        Proveedor
                        <span class="text-danger">*</span>
                      </label>
                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="ProveedorAsesor" id="ProveedorAsesor"
                               placeholder="Ingrese Nombre Completo"> <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                      </div>
                      
                      
                      </div>
                    
                    <!-- End Input -->
                  </div>

                  <div class="col-md-6">
                    <!-- Input segundo bloque donde se ingresa el nombre del asesor de algun proveedor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el nombre del asesor del proveedor -->
                        Nombre completo del Asesor
                        <span class="text-danger">*</span>
                      </label>
                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="nombreAsesor" id="nombreAsesor" required
                        
                               data-msg="Ingrese Nombre Completo."
                               minlength="1" maxlength="22"
                               title="Nombre Completo Tamaño máximo: 22 Caracteres"
                               placeholder="Ingrese Nombre Completo"> <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


                  <div class="w-100"></div>
                  
                  <div class="col-md-6">
                    <!-- Input tercer bloque donde se ingresa el telefono del asesor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se almacena el numero de telefono del asesor del proveedor -->
                       Telefono
                      <span class="text-danger">*</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="text" name="telefonoAsesor" id="telefonoAsesor" required
                        minlength="3" maxlength="12"
                                pattern="[0-9]{3,12}"  title="Telefono. Tamaño mínimo: 3. Tamaño máximo: 12"
                                placeholder="Ingrese No. de Telefono"
                               
                               data-msg="Ingrese No Telefono."
                               data-error-class="u-has-error"
                               data-success-class="u-has-success"> <!-- se asignan identificadores y detalles a la caja de texto del numero del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


                  <div class="col-md-6">
                    <!-- Input cuarto bloque donde se ingres al correo del asesor -->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase">
                        Correo Electronico
                        <span class="h10 small">(UNICO)</span>
                      </label>

                      <div class="js-focus-state input-group form">
                        <input class="form-control form__input" type="email" name="correoAsesor" id="correoAsesor" required
                               placeholder="Ingrese Correo Electronico del Asesor"><!-- se asignan identificadores, validaciones  y detalles a la caja de texto del correoEelctronico del asesor de proveedores -->
                      </div>
                    </div>
                    <!-- End Input -->
                  </div>


    
                  <div class="w-100"></div>


                  <div class="col-md-6">
                    <!-- Input quinto bloque donde se selecciona el estado del asesor si aun esta activo o inactivo-->
                    <div class="mb-6">
                      <label class="h6 small d-block text-uppercase">
                      Estado de actividad del Asesor
                        <span class="text-danger">*</span>
                      </label>
                        <select class="custom-select" name="estadoAsesor" id="estadoAsesor"> 
                        <option selected="true" disabled="disabled">Seleccione Estado del Asesor</option>                     
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>               
                        </select> <!-- se asignan identificadores y detalles al selector de estado de actividad del asesor de proveedores -->
                      </div>
                    <!-- End Input -->
                  </div>


                  <div class="col-md-6">
                  </div>
  
                  <div class="w-100"></div>
                <div class="w-100"></div>
                 
                  
                </div>
               
                <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="asignarAsesor" value="Guardar" name="asignarAsesor" id="btnGuardarAsesor"></input>
                <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                 
                 <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>

          </form>
                 <!-- Checkout Form -->
      
                 
				  
			


		</div>
	  </div>
	</div>
