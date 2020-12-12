<?php

require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

?>

<!-- Modal -->
<div class="modal fade" id="Modal_editarProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <!-- etiqueta y de id al modal -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-xl">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelProveedores"></h5>
        <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body">

        <!-- Checkout Form -->
        <form class="form-horizontal" method="post" id="actualizar_cliente" name="actulizar_cliente">
          <!-- Step Form Header -->
          <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
            <!-- Step Form Item -->
            <li class="list-inline-item u-shopping-cart-step-form__item mb-3">

              <span class="u-shopping-cart-step-form__title">Editar Cliente</span> <!-- titulo del formulario en texto-->
            </li>
          </ul>
          <!-- End Step Form Header -->

          <!-- Step Form Content -->
          <div id="stepFormContent">
            <!-- Customer Info -->
            <div id="newproveedor" class="active">
              <!-- asigna un id al bloque donde estan los campos de nuevo proveedor-->

              <!-- Billing Form -->
              <div class="row">
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Nombres
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="nombresCliente2" id="nombresCliente2" required placeholder="Ingrese Nommbre(s) del Cliente" data-msg="Ingrese Nommbre(s) del Cliente" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Apellidos
                      <span class="text-danger">*</span>
                    </label>
                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="apellidosCliente2" id="apellidosCliente2"
                       placeholder="Ingrese apellido(s) del Cliente"
                       data-rule-required="true"
                      data-rule-minlength="2"
                      data-rule-maxlength="50"
                      data-msg-minlength="Los apellidos deben contener al menos 2 letras"
                      data-msg-maxlength="Los apellidos no deben contener más de 50 letras"
                      data-msg="Por favor ingrese los apellidos del cliente." 
                      data-error-class="u-has-error" 
                      data-success-class="u-has-success"
                       >
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      NIT
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="nitCliente2" id="nitCliente2" required placeholder="Ingrese NIT del Cliente" data-msg="Por favor ingrese NIT del Cliente."  data-rule-required="true"
                      data-rule-minlength="3"
                      data-rule-maxlength="13"
                       data-msg="Por favor ingrese un NIT válido" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Telefono
                      <span class="h10 small">(opcional)</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="telefonoCliente2" id="telefonoCliente2" 
                      placeholder="Ingrese Telefono o Celular del Cliente"
                      data-rule-minlength="8"
                      data-rule-maxlength="8"
                      data-msg-minlength="El número debe contener al menos 8 digitos"
                      data-msg-maxlength="El número no debe contener más de 8 digitos">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="w-100"></div>
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Dirección
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="direccionCliente2" id="direccionCliente2" required placeholder="Ingrese dirección del Cliente" data-rule-required="true"
                      data-rule-minlength="6"
                      data-rule-minlength="40"
                      data-msg="Por favor ingrese una dirección válida" 
                      data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Correo
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" name="emailCliente2" id="emailCliente2" type="email2" required 
                      placeholder="Ingrese Email del Cliente" data-rule-email="true"
                      data-msg-email="Por favor ingrese email un válido" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>
                <div class="w-100"></div>
                <div class="w-100"></div>
                <div class="w-100"></div>
              </div>
              <!-- End Billing Form -->

              <!-- Buttons -->
              <div class="d-sm-flex justify-content-sm-center align-items-sm-center">
                <input type="submit" class="btn btn-facebook btn-xs text-center" data-next-step="agregar" value="Actualizar" id="btnActulizar" name="Actualizar"></input>
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


      </div>
      <!--div del modalbody-->
    </div>
    <!--div del modalcontent-->
  </div>
  <!--div del modaldialog-->
</div>
</div>
<!--div del modal-->