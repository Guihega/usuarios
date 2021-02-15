<?php
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$username=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$password=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (!isset($_SESSION["nombre"]))
		{
			header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
			{
				$imagen=$_POST["imagenactual"];
			}
			else 
			{
				$ext = explode(".", $_FILES["imagen"]["name"]);
				if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
				{
					$imagen = round(microtime(true)) . '.' . end($ext);
					move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/" . $imagen);
				}
			}
			//Hash SHA256 en la contraseña
			$passwordhash=hash("SHA256",$password);
			if (empty($idusuario)){
				$rspta=$usuario->insertar($nombre,$direccion,$telefono,$email,$username,$passwordhash,$imagen);
				echo $rspta ? 0: 1;
			}
			else {
				$rspta=$usuario->editar($idusuario,$nombre,$direccion,$telefono,$email,$imagen);
				echo $rspta ? 2 : 3;
			}
		}
	break;

	case 'desactivar':
		if (!isset($_SESSION["nombre"]))
		{
			header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			$rspta=$usuario->desactivar($idusuario);
	 		echo $rspta ? 0: 1;
		}
	break;

	case 'activar':
		if (!isset($_SESSION["nombre"]))
		{
		 	header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			$rspta=$usuario->activar($idusuario );
	 		echo $rspta ? 0 : 1;
		}
	break;

	case 'mostrar':
		if (!isset($_SESSION["nombre"]))
		{
		 	header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			$rspta=$usuario->mostrar($idusuario);
	 		//Codificar el resultado utilizando json
	 		echo json_encode($rspta);
		}
	break;

	case 'listar':
		if (!isset($_SESSION["nombre"]))
		{
		 	header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			$rspta=$usuario->listar();
	 		//Vamos a declarar un array
	 		$data= Array();

	 		while ($reg=$rspta->fetch_object()){
	 			$data[]=array(
	 				"0"=>($reg->estado)?'<button class="btn btn-xs btn-warning" onclick="mostrar('.$reg->idusuario.',1)"><i class="fa fa-edit"></i></button>'.
	 					'<button class="btn btn-xs btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>'.
	 					'<button class="btn btn-xs btn-success" onclick="mostrar('.$reg->idusuario.',2)"><i class="fa fa-key"></i></button>':
	 					'<button class="btn btn-xs btn-warning" onclick="mostrar('.$reg->idusuario.',1)"><i class="fa fa-eye"></i></button>'.
	 					' <button class="btn btn-xs btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
	 				"1"=>$reg->nombre,
	 				"2"=>$reg->direccion,
	 				"3"=>$reg->telefono,
	 				"4"=>$reg->email,
	 				"5"=>$reg->username,
	 				"6"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px' >",
	 				"7"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
	 				'<span class="label bg-red">Desactivado</span>'
	 				);
	 		}
	 		$results = array(
	 			"sEcho"=>1, //Información para el datatables
	 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
	 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
	 			"aaData"=>$data);
	 		echo json_encode($results);
		}
	break;

	case 'verificar':
		$username=$_POST['logina'];
	    $password=$_POST['clavea'];
	    //Hash SHA256 en la contraseña
		$passwordhash=hash("SHA256",$password);
		$rspta=$usuario->verificar($username, $passwordhash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['imagen']=$fetch->imagen;
	        $_SESSION['username']=$fetch->username;
	    }
	    echo json_encode($fetch);
	break;

	case 'actualizarPassword':
		if (!isset($_SESSION["nombre"]))
		{
		 	header("Location: ../vistas/login.php");//Validamos el acceso solo a los usuarios logueados al sistema.
		}
		else
		{
			//$idusuarioPassword=$_POST['idusuarioPassword'];
			$emailPassword=$_POST['emailPassword'];
			$usernamePassword=$_POST['loginPassword'];
	    	$passwordUpdate=$_POST['clavePassword'];

			$passwordhash=hash("SHA256",$passwordUpdate);
			$rspta=$usuario->actualizarPassword($emailPassword,$usernamePassword,$passwordhash);
			echo $rspta ? 0 : 1;
		}
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");

	break;
}
ob_end_flush();
?>