<?php 
	
	include 'Conexion.php';

	if(isset($_GET["id_articulo"]) && isset($_GET["id_usuario"]) ) {

		$id_articulo=$_GET['id_articulo'];
		$id_usuario=$_GET['id_usuario'];
		
		$conexion = new Conexion();
		$cnn = $conexion->getConexion();

		$consulta="SELECT *
			FROM usuario_articulo
			WHERE id_articulo=:id_articulo AND id_usuario=:id_usuario";

		$statement = $cnn->prepare($consulta);
		$statement->bindParam(':id_articulo', $id_articulo);
		$statement->bindParam(':id_usuario', $id_usuario);
		$valor = $statement->execute();
		$resultado = $statement->fetch();
		
		if($resultado){

			$json = true;
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