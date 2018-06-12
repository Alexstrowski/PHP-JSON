<?php

include 'Conexion.php';

	if(isset($_GET["id_subtema"]) && isset($_GET["id_usuario"]) ) {

		$id_subtema=$_GET['id_subtema'];
		$id_usuario=$_GET['id_usuario'];
		
		$conexion = new Conexion();
		$cnn = $conexion->getConexion();

		$consulta="SELECT completado
			FROM usuario_subtema
			WHERE id_subtema=:id_subtema AND id_usuario=:id_usuario";

		$statement = $cnn->prepare($consulta);
		$statement->bindParam(':id_subtema', $id_subtema);
		$statement->bindParam(':id_usuario', $id_usuario);
		$valor = $statement->execute();
		

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