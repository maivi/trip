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
		e.preventDefault();
		$(".navbar-toggle").click();
		if(screen.width<768){
			$(".cuerpo-padding+.reg").find(".box").css("height","850px");
		}else{
			$(".cuerpo-padding+.reg").find(".box").css("height","650px");
		}
		$(".cuerpo-padding+.reg").animate({
			top: 60
		},500);
		
		$(".perdi-cuenta").css("display","none");
		$(".cuerpo-padding+.reg").css("display","block");
		$(".perdi-cuenta-reg").css("top","-800px");
	});

	$(".submit2").click(function(e){ //PERDI ACCESO
		e.preventDefault();
		
		$(".cuerpo-padding+.reg").find(".box").css("height","0px");
		$(".navbar-toggle").click();
		
		$(".perdi-cuenta").animate({
			top: 60
		},500);
		$(".cuerpo-padding+.reg").css("display","none");
		$(".perdi-cuenta").css("display","block");
		
		$(".cuerpo-padding+.reg").css("top","-800px");

	});

	$("#perdi-password").click(function(e){
		e.preventDefault();
		var usuario = $("#usuario-lost").val();
		if(usuario!=""){
			$.ajax({
				url: "include/perdi_pass.php",
				method: "POST",
				data: {
					usuario: usuario
				}
			}).done(function(json){
				var objeto = $.parseJSON(json);
				if(objeto[0]["existe"]=="no"){
					$(".respuesta-mail").find("p").text("Usuario incorrecto.");
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
		$(".perdi-cuenta-reg").css("top","-800px");		
		$(".cuerpo-padding+.reg").css("display","block");
	});

	$(".cuerpo-padding+.reg").find(".cerrar").click(function(e){
		e.preventDefault();
		$(".cuerpo-padding+.reg").css("top","-800px");
		
		$(".perdi-cuenta").css("display","block");
	})


	//LOGIN
	$(".send").click(function(e){
		e.preventDefault();
		user = $("#user-login").val();
		pw = $("#pw-login").val();
		if ( (user != "") && (pw != "") ){
			$.ajax({
				url: "include/logica_login.php",
				data: {
					pw:pw,
					user:user,
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
					window.location="index.php";
				}
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
		user = $("#user").val();
		sexo = $("#sexo").val();
		cap = $("#captcha").val();
		if ( (nombre!="") && (apellido!="") && (email!="") && (dni!="") && (telefono!="") && (pw!="") && (user!="") ){
			$.ajax({ 
				url: "include/control_usuario.php",
				data: {
					user:user
				},
				method: "POST"
			}).done(function(json){
				var obj2 = $.parseJSON(json);
				console.log(obj2);
				if(obj2["usuario"]==1){
					var user = $("#user");
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
							user:user,
							captcha:cap,
							flag:1
						},
						method: "POST"

					}).done(function(json) {
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

});

function pulsar(e) {
	tecla=(document.all) ? e.keyCode : e.which;
	if(tecla==13) return false;
}



