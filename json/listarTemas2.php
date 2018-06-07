<?php
	include 'Conexion.php';

	ini_set('mssql.charset', 'UTF-8');
	$conexion = new Conexion();
	$cnn = $conexion->getConexion();
	$sql = "SELECT 
t.id_tema,
t.nombre,
t.porcentaje,
t.completado,
asig.nombre
FROM tema t 
INNER JOIN asignatura asig on (asig.id_asignatura = t.ASIGNATURA_id_asignatura)";
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