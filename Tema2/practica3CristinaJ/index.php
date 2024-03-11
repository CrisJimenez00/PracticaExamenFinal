<?php
$error_form = false;
function LetraNIF($dni)
{
  return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
}
function dni_bien_escrito($texto)
{
  //1º lo pasamos a mayus por si tiene letras se pueda comparar más fácilmente
  //2º Miramos que el lenght sea 9 y cogemos los primero 8 carácteres para asegurarnos que son números
  //3º Miramos que el último caracter sea una letra entre A y Z

  return strlen($texto) == 9 && is_numeric(substr($texto, 0, 8)) && substr($texto, -1) >= 'A' && substr($texto, -1) <= 'Z';
}
function dni_valido($texto)
{
  //comprobamos 1º los números
  $numero = substr($texto, 0, 8);
  //comprobamos seguidamente la última letra
  $letra = substr($texto, -1);
  //Por último miramos si coinciden la letra introducida y el método creado que crea la letra
  $valido = LetraNIF($numero) == $letra;
  //Se devuelve el booleano
  return $valido;

  //Otra forma de hacerlo
  // return LetraNIF(substr($texto,0,8))==substr($texto,-1);
}

//Se comrpueban errores
if (isset($_POST["btnGuardar"])) {

  $error_nombre = $_POST["nombre"] == "";
  $error_apellidos = $_POST["apellidos"] == "";
  $error_clave = $_POST["clave"] == "";
  $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
  $error_sexo = !isset($_POST["sexo"]);
  $error_comentarios = $_POST["comentarios"] == "";
  $error_archivo = $_FILES["archivo"]["name"] != "" &&( $_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);
  $error_form = $error_nombre || $error_apellidos || $error_clave || $error_dni || $error_sexo || $error_comentarios||$error_archivo;
}
//resetea el formulario como si fuera desde 0 
if (isset($_POST["btnBorrar"])) {
  //(es más óptima, se considera mejor)
  unset($_POST);
  //otra forma
  //header("Location:index.php");
  //exit;
}
//Si no hay errores en el formulario
if (isset($_POST["btnGuardar"]) && !$error_form) {
  require "vistas/vista_respuesta.php";
} else {
  require "vistas/vista_formulario.php";
}
