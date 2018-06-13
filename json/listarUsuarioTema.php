<?php
	include 'Conexion.php';
	ini_set('mssql.charset', 'UTF-8');
	$conexion = new Conexion();
    $cnn = $conexion->getConexion();
    if(isset($_GET["id_usuario"])&& isset($_GET["id_tema"])){
        $id_usuario=$_GET["id_usuario"];
        $id_tema=$_GET["id_tema"];
        // usuario tema regreso objeto usuariotema usuario tem porceas
        $sql="select * from usuario_tema where id_usuario = ? and id_tema = ?;";
        $resultado=$cnn->prepare($sql);
        $resultado->execute(array($id_usuario,$id_tema));
        if($resultado){
            $result = $resultado->fetch(PDO::FETCH_ASSOC);
            echo $result;
    }
}

?>