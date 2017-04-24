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

$(document).ready(function(){
	console.log(typeof localStorage["ultimo_id"]);
	if((typeof localStorage["ultimo_id"])==="undefined"){
		$.ajax({
			url: "include/logica.php",
			method: "POST"
		})
		.done(function(json) {
			var objeto = $.parseJSON(json);
			console.log(objeto);
			var i=0;
			var localidades = $("#localidad");
			var sexos = $("#sexo");
			var constructor;
			var cant_localidades = 0;
			var cant_sexos = 0;
			console.log(objeto.length);
			while(i<objeto.length){
				console.log("ENTRO")
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
			console.log(objeto[0]["id_ultima_pregunta"]);
			localStorage["ultimo_id"] = objeto[0]["id_ultima_pregunta"];

		})
		.fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	}

	localStorage.removeItem("ultimo_id");

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
		$(".login").css("display","none");
		$(".reg").css("display","block");
		$(".login").animate({left: "-250%"},5000);

	});

	$(".send").click(function(e){
		e.preventDefault();
		user = $("#user-login").val();
		pw = $("#pw-login").val();
		$.ajax({
			url: "include/logica_login.php",
			data: {
				pw:pw,
				user:user,
				flag:0
			},
			method: "POST",
			error: function(xhr, status, error) {
				console.log(xhr);
				console.log(status);
				console.log(error);
			}

		}).done(function(json) {
			console.log(json);
			var obj = $.parseJSON(json);
			if(obj["existe"]==0){
				$(".usuario").addClass("danger-login");
				$(".password").addClass("danger-login");
				$(".icono-login").addClass("remover-borde");	
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
			window.location="index.php";
		})
		.fail(function(xhr, status, error){
			console.log(xhr);
			console.log(status);
			console.log(error);
			console.log("FAIL");
		});
	});
});