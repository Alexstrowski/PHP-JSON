<?php

$host = "localhost";
$dbname = "test";
$user = "root";
$pass = "";
$conexion = null;

$json=array();

	if(isset($_POST["usuario"]) && isset($_POST["password"]) ) {

		$usuario=$_POST['usuario'];
		$password=$_POST['password'];
		
		$conexion=mysqli_connect($host,$user,$pass,$dbname);

		$consulta="SELECT * FROM usuario WHERE usuario = '{$usuario}' AND password = '{$password}'";
		$resultado=mysqli_query($conexion,$consulta);

		if($registro=mysqli_fetch_array($resultado)){

			$json[]=$registro;

			mysqli_close($conexion);
			echo json_encode($json);
		}
		else{

			$json=NULL;
			mysqli_close($conexion);
			echo json_encode($json);
		}
	}else{
			
			$json='No se pudo comunicar con el servidor';
			mysqli_close($conexion);
			echo json_encode($json);
	}
?>