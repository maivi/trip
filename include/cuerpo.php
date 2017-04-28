<div class="contenedor-cuerpo">
	<div class="perdi-cuenta">
		<div class="reg perdi-cuenta-reg">
			<div class="box">
				<div class="container-fluid full-reg">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h1 class="titulo1">PERDÍ MI ACCESO</h1><a class="cerrar" href="#"><img src="assets/images/cerrar.png"/></a>

						</div>
					</div>
				</div> 
			</div>
		</div>

		<div class="padre-usuario-lost">
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>       
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<input type="text" class="form-control" id="usuario-lost"
					placeholder="Nombre de Usuario">
					<p class="help-block text-danger"></p>
				</div>	
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
		</div>
		
		<div class="clearfix"></div>

		<div class="enviar-usuario-perdido">
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="form-group">
					<button  id="perdi-password" type="submit" class="btn btn-default">ENVIAR</button>
				</div>
			</div>          
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
		</div>
		
		<div class="clearfix"></div>

		<div class="respuesta-mail">
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<p></p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 hidden-xs"></div>
		</div>
	</div>
</div>

<div class="container-fluid front">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 banner">
			<img src="assets/images/banner-nihuil.jpg" alt="">
		</div>
	</div>
</div>
<div class="container cuerpo-padding">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bases-y-condiciones">
			<a href="assets/file/BBCC_Sorteo_Viajes_Nihuil.pdf"  target="_blank" class="base-click"><span>Bases y Condiciones</span></a>
		</div>
	</div>	

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pregunta">
			<h4 class="consigna">
				<?php

				$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

				$arrayDias = array( 'Domingo', 'Lunes', 'Martes',
					'Miercoles', 'Jueves', 'Viernes', 'Sabado');

				//echo $arrayDias[date('w')]." ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
				echo $arrayDias[date('w')]." ".date('d')." de ".$arrayMeses[date('m')-1];
				?>

				<div class="container question">

					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contpreg">


							<form id="form" class="ac-custom ac-radio ac-circle" autocomplete="off">
								<h2>Escuchá</h2>
								<p>la programación de la radio para conocer la pregunta de hoy y elegí la opción de respuesta correcta entre…</p>
								<ul>
									<li><input id="r1" name="r1" type="radio"><label for="r1">Respuesta 1</label></li>
									<li><input id="r2" name="r1" type="radio"><label for="r2">Respuesta 2</label></li>
									<li><input id="r3" name="r1" type="radio"><label for="r3">Respuesta 3</label></li><br>
								</ul>
								<div id="contenedor-boton">
									<?php  
									if ( ( isset( $_SESSION['newsession'] ) )  && ( $_SESSION['newsession']=='yes') ) { 
										?>
										<button class="btn btn-default enviar-respuesta" type="submit">Enviar</button>
										<?php
									}else{
										?>
										<button type="submit" class="btn btn-default" id="registrate2">Registrate</button>
										<p>Registrate ahora y participá por el viaje al Caribe para vos y un acompañante con todo pago!
Si ya estás registrado, sólo ingresa tu USER y PASS.</p>
										<?php 
									}
									?>
								</div>

							</form>
						</div>
					</div>
				</div>
			</h4>
		</div>
	</div>
</div>
</div>