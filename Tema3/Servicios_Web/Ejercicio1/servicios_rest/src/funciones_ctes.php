<?php

define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");


function obtener_productos()
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["mensaje_error"] = "<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>";
        return $respuesta;
    }

    try {
        $consulta = "select * from producto";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["mensaje_error"] = "No se ha podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    $respuesta["productos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}

function obtener_producto($codigo)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["mensaje_error"] = "<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>";
        return $respuesta;
    }

    try {
        $consulta = "select * from producto where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$codigo]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["mensaje_error"] = "No se ha podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    if ($sentencia->rowCount() > 0) {
        $respuesta["productos"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $respuesta["mensaje"] = "El producto con cod: " . $codigo . " no se encuentra en la BD";
    }
    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
function insertar_producto($datos)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["mensaje_error"] = "<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>";
        return $respuesta;
    }

    try {
        $consulta = "insert into producto(cod,nombre,nombre_corto,descripcion,PVP,familia) values (?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["mensaje_error"] = "No se ha podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    $respuesta["mensaje"] = "Se ha insertado correctamente";

    $sentencia = null;
    $conexion = null;
    return $respuesta;
}
