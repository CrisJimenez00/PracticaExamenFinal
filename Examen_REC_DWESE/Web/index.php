
<?php
require "src/funciones_ctes.php";
if (isset($_POST["btnSalir"])) {
    $url = DIR_SERV . "/salir";
    $datos[] = $_SESSION["api_session"];
    consumir_servicios_REST($url, "POST", $datos);
    session_destroy();
    header("Location:index.php");
}

if (isset($_SESSION["usuario"])) {
    require "src/seguridad.php";
    require "vistas/vista_usuario.php";
} else {
    require "vistas/vista_home.php";
}

?>
