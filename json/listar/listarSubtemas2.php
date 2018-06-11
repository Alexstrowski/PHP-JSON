<?php
	include 'Conexion.php';

	ini_set('mssql.charset', 'UTF-8');
	$conexion = new Conexion();
	$cnn = $conexion->getConexion();
	$sql = "SELECT 
sub.id_subtema,
sub.nombre,
sub.porcentaje,
sub.completado,
tem.nombre
FROM subtema sub 
INNER JOIN tema tem ON (tem.id_tema = sub.TEMA_id_tema)";
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