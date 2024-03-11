<?php

define('SERVIDOR_BD', 'localhost');
define('USUARIO_BD', 'jose');
define('CLAVE_BD', 'josefa');
define('NOMBRE_BD', 'bd_tienda');

function login($usuario, $clave){

    //conexión PDO
    try {
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD, USUARIO_BD, CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        return array("mensaje_error"=>"No ha podido conectarse a la base de batos: ".$e->getMessage());
    }

    //consulta PDO
    try{
        $consulta="select * from usuarios where usuario=? and contrasena=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        return array("mensaje_error"=>"No se ha podido realizar la consulta: ".$e->getMessage());
    }

    //respuesta PDO
    if ($sentencia->rowCount()==0) {
        $respuesta["mensaje"]="El usuario no se encuentra registrado en la BD";
    } else {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
    }
    $sentencia=null;
    $conexion=null;
    return $respuesta;

}

?>