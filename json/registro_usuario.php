<?php

$host = "localhost";
$dbname = "test2";
$user = "root";
$pass = "";
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

			$consulta="SELECT id_usuario FROM usuario WHERE usuario = '{$usuario}' AND password = '{$password}'";
			$resultado=mysqli_query($conexion,$consulta);
			
			if ($resultado->num_rows > 0) {
				while($row = $resultado->fetch_assoc()) {
				    $id=$row["id_usuario"];
				}
			}

			for ($i=1; $i <= 19 ; $i++) { 
				if($i != 8 && $i!= 19 ){
					$insert_usuario_asignatura="INSERT INTO usuario_asignatura (id_usuario,id_asignatura,porcentaje)VALUES( '{$id}','{$i}',0)";
					$resultado2=mysqli_query($conexion,$insert_usuario_asignatura);
					
				}
			}

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
			echo json_encode($json);
	}
?>