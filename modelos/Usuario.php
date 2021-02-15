<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$direccion,$telefono,$email,$username,$password,$imagen)
	{
		$sql="INSERT INTO usuario (nombre, direccion, telefono, email, username, password, imagen, estado)
		VALUES ('$nombre','$direccion','$telefono','$email','$username','$password','$imagen',1)";
		return ejecutarConsulta($sql);
	}
	
	public function editar($idusuario,$nombre,$direccion,$telefono,$email,$imagen)
	{
		$sql="UPDATE usuario SET nombre='$nombre',direccion='$direccion',telefono='$telefono',email='$email',imagen='$imagen' WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}


	//Implementar un método para mostrar los datos de un registro
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}


	//Implementamos un método para desactivar 
	public function desactivar($idusuario)
	{
		$sql="UPDATE usuario SET estado=0 WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar 
	public function activar($idusuario)
	{
		$sql="UPDATE usuario SET estado=1 WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario";
		return ejecutarConsulta($sql);		
	}

	//Función para verificar el acceso al sistema
	public function verificar($username,$password)
    {
    	$sql="SELECT idusuario,nombre,telefono,email,imagen,username FROM usuario WHERE email='$username' AND password='$password' AND estado='1'"; 
    	return ejecutarConsulta($sql);
    	//return $sql;
    }

    public function actualizarPassword($email,$username,$password)
	{
		$sql="UPDATE usuario SET password='$password' WHERE email='$email' AND username='$username'";
		return ejecutarConsulta($sql);
	}
}

?>