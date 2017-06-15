<div class="backnihuil"><a href="http://radionihuil.com.ar/radio/">
<img src="assets/images/backnihuil.png" alt="" />
</a></div>	

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="http://radionihuil.com.ar/">
				<img src="assets/images/logo.png">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<?php 
		if ( ( isset( $_SESSION['newsession'] ) )  && ( $_SESSION['newsession']=='yes') ) { 

			?>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<i class="fa fa-user" aria-hidden="true"></i>
					</li>
					<li>
						<p class="usuario-ingresado"><!--?php echo $_SESSION['usuario']; ?--></p>
					</li>
					<li>
						<a href="#" class="editar-perfil">MI PERFIL</a>
					</li>
					<li><a href="#" class="salir-sesion">SALIR</a></li>
				</ul>
			</div>
			<?php

		}else{
			?>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<form class="navbar-form navbar-left">
					<div class="form-group">
						<input id="user-login" type="email" class="form-control" placeholder="E-Mail">
					</div>
					<div class="form-group">
						<input id="pw-login" type="password" class="form-control" placeholder="Contraseña">
					</div>
					<button type="submit" class="btn btn-default send">ENTRAR</button>
				</form>
				<div class="mensaje-alerta">
					<p>

					</p>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" class="submit1">REGISTRARSE</a></li>
					<li><a href="#" class="submit2">PERDÍ MI ACCESO</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
			<?php  
		}
		?>
	</div><!-- /.container-fluid -->
</nav>

<?php  
if ( ( isset( $_SESSION['newsession'] ) )  && ( $_SESSION['newsession']=='yes') ) {
	?>

	<div class="contenedor-editar">
		<div class="container-fluid">
			<div class="row">	
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<h1 class="titulo1">EDITAR</h1><a id="cerrar-editar" class="cerrar" href="#"><img src="assets/images/cerrar.png"/></a>

				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<form class="form-horizontal form1" role="form">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="nombre">Nombre:</label>
								<input type="text" class="form-control" id="nombre"
								placeholder="Nombre">
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="apellido">Apellido:</label>
								<input type="text" class="form-control" id="apellido"
								placeholder="Apellido">
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="email">Email:</label>
								<input type="email" class="form-control" id="email"
								placeholder="Email">
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="pw">Password:</label>
								<input type="password" class="form-control" id="pw" 
								placeholder="Contraseña">
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="dni">DNI:</label>
								<input type="number" class="form-control" id="dni" 
								placeholder="DNI">
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>



					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="telefono">Telefono:</label>
								<input type="number" class="form-control" id="telefono" 
								placeholder="Teléfono">
								<p class="help-block text-danger"></p>
							</div>
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="localidad">Localidad:</label>
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
								<label for="sexo">Sexo:</label>
								<select class="form-control" name="localidad" id="sexo">
									<option value='1'>Hombre</option>
									<option value='2'>Mujer</option>
								</select>
							</div>
						</div>
					</div>


					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 boton-enviar-form">          
						<div class="form-group">
							<button  id="change-info" type="submit" class="btn btn-default">ACTUALIZAR</button>
						</div>
					</div>

				</form>

			</div>
		</div>
	</div>


			<?php
		}

		?>