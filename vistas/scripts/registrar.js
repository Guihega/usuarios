var tabla;
var icono;
var mensaje;

//Función que se ejecuta al inicio
function init(){
	$("#frmRegistrar").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#frmCambiarPassword").on("submit",function(e)
	{
		actualizarPassword(e);
	})

	$("#imagenmuestra").hide();
}

//Función limpiar
function limpiar()
{
	$(".modal-title").html('Nuevo Usuario');

	$("#nombre").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#email").val("");
	$("#cargo").val("");
	$("#login").val("");
	$("#clave").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#idusuario").val("");

	$(".login").show();
	$(".password").show();
	$("#login").prop('required',true);
	$("#clave").prop('required',true);
}

//Función para guardar o editar
function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#frmRegistrar")[0]);
	// for (var value of formData.values()) {
	//    console.log(value);
	// }
	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {                    
			//bootbox.alert(datos);
			//console.log(datos);
			if (datos == 0) {
	    		icono = 'success';
	    		mensaje = 'Usuario guardado';
	    	}
	    	else if (datos == 1) {
	    		icono = 'error';
	    		mensaje = 'El usuario no se pudo registrar';
	    	}
	    	else if (datos == 2){
	    		icono = 'success';
	    		mensaje = 'Usuario actualizado';
	    	}
	    	else{
	    		icono = 'error';
	    		mensaje = 'El usuario no se pudo actualizar';
	    	}
	    	//mensaje(icono,mensaje);
	    	Swal.fire({
		      position: 'top-end',
		      icon: icono,
		      title: mensaje,
		      showConfirmButton: false,
		      timer: 3000,
		      showClass: {
		        popup: 'animate__animated animate__fadeInDown'
		      },
		      hideClass: {
		        popup: 'animate__animated animate__fadeOutUp'
		      },
		      showCloseButton: true,
		      focusConfirm: false,
		      timerProgressBar: true,
		    });
		    setTimeout(function() { 
		    	$(location).attr('href','../vistas/usuario.php');
		    }, 3000);
	    }

	});
}

function showHidePwd(){
  $('#clavePassword').attr('type', $('#clavePassword').is(':password') ? 'text' : 'password');
  if ($('#clavePassword').attr('type') === 'password') {
    $('#eye').removeClass('fa-eye').addClass('fa-eye-slash');
  } else {
    $('#eye').removeClass('fa-eye-slash').addClass('fa-eye');
  }
}

function actualizarPassword(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnActualizarPassword").prop("disabled",true);
	var formData = new FormData($("#frmCambiarPassword")[0]);

	$.ajax({
		url: "../ajax/usuario.php?op=actualizarPassword",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {
	    	console.log(datos);
			if (datos == 0) {
	    		icono = 'success';
	    		mensaje = 'Contraseña actualizada';
	    	}
	    	else if (datos == 1) {
	    		icono = 'error';
	    		mensaje = 'La contraseña no se pudo actualizar';
	    	}
	    	//mensaje(icono,mensaje);
	    	Swal.fire({
		      position: 'top-end',
		      icon: icono,
		      title: mensaje,
		      showConfirmButton: false,
		      timer: 3000,
		      showClass: {
		        popup: 'animate__animated animate__fadeInDown'
		      },
		      hideClass: {
		        popup: 'animate__animated animate__fadeOutUp'
		      },
		      showCloseButton: true,
		      focusConfirm: false,
		      timerProgressBar: true,
		    });
		    setTimeout(function() { 
		    	$(location).attr('href','../vistas/usuario.php');
		    }, 3000);
	    }

	});
	limpiar();
}

init();