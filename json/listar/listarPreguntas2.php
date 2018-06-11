<?php
	include 'Conexion.php';

	ini_set('mssql.charset', 'UTF-8');
	$conexion = new Conexion();
	$cnn = $conexion->getConexion();
	$sql = "SELECT 
p.id_pregunta,
p.enunciado,
p.clave1,
p.clave2,
p.clave3,
p.clave4,
p.clave5,
p.correcta,
sub.nombre,
tp.nombre,
di.nivel
FROM 
pregunta p
INNER JOIN subtema sub on (sub.id_subtema = p.SUBTEMA_id_subtema)
INNER JOIN dificultad di on (di.id_dificultad = p.DIFICULTAD_id_dificultad)
INNER JOIN tipo_pregunta tp on (tp.id_tipopregunta = p.TIPO_PREGUNTA_id_tipopregunta)
WHERE p.SUBTEMA_id_subtema = 9";
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