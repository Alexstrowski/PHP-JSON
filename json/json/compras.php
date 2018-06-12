<?php
    include 'Conexion.php';
	ini_set('mssql.charset', 'UTF-8');
    $conexion = new Conexion();
    $cnn = $conexion->getConexion();
    if(isset($_GET["id_usuario"]) && isset($_GET["id_articulo"]) && isset($_GET["monedas"])) {

        $id_articulo=$_GET["id_articulo"];
        $id_usuario=$_GET["id_usuario"];
        $monedas=$_GET["monedas"];


        $sql = "INSERT INTO usuario_articulo(id_usuario, id_articulo) VALUES(?,?)";
        $resultado=$cnn->prepare($sql);
        $resultado->execute(array($id_usuario,$id_articulo));
        $result=$resultado->fetch();

        if(!$result){

            $update="UPDATE usuario SET monedas= ? WHERE id_usuario = ?";
            $resultado_update=$cnn->prepare($update);
            $resultado_update->execute(array($monedas,$id_usuario));

            $json=true;
            echo json_encode($json);
        }else{

            $json=NULL;
            echo json_encode($json);
        }
        $resultado->closecursor();
        $conexion = null;    
    }else{

        $json='No se pudo comunicar con el servidor';
        $conexion = null;
        echo json_encode($json);
    }
    

?>