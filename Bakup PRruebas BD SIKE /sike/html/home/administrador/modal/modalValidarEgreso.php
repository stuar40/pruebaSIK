	
<!-- Modal -->
<div class="modal fade" id="modalValidarAdministrador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelValidar"></h5>
                    <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
            </div>
        
          <div class="modal-body">

            <!-- Checkout Form -->
            <form class="form-horizontal" method="post" id="formValidarAdministrador" name="formValidarAdministrador">
                    <!-- Step Form Header -->
                    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                      <!-- Step Form Item -->
                      <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                      
                        <span class="u-shopping-cart-step-form__title">Validar Egreso por Administrador</span>  <!-- titulo del formulario en texto-->
                      </li>
                    </ul>
                    <!-- End Step Form Header -->
        
                    <!-- Step Form Content -->
                    <div id="stepFormContent">
                      <!-- Customer Info -->
                      <div id="newproveedor" class="active">  <!-- asigna un id al bloque donde estan los campos de nuevo proveedor-->
                        
                        <!-- Billing Form -->
                        <div class="row">
                          
                        <div class="col-md-12">   <!--Bloque de Columna son 2 columnas por fila -->
                    <!-- Input Bloque de ingreso de la descripcion del proveedor-->
                    <div class="js-form-message mb-6">
                      <label class="h6 small d-block text-uppercase"><!-- etiqueta del campo de texto  donde se ingresa la descripcion del proveedor -->
                        Sucursal
                      </label>

                      <div class="js-focus-state input-group form">
                      <select class="custom-select" name="SucursalAdministrador" id="SucursalAdministrador" > 
                              <option value ="" selected="true" disabled="disabled" >Sucursal</option>                     
                              <?php
                                    $sql= "SELECT id,numero,direccion from sucursal";
                                    $res=mysqli_query($con,$sql);
                                    while ($data=mysqli_fetch_row($res))
                                            {
                                              $idSucursal = $data[0];
                                              $numSucursal = $data[1];
                                              $nombreSucursal = $data[2];
                                              
                                    ?>
                                              <option disabled="disabled" value="<?php echo $idSucursal; ?>"> <?php echo $numSucursal." ".$nombreSucursal; ?></option>
                                    <?php 	} ?>        
                                              
                            </select> <!-- se asignan identificadores y detalles al select de proveedores -->

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
                                Usuario
                                
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input  class="form-control form__input" type="text" name="usuario" id="usuario"  required
                                        minlength="1"
                                        data-msg="Ingrese usuario Administrador"
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
                              Contraseña
                                </label>
        
                              <div class="js-focus-state input-group form">
                              <input  class="form-control form__input" type="password" name="Contraseña" id="Contraseña" required
                                        
                                        data-msg="Ingrese la Contraseña"
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
                          <!-- End Checkout Form -->
                        
                          <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>
                            <input type="submit" class="btn btn-facebook btn-xs text-center" data-next-step="Editar" value="Validar" name="Editar"></input>
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
