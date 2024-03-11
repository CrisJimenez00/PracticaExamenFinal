<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 ficheros</title>
    <style>
        table,tr,td,th{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0.5em;
        }
        </style>
</head>

<body>
    <h2>Mostrar tabla</h2>

    <?php
    $count_linea = 1;
    @$fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
    if (!$fd) {
        echo "<p>No se ha podido abrir bien el archivo</p>";
    } else {
        echo "<table>";
        $linea = fgets($fd);

        $datos_linea = explode("\t", $linea);
        $n_col = count($datos_linea);
        echo "<tr>";
        for ($i = 0; $i < $n_col; $i++) {
            $division2 = explode(",", $datos_linea[0]);
            if ($i == 0) {
                echo "<th>" . $division2[2] . "</th>";
            } else {
                echo "<th>" . $datos_linea[$i] . "</th>";
            }
        }
        echo "</tr>";

        while ($linea = fgets($fd)) {
            if ($count_linea == 1) {
                $count_linea++;
            } else {
                $division = explode("\t", $linea);
                echo "<tr>";
                for ($i = 0; $i < count($division); $i++) {
                    if ($i == 0) {
                        $division2 = explode(",", $division[$i]);
                        echo "<th>" . end($division2) . "</th>";
                        $i++;
                    }
                    echo "<td>" . $division[$i] . "</td>";
                }
                echo "</tr>";
            }
        }
        echo "</table>";
    }
    fclose($fd);
    ?>
</body>

</html>