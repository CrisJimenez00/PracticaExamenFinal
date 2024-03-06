<?php
if (isset($_POST["equipo"])) {


    $url = DIR_SERV . "/deGuardia/". $_POST["dia"] ."/". $_POST["hora"] ."/". $datos_usuario_log->id_usuario;
    $respuesta = consumir_servicios_REST($url, "GET", $datos);
    $obj = json_decode($respuesta);
    
    if (isset($obj->error)) {
        session_destroy();
        die(error_page("Examen4 DWESE Curso 23-24", "Gestion de Horario", $obj->error));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Guardias</title>
    <style>
        table,
        th,
        td,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        .enlace {
            background-color: white;
            color: blue;
            text-decoration: underline;
            border: none;
        }
    </style>
</head>

<body>
    <h1>Gestoin de Guardias</h1>
    <form action="index.php" method="post">
        <p>Bienvenido <?php echo $datos_usuario_log->usuario; ?></p>
        <button type="submit" name="btnSalir">Salir</button>

    </form>
    <?php
    $dias[] = "Lunes";
    $dias[] = "Martes";
    $dias[] = "Miércoles";
    $dias[] = "Jueves";
    $dias[] = "Viernes";
    echo "<h1>Equipos de Guardia del IES Mar de Alborán</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>Horas</th>";
    for ($i = 1; $i <= 5; $i++) {
        echo "<th>" . $dias[$i-1] . "</th>";
    }

    echo "</tr>";
    $contador = 1;
    for ($hora = 1; $hora <= 6; $hora++) {
        if ($hora == 4) {
            echo "<tr><td colspan='6'>RECREO</td></tr>";
        }
        echo "<tr>";
        echo "<td>" . $hora . "º Hora</td>";
        for ($dia = 1; $dia <= 5; $dia++) {
            echo "<td>";
            echo "
            <form action='index.php' method='post'>
                <input type='hidden' name='dia' value='$dia'>
                <input type='hidden' name='hora' value='$hora'>
                <input type='hidden' name='equipo' value='$contador'>
                <button name='btnGuardia' class='enlace'>Equipo $contador</button>
            </form>";
            echo "</td>";
            $contador++;
        }
        echo "</tr>";
    }

    echo "</table>";
    if (isset($obj)&&isset($_POST["equipo"])) {
        echo "<h1>Equipo de Guardia" . $_POST["equipo"] . "</h1>";
        if ($obj->de_guardia) {

            echo "<h3>" . $dias[$_POST["dia"]] . " a " . $_POST["hora"] . "º hora</h3>";
        } else {
            echo "<h3>Usted no se encuentra de guardia a " . $dias[$_POST["dia"]] . " a " . $_POST["hora"] . "º hora</h3>";
        }
    }
    ?>
</body>

</html>