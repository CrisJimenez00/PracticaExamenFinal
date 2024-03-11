<?php
function dia($numero)
{
    switch ($numero) {
        case 1:
            return "Lunes";
        case 2:
            return "Martes";
        case 3:
            return "Miércoles";
        case 4:
            return "Jueves";
        case 5:
            return "Viernes";
    }
}
function hora($numero)
{
    switch ($numero) {
        case 1:
            return "8:15 – 9:15";
        case 2:
            return "9:15 – 10:15";
        case 3:
            return "10:15 – 11:15";
        case 4:
            return "11:15 –11:45";
        case 5:
            return "11:45 –12:45";
        case 6:
            return "12:45 –13:45";
        case 7:
            return "13:45 –14:45";
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
        button {
            background-color: white;
            border: none;
            color: blue;
            text-decoration: blue;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>

<body>
    <h1>Gestion de Guardias</h1>
    <p>
    <form action="index.php" method="post">Bienvenido <strong><?php echo $_SESSION["usuario"]; ?></strong> -
        <button type="submit" name="btnSalir">Salir</button>
    </form>
    </p>
    <h3>Hoy es <?php echo dia(date("w")); ?></h3>
    <table>
        <tr>
            <th>Hora</th>
            <th>Profesor de Guardia</th>
            <th>Informacion del Profesor con ID:<?php
                                                if (isset($_POST["id_profesor"])) {
                                                    $_POST["id_profesor"];
                                                }
                                                ?></th>
        </tr>
        <?php
        $hora_consulta = 1;
        $url = DIR_SERV . "/usuariosGuardia/" . date("w") . "/" . $hora_consulta;
        $datos[] = $_SESSION["api_session"];
        $respuesta = consumir_servicios_REST($url, "GET", $datos);
        $obj2 = json_decode($respuesta);
        if (!$obj2) {
            session_destroy();
            echo "Error al consumir servicio: " . $url;
        }
        if (isset($obj2->error)) {
            session_destroy();
            echo $obj2->error;
            exit();
        } else {
            $hora_consulta++;
        }
        for ($hora = 1; $hora <= 7; $hora++) {
            echo "<tr>";
            //1ºParte(Las horas)
            echo "<td>";
            echo hora($hora);
            echo "</td>";
            //esto es solo para ver si está bien las filas
            /*if ($hora == 3) {
                echo "<td colspan='2'>";
                echo "RECREO";
                echo "</td>";
            }*/

            echo "<td>";
            echo "<ol>";
            foreach ($obj2->usuario as $tupla) {
                //echo $tupla->nombre
        ?>
        <li>
                    <form action="index.php" method="post">
                        <button type="submit" value="<?php $tupla->id_usuario ?>" name="id_profesor"><?php echo $tupla->nombre; ?>
                    </button></form>
            </li><?php
                
            }
            echo "</td>";
            echo "<td>";
            if (isset($_POST["id_profesor"])) {
                $url = DIR_SERV . "/usuario/" . $_POST["id_profesor"];
                $datos[] = $_SESSION["api_session"];
                $respuesta = consumir_servicios_REST($url, "GET", $datos);
                $obj3 = json_decode($respuesta);
                if (!$obj3) {
                    session_destroy();
                    echo "Error al consumir servicio: " . $url;
                }
                if (isset($obj3->error)) {
                    session_destroy();
                    echo $obj3->error;
                    exit();
                } else {
                    echo $_POST["id_profesor"];
                    var_dump($obj3);
                }
            }
            echo "</td>";

            //Hacer botones hidden los cuales pasen por value el id del profesor !importante para mostrarlo todo

            echo "</tr>";
            echo "</ol>";
        }
        ?>
    </table>
</body>

</html>