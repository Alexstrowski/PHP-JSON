<?php 

	$host = "localhost";
	$dbname = "test";
	$user = "root";
	$pass = "";
	$conexion = null;

	header('Access-Control-Allow-Origin: *');

	if(isset($_POST["respuestas"]) ) {

		

		$respuestas=$_POST['respuestas'];

		$conexion=mysqli_connect($host,$user,$pass,$dbname);

		foreach ($respuestas as $p){
			

			$insert="INSERT INTO respuesta(id_usuario,id_pregunta,acertada) VALUES ('".$p['id_usuario']."','".$p['id_pregunta']."','".$p['acertada']."')";
			$resultado_insert=mysqli_query($conexion,$insert);


		}

		$json=true;
		mysqli_close($conexion);
		echo json_encode($json);

	}else{
			
			$json='No se pudo comunicar con el servidor';
			$conexion = null;
			echo json_encode($json);
	}

 ?>
