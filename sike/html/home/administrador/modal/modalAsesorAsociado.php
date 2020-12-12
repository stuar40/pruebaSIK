<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

// consulta para llenar tabla 
$query_select = mysqli_query($con,"SELECT * FROM asesor");
$num_rows = mysqli_num_rows($query_select);
?>
	
	<!-- Modal Asesor asociado-->
	<div class="modal fade responsive-mode" id="Modal_AsesorAsociado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content modal-xl">
		<div class="modal-header">
            <h5 class="modal-title" id="modalLabelverAsesor"></h5>
            <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
    </div>
          
		    <div class="modal-body responsive-mode">
        
          <form class="form-horizontal" method="post" id="verAsesorAsociado" name="verAsesorAsociado"><!-- le asigna un identificador al formulario para generar un post y enviar los datos  -->
              
              <!-- Step Form Header -->
              <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                <!-- Step Form Item -->
                <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                 
                  <span class="u-shopping-cart-step-form__title">Asesores Asociados </span> <!-- titulo del formulario en texto-->
                </li>
              </ul>
              <!-- End Step Form Header -->
  
              <!-- Step Form Content -->
              <div id="stepFormContent">
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
                        <input class="form-control form__input" type="text" name="nombreProveedorAsociado" id="nombreProveedorAsociado"
                                 placeholder="Nombre Proveedor" disabled > <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                        
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
                          <input class="form-control form__input" type="text" name="telefonoProveedor" id="telefonoProveedor"
                                 placeholder="Telefono Proveedor" disabled > <!-- se asignan identificadores y detalles alnombre del asesor de proveedores -->
                        </div>
                      </div>
                      <!-- End Input -->
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
                            
                            <tbody id="filaAsesoresAsociados">
                           
                            </tbody>
                                                  
                        </table>
                  </div>

            </div>
        </div>
    </div>
    </div>
	</div>