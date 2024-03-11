<?php
$error_form = false;
//La foto no es obligatoria pero se tiene que controlar excepciones
//Se comrpueban errores
if (isset($_POST["btnGuardar"])) {

    $error_nombre = $_POST["nombre"] == "";
    $error_sexo = !isset($_POST["sexo"]);
    $error_archivo = $_FILES["archivo"]["name"] != "" &&( $_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);
    $error_form = $error_nombre || $error_sexo ||$error_archivo;
    
}

//Si no hay errores en el formulario
if (isset($_POST["btnGuardar"]) && !$error_form) {
  require "vistas/vista_datos.php";
} else {
    require "vistas/vista_fomulario.php";
}
?>