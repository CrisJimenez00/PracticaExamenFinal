<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18</title>
</head>
<body>
    <?php
        $deportes=array("futbol", "baloncesto", "natacion", "tenis");
        echo "<p>La lista es: ";
        for ($i=0; $i < count($deportes); $i++) { 
            echo $deportes[$i];
        }
        echo "</p>";
        echo "<p>Cantidad de valoresque tiene: ".count($deportes)."</p>";
        echo "<p>Valor actual al que apunta: ".current($deportes)."</p>";
        echo "<p>Para moverme una posición en el array: ".next($deportes)."</p>";
        echo "<p>Ultimo valor del array: ".end($deportes)."</p>";
        echo "<p>Para volver una posición en el array: ".prev($deportes)."</p>";
    ?>
</body>
</html>