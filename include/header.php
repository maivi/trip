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
			<a class="navbar-brand" href="#">#DECÍNIHUIL</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<?php 
		if ( ( isset( $_SESSION['newsession'] ) )  && ( $_SESSION['newsession']=='yes') ) { 

			?>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<p class="usuario-ingresado"><?php echo $_SESSION['usuario']; ?></p>
					</li>
					<li><a href="#" class="salir-sesion">Salir</a></li>
				</ul>
			</div>
			<?php

		}else{
			?>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<form class="navbar-form navbar-left">
					<div class="form-group">
						<input id="user-login" type="text" class="form-control" placeholder="Usuario">
					</div>
					<div class="form-group">
						<input id="pw-login" type="password" class="form-control" placeholder="Contraseña">
					</div>
					<button type="submit" class="btn btn-default send">ENTRAR</button>
				</form>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#" class="submit1">REGISTRARSE</a></li>
					<li><a href="#" class="submit2">Perdí mi acceso</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
			<?php  
		}
		?>
	</div><!-- /.container-fluid -->
</nav>