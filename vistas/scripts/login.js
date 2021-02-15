//Función que se ejecuta al inicio
function init(){
  $("#frmAcceso").on('submit',function(e)
  {
    validarUsuario(e);  
  });
}


function validarUsuario(e){
  e.preventDefault();
  logina=$("#username").val();
  clavea=$("#password").val();
  console.log(logina);
  console.log(clavea);
  $.post("../ajax/usuario.php?op=verificar",
    {"logina":logina,"clavea":clavea},
    function(data)
    {
      console.log(data);
      if (data!="null")
      {
        $(location).attr("href","usuario.php");            
      }
      else
      {
        //OK
        Swal.fire({
          position: 'top-end',
          icon: 'error',
          title: 'Usuario y/o Password incorrectos!',
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
      }
  });
}


function showHidePwd(){
  $('#clavea').attr('type', $('#clavea').is(':password') ? 'text' : 'password');
  if ($('#clavea').attr('type') === 'password') {
    $('#eye').removeClass('fa-eye').addClass('fa-eye-slash');
  } else {
    $('#eye').removeClass('fa-eye-slash').addClass('fa-eye');
  }
}

init();