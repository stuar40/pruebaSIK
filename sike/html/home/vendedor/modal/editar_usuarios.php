<?php

require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

?>

<!-- Modal -->
<div class="modal fade" id="Modal_Edit_Usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content modal-xl">
      <div class="modal-header">
        <button type="button" id="cerrar" class="close" data-dismiss="modal" aria-label="Close"><span id="span" aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">

        <form class="form-horizontal" method="post" id="editar_usuario" name="editar_usuario">

          <!-- Step Form Header -->
          <ul id="stepFormProgress" class="js-step-progress list-inline u-shopping-cart-step-form mb-4">
            <!-- Step Form Item -->
            <li class="list-inline-item u-shopping-cart-step-form__item mb-3">

              <span class="u-shopping-cart-step-form__title">Actualizar Usuario</span>
            </li>
          </ul>
          <!-- End Step Form Header -->

          <!-- Step Form Content -->
          <div id="stepFormContent">
            <!-- Customer Info -->
            <div id="nuevapersona" class="active">

              <!-- Billing Form -->
              <div class="row">
                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Primer Nombre
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="pnombre2" id="pnombre2" required placeholder="Ingrese Primer Nombre" data-msg="Ingrese Primer Nombre." data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Segundo Nombre
                      <span class="h10 small">(opcional)</span>
                    </label>
                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="snombre2" id="snombre2" placeholder="Ingrese Segundo Nombre">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>



                <div class="w-100"></div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Primer Apellido
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="papellido2" id="papellido2" required placeholder="Ingrese Primer Apellido" data-msg="Por favor ingrese Primer Apellido." data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>


                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Segundo Apellido
                      <span class="h10 small">(opcional)</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="sapellido2" id="sapellido2" placeholder="Ingrese Segundo Apellido">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>



                <div class="w-100"></div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Numero de DPI
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="number" name="cui2" id="cui2" required placeholder="Ingrese Numero de DPI" data-msg="Por favor ingrese el número de DPI." data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Fecha de Nacimiento
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" name="fecha2" id="fecha2" type="date" required data-msg="Por favor ingrese la fecha de nacimiento." data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>



                <div class="w-100"></div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Usuario
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="usuario2" id="usuario2" required placeholder="Ingrese Nombre de Usuario" data-msg="Por favor ingrese Usuario." data-rule-required="true" data-rule-minlength="8" data-rule-maxlength="15" data-msg-minlength="El usuario debe contener al menos 8 caracteres" data-msg-maxlength="El usuario no debe contener más de 15 caracteres" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>




                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Correo Electronico
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="email" name="email2" id="email2" required placeholder="Ingrese Correo Electronico" placeholder="Ingrese Nombre de Usuario" data-rule-email="true" data-msg-email="Ingrese un correo válido" data-error-class="u-has-error" data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>




                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Contraseña
                      <span class="text-danger">*</span>
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="password" name="pass2" id="pass2" required placeholder="Ingrese Contraseña" 
                      data-rule-required="true"
                      data-rule-minlength="6"
                      data-rule-maxlength="15"
                      data-msg-minlength="La contraseña debe contener al menos 6 caracteres"
                      data-msg-maxlength="La contraseña no debe contener más de 15 letras"
                      data-msg="Por Favor Ingrese Una Contraseña." 
                      data-error-class="u-has-error" 
                      data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="w-100"></div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Estado del Usuario
                      <span class="text-danger">*</span>
                    </label>
                    <select class="custom-select" name="estad2" id="estad2">
                      <option selected="true" disabled="disabled">Seleccione Estado</option>
                      <option value="ACTIVO">ACTIVAR</option>
                      <option value="INACTIVO">DESACTIVAR</option>
                    </select>
                  </div>
                  <!-- End Input -->
                </div>


                <div class="col-md-6">
                  <div class="mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Tipo de Usuario
                      <span class="text-danger">*</span>
                    </label>
                    <select class="custom-select" name="rol2" id="rol2">
                      <option selected="true" disabled="disabled">Seleccione tipo de Usuario</option>
                      <?php

                      $sql = "SELECT * FROM roles";
                      $res = mysqli_query($con, $sql);
                      while ($data = mysqli_fetch_row($res)) {
                        $d1 = $data[0];
                        $d2 = $data[1];
                      ?>
                        <option value="<?php echo $d1; ?>"> <?php echo $d2; ?></option>
                      <?php  } ?>
                    </select>
                  </div>
                </div>


                <div class="w-100"></div>

                <!-- Select -->
                <div class="col-md-6">
                  <div class="mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Sucursal
                      <span class="text-danger">*</span>
                    </label>
                    <select class="custom-select" name="sids2" id="sids2">
                      <option selected="true" disabled="disabled">Seleccione Sucursal</option>
                      <?php

                      $sql = "SELECT * from sucursal";
                      $res = mysqli_query($con, $sql);
                      while ($data = mysqli_fetch_row($res)) {
                        $d1 = $data[0];
                        $d2 = $data[1];
                        $d3 = $data[2];
                      ?>
                        <option value="<?php echo $d1; ?>"> <?php echo $d2, "-"; ?> <?php echo $d3, ",  "; ?></option>
                      <?php } ?>

                    </select>
                  </div>
                  <!-- End Select -->
                </div>


                <!-- Select -->
                <div class="col-md-6">
                  <div class="mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Horario
                      <span class="text-danger">*</span>
                    </label>
                    <select class="custom-select" name="hora2" id="hora2">
                      <option selected="true" disabled="disabled">Seleccione Horario</option>
                      <?php

                      $sql = "SELECT  * from horarios";
                      $res = mysqli_query($con, $sql);
                      while ($data = mysqli_fetch_row($res)) {
                        $d1 = $data[0];
                        $d2 = $data[1];

                      ?>
                        <option value="<?php echo $d1; ?>"> <?php echo $d1, "-"; ?> <?php echo $d2 ?></option>
                      <?php } ?>

                    </select>
                  </div>
                  <!-- End Select -->
                </div>



                <div class="w-100"></div>
                <!-- Input -->
                <div class="col-md-6">
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Dirección Domiciliar
                      <span class="text-danger">*</span>
                    </label>
                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" type="text" name="dir2" id="dir2" required placeholder="Ingrese la Dirección del Usuario" data-rule-required="true"
                      data-rule-minlength="2"
                      data-rule-maxlength="75"
                      data-msg-minlength="El la dirección debe contener al menos 6 letras"
                      data-msg-maxlength="El dirección no debe contener más de 75 letras"
                      data-msg="Por favor ingrese una direccion válida." 
                      data-error-class="u-has-error" 
                      data-success-class="u-has-success">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

                <div class="col-md-6">
                  <!-- Input -->
                  <div class="js-form-message mb-6">
                    <label class="h6 small d-block text-uppercase">
                      Número de Teléfono
                    </label>

                    <div class="js-focus-state input-group form">
                      <input class="form-control form__input" name="telefono2" id="telefono2" type="number" placeholder="Ingrese Numero de Telefono"
                      data-rule-minlength="8"
                      data-rule-maxlength="8"
                      data-msg-minlength="El número debe contener al menos 8 digitos"
                      data-msg-maxlength="El número no debe contener más de 8 digitos">
                    </div>
                  </div>
                  <!-- End Input -->
                </div>

              </div>
              <!-- End Billing Form -->
              <!-- idpara editar -->

              <input type="text" name="action" id="action" value="editar_usuario" hidden>
              <input type="text" name="id_usu" id="id_usu" hidden>
              <!-- Buttons -->
              <div class="d-sm-flex justify-content-sm-between align-items-sm-center">

                <input type="submit" class="btn btn-facebook btn-xs text-center" data-next-step="Editar" value="Actualizar" name="Editar"></input>
                <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cerrar</button>

        </form>


      </div>
    </div>
  </div>