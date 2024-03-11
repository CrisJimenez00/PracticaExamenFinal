<?php
/*$url = DIR_SERV . "/logueado";
$datos["usuario"] = $_SESSION["usuario"];
$datos["clave"] = $_SESSION["clave"];
$respuesta = consumir_servicios_REST($url, "GET", $datos);
$obj = json_decode($respuesta);
if (!$obj) {
    session_destroy();
    echo "Error al consumir servicio: " . $url;
}
if (isset($obj->error)) {
    session_destroy();
    echo $obj->error;
    exit();
}
if (isset($obj->no_auth)) {
    session_unset();
    echo $obj->no_auth;
}
header("Location:index.php");
$datos_usu_log = $obj;

var_dump($datos_usu_log);*/

if (time() - $_SESSION["ultima_accion"] > MINUTOS * 60) {
    $url = DIR_SERV . "/salir";
    $datos[] = $_SESSION["api_session"];
    consumir_servicios_REST($url, "POST", $datos);
    session_destroy();
    header("Location:index.php");
}
