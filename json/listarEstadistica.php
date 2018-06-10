<?php

$host = "localhost";
$dbname = "test";
$user = "root";
$pass = "";
$conexion = null;

$json=array();

	if(isset($_GET["id_subtema"]) && isset($_GET["id_usuario"]) ) {

		$id_subtema=$_GET['id_subtema'];
		$id_usuario=$_GET['id_usuario'];
		
		$conexion=mysqli_connect($host,$user,$pass,$dbname);

		$consulta="SELECT r.id_usuario,p.enunciado,r.acertada
FROM respuesta r
INNER JOIN pregunta p ON (r.id_pregunta = p.id_pregunta)
WHERE P.id_subtema='{$id_subtema}' AND r.id_usuario='{$id_usuario}'";

		$resultado=mysqli_query($conexion,$consulta);

		$i=0;

		while ($R = $resultado->fetch_array()) 
        {	

               /*$id=$R["id_usuario"];
               $enunciado=$R["enunciado"];
               $acertada=$R["acertada"];
               
               $json[$i][0]=$R["id_usuario"];
               $json[$i][1]=$R["enunciado"];
               $json[$i][2]=$R["acertada"];
               $i++;*/
        }

        var_dump($json);

		if($resultado){

			while($R = $resultado->fetch_array()){
				$json[]=$R;
			}

			echo 'aaa';

			mysqli_close($conexion);
			echo json_encode($json);
		}
		else{

			$json='No devuelve';
			mysqli_close($conexion);
			echo json_encode($json);
		}
	}else{
			
			$json='No se pudo comunicar con el servidor';
			mysqli_close($conexion);
			echo json_encode($json);
	}

?>