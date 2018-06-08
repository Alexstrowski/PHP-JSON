<?php 
	$host = "localhost";
	$dbname = "test";
	$user = "root";
	$pass = "";
	$conexion = null;
	

	if (isset($_POST['respuesta']) && isset($_POST["id"])) {
		
		$respuesta=$_POST['respuesta'];
		$conexion=mysqli_connect($host,$user,$pass,$dbname);

		if($respuesta='normal'){

		}else(){

		}

	}else{

		$json='No se pudo comunicar con el servidor';
		mysqli_close($conexion);
		echo json_encode($json);

	}
	
	$preguntas=$_POST['preguntas'];
	//$preguntas = json_decode($preguntas, true);
	
	
		foreach ($preguntas as $p){
			
			$insert="INSERT INTO respuesta(id_usuario,id_pregunta,acertada) VALUES ('".$p['id_usuario']."','".$p['id_pregunta']."','".$p['acertada']."')";
			$resultado_insert=mysqli_query($conexion,$insert);

		}
/*
		if($resultado_insert){
			$json=true;
			mysqli_close($conexion);
			echo json_encode($json);
		}
		else{
			$json=NULL;
			mysqli_close($conexion);
			echo json_encode($json);
		}*/
	/*}else{
			
			$json='No se pudo comunicar con el servidor';
			mysqli_close($conexion);
			echo json_encode($json);
	}*/
 ?>