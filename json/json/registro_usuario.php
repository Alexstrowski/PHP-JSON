<?php

$host = "localhost";
$dbname = "u736411459_bd";
$user = "u736411459_alexk";
$pass = "ruEvGTzVY1F7";
$conexion = null;

$json=array();

	if(isset($_POST["id_usuario"]) && isset($_POST["usuario"]) && isset($_POST["password"]) && isset($_POST["nombres"]) && isset($_POST["apellidos"]) && isset($_POST["correo"]) && isset($_POST["monedas"]) ) {

		$id_usuario=$_POST['id_usuario'];
		$usuario=$_POST['usuario'];
		$password=$_POST['password'];
		$nombres=$_POST['nombres'];
		$apellidos=$_POST['apellidos'];
		$correo=$_POST['correo'];
		$monedas=$_POST['monedas'];
		
		$conexion=mysqli_connect($host,$user,$pass,$dbname);
		
		$insert="INSERT INTO usuario(id_usuario,usuario,password,nombres,apellidos,correo,monedas) VALUES ('{$id_usuario}','{$usuario}','{$password}','{$nombres}',
		'{$apellidos}','{$correo}','{$monedas}')";

		$resultado_insert=mysqli_query($conexion,$insert);

		if($resultado_insert){

			$json=true;
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