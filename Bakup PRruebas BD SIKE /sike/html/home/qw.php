


<!-------------Fin Modales actulizacion de precios por tienda ------------------------------------------->
 <!-- Modal actualizar precios-->
<!-- Signup Modal Window -->
<div id="precio" class="js-signup-modal u-modal-window" style="width: 600px;">
  <!-- Modal Close Button -->
  <button class="btn btn-sm btn-icon btn-text-secondary u-modal-window__close" type="button" onclick="Custombox.modal.close();">
    <span class="fas fa-times"></span>
  </button>
  <!-- End Modal Close Button -->

  <!-- Content -->
  <div class="px-5">
    <form class="js-validate" method="post" action="../validar/update_precio.php" action="post">
      <!-- Signin -->
      <div id="signin" data-target-group="idForm">
               <!-- Logo -->
    <div class="text-center">
      <br>
      <a href="../home/index.html" aria-label="Space">
        <img class="mb-3" src="../imagenes/Logo.png" alt="Logo" width="100" height="80">
      </a>
    </div>
    <!-- End Logo -->
        <!-- Title -->
        <header class="text-center mb-5">
          <h2 class="h4 mb-0">Actualización Precios Productos</h2>
          <p>Todos los campos son necesarios</p>

        </header>
        <!-- End Title -->

     <form class="js-validate" >
  <div class="row">


         <!-- Combobox Producto -->
   <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
         <select name="cbx_codigo" class="custom-select mr-sm-2">
        <option value="0">Pruducto</option>
        <?php while($row = $resultado3->fetch_assoc()) { ?>
          <option value="<?php echo $row['codigo']; ?>"><?php echo $row['codigo']; ?></option>
        <?php } ?>
    </select>
      </div>
    </div>
  </div>
    <!-- End Input -->
    
                <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="costo" required
                 placeholder="Costo"
                 aria-label="Costo"
                 data-msg="Actualice precio Costo"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
    <!-- End Input -->
    
            <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="quiche" required
                 placeholder="Quiche"
                 aria-label="Quiche"
                 data-msg="Actualice precio Quiche"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
    <!-- End Input -->

      <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="xela" required
                 placeholder="Xela"
                 aria-label="Xela"
                 data-msg="Actualice precio Xela"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
       <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="esperanza" required
                 placeholder="La Esperanza"
                 aria-label="La Esperanza"
                 data-msg="Actualice precio La Esperanza"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
          <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="mazate" required
                 placeholder="Mazatenango"
                 aria-label="Mazate"
                 data-msg="Actualice precio Mazatenango"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
          <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="chimal" required
                 placeholder="Chimaltenango"
                 aria-label="Chimaltenango"
                 data-msg="Actualice precio chimaltenango"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
  
          <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="pedro" required
                 placeholder="San Pedro Sac."
                 aria-label="San Pedro Sac."
                 data-msg="Actualice precio San Pedro Sac."
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
    <!-- End Input -->
    
              <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="malacatan" required
                 placeholder="Malacatan"
                 aria-label="Malacatan"
                 data-msg="Actualice precio Malacatan"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
    <!-- End Input -->
    
        
              <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="huehue" required
                 placeholder="Huehuetenango"
                 aria-label="Huehuetenango"
                 data-msg="Actualice precio Huehuetenango"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
    <!-- End Input -->
    
        
              <!-- Input Medidas de producto-->
    <div class="col-sm-4 mb-4">
      <div class="js-form-message">
        <div class="js-focus-state input-group form">
          <input class="form-control form__input" type="text" name="EPS" required
                 placeholder="EPS"
                 aria-label="EPS"
                 data-msg="Actualice precio EPS"
                 data-error-class="u-has-error"
                 data-success-class="u-has-success">
        </div>
      </div>
    </div>
    <!-- End Input -->

 
  <div class="col-lg-10">
       <input value="<?php echo $_SESSION['user'];?>" name="empleado2" type="hidden" class="form-control form-control-sm" id="validationServer01" required>
        </div> 
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-outline-dark btn-wide mb-1">Guardar</button>
  </div>
</form>
</div>
</form>
</div>
</div>
<!--Fin del modal-->