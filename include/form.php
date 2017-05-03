    <?php

    include "captcha.php";

    $captcha = new Captcha();

    $datos = $captcha->GenerarCaptcha();

    $_SESSION["pepita"]=$datos->texto;
    ?>

    <div class="reg">
     <div class="box">
      <div class="container-fluid full-reg">
       <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <h1 class="titulo1">REGISTRO</h1><a class="cerrar" href="#"><img src="assets/images/cerrar.png"/></a>

        </div>
      </div>
    </div>              

    <div class="container">
      <div class="row">


        <form class="form-horizontal form1" role="form">

         <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" id="nombre"
              placeholder="Nombre">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" id="apellido"
              placeholder="Apellido">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="email" class="form-control" id="email"
              placeholder="Email">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>



        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">        
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="text" class="form-control" id="user"
              placeholder="Usuario">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="password" class="form-control" id="pw" 
              placeholder="Contraseña">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="number" class="form-control" id="dni" 
              placeholder="DNI">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>



        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <input type="number" class="form-control" id="telefono" 
              placeholder="Teléfono">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>






    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="form-group">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <select class="form-control" name="localidad" id="localidad" placeholder="Ciudad">
            <option value='1'>Ciudad</option>
            <option value='2'>General Alvear</option>
            <option value='3'>Godoy Cruz</option>
            <option value='4'>Guaymallén</option>
            <option value='5'>Junín</option>
            <option value='6'>La paz</option>
            <option value='7'>Las Heras</option>
            <option value='8'>Lavalle</option>
            <option value='9'>Luján de Cuyo</option>
            <option value='10'>Maipú</option>
            <option value='11'>Malargüe</option>
            <option value='12'>Rivadavia</option>
            <option value='13'>San Carlos</option>
            <option value='14'>San Martín</option>
            <option value='15'>San Rafael</option>
            <option value='16'>Santa Rosa</option>
            <option value='17'>Tunuyán</option>
            <option value='18'>Tupungato</option>
          </select>
        </div>
      </div>
    </div>

    



    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
     <div class="form-group">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <select class="form-control" name="localidad" id="sexo">
          <option value='1'>Hombre</option>
          <option value='2'>Mujer</option>

        </select>
      </div>
    </div>
  </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="form-group">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 imgcap">
            <img id="<?php echo $datos->texto; ?>" src="pepe/<?=$datos->captcha?>">
          </div>
        </div>
      </div>


      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <div class="form-group captcha-message">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
          <input type="text" class="form-control"  id="captcha" value="">
        </div>
      </div>
    </div>




  <div id="success"></div>


  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boton-enviar-form">          
    <div class="form-group">
      <button  id="register" type="submit" class="btn btn-default">ENVIAR</button>
    </div>
  </div>

</form>



</div><!--fin row -->
</div><!--fin container -->
</div><!--fin box -->
</div><!--fin reg -->
