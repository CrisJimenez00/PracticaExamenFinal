<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14</title>
    <style>
        table,
        tr,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    $estadios_futbol = array("Barcelona" => "Camp Nou", "Real Madrid" => "Santiago Bernabeu", "Valencia" => "Mestalla", "Real Sociedad" => "Anoeta");
    echo "<h3>Antes</h3>";
    echo "<table>";
    echo "<tr><th>Equipos</th><th>Estadios</th></tr>";
    foreach ($estadios_futbol as $indice => $contenido) {
        echo "<tr>";
        echo "<td>" . $indice . "</td>";
        echo "<td>" . $contenido . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    unset($estadios_futbol["Real Madrid"]);
    echo "<h3>Despues</h3>";
    echo "<ol>";
    foreach ($estadios_futbol as $indice => $contenido) {
        
        echo "<li>" . $indice . "</li>";
        echo "<ul>";
        echo "<li>" . $contenido . "</li>";
        echo "</ul>";
        
    }
    echo "</ol>";
    ?>
</body>

</html>