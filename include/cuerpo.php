<div class="contenedor-cuerpo">
	<div class="container-fluid front">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 banner">
				<img src="assets/images/banner-nihuil.png" alt="">
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bases-y-condiciones">
				<a href="assets/file/BBCC_Sorteo_Viajes_Nihuil.pdf"  target="_blank" class="base-click"><span>Bases y Condiciones</span></a>
			</div>
		</div>	

		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pregunta">
				<h4 class="consigna">Consigna #1 - 
					<?php

					$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
						'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

					$arrayDias = array( 'Domingo', 'Lunes', 'Martes',
						'Miercoles', 'Jueves', 'Viernes', 'Sabado');

					echo $arrayDias[date('w')]." ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
					?>

					<div class="container question">

						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								

								<form id="form" class="ac-custom ac-radio ac-circle" autocomplete="off">
									<h2><span id="num">1°</span> PREGUNTA</h2>
									<ul>
										<li><input id="r1" name="r1" type="radio"><label for="r1">1 febrero 1994</label></li>
										<li><input id="r2" name="r1" type="radio"><label for="r2">1 marzo 1994</label></li>
										<li><input id="r3" name="r1" type="radio"><label for="r3">1 febrero 1993</label></li><br>
									</ul>
									<div id="contenedor-boton">
										<button class="btn btn-default" type="submit">Enviar</button>
									</div>

								</form>




							</div>
						</div>
					</div>

					<script src="assets/js/jquery-1.12.min.js"></script>
					<script src="assets/js/classie.js"></script>
					<script src="assets/js/selectFx.js"></script>
					<script src="assets/js/fullscreenForm.js"></script>
					<script src="assets/js/svgcheckbx.js"></script>





				</h4>
			</div>
		</div>
	</div>
</div>