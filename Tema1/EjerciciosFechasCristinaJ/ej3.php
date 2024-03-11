<?php
if (isset($_POST["guardar"])) {
    $error_fecha1 = $_POST["fecha1"] == "";
    $error_fecha2 = $_POST["fecha2"] == "";
    $error_form = $error_fecha1 || $error_fecha2;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Fecha3</title>
    <meta charset="UTF-8" />
    <style>
        .formulario {
            background-color: lightblue;
            border: 2px solid black;
        }

        .respuesta {
            background-color: lightgreen;
            border: 2px solid black;
            margin-top: 2em
        }

        h1 {
            text-align: center
        }

        form,
        .respuesta p {
            margin-left: 2em
        }
    </style>
</head>

<body>
    <div class='formulario'>
        <h1>Fechas - Formulario</h1>
        <form method="post" action="ej3.php" enctype="multipart/form-data">
            <p>Introduzca una fecha:
                <input type="date" name="fecha1" value="<?php if (isset($_POST["fecha1"])) echo $_POST["fecha1"]; ?>" />

                <?php
                if (isset($_POST["guardar"]) && $_POST["fecha1"] == "")
                    echo "*Campo vacio*";
                ?>
            </p>

            <p>Introduzca una fecha:
                <input type="date" name="fecha2" value="<?php if (isset($_POST["fecha2"])) echo $_POST["fecha2"]; ?>" />
                <?php
                if (isset($_POST["guardar"]) && $_POST["fecha2"] == "")
                    echo "*Campo vacio*";
                ?>

            </p>

            <br />
            <button type="submit" name="guardar">Calcular</button>
            <br />
        </form>
    </div>
    <?php
    if (isset($_POST["guardar"]) && !$_POST["fecha2"] == "" && !$_POST["fecha1"] == "") {
        $seg1 = strtotime($_POST["fecha1"]);
        $seg2 = strtotime($_POST["fecha2"]);

        $dias = ($seg1 - $seg2) / (24 * 60 * 60);
        $dias = floor(abs($dias));
        echo "<div class='respuesta'>";
        echo "<h1>Fechas - Resultado</h1>";
        echo "<p> Hay <strong>$dias</strong> dias de diferencia</p>";
        echo "</div>";
    }




    ?>

</body>

</html>