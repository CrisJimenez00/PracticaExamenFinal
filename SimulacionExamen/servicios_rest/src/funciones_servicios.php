<?php
require "config_bd.php";

function conexion_pdo()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        $respuesta["mensaje"] = "Conexi&oacute;n a la BD realizada con &eacute;xito";

        $conexion = null;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
    }
    return $respuesta;
}

    function login($usuario,$clave){
        //Conectamos primero
        try {
            $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $e) {
            $respuesta["error"] = "Imposible conectar:" . $e->getMessage();
            return $respuesta;
        }

        //Hacemos la consulta
        try {
            $consulta= "select * from usuarios where usuario=? and clave=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$usuario,$clave]);
        } catch (PDOException $e) {
            $respuesta["error"]="Imposible realizar la consulta: ".$e->getMessage();
            $sentencia=null;
            $conexion=null;
            return $respuesta;
        }
        //recorremos el resultado
        if ($sentencia->rowCount()>0) {
            $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
            session_name("Examen_SW_23_24");
            session_start();
            $_SESSION["usuario"]=$respuesta["usuario"]["usuario"];
            $_SESSION["clave"]=$respuesta["usuario"]["clave"];
            $_SESSION["tipo"]=$respuesta["usuario"]["tipo"];
            $respuesta["api_session"]=session_id();
        }else{
            $respuesta["mensaje"]="El usuario no se encuentra en la base de datos";
        }
        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
?>