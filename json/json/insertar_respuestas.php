<?php 

	$host = "localhost";
	$dbname = "test";
	$user = "root";
	$pass = "";
	$conexion = null;


	if(isset($_POST["id_usuario"]) && isset($_POST["id_pregunta"]) && isset($_POST["acertada"])) {

		$id_usuario=$_POST["id_usuario"];
		$id_pregunta=$_POST["id_pregunta"];
		$acertada=$_POST["acertada"];

		$conexion=mysqli_connect($host,$user,$pass,$dbname);

			$select = "SELECT * from respuesta where id_usuario='{$id_usuario}' and id_pregunta='{$id_pregunta}'";
			$resultado_select=mysqli_query($conexion,$select);

			if ($resultado_select->num_rows > 0) {
			    while($row = $resultado_select->fetch_assoc()) {
			        
			        $selectId_usuario = $row["id_usuario"];
			        $selectId_pregunta= $row["id_pregunta"];
			        $selectAcertada = $row["acertada"];
				}
			}

			if ( isset($selectId_usuario) && isset($selectId_pregunta) ){

				$update="UPDATE respuesta SET id_usuario = '{$id_usuario}', id_pregunta = '{$id_pregunta}', acertada = '{$acertada}' WHERE id_usuario = '{$id_usuario}' and id_pregunta = '{$id_pregunta}'";

				$resultado_update=mysqli_query($conexion,$update);

				if($resultado_update){
					
					$json=true;
					mysqli_close($conexion);
					echo json_encode($json);

				}else{
					
					$json=NULL;
					mysqli_close($conexion);
					echo json_encode($json);

				}

			}else{
				
				$insert="INSERT INTO respuesta(id_usuario,id_pregunta,acertada) VALUES ('{$id_usuario}','{$id_pregunta}','{$acertada}')";
				$resultado_insert=mysqli_query($conexion,$insert);

				if($resultado_insert){

					$json=true;
					mysqli_close($conexion);
					echo json_encode($json);
				}
				else{

					$json=NULL;
					mysqli_close($conexion);
					echo json_encode($json);
				}
			}


	}else{
			
			$json='No se pudo comunicar con el servidor';
			$conexion = null;
			echo json_encode($json);
	}

 ?>