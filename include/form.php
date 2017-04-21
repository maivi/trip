<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4">
			<div class="reg">

				<FORM action="#" method="post">
					<P>
						<LABEL for="nombre">Nombre: </LABEL>
						<INPUT type="text" id="nombre"><BR>

						<LABEL for="apellido">Apellido: </LABEL>
						<INPUT type="text" id="apellido"><BR>

						<LABEL for="email">E-mail: </LABEL>
						<INPUT type="email" id="email"><BR>

						<LABEL for="password">Contraseña: </LABEL>
						<INPUT type="password" id="pw"><BR>		

						<LABEL for="dni">D.N.I: </LABEL>
						<INPUT type="number" id="dni"><BR>

						<LABEL for="telefono">Teléfono: </LABEL>
						<INPUT type="number" id="telefono"><BR>	

						<LABEL for="localidad">Localidad: </LABEL>	
						<select name="localidad" onchange="salta(this.form)">
                            <option selected> ---
                            <option value="xxxx.htm">Gral Alvear
                            <option value="yyyy.htm">Ciudad
                            <option value="zzzz.htm">Godoy Cruz
                        </select>

                        <LABEL for="sexo">Sexo: </LABEL>	
						<select name="sexo" onchange="salta(this.form)">
                            <option selected> ---
                            <option value="xxxx.htm">Hombre
                            <option value="yyyy.htm">Mujer
                        </select>

						<INPUT type="submit" value="Enviar">
					</P>
				</FORM>


			</div>
		</div>
	</div>
</div>