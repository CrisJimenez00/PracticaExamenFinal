<?php
if (isset($_POST["btnCalcular"])) {
    $error_fecha1 = !checkdate($_POST["mes1"], $_POST["dia1"], $_POST["anyo1"]);
    $error_fecha2 = !checkdate($_POST["mes2"], $_POST["dia2"], $_POST["anyo2"]);
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
    <form action="ej2.php" method="post">
        <p>Introduzca una fecha:
        <p>Día:
            <select name="dia1">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    if (isset($_POST["btnCalcular"]) && $_POST["dia1"] == $i) {
                        echo "<option value='$i' selected>$i</option>";
                    } else {
                        echo "<option value='$i'>$i</option>";
                    }
                }
                ?>
            </select>
            Mes:
            <select name="mes1">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $fecha = DateTime::createFromFormat('!m', $i);
                    $mes = strftime("%B", $fecha->getTimestamp());
                    if (isset($_POST["btnCalcular"]) && $_POST["mes1"] == $i) {
                        echo "<option value='$i' selected>$mes</option>";
                    } else {
                        echo "<option value='$i'>$mes</option>";
                    }
                }
                ?>
            </select>
            Año:
            <select name="anyo1">
                <?php
                for ($i = 1970; $i <= 2023; $i++) {
                    if (isset($_POST["btnCalcular"]) && $_POST["anyo1"] == $i) {
                        echo "<option value='$i' selected>$i</option>";
                    } else {
                        echo "<option value='$i'>$i</option>";
                    }
                }
                ?>
            </select>
        </p>
        <!--Errores en el input fecha1-->
        <?php
        if (isset($_POST["btnCalcular"]) && $error_fecha1) {

            echo "<span class='error'>Fecha no válida</span>";
        }
        ?>
        </p>
        <p><label for="fecha2">Introduzca una fecha:</label>
        <p>Día:
            <select name="dia2">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    if (isset($_POST["btnCalcular"]) && $_POST["dia2"] == $i) {
                        echo "<option value='$i' selected>$i</option>";
                    } else {
                        echo "<option value='$i'>$i</option>";
                    }
                }
                ?>
            </select>
            Mes:
            <select name="mes2">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $fecha = DateTime::createFromFormat('!m', $i);
                    $mes = strftime("%B", $fecha->getTimestamp());
                    if (isset($_POST["btnCalcular"]) && $_POST["mes2"] == $i) {
                        echo "<option value='$i' selected>$mes</option>";
                    } else {
                        echo "<option value='$i'>$mes</option>";
                    }
                }
                ?>
            </select>
            Año:
            <select name="anyo2">
                <?php
                for ($i = 1970; $i <= 2023; $i++) {

                    if (isset($_POST["btnCalcular"]) && $_POST["anyo2"] == $i) {
                        echo "<option value='$i' selected>$i</option>";
                    } else {
                        echo "<option value='$i'>$i</option>";
                    }
                }
                ?>
            </select>

            <!--Errores en el input fecha2-->
            <?php
            if (isset($_POST["btnCalcular"]) && $error_fecha2) {

                echo "<span class='error'>Fecha no válida</span>";
            }
            ?>
        </p>
        </p>
        <button type="submit" name="btnCalcular">Calcular</button>
    </form>
    <?php
    if (isset($_POST["btnCalcular"]) && !$error_formulario) {
        $seg1 = mktime(0, 0, 0, $_POST["mes1"], $_POST["dia1"], $_POST["anyo1"]);
        $seg2 = mktime(0, 0, 0, $_POST["mes2"], $_POST["dia2"], $_POST["anyo2"]);

        $dias = ($seg1 - $seg2) / (3600 * 24);

        $dias_pasados = abs(floor($dias));
        echo "<br/>";
        echo "<br/>";
        echo "<div class='verdoso'>";
        echo "<h1>Fechas-Resultado</h1>";
        echo "<p>Las diferencias entre las dos fechas es de: <strong>$dias_pasados días</strong></p>";
        echo "</div>";
    }
    ?>
</body>

</html>