<?php 

	$host = "localhost";
	$dbname = "test2";
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
					echo json_encode($json);

				}else{
					
					$json=NULL;	
					echo json_encode($json);

				}

			}else{
				
				$insert="INSERT INTO usuario_subtema (id_usuario,id_subtema,completado) VALUES ('{$id_usuario}','{$id_subtema}','{$completado}')";
				$resultado_insert=mysqli_query($conexion,$insert);


				if($resultado_insert){

					$json=true;	
					echo json_encode($json);
				}
				else{

					$json=NULL;
					echo json_encode($json);
				}
			}


			////////////// PORCENTAJES ///////////////

			// EXTRAER TEMA DEL SUBTEMA

				$select_tema="SELECT id_tema from subtema where id_subtema='{$id_subtema}'";
				$resultado_select=mysqli_query($conexion,$select_tema);

				if ($resultado_select->num_rows > 0) {
			    while($row = $resultado_select->fetch_assoc()) {
			        
				        $selectId_tema = $row["id_tema"];

					}
				}


			// EXTRAER EL TOTAL DE SUBTEMAS DE UN TEMA

				$selectTotal = "SELECT 
					count(*) as suma
					FROM subtema sub
					INNER JOIN tema t on (t.id_tema = sub.id_tema)
					WHERE t.id_tema='{$selectId_tema}'";	
				$resultado_selectTotal=mysqli_query($conexion,$selectTotal);

				if ($resultado_selectTotal->num_rows > 0) {
			    while($row = $resultado_selectTotal->fetch_assoc()) {
			        
				        $total= $row["suma"];

					}
				}


			// EXTRAER EL TOTAL DE SUBTEMAS DE UN TEMA COMPLETADO

				$selectCompletados = "SELECT 
					count(*) as suma
					FROM usuario_subtema  us
					INNER JOIN subtema sub on (us.id_subtema=sub.id_subtema)
					INNER JOIN tema t on (t.id_tema = sub.id_tema)
					WHERE us.id_usuario='{$id_usuario}' and t.id_tema='{$selectId_tema}' and completado=1";

				$resultado_selectCompletados=mysqli_query($conexion,$selectCompletados);

				if ($resultado_selectCompletados->num_rows > 0) {
			    while($row = $resultado_selectCompletados->fetch_assoc()) {
			        
				        $completados= $row["suma"];

					}
				}


				$porcentajeTema = $completados*100/$total;
				

				////////////COMPROBANDO SI EXISTE DATOS EN USUARIO_TEMA///////////////

				$select_final = "SELECT * from usuario_tema where id_usuario='{$id_usuario}' and id_tema='{$selectId_tema}'";
				$resultado_final=mysqli_query($conexion,$select_final);

				if ($resultado_final->num_rows > 0) {

					$update_usuario_tema="UPDATE usuario_tema SET porcentaje = '{$porcentajeTema}' WHERE id_usuario = '{$id_usuario}' and id_tema = '{$selectId_tema}'";

					mysqli_query($conexion,$update_usuario_tema);

				}else{

					$insert_usuario_tema="INSERT INTO usuario_tema (id_usuario,id_tema,porcentaje) VALUES ('{$id_usuario}','{$selectId_tema}','$porcentajeTema')";
					mysqli_query($conexion,$insert_usuario_tema);

				}	

				mysqli_close($conexion);


	}else{
			
			$json='No se pudo comunicar con el servidor';
			$conexion = null;
			echo json_encode($json);
	}

 ?>