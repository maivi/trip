var nombre;
var apellido;
var email;
var dni;
var telefono;
var localidad;
var pw;
var user;
var sexo;
var flag=0;
var json2;
var hoy = new Date();
var dia = hoy.getDate();
var rellenar = $("#form").find("ul");
var clicks=0;
var captcha_google="";

function correctCaptcha(response) {
	captcha_google = response;
};

$(document).ready(function(){
	$.ajax({
		url: "include/id_pregunta.php",
		method: "POST"
	}).done(function(json){
		var objeto = $.parseJSON(json);
		if(localStorage["ultimo_id"]!=objeto["id_pregunta"]){
			localStorage["ultimo_id"]=objeto["id_pregunta"];
			localStorage["respondida"]="No";
		}
	});


	//Comprobamos que no exista los localstorage
	if ( ( (typeof localStorage["respondida"])==="undefined") ){
		localStorage["respondida"]= "No";
	}

	if(localStorage["logged"] == "Si"){
		$(".usuario-ingresado").empty();
		$(".usuario-ingresado").text(localStorage["usuario"]);
	}
	

	if ((localStorage["respondida"] == "Si") && (localStorage["logged"] == "Si")) {
		$("#form").find("ul").empty();
		$("#form").find("h2").empty();
		$("#form").find("p").empty();
		$("#form").find("h2").append("Gracias por participar. Volvé mañana por una nueva pregunta");
		$("#contenedor-boton").empty();
		$(".cuerpo-padding").addClass("enviada");
	}

	if ( ( (typeof localStorage["resp_1"])!="undefined") && ( (typeof localStorage["resp_2"])!="undefined" ) && ( (typeof localStorage["resp_3"])!="undefined" ) && (localStorage["ultimo_dia"] == dia) ){
		if ((localStorage["respondida"]=="Si") && (localStorage["logged"] == "Si") ){
			$("#form").find("ul").empty();
			$("#form").find("h2").empty();
			$("#form").find("h2").append("Gracias por participar. Volvé mañana por una nueva pregunta");
			$("#contenedor-boton").empty();
		}

		// Si es el mismo día, directamente trae las respuestas cacheadas
		rellenar.find("li:nth-child(1)").find("label").empty();
		rellenar.find("li:nth-child(1)").find("label").append(localStorage["resp_1"]);
		rellenar.find("li:nth-child(2)").find("label").empty();
		rellenar.find("li:nth-child(2)").find("label").append(localStorage["resp_2"]);
		rellenar.find("li:nth-child(3)").find("label").empty();
		rellenar.find("li:nth-child(3)").find("label").append(localStorage["resp_3"]);


	}

	$.ajax({
		url: "include/logica.php",
		method: "POST"
	})
	.done(function(json) {
		//Cache de las localidades y los sexos
		var objeto = $.parseJSON(json);
		var constructor;
		if ( (localStorage["respondida"]=="Si") && (localStorage["logged"] == "Si") ){
			$("#form").find("ul").empty();
			$("#form").find("h2").empty();
			$("#form").find("h2").append("Gracias por participar. Volvé mañana por una nueva pregunta");
			$("#contenedor-boton").empty();
		}

		if ( ( (typeof localStorage["ultimo_id"])==="undefined") && ( (typeof localStorage["ultimo_dia"])==="undefined" ) ){
			// Creamos los 2 localstorage para Dia e ID
			localStorage["ultimo_id"] = objeto[0]["id_ultima_pregunta"];
			localStorage["ultimo_dia"] = dia;
		}

		//Checkeamos si estan creados los localstorages de las preguntas para cachearlos
		if ( ( (typeof localStorage["resp_1"])==="undefined") && ( (typeof localStorage["resp_2"])==="undefined" ) && ( (typeof localStorage["resp_3"])==="undefined" ) ){
			console.log("Entro");
			$.ajax({
				url: "include/logica_respuestas.php",
				data: {
					id:localStorage["ultimo_id"]
				},
				method: "POST"
			})
			.done(function(test){
				var objeto = $.parseJSON(test);
				localStorage["resp_1"] = objeto[0]["resp_1"];
				localStorage["resp_2"] = objeto[0]["resp_2"];
				localStorage["resp_3"] = objeto[0]["resp_3"];

				// Cacheamos las respuestas para no tener que volver a realizar las consultas

				rellenar.find("li:nth-child(1)").find("label").empty();
				rellenar.find("li:nth-child(1)").find("label").append(localStorage["resp_1"]);
				rellenar.find("li:nth-child(2)").find("label").empty();
				rellenar.find("li:nth-child(2)").find("label").append(localStorage["resp_2"]);
				rellenar.find("li:nth-child(3)").find("label").empty();
				rellenar.find("li:nth-child(3)").find("label").append(localStorage["resp_3"]);

				//Aca cambiamos las preguntas con las ya cacheadas
			})
			.fail(function(xhr, status, error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				console.log("FAIL");
			});
		}else{
			// Si existe el localstorage, comprobamos el dia para realizar el cambio de id de pregunta
			if(localStorage["ultimo_dia"] != dia){
				$.ajax({
					url: "include/ultimo_dia.php",
					method: "POST"
				}).done(function(json) {
					var objeto = $.parseJSON(json);
					localStorage["ultimo_id"] = objeto[0]["id_ultima_pregunta"];
					localStorage["ultimo_dia"] = dia;
					//Nuevamente, cacheamos las respuestas de ese dia

					$.ajax({
						url: "include/logica_respuestas.php",
						data: {
							id:localStorage["ultimo_id"]
						},
						method: "POST"
					})
					.done(function(json){
						var objeto = $.parseJSON(json);
						console.log(objeto);
						localStorage["resp_1"] = objeto[0]["resp_1"];
						localStorage["resp_2"] = objeto[0]["resp_2"];
						localStorage["resp_3"] = objeto[0]["resp_3"];
						rellenar.find("li:nth-child(1)").find("label").empty();
						rellenar.find("li:nth-child(1)").find("label").append(localStorage["resp_1"]);
						rellenar.find("li:nth-child(2)").find("label").empty();
						rellenar.find("li:nth-child(2)").find("label").append(localStorage["resp_2"]);
						rellenar.find("li:nth-child(3)").find("label").empty();
						rellenar.find("li:nth-child(3)").find("label").append(localStorage["resp_3"]);
					})
					.fail(function(xhr, status, error){
						console.log(xhr);
						console.log(status);
						console.log(error);
						console.log("FAIL");
					});
					localStorage["respondida"]="No";
				});
			}else{
				$.ajax({
					url: "include/logica_respuestas.php",
					data: {
						id:localStorage["ultimo_id"]
					},
					method: "POST"
				})
				.done(function(json){
					var objeto = $.parseJSON(json);
					localStorage["resp_1"] = objeto[0]["resp_1"];
					localStorage["resp_2"] = objeto[0]["resp_2"];
					localStorage["resp_3"] = objeto[0]["resp_3"];
					rellenar.find("li:nth-child(1)").find("label").empty();
					rellenar.find("li:nth-child(1)").find("label").append(localStorage["resp_1"]);
					rellenar.find("li:nth-child(2)").find("label").empty();
					rellenar.find("li:nth-child(2)").find("label").append(localStorage["resp_2"]);
					rellenar.find("li:nth-child(3)").find("label").empty();
					rellenar.find("li:nth-child(3)").find("label").append(localStorage["resp_3"]);
				})
				.fail(function(xhr, status, error){
					console.log(xhr);
					console.log(status);
					console.log(error);
					console.log("FAIL");
				});
				localStorage["respondida"]="No";

			}
		}
	})
.fail(function(xhr, status, error){
	console.log(xhr);
	console.log(status);
	console.log(error);
	console.log("FAIL");
});



	//Comprobamos cual es la opcion elegida
	var clickeados;
	
	$(".enviar-respuesta").click(function(e){
		e.preventDefault();
		clickeados = $("#form ul input[type='radio']:checked");
		var reemplazar;
		var aumentador = 0;
		var restar;

		clickeados.each(function(){
			reemplazar=$(this)[0].id;
			reemplazar = reemplazar.replace("r","");
			reemplazar = parseInt(reemplazar);
		});

		$.ajax({
			url: "include/enviar_respuesta.php",
			data: {
				respuesta: reemplazar,
				id_pregunta: localStorage["ultimo_id"]
			},
			method: "POST"

		}).done(function(json) {
			var objeto = $.parseJSON(json);
			localStorage["respondida"] = "Si";
			$("#form").find("ul").empty();
			$("#form").find("h2").empty();
			$("#form").find("h2").append("Gracias por participar. Volvé mañana por una nueva pregunta");
			$("#contenedor-boton").empty();
			$(".ocultar").empty();
			$(".cuerpo-padding").addClass("enviada");

		})
		.fail(function(xhr, status, error){

		});
	});


	$("#registrate2").click(function(e){
		e.preventDefault();

		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
		
		$(".submit1").click();
	});
	

	$(".salir-sesion").click(function(e){
		e.preventDefault();
		$.ajax({
			url: "include/salir.php",
			method: "POST"

		}).done(function(){
			localStorage["logged"] = "No";
			localStorage["respondida"] = "No";
			window.location="index.php";
			
		}).fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});



	$(".submit1").click(function(e){ //REGISTRATE
		localStorage["logged"] = "No";
		e.preventDefault();
		$(".navbar-toggle").click();
		if(screen.width<768){
			$(".cuerpo-padding+.reg").find(".box").css("height","900px");
		}else{
			$(".cuerpo-padding+.reg").find(".box").css("height","700px");
		}
		$(".cuerpo-padding+.reg").animate({
			top: 100
		},500);
		
		$(".perdi-cuenta").css("display","none");
		$(".cuerpo-padding+.reg").css("display","block");
		$(".perdi-cuenta-reg").css("top","-850px");
	});

	$(".submit2").click(function(e){ //PERDI ACCESO
		e.preventDefault();
		
		$(".cuerpo-padding+.reg").find(".box").css("height","0px");
		$(".navbar-toggle").click();
		
		$(".perdi-cuenta").animate({
			top: 100
		},500);
		$(".cuerpo-padding+.reg").css("display","none");
		$(".perdi-cuenta").css("display","block");
		
		$(".cuerpo-padding+.reg").css("top","-850px");

	});

	$("#perdi-password").click(function(e){
		e.preventDefault();
		email = $("#usuario-lost").val();
		if(email!=""){
			$.ajax({
				url: "include/perdi_pass.php",
				method: "POST",
				data: {
					email: email
				}
			}).done(function(json){
				var objeto = $.parseJSON(json);
				if(objeto[0]["existe"]=="no"){
					$(".respuesta-mail").find("p").text("Email Inexistente.");
				}else{
					$(".respuesta-mail").find("p").text("Revisa tu correo para recuperar tu contraseña.");
				}
			}).fail(function(xhr, status, error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				console.log("FAIL");
			});
		}else{
			$("#usuario-lost").parent().addClass("has-error");
		}
	});

	$(".cerrar").click(function(e){
		e.preventDefault();
		$(".perdi-cuenta-reg").css("top","-850px");		
		$(".cuerpo-padding+.reg").css("display","block");
	});

	$(".cuerpo-padding+.reg").find(".cerrar").click(function(e){
		e.preventDefault();
		$(".cuerpo-padding+.reg").css("top","-850px");
		
		$(".perdi-cuenta").css("display","block");
	})


	//LOGIN
	$(".send").click(function(e){
		e.preventDefault();
		email = $("#user-login").val();
		pw = $("#pw-login").val();
		if ( (email != "") && (pw != "") ){
			$.ajax({
				url: "include/logica_login.php",
				data: {
					pw:pw,
					email:email,
					id_pregunta: localStorage["ultimo_id"],
					flag:0
				},
				method: "POST"

			}).done(function(json) {
				var obj = $.parseJSON(json);
				if(obj["cantidad"]==1){
					localStorage["respondida"] = "Si";
				}else{
					localStorage["respondida"] = "No";
				}
				if(obj["existe"]==0){
					var eliminar = $(".mensaje-alerta").find("p");
					eliminar.empty();
					eliminar.append("Usuario o Password incorrecto");	
				}else{
					localStorage["logged"] = "Si";
					localStorage["usuario"] = obj["nombre_usuario"];
					window.location="index.php";
				}
				localStorage["remember"]=obj["id"];
			})
			.fail(function(xhr, status, error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				console.log("FAIL");
			});
		}
		
	})

	$(".perdi-cuenta").find(".cerrar").click(function(){
		$(".perdi-cuenta").animate({
			top: "-100%"
		})
	});


	$("#register").click(function(e){
		e.preventDefault();
		nombre = $("#nombre").val();
		apellido = $("#apellido").val();
		email = $("#email").val();
		dni = $("#dni").val();
		telefono = $("#telefono").val();
		localidad = $("#localidad").val();
		pw = $("#pw").val();
		sexo = $("#sexo").val();
		localStorage["logged"] = "No";
		console.log(localidad);
		console.log(captcha_google);
		if (captcha_google==""){
			$("#success").empty();
			$("#success").append("<p>Captcha Incorrecto</p>");
		}
		if ( (nombre!="") && (apellido!="") && (email!="") && (dni!="") && (telefono!="") && (pw!="") && (localidad!==null) && (captcha_google!="") ){
			$.ajax({ 
				url: "include/control_usuario.php",
				data: {
					email:email
				},
				method: "POST"
			}).done(function(json){
				var obj2 = $.parseJSON(json);
				console.log(obj2);
				user = $("#email").val();
				if(obj2["usuario"]==1){
					var user = $("#email");
					user.parent().parent().addClass("has-error");
				}else{
					$.ajax({
						url: "include/logica_login.php",
						data: {
							nombre: nombre, 
							apellido: apellido,
							email: email,
							dni: dni,
							telefono: telefono,
							localidad: localidad,
							pw:pw,
							sexo:sexo,
							cap:captcha_google,
							flag:1
						},
						method: "POST"

					}).done(function(json) {
						var obj3 = $.parseJSON(json);
						console.log(obj3);
						console.log(obj3["cap"]);
						
						localStorage["logged"] = "Si";
						localStorage["usuario"] = obj3["nombre_usuario"];
						localStorage["remember"] = obj3["id"];
						window.location="index.php";

					})
					.fail(function(xhr, status, error){
						console.log(xhr);
						console.log(status);
						console.log(error);
						console.log("FAIL");
					});
				}

			}).fail(function(xhr, status, error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				console.log("FAIL");
			});
		}else{
			console.log("ENTRO SIN CAPTCHA");
			nombre=$("#nombre");
			if(nombre.val()==""){
				if(!( nombre.parent().parent().hasClass("has-error") ) ){
					nombre.parent().parent().addClass("has-error");
				}
			}else{
				nombre.parent().parent().removeClass("has-error");
			}

			apellido=$("#apellido");
			if(apellido.val()==""){
				if(!( apellido.parent().parent().hasClass("has-error") ) ){
					apellido.parent().parent().addClass("has-error");
				}
			}else{
				apellido.parent().parent().removeClass("has-error");
			}

			email=$("#email");
			if(email.val()==""){
				if(!( email.parent().parent().hasClass("has-error") ) ){
					email.parent().parent().addClass("has-error");
				}
			}else{
				email.parent().parent().removeClass("has-error");
			}


			dni=$("#dni");
			if(dni.val()==""){
				if(!( dni.parent().parent().hasClass("has-error") ) ){
					dni.parent().parent().addClass("has-error");
				}
			}else{
				dni.parent().parent().removeClass("has-error");
			}


			telefono=$("#telefono");
			if(telefono.val()==""){
				if(!( telefono.parent().parent().hasClass("has-error") ) ){
					telefono.parent().parent().addClass("has-error");
				}
			}else{
				telefono.parent().parent().removeClass("has-error");
			}


			pw=$("#pw");
			if(pw.val()==""){
				if(!( pw.parent().parent().hasClass("has-error") ) ){
					pw.parent().parent().addClass("has-error");
				}
			}else{
				pw.parent().parent().removeClass("has-error");
			}


			user=$("#user");
			if(user.val()==""){
				if(!( user.parent().parent().hasClass("has-error") ) ){
					user.parent().parent().addClass("has-error");
				}
			}else{
				user.parent().parent().removeClass("has-error");
			}

			localidad=$("#localidad");
			if(localidad.val()===null){
				if(!( localidad.parent().parent().hasClass("has-error") ) ){
					localidad.parent().parent().addClass("has-error");
				}
			}else{
				localidad.parent().parent().removeClass("has-error");
			}

		}
		
		
	});

	var target=$(".navbar-collapse");

	$(".navbar-toggle").click(function(e){
		e.preventDefault();
		if (target.hasClass("in")){
			target.removeClass("in");
			clicks=1;
		}else{
			if(clicks==1){
				target.addClass("in");
			}
		}

	});

	$("#ingress-history").click(function(e){
		var user_history = $("#nombre-history").val();
		var pass_history = $("#password-usuario").val();
		if ( (user_history!="") && (pass_history!="") ){
			$.ajax({ 
				url: "include/comprobacion.php",
				data: {
					user:user_history,
					pass:pass_history,
					flag: 0
				},
				method: "POST"
			}).done(function(json){
				var obj = $.parseJSON(json);
				if(obj["entro"]==1){
					window.location="history";
				}else{
					$(".history-incorrecto").empty();
					$(".history-incorrecto").append("USUARIO INCORRECTO");
				}
			});
		}
	});

	$("#ingress-up").click(function(e){
		var user_history = $("#nombre-up").val();
		var pass_history = $("#password-up").val();
		if ( (user_history!="") && (pass_history!="") ){
			$.ajax({ 
				url: "include/comprobacion.php",
				data: {
					user:user_history,
					pass:pass_history,
					flag: 1
				},
				method: "POST"
			}).done(function(json){
				var obj = $.parseJSON(json);
				if(obj["entro"]==1){
					window.location="up";
				}else{
					$(".history-incorrecto").empty();
					$(".history-incorrecto").append("USUARIO INCORRECTO");
				}
			});
		}
	});

	
	$("#incrementar").click(function(e){
		$.ajax({ 
			url: "include/incrementar.php",
			method: "POST"
		}).done(function(json){
			var obj = $.parseJSON(json);
			$(".up-mensaje").empty();
			$(".up-mensaje").append("El ID anterior era: "+obj["id_antes"]);
			$(".up-mensaje").append(". Fue incrementado a: "+obj["id_despues"]);
			
		});
	});

	$("#testeando").click(function(e){
		console.log("CLICK");
		e.preventDefault();
		
		$.ajax({
			url: "include/salir.php",
			method: "POST"

		}).done(function(){
			window.location="history";
			
		}).fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});

	$(".salir-sesion-history").click(function(f){
		console.log("CLICK");
		f.preventDefault();
		
		$.ajax({
			url: "include/salir.php",
			method: "POST"

		}).done(function(){
			window.location="history";
			
		}).fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});


	$(".salir-sesion-up").click(function(e){ 
		e.preventDefault();
		$.ajax({
			url: "include/salir.php",
			method: "POST"

		}).done(function(){
			window.location="up";
			
		}).fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});

	
	$(".editar-perfil").click(function(e){
		e.preventDefault();
		$(".contenedor-editar").animate({
			top: "60px"
		},500);
		$.ajax({
			url: "include/info_user.php",
			method: "POST",
			data: {
				id:localStorage["remember"]
			}

		}).done(function(json){
			var obj = $.parseJSON(json);
			console.log(obj);
			$("#nombre").val(obj["nombre"]);
			$("#apellido").val(obj["apellido"]);
			$("#email").val(obj["email"]);
			$("#dni").val(obj["dni"]);
			$("#telefono").val(obj["telefono"]);
			$("#localidad").val(obj["localidad"]);
			$("#pw").val("");
			$("#user").val(obj["user"]);
			$("#sexo").val(obj["sexo"]);
			
		})
	})

	$("#change-info").click(function(e){
		e.preventDefault();
		nombre = $("#nombre").val();
		apellido = $("#apellido").val();
		email = $("#email").val();
		dni = $("#dni").val();
		telefono = $("#telefono").val();
		localidad = $("#localidad").val();
		pw = $("#pw").val();
		sexo = $("#sexo").val();

		if ( (nombre!="") && (apellido!="") && (email!="") && (dni!="") && (telefono!="") && (pw!="")){
			$.ajax({ 
				url: "include/actualizar_user.php",
				data: {
					nombre: nombre,
					apellido: apellido,
					email: email,
					dni: dni,
					telefono: telefono,
					localidad: localidad,
					pw: pw,
					sexo: sexo,
					id: localStorage["remember"]
				},
				method: "POST"
			}).done(function(json){
				var obj = $.parseJSON(json);
				$(".usuario-ingresado").empty();
				$(".usuario-ingresado").append(obj["nombre"]);
				localStorage["usuario"]=obj["nombre"];
				$("#cerrar-editar").click();				
			}).fail(function(xhr, status, error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				console.log("FAIL");
			});
		}else{
			nombre=$("#nombre");
			if(nombre.val()==""){
				if(!( nombre.parent().parent().hasClass("has-error") ) ){
					nombre.parent().parent().addClass("has-error");
				}
			}else{
				nombre.parent().parent().removeClass("has-error");
			}

			apellido=$("#apellido");
			if(apellido.val()==""){
				if(!( apellido.parent().parent().hasClass("has-error") ) ){
					apellido.parent().parent().addClass("has-error");
				}
			}else{
				apellido.parent().parent().removeClass("has-error");
			}

			email=$("#email");
			if(email.val()==""){
				if(!( email.parent().parent().hasClass("has-error") ) ){
					email.parent().parent().addClass("has-error");
				}
			}else{
				email.parent().parent().removeClass("has-error");
			}


			dni=$("#dni");
			if(dni.val()==""){
				if(!( dni.parent().parent().hasClass("has-error") ) ){
					dni.parent().parent().addClass("has-error");
				}
			}else{
				dni.parent().parent().removeClass("has-error");
			}


			telefono=$("#telefono");
			if(telefono.val()==""){
				if(!( telefono.parent().parent().hasClass("has-error") ) ){
					telefono.parent().parent().addClass("has-error");
				}
			}else{
				telefono.parent().parent().removeClass("has-error");
			}


			pw=$("#pw");
			if(pw.val()==""){
				if(!( pw.parent().parent().hasClass("has-error") ) ){
					pw.parent().parent().addClass("has-error");
				}
			}else{
				pw.parent().parent().removeClass("has-error");
			}

		}
	});


	$("#cerrar-editar").click(function(e){
		e.preventDefault();
		$(".contenedor-editar").animate({
			top: "-100%"
		},500)
	});


	var grafico = $("#canvas").clone();
	$("#canvas").remove();
	$(".grafico").append(grafico);
	var header = $(".statistics").find(".navbar.navbar-default").clone();
	$(".statistics").find(".navbar.navbar-default").remove();
	var titulo = $(".titulo_estadisticas").clone();
	$(".titulo_estadisticas").remove();
	var estadisticas = $(".tabla_estadisticas").clone();
	$(".tabla_estadisticas").remove();
	var tabla_sexos = $(".table-sexos").clone();
	$(".table-sexos").remove();
	$(".statistics").prepend("<div class='container estadisticas-tabla' style='height: auto;clear:both;'></div>");
	$(".statistics").find(".estadisticas-tabla").prepend(estadisticas);
	
	$(".statistics").prepend("<div class='container sexos-tabla' style='height: auto;clear:both;'></div>");
	$(".statistics").find(".sexos-tabla").prepend(tabla_sexos);

	$(".statistics").prepend(titulo);
	$(".statistics").prepend(header);

	//CHART
	var localidad1=parseInt($("#localidad0").find("td")[2].innerText);
	var localidad2=parseInt($("#localidad1").find("td")[2].innerText);
	var localidad3=parseInt($("#localidad2").find("td")[2].innerText);
	var localidad4=parseInt($("#localidad3").find("td")[2].innerText);
	var localidad5=parseInt($("#localidad4").find("td")[2].innerText);
	var localidad6=parseInt($("#localidad5").find("td")[2].innerText);
	var localidad7=parseInt($("#localidad6").find("td")[2].innerText);
	var localidad8=parseInt($("#localidad7").find("td")[2].innerText);
	var localidad9=parseInt($("#localidad8").find("td")[2].innerText);
	var localidad10=parseInt($("#localidad9").find("td")[2].innerText);
	var localidad11=parseInt($("#localidad10").find("td")[2].innerText);
	var localidad12=parseInt($("#localidad11").find("td")[2].innerText);
	var localidad13=parseInt($("#localidad12").find("td")[2].innerText);
	var localidad14=parseInt($("#localidad13").find("td")[2].innerText);
	var localidad15=parseInt($("#localidad14").find("td")[2].innerText);
	var localidad16=parseInt($("#localidad15").find("td")[2].innerText);
	var localidad17=parseInt($("#localidad16").find("td")[2].innerText);
	var localidad18=parseInt($("#localidad17").find("td")[2].innerText);

	var doughnutData = [
	{
		value: localidad1,
		color:"#F7464A"
	},
	{
		value : localidad2,
		color : "#46BFBD"
	},
	{
		value : localidad3,
		color : "#FDB45C"
	},
	{
		value : localidad4,
		color : "#949FB1"
	},

	{
		value : localidad5,
		color : "#2ecc71"
	},

	{
		value : localidad6,
		color : "#3498db"
	},

	{
		value : localidad7,
		color : "#9b59b6"
	},

	{
		value : localidad8,
		color : "#34495e"
	},

	{
		value : localidad9,
		color : "#f1c40f"
	},

	{
		value : localidad10,
		color : "#e67e22"
	},

	{
		value : localidad11,
		color : "#e74c3c"
	},

	{
		value : localidad12,
		color : "#ecf0f1"
	},

	{
		value : localidad13,
		color : "#95a5a6"
	},

	{
		value : localidad14,
		color : "#f39c12"
	},

	{
		value : localidad15,
		color : "#d35400"
	},

	{
		value : localidad16,
		color : "#c0392b"
	},


	{
		value : localidad17,
		color : "#4D5360"
	},
	{
		value : localidad18,
		color : "#CCC"
	}

	];

	var myDoughnut = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(doughnutData);



});

function pulsar(e) {
	tecla=(document.all) ? e.keyCode : e.which;
	if(tecla==13) return false;
}



