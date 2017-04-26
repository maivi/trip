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
				<a href="#" class="base-click"><span>Bases y Condiciones</span></a>
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
				</h4>
			</div>
		</div>
	</div>
</div>