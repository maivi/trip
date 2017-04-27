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

$(document).ready(function(){

	//Comprobamos que no exista los localstorage
	
	$.ajax({
		url: "include/logica.php",
		method: "POST"
	})
	.done(function(json) {
			//Cache de las localidades y los sexos
			var objeto = $.parseJSON(json);
			var i=0;
			var localidades = $("#localidad");
			var sexos = $("#sexo");
			var constructor;
			var cant_localidades = 0;
			var cant_sexos = 0;
			console.log(objeto.length);
			console.log(objeto);

			while(i<objeto.length){
				if("undefined" != typeof objeto[i]["localidades"]){
					cant_localidades++;
				}

				if("undefined" != typeof objeto[i]["sexo"]){
					cant_sexos++;
				}
				i++;
			}

			i=0;
			while(i<cant_localidades){
				constructor = "<option value='"+(i+1)+"'>"+objeto[i]["localidades"]+"</option>";
				localidades.append(constructor);
				i++;
			}

			i=0;
			while(i<cant_sexos){
				constructor = "<option value='"+(i+1)+"'>"+objeto[i]["sexo"]+"</option>";
				sexos.append(constructor);
				i++;
			}
			i=0;

			if ( ( (typeof localStorage["ultimo_id"])==="undefined") && ( (typeof localStorage["ultimo_dia"])==="undefined" ) ){
			// Creamos los 2 localstorage para Dia e ID
			localStorage["ultimo_id"] = objeto[0]["id_ultima_pregunta"];
			localStorage["ultimo_dia"] = dia;
		}
			//Checkeamos si estan creados los localstorages de las preguntas para cachearlos
			if ( ( (typeof localStorage["pregunta_1"])==="undefined") && ( (typeof localStorage["pregunta_2"])==="undefined" ) && ( (typeof localStorage["pregunta_3"])==="undefined" ) ){

				$.ajax({
					url: "include/logica_respuestas.php",
					data: {
						id:localStorage["ultimo_id"]
					},
					method: "POST"
				})
				.done(function(test){
					console.log(test);
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
							console.log(json);
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
					});
				}else{
					// Si es el mismo día, directamente trae las respuestas cacheadas
					rellenar.find("li:nth-child(1)").find("label").empty();
					rellenar.find("li:nth-child(1)").find("label").append(localStorage["resp_1"]);
					rellenar.find("li:nth-child(2)").find("label").empty();
					rellenar.find("li:nth-child(2)").find("label").append(localStorage["resp_2"]);
					rellenar.find("li:nth-child(3)").find("label").empty();
					rellenar.find("li:nth-child(3)").find("label").append(localStorage["resp_3"]);

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
			console.log(reemplazar);
		});
	});



	

	$(".salir-sesion").click(function(e){
		e.preventDefault();
		console.log("Salir");
		$.ajax({
			url: "include/salir.php",
			method: "POST"

		}).done(function(){
			window.location="index.php";
			
		}).fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});



	$(".submit1").click(function(e){
		e.preventDefault();
		console.log("CLICK");
		$(".reg").css("top","60px");


	});

	$(".cerrar").click(function(e){
		e.preventDefault();
		console.log("CLICK");
		$(".reg").css("top","-800px");


	});


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
					flag:0
				},
				method: "POST"

			}).done(function(json) {
				console.log(json);
				var obj = $.parseJSON(json);
				if(obj["existe"]==0){
					var eliminar = $(".mensaje-alerta").find("p");
					eliminar.empty();
					eliminar.append("Usuario o Password incorrecto");	
				}else{
					window.location="index.php";
				}
				console.log(obj["existe"]);
			})
			.fail(function(xhr, status, error){
				console.log(xhr);
				console.log(status);
				console.log(error);
				console.log("FAIL");
			});
		}
		
	})


	$("#register").click(function(e){
		nombre = $("#nombre").val();
		apellido = $("#apellido").val();
		email = $("#email").val();
		dni = $("#dni").val();
		telefono = $("#telefono").val();
		localidad = $("#localidad").val();
		pw = $("#pw").val();
		user = $("#user").val();
		sexo = $("#sexo").val();
		e.preventDefault();
		console.log("CLICK");
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
				flag:1
			},
			method: "POST",
			error: function(xhr, status, error) {
				console.log(xhr);
				console.log(status);
				console.log(error);
			}

		}).done(function(json) {
			var obj2 = $.parseJSON(json);
			console.log(obj2);
		})
		.fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});


	$(".click-historial").click(function(e){
		e.preventDefault();
		var preguntas = localStorage["ultimo_id"];
		if (preguntas>1){
			/*$.ajax({
				url: "include/logica.php",
				method: "POST"
			})*/
		}else{
			console.log("No hay preguntas");
		}
	});
});