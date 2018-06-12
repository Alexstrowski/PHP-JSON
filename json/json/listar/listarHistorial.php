<?php

include 'Conexion.php';

	if(isset($_GET["id_subtema"]) && isset($_GET["id_usuario"]) ) {

		$id_subtema=$_GET['id_subtema'];
		$id_usuario=$_GET['id_usuario'];
		
		$conexion = new Conexion();
		$cnn = $conexion->getConexion();

		$consulta="SELECT p.enunciado,r.acertada
			FROM respuesta r
			INNER JOIN pregunta p ON (r.id_pregunta = p.id_pregunta)
			WHERE p.id_subtema=:id_subtema AND r.id_usuario=:id_usuario";

		$statement = $cnn->prepare($consulta);
		$statement->bindParam(':id_subtema', $_GET['id_subtema']);
		$statement->bindParam(':id_usuario', $_GET['id_usuario']);
		$valor = $statement->execute();
		var_dump($consulta);

		if($valor){

		while( $resultado = $statement->fetch(PDO::FETCH_ASSOC)){

				$json[] = $resultado;

		}

			$conexion = null;
			echo json_encode($json);
		}
		else{

			$json=null;
			$conexion = null;
			echo json_encode($json);
		}
	}else{
			
			$json='No se pudo comunicar con el servidor';
			$conexion = null;
			echo json_encode($json);
	}

?>