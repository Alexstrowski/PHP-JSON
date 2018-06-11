<?php
	include 'Conexion.php';
	ini_set('mssql.charset', 'UTF-8');
	$conexion = new Conexion();
	$cnn = $conexion->getConexion();
	$sql = "SELECT * FROM articulo";
	$statement = $cnn->prepare($sql);
	$valor = $statement->execute();
	if( $valor){
		while( $resultado = $statement->fetch(PDO::FETCH_ASSOC)){
			
			$data[] = $resultado;
		}
			
			var_dump(json_encode($data,true));
	}else{
		var_dump (error);
	}
	$statement->closeCursor();
	$conexion = null;
?>