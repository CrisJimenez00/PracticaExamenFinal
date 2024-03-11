<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>

<body>
    <?php
    $ciudades = array("MD" => "Madrid", "BC" => "Barcelona", "LD" => "Londres", "NY" => "New York", "LA" => "Los Ángeles", "CG" => "Chicago");
    foreach ($ciudades as $indice => $contenido) {
        echo "El indice del array que contiene como valor " . $contenido . " es " . $indice . "<br/>";
    }
    ?>
</body>

</html>