var tabla;
var icono;
var mensaje;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$("#formularioPass").on("submit",function(e)
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

//Función mostrar formulario
function mostrarform(flag,accion)
{
	limpiar();
	if (accion==1) {
		if (flag)
		{
			$('#modalNuevoUsuario').modal('show');
			$("#btnGuardar").prop("disabled",false);
		}
		else
		{
			$('#modalNuevoUsuario').modal('hide');
		}
	}
	else if(accion==2){
		if (flag)
		{
			$('#modalCambiarPassword').modal('show');
		}
		else
		{
			$('#modalCambiarPassword').modal('hide');
		}
	}
}

//Función cancelarform
function cancelarform(accion)
{
	limpiar();
	if (accion==1) {
		mostrarform(false,1);
	}
	else if(accion==2){
		mostrarform(false,2);
	}
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"lengthMenu": [ 5, 10, 25, 75, 100],//mostramos el menú de registros a revisar
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
		"ajax":
		{
			url: '../ajax/usuario.php?op=listar',
			type : "get",
			dataType : "json",
			error: function(e){
				console.log(e.responseText);
			}
		},
		"language": {
            "url": "../public/plugins/datatables/language/Spanish.json"
        },
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();

	var buttons = new $.fn.dataTable.Buttons(tabla, {
	    buttons: [
            {
            	text: 'Copiar',
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                title: 'Events export'
            },
            {
                extend: 'pdfHtml5',
                title: 'Events export'
            },
            {
                extend: 'csvHtml5',
                title: 'Events export'
            }
        ]
	}).container().appendTo($('.exportButtons'));

	$('.btn-secondary').addClass('btn-sm');
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
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

			mostrarform(false,1);
			tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idusuario, opcion)
{
	if (opcion == 1) {
		$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
		{
			data = JSON.parse(data);		
			mostrarform(true,1);

			$(".modal-title").html('Editar Usuario ' + idusuario);
			$(".login").hide();
			$(".password").hide();
			$("#login").prop('required',false);
			$("#clave").prop('required',false);

			$("#nombre").val(data.nombre);
			$("#direccion").val(data.direccion);
			$("#telefono").val(data.telefono);
			$("#email").val(data.email);
			$("#login").val(data.username);
			$("#imagenmuestra").show();
			$("#imagenmuestra").attr("src","../files/usuarios/"+data.imagen);
			$("#imagenactual").val(data.imagen);
			$("#idusuario").val(data.idusuario);

	 	});
	}
	else{
		$.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
		{
			data = JSON.parse(data);

			mostrarform(true,2);
			$("#idusuarioPassword").val(data.idusuario);
			$(".modal-title").html('Actualizar contraseña usuario ' + idusuario);
			$("#nombrePassword").val(data.nombre);
			$("#emailPassword").val(data.email);
			$("#loginPassword").val(data.username);
			$("#clavePassword").val();
			//deshabilitaControles();
	 	});
	}
}

//Función para desactivar registros
function desactivar(idusuario)
{
	swal({
	    title: '¿Está seguro de desactivar el usuario?',
	    icon: "warning",
	    buttons: true,
	    showCancelButton: true,
	    buttons:{
		  cancel: {
		    text: "Cancelar",
		    value: true,
		    visible: true,
		    className: "",
		    closeModal: true,
		  },
		  confirm: {
		    text: "Aceptar",
		    //value: true,
		    value: "Aceptar",
		    visible: true,
		    className: "",
		    closeModal: true
		  }
		},
	    dangerMode: true,
	    buttonsStyling: true,
	    closeOnEsc: false,
	    closeOnClickOutside: false
		}).then((value) => {
		switch (value) {
			case "Aceptar":
			  	$.ajax({
			        type: "POST",
			        url: "../ajax/usuario.php?op=desactivar",
			        data: {idusuario : idusuario},
			        cache: false,
			        success: function(response) {
			            if (response == 0) {
				    		icono = 'success';
				    		mensaje = 'Usuario desactivado';
				    	}
				    	else if (response == 1) {
				    		icono = 'error';
				    		mensaje = 'El usuario no se pudo desactivar';
				    	}

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
					    
					    tabla.ajax.reload();
			        }
			    });
			  	break;
			default:
		  		break;
		}
	});
}

//Función para activar registros
function activar(idusuario)
{
	swal({
	    title: '¿Está seguro de activar el usuario?',
	    icon: "warning",
	    buttons: true,
	    showCancelButton: true,
	    buttons:{
		  cancel: {
		    text: "Cancelar",
		    value: true,
		    visible: true,
		    className: "",
		    closeModal: true,
		  },
		  confirm: {
		    text: "Aceptar",
		    //value: true,
		    value: "Aceptar",
		    visible: true,
		    className: "",
		    closeModal: true
		  }
		},
	    dangerMode: true,
	    buttonsStyling: true,
	    closeOnEsc: false,
	    closeOnClickOutside: false
		}).then((value) => {
		switch (value) {
			case "Aceptar":
			  	$.ajax({
			        type: "POST",
			        url: "../ajax/usuario.php?op=activar",
			        data: {idusuario : idusuario},
			        cache: false,
			        success: function(response) {
			            if (response == 0) {
				    		icono = 'success';
				    		mensaje = 'Usuario activo';
				    	}
				    	else if (response == 1) {
				    		icono = 'error';
				    		mensaje = 'El usuario no se pudo activar';
				    	}

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
					    
					    tabla.ajax.reload();
			        }
			    });
			  	break;
			default:
		  		break;
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
	var formData = new FormData($("#formularioPass")[0]);
	// for (var value of formData.values()) {
	// 	console.log(value);
	// }
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

			mostrarform(false,2);
			tabla.ajax.reload();
	    }

	});
	limpiar();
}

function deshabilitaControles(){
	$("#nombrePassword").prop('readonly', true);
	$("#emailPassword").attr('readonly', true);
	$("#loginPassword").attr('readonly', true);
}

init();