<?php
	include 'Conexion.php';

	ini_set('mssql.charset', 'UTF-8');
	$conexion = new Conexion();
	$cnn = $conexion->getConexion();
	$sql = "SELECT * FROM PREGUNTA";
	$statement = $cnn->prepare($sql);
	$valor = $statement->execute();

	if( $valor){

		while( $resultado = $statement->fetch(PDO::FETCH_ASSOC)){
			
			$data["data"][] = $resultado;

		}
			
			echo json_encode($data,true);
	}else{

		echo "error";
	}

	$statement->closeCursor();
	$conexion = null;


?>