<?php
    include 'Conexion.php';
	ini_set('mssql.charset', 'UTF-8');
    $conexion = new Conexion();
    $cnn = $conexion->getConexion();
    if(isset($_POST["id_usuario"]) && isset($_POST["id_articulo"]) ) {

        $id_articulo=$_POST["id_articulo"];
        $id_usuario=$_POST["id_usuario"];

        $sql = "insert into usuario_articulo(`id_usuario`, `id_articulo`) values(?,?);";
        $resultado=$cnn->prepare($sql);
        $resultado->execute(array($id_usuario,$id_articulo));
        $result=$resultado->fetch();

        if($result){

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