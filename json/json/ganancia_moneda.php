<?php 
	$host = "localhost";
	$dbname = "test";
	$user = "root";
	$pass = "";
	$conexion = null;
	
	if (isset($_GET['monedas']) && isset($_GET['id_usuario'])) {

		$conexion=mysqli_connect($host,$user,$pass,$dbname);
		
		$monedas=$_GET['monedas'];
		$id=$_GET['id_usuario'];

		$update="UPDATE usuario SET monedas = '{$monedas}' WHERE id_usuario = '{$id}'";

		$resultado_update=mysqli_query($conexion,$update);

		if($resultado_update){
			
			$json=true;
			mysqli_close($conexion);
			echo json_encode($json);

		}else{
			
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