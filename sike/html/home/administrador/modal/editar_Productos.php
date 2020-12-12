<?php    

require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

?>
	
<!-- Modal -->
	<div class="modal fade" id="Modal_editarProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 	<!-- etiqueta y de id al modal -->
	  <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-xl">
            <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelProveedores"></h5>
                    <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
            </div>
        
          <div class="modal-body">

            <!-- Checkout Form -->
            <form class="form-horizontal" method="post" id="actualizar_producto" name="actulizar_producto">
                    <!-- Step Form Header -->
                    <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
                      <!-- Step Form Item -->
                      <li class="list-inline-item u-shopping-cart-step-form__item mb-3">
                      
                        <span class="u-shopping-cart-step-form__title">Editar Producto</span>  <!-- titulo del formulario en texto-->
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
                                Nombre del producto
                                <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input class="form-control form__input" type="text" name="eproducto" id="eproducto" required
                                      placeholder="Ingrese Nombre del producto"
                                      data-msg="Ingrese Nombre del producto."
                                      data-error-class="u-has-error"
                                      data-success-class="u-has-success">     <!-- se asignan identificadores y detalles al campo de texto del nombre comercial del proveedor -->
                              </div> 
                            </div>
                            <!-- End Input -->
                          </div>
        
                          <div class="col-md-6">
                      
                            <div class="js-form-message mb-6">
                              <label class="h6 small d-block text-uppercase"> <!-- etiqueta del campo de texto  donde se almacena el NIT comercial del proveedor -->
                              Descripcion del producto
                              <span class="text-danger">*</span>
                              </label>
                              <div class="js-focus-state input-group form">
                                <input class="form-control form__input" 
                                type="text" name="edescripcion" id="edescripcion" required
                                                               
                                      placeholder="Ingrese descripcion del producto"> <!-- se asignan identificadores y detalles al campo de texto del NIT  comercial del proveedor -->
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
                               Presentacion del producto
                               <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input class="form-control form__input" type="text" name="epresentacion" id="epresentacion" 
                                      placeholder="Ingrese Presentacion del producto"
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
                               Marca
                               <span class="text-danger">*</span>
                              </label>
        
                              <div class="js-focus-state input-group form">
                                <input class="form-control form__input" type="tel" name="emarca" id="emarca" minlength="3" maxlength="12"
                                      placeholder="Ingrese No. de Telefono"> <!-- se asignan identificadores y detalles al campo de texto del No telefono del proveedor -->
                              </div>
                            </div>
                            <!-- End Input -->
                          </div>
        
        
            
                          <div class="w-100"></div>   <!-- Bloque de ancho de la fila -->
                          <div class="col-md-6">
                    <div class="mb-6">
                     <label class="h6 small d-block text-uppercase">
                       Categoria
                       <span class="text-danger">*</span>
                     </label>
                 <select class="form-control input-sm" name="ecategoria" id="ecategoria"  >

             <option value="0" disabled ="true" selected = "selected">Seleccionar</option>
               
             <?php
		
		$sql= "SELECT * FROM categoria";
		$res=mysqli_query($con,$sql);
			while ($data=mysqli_fetch_array($res))
										{

											$d1 = $data['id'];
											$d2 = $data['nombre'];
										
?>

<option value="<?php echo $d1; ?>"> <?php echo $d2; ?></option>
<?php
										}
												?>

</select>
                     </div>
                   <!-- End Select -->
                    </div>






                    <div class="col-md-6">
                    <div class="mb-6">
                     <label class="h6 small d-block text-uppercase">
                       Sub-Categoria
                       <span class="text-danger">*</span>
                     </label>
                 <select class="form-control input-sm" name="esubcategoria" id="esubcategoria"  >

             <option value="0" disabled ="true" selected = "selected">Seleccionar</option>
               
             <?php
		
		$sql= "SELECT  s.id,s.nombre FROM producto p INNER JOIN subcategoria s
        ON p.subcategoria_id = s.id";
		$res=mysqli_query($con,$sql);
			while ($data=mysqli_fetch_array($res))
										{

											$d1 = $data['id'];
											$d2 = $data['nombre'];
										
?>

<option value="<?php echo $d1; ?>"> <?php echo $d2; ?></option>
<?php
										}
												?>

</select>
                     </div>
                   <!-- End Select -->
                    </div>
        
        
        
                          <div class="w-100"></div>


                          <div class="col-md-6">
                    <div class="mb-6">
                     <label class="h6 small d-block text-uppercase">
                       Estado
                       <span class="text-danger">*</span>
                     </label>
                 <select class="form-control input-sm" name="eestado" id="eestado"  >

             <option value="0" disabled ="true" selected = "selected">Seleccionar</option>
               
             <?php
		
		$sql= "SELECT * FROM estado_prod";
		$res=mysqli_query($con,$sql);
			while ($data=mysqli_fetch_array($res))
										{

											$d1 = $data['id'];
											$d2 = $data['estado'];
										
?>

<option value="<?php echo $d1; ?>"> <?php echo $d2; ?></option>
<?php
										}
												?>

</select>
                     </div>
                   <!-- End Select -->
                    </div>

    
                          
                        
                            
                        </div>
                    
                        <!-- Buttons -->
                        <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                          <input type="submit" class="btn btn-facebook btn-xs text-center"  data-next-step="agregar" value="Actualizar" id="btnActulizar" name="Actualizar"></input>
                          <!-- End Checkout Form -->
                          <input type="text" id="eid" name="eid" hidden>
                          <input type="text" id="action" name="action" value="editar" hidden>
                          <!-- Buttons -->
                          <div class="d-sm-flex justify-content-sm-between align-items-sm-center">
                            <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal" id="cerrar" name="cerrar">Cerrar</button>
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

