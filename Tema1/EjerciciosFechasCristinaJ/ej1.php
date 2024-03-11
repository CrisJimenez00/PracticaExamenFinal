<?php
//Funcion que comprueba que se separa correctamente por / todo
function buenos_separadores($texto)
{
    return substr($texto, 2, 1) == "/" && substr($texto, 5, 1) == "/";
}
//Funcion que comprueba que todos los valores entre / son numéricos
function numeros_buenos($texto)
{
    return is_numeric(substr($texto, 0, 2)) && is_numeric(substr($texto, 3, 2)) && is_numeric(substr($texto, 6, 4));
}
//Función que comprueba que la fecha introducida en el input es válida
function fecha_valida($texto)
{
    return checkdate(substr($texto, 3, 2), substr($texto, 0, 2), substr($texto, 6, 4));
}
if (isset($_POST["btnCalcular"])) {
    $error_fecha1 = $_POST["fecha1"] == "" || strlen($_POST["fecha1"]) != 10 || !buenos_separadores($_POST["fecha1"]) || !numeros_buenos($_POST["fecha1"]) || !fecha_valida($_POST["fecha1"]);
    $error_fecha2 = $_POST["fecha2"] == "" || strlen($_POST["fecha2"]) != 10 || !buenos_separadores($_POST["fecha2"]) || !numeros_buenos($_POST["fecha2"]) || !fecha_valida($_POST["fecha2"]);
    $error_formulario = $error_fecha1 || $error_fecha2;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 fechas</title>
    <style>
        h1 {
            text-align: center;
        }

        form {
            background-color: lightblue;
            border: 1px solid black;
            padding: 2em;
        }

        div {
            background-color: lightgreen;
            border: 1px solid black;
            padding: 2em;
        }
    </style>
</head>

<body>
    <form action="ej1.php" method="post">
        <p><label for="fecha1">Introduzca una fecha(DD/MM/YYYY):</label>
            <input type="text" name="fecha1" id="fecha1" value="<?php
                                                                if (isset($_POST["fecha1"])) {
                                                                    echo $_POST["fecha1"];
                                                                }
                                                                ?>">
            <!--Errores en el input fecha1-->
            <?php
            if (isset($_POST["btnCalcular"]) && $error_fecha1) {
                if ($_POST["fecha1"] == "") {
                    echo "<span class='error'>Campo vacío</span>";
                } else {
                    echo "<span class='error'>Fecha no válida</span>";
                }
            }
            ?>
        </p>
        <p><label for="fecha2">Introduzca una fecha(DD/MM/YYYY):</label>
            <input type="text" name="fecha2" id="fecha2" value="<?php
                                                                if (isset($_POST["fecha2"])) {
                                                                    echo $_POST["fecha2"];
                                                                }
                                                                ?>">
            <!--Errores en el input fecha2-->
            <?php
            if (isset($_POST["btnCalcular"]) && $error_fecha2) {
                if ($_POST["fecha2"] == "") {
                    echo "<span class='error'>Campo vacío</span>";
                } else {
                    echo "<span class='error'>Fecha no válida</span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="btnCalcular">Calcular</button>
    </form>
    <?php
    if (isset($_POST["btnCalcular"]) && !$error_formulario) {
        $fecha1 = explode("/", $_POST["fecha1"]);
        $fecha2 = explode("/", $_POST["fecha2"]);
        $tiempo1 = mktime(0, 0, 0, $fecha1[1], $fecha1[0], $fecha1[2]);
        $tiempo2 = mktime(0, 0, 0, $fecha2[1], $fecha2[0], $fecha2[2]);
        /*$tiempo1=strtotime($fecha1[2]."/".$fecha1[0]."/".$fecha1[2]);
        $tiempo2=strtotime($fecha2[2]."/".$fecha2[0]."/".$fecha2[2]);*/
        $dif_segundos = abs($tiempo1 - $tiempo2);
        $dias_pasados = floor($dif_segundos / (60 * 60 * 24));
        echo "<br/>";
        echo "<br/>";
        echo "<div class='verdoso'>";
        echo "<h1>Fechas-Resultado</h1>";
        echo "<p>Las diferencias entre las dos fechas es de: <strong>$dias_pasados</strong></p>";
        echo "</div>";
    }
    ?>
</body>

</html>