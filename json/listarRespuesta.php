<?php
	include 'Conexion.php';

	ini_set('mssql.charset', 'UTF-8');


	if(isset($_GET["id_subtema"]) && isset($_GET["id_usuario"]) ) {

		$id_subtema=$_GET['id_subtema'];
		$id_usuario=$_GET['id_usuario'];

		$conexion = new Conexion();
		$cnn = $conexion->getConexion();


		$sql = "SELECT p.enunciado,r.acertada
			FROM respuesta r
			INNER JOIN pregunta p ON (r.id_pregunta = p.id_pregunta)
			WHERE P.id_subtema= :id_subtema AND r.id_usuario=:id_usuario";
		
		$statement = $cnn->prepare($sql);
		$statement->bindParam(':id_subtema', $_GET['id_subtema']);
		$statement->bindParam(':id_usuario', $_GET['id_usuario']);
		$valor = $statement->execute();

		if( $valor){

			while( $resultado = $statement->fetch(PDO::FETCH_ASSOC)){

				$data[] = $resultado;

			}
				
				echo json_encode($data,true);
		}else{

			echo "error";
		}

		$statement->closeCursor();
		$conexion = null;

	}else{
			
			$json='No se pudo comunicar con el servidor';
			$conexion = null;
			echo json_encode($json);
	}
?>