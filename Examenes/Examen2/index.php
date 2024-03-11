<?php

function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        .centro {
            text-align: center;
        }

        table,
        td,
        tr,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        table {
            width: 80%;
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
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <?php
    //Select loquesea from tabla where clave1=clave2

    //Creamos la conexión
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_horarios_exam");
        mysqli_set_charset($conexion, 'utf8');
    } catch (Exception $e) {
        die("<p>No ha podido conectarse con la base de datos " . $e->getMessage() . "</p></body></html>");
    }

    //Si existe la conexion creamos el select para elegir profesor
    //PRIMER SELECT
    if ($conexion) {
        try {
            $consulta = "select * from usuarios";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("No se puede", "No se puede realizar la consulta select en la base de datos"));
        }
    ?>
        <form action="index.php" method="post">
            <p>Horario del Profesor:
                <select name="profesor" id="profesor">
                    <?php

                    while ($tupla = mysqli_fetch_assoc($resultado)) {

                        if (isset($_POST["profesor"]) && $_POST["profesor"] == $tupla["id_usuario"]) {
                            echo "<option selected value='" . $tupla["id_usuario"] . "'>";
                            echo "<p>" . $tupla["nombre"] . "</p>";
                            echo "</option>";
                            //Almacenamos el nombre y el id para poder hacer las consultas con más comodidad
                            $nombre_profesor = $tupla["nombre"];
                            $id_profesor = $tupla["id_usuario"];
                        } else {
                            echo "<option value='" . $tupla["id_usuario"] . "'>";
                            echo "<p>" . $tupla["nombre"] . "</p>";
                            echo "</option>";
                        }
                    }
                    ?>
                </select>
                <?php

                echo  "<button type='submit' name='btnVerHorario' >Ver Horario</button>";
                if (isset($_POST["btnVerHorario"])) {
                    if (isset($_POST["profesor"])) {
                        $_SESSION["id_profesor"] = $_POST["profesor"];
                    }
                    //Mantenemos valores de nombre en el título pero no en el select
                    if (isset($nombre_profesor)) {
                        $_SESSION["nombre_profesor"] = $nombre_profesor;
                    }
                }
                ?>
            </p>
        </form>

    <?php
        $hora = 8;
        $minutos = 15;
        //Sale correctamente el nombre del profesor
        if (isset($_POST["btnVerHorario"]) || isset($_POST["btnEditar"])) {
            if (isset($nombre_profesor)) {
                echo "<h2 class='centro'>Horario del profesor: <i>" . $nombre_profesor . "</i></h2>";
            } elseif (isset($_SESSION["nombre_profesor"])) {
                echo "<h2 class='centro'>Horario del profesor: <i>" . $_SESSION["nombre_profesor"] . "</i></h2>";
            }
            //Creamos la tabla
            echo "<table><tr><th>Horas</th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th></tr>";
            //Para que en caso de que no esté la conexión hacer otra
            if (!isset($conexion)) {
                try {
                    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_horarios_exam");
                    mysqli_set_charset($conexion, 'utf8');
                } catch (Exception $e) {
                    die("<p>No ha podido conectarse con la base de datos " . $e->getMessage() . "</p></body></html>");
                }
            }
            //Si existe la conexion creamos el select para elegir profesor
            if (isset($_SESSION["id_profesor"])) {
                //SELECT PARA MOSTRAR LAS CLASES DE ESE PROFESOR
                try {
                    $consulta = "select * from usuarios, horario_lectivo where usuarios.id_usuario=horario_lectivo.usuario and usuarios.id_usuario='" . $_SESSION["id_profesor"] . "'";
                    $resultado = mysqli_query($conexion, $consulta);
                } catch (Exception $e) {
                    mysqli_close($conexion);
                    die(error_page("No se puede", "No se puede realizar la consulta select de las clases en la base de datos"));
                }

                //Para mostrar las horas correctamente
                for ($i = 0; $i <= 7; $i++) {
                    echo "<tr>";
                    if ($i < 3) {
                        echo "<th>$hora:$minutos-" . ($hora + 1) . ":$minutos</th>";
                        $hora++;

                        for ($j = 0; $j < 5; $j++) {
                            echo "<td>";
                            while ($tupla = mysqli_fetch_assoc($resultado)) {
                                //echo print_r($tupla);

                                if ($tupla["usuario"] == $_SESSION["id_profesor"]) {
                                    if ($j == $tupla["dia"] - 1) {
                                        if ($i == $tupla["hora"] - 1) {

                                            echo $tupla["grupo"];
                                        }
                                    }
                                }
                            }

                            echo "<form action='index.php' method='post'><button type='submit' class='enlace' name='btnEditar' value='$i'>Editar</button></form></td>";
                        }
                    }
                    if ($i == 4) {
                        echo "<th>$hora:$minutos-";
                        $minutos = 45;
                        echo "$hora:$minutos</th>";
                        echo "<td colspan='5' class='centro'>RECREO</td>";
                    }


                    if ($i > 4 && $i <= 7) {
                        echo "<th>$hora:$minutos-" . ($hora + 1) . ":$minutos</th>";
                        $hora++;
                        for ($k = 0; $k < 5; $k++) {
                            echo "<td><form action='index.php' method='post'><button type='submit' class='enlace' name='btnEditar' value='" . $i . "'>Editar</button></form></td>";
                        }
                    }
                    echo "</tr>";
                }

                echo "</table>";
                if (isset($_POST["btnEditar"])) {

                    //Para que salga el titulo de editar bien
                    $hora = 8;
                    $minutos = 15;
                    for ($i = 0; $i <= 7; $i++) {
                        if ($_POST["btnEditar"] + 1 == 1) {
                            echo "<h2>Editando " . ($_POST["btnEditar"] + 1) . "º hora";
                            echo "($hora:$minutos -" . ($hora + 1) . ":$minutos)";
                            $hora++;
                            break;
                        } else {
                            $hora++;
                        }
                        if ($_POST["btnEditar"] + 1 == 2) {
                            echo "<h2>Editando " . ($_POST["btnEditar"] + 1) . "º hora";
                            echo "($hora:$minutos -" . ($hora + 1) . ":$minutos)";
                            $hora++;
                            break;
                        } else {
                            $hora++;
                        }
                        if ($_POST["btnEditar"] + 1 == 3) {
                            echo "<h2>Editando " . ($_POST["btnEditar"] + 1) . "º hora";
                            echo "($hora:$minutos -" . ($hora + 1) . ":$minutos)";
                            $hora++;
                            break;
                        } else {
                            $hora++;
                        }
                        if ($_POST["btnEditar"] + 1 == 4) {
                            echo "<h2>Editando " . ($_POST["btnEditar"] + 1) . "º hora";
                            echo "($hora:$minutos-";
                            $minutos = 45;
                            echo "$hora:$minutos";
                        } else {
                            $hora++;
                        }
                        if ($_POST["btnEditar"] == 5) {
                            echo "<h2>Editando " . ($_POST["btnEditar"]-1) . "º hora";
                            $minutos = 45;
                            echo "($hora:$minutos -" . ($hora + 1) . ":$minutos)";

                            $hora++;
                            break;
                        } else {
                            $hora++;
                        }

                        if ($_POST["btnEditar"] == 6) {
                            echo "<h2>Editando " . ($_POST["btnEditar"] - 1) . "º hora";
                            $minutos = 45;
                            echo "($hora:$minutos -" . ($hora + 1) . ":$minutos)";
                            $hora++;
                            break;
                        } else {
                            $hora++;
                        }
                        if ($_POST["btnEditar"] == 7) {
                            echo "<h2>Editando " . ($_POST["btnEditar"] - 1) . "º hora";
                            $minutos = 45;
                            echo "($hora:$minutos -" . ($hora + 1) . ":$minutos)";
                            $hora++;
                            break;
                        }
                    }
                    echo "</h2>";
                }
            }
        }
    }
    ?>

</body>

</html>