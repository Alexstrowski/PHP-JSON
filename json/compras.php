<?php
    include 'Conexion.php';
	ini_set('mssql.charset', 'UTF-8');
    $conexion = new Conexion();
    $cnn = $conexion->getConexion();
    if(isset($_GET["id_usuario"]) && isset($_GET["id_articulo"]) ) {
        $id_articulo=$_GET["id_articulo"];
        $id_usuario=$_GET["id_usuario"];
        $monedas=$_GET["monedas"];

        $sql = "insert into usuario_articulo(`id_usuario`, `id_articulo`) values(?,?);";
        $resultado=$cnn->prepare($sql);
        $resultado->execute(array($id_usuario,$id_articulo));
        $result=$resultado->fetch();

        if(!$result){
            $json=true;
            $update="UPDATE usuario SET monedas= ? WHERE id_usuario = ?";
            $resultado_update=$cnn->prepare($update);
            $resultado_update->execute(array($monedas,$id_usuario));
            $sql = "insert into usuario_asignatura(`id_usuario`, `id_asignatura`,`porcentaje`) values(?,?,?);";
            $resultado_insert=$cnn->prepare($sql);
            $resultado_insert->execute(array($id_usuario,$id_articulo,0.0));
            $result_insert=$resultado_insert->fetch();
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