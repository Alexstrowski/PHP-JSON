<?php 

	$host = "localhost";
	$dbname = "test";
	$user = "root";
	$pass = "";
	$conexion = null;

	header('Access-Control-Allow-Origin: *');
	
	$preguntas=$_POST['preguntas'];

	//$preguntas = json_decode($preguntas, true);

	$conexion=mysqli_connect($host,$user,$pass,$dbname);

	//echo $preguntas . 'hola aa ';

	//if(isset($_GET["id_usuario"]) && isset($_GET["id_pregunta"]) && isset($_GET["acertada"]) ) {
		/*$insert="INSERT INTO respuesta(id_usuario,id_pregunta,acertada) VALUES ('{$id_usuario}','{$id_pregunta}','{$acertada}')";*/


		//foreach ($preguntas as $p => $valor){
			/*$insert="INSERT INTO respuesta(id_usuario,id_pregunta,acertada) VALUES ('".$p['id_usuario']."','".$p['id_pregunta']."','".$p['acertada']."')";
			$resultado_insert=mysqli_query($conexion,$insert);*/

			//echo "{$clave} => {$valor}";
			/*echo ($p['id_usuario']);
			echo ($p['id_pregunta']);
			echo ($p['acertada']);*/
			//var_dump($valor);
		//}

		foreach ($preguntas as $p){
			

			$insert="INSERT INTO respuesta(id_usuario,id_pregunta,acertada) VALUES ('".$p['id_usuario']."','".$p['id_pregunta']."','".$p['acertada']."')";
			$resultado_insert=mysqli_query($conexion,$insert);

			/*echo $valor['id_usuario'];
			echo $valor['id_pregunta'];
			echo $valor['acertada'];*/
		}
/*

		if($resultado_insert){

			$json=true;
			mysqli_close($conexion);
			echo json_encode($json);
		}
		else{

			$json=NULL;
			mysqli_close($conexion);
			echo json_encode($json);
		}*/
	/*}else{
			
			$json='No se pudo comunicar con el servidor';
			mysqli_close($conexion);
			echo json_encode($json);
	}*/

 ?>
