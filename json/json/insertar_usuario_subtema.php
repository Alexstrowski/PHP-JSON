<?php 

	$host = "localhost";
	$dbname = "test";
	$user = "root";
	$pass = "";
	$conexion = null;


	if(isset($_GET["id_usuario"]) && isset($_GET["id_subtema"]) && isset($_GET["completado"])) {

		$id_usuario=$_GET["id_usuario"];
		$id_subtema=$_GET["id_subtema"];
		$completado=$_GET["completado"];

		$conexion=mysqli_connect($host,$user,$pass,$dbname);

			$select = "SELECT * from usuario_subtema where id_usuario='{$id_usuario}' and id_subtema='{$id_subtema}'";
			$resultado_select=mysqli_query($conexion,$select);

			if ($resultado_select->num_rows > 0) {
			    while($row = $resultado_select->fetch_assoc()) {
			        
			        $selectId_usuario = $row["id_usuario"];
			        $selectId_subtema= $row["id_subtema"];
			        $selectCompletado = $row["completado"];
				}
			}

			if ( isset($selectId_usuario) && isset($selectId_subtema) ){

				$update="UPDATE usuario_subtema SET completado = '{$completado}' WHERE id_usuario = '{$id_usuario}' and id_subtema = '{$id_subtema}'";

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
				
				$insert="INSERT INTO usuario_subtema (id_usuario,id_subtema,completado) VALUES ('{$id_usuario}','{$id_subtema}','{$completado}')";
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