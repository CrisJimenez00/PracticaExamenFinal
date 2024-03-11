<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>

<body>
    <?php
    $ciudades = array("Madrid", "Barcelona", "Londres", "New York", "Los Ángeles", "Chicago");
    foreach ($ciudades as $indice => $contenido) {
        echo "La ciudad con el indice " . $indice . " tiene el nombre de " . $contenido . "<br/>";
    }
    ?>
</body>

</html>