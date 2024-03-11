<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 19</title>
</head>

<body>

    <?php
    $array["Madrid"]["Pedro"]["Edad"] = "32";
    $array["Madrid"]["Pedro"]["Tlf"] = "91-9999999";
    $array["Madrid"]["Antonio"]["Edad"] = "32";
    $array["Madrid"]["Antonio"]["Tlf"] = "00-9900999";
    $array["Madrid"]["Alguien"]["Edad"] = "32";
    $array["Madrid"]["Alguien"]["Tlf"] = "00-9900999";
    $array["Barcelona"]["Susana"]["Edad"] = "34";
    $array["Barcelona"]["Susana"]["Tlf"] = "93-0000000";
    $array["Toledo"]["Nombre"]["Edad"] = "42";
    $array["Toledo"]["Nombre"]["Tlf"] = "9525954548";
    $array["Toledo"]["Nombre2"]["Edad"] = "43";
    $array["Toledo"]["Nombre2"]["Tlf"] = "9521235548";
    $array["Toledo"]["Nombre3"]["Edad"] = "41";
    $array["Toledo"]["Nombre3"]["Tlf"] = "9525004548";
    foreach ($array as $ciudades => $datos) {
        echo "<p>Amigos en " . $ciudades . "</p>";
        echo "<ol>";
        foreach ($datos as $nombres => $datos) {
            echo "<li>Nombre: " . $nombres . ".Edad: " . $datos["Edad"] . ".Telefono:" . $datos["Tlf"] . "</li>";
        }
        echo "</ol>";
    }
    ?>
</body>

</html>