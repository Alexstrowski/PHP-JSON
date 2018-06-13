<?php
	include 'Conexion.php';

	ini_set('mssql.charset', 'UTF-8');


	if(isset($_GET["id_usuario"]) ) {

		$id_subtema=$_GET['id_subtema'];
		$id_usuario=$_GET['id_usuario'];

		$conexion = new Conexion();
		$cnn = $conexion->getConexion();


		$sql = "SELECT * FROM pregunta WHERE id_subtema= :id_subtema ";
		
		$statement = $cnn->prepare($sql);
		$statement->bindParam(':id_subtema', $_GET['id_subtema']);
		$valor = $statement->execute();

		if( $valor){

			while( $resultado = $statement->fetch(PDO::FETCH_ASSOC)){

				$data[] = $resultado;

			}
				
				if ($id_tipopregunta==1) {
					$dataIndices=array_rand($data, 7);
					for ($i=0; $i < 7; $i++) { 
						$arreglo[$i]=$data[$dataIndices[$i]];
					}
				}else{
					$data[]=array_rand($data, 10);	
					$dataIndices=array_rand($data, 10);
					for ($i=0; $i < 10; $i++) { 
						$arreglo[$i]=$data[$dataIndices[$i]];
					}
				}
				
				echo json_encode($arreglo,true);
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