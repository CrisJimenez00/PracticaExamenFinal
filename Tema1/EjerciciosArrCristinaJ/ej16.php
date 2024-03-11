<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16</title>
</head>
<body>
    <?php
        $lista=array(5=>1, 12=>2, 13=>56, "x"=>42);
        echo "<p>Lista: ";
        foreach ($lista as $indice => $contenido) {
            echo $contenido.",";
        }
        echo "</p>";
        echo "<p>Cantidad: ".count($lista)."</p>";
        print_r($lista);
        unset($lista[5]);
        echo "<p>Después: ";
        print_r($lista);
        echo "</p>";
    ?>
</body>
</html>