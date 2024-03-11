<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15</title>
</head>
<body>
    <?php
    $numeros=array(3,2,8,123,5,1);
    rsort($numeros);
    $inversa=array_reverse($numeros);
    for ($i=0; $i < count($inversa); $i++) { 
        echo $inversa[$i].", ";
    }
    ?>
</body>
</html>