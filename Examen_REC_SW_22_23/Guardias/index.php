<?php

session_name("Examen_22_23");
session_start();
require "src/funciones_ctes.php";
if(isset($_POST["btnSalir"])){
    $url=DIR_SERV."/salir";
        $respuesta=consumir_servicios_REST($url,"POST");
        session_destroy();
        header("Location:index.php");
}
if(isset($_SESSION["usuario"])){
    require "src/seguridad.php";
    require "vistas/vista_examen.php";
}else{
    require "vistas/vista_home.php";
}
if (isset($_POST["btnLogin"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_usuario || $error_clave;
}
if (isset($_POST["btnLogin"])&&!$error_form) {
    $datos["usuario"] = $_POST["usuario"];
    $datos["clave"] = md5($_POST["clave"]);
    consumir_servicios_REST(DIR_SERV."/login", "POST", $datos);
}
?>
</body>

</html>