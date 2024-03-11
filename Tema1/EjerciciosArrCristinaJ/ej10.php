<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10 </title>
</head>

<body>
    <?php
    //creamos el array vacío y declaramos variables
    $numeros = array();
    $valor = 1;
    $suma_par = 0;
    $indices_pares = 1;
    //Lo rellenamos de números naturales
    for ($i = 0; $i < 10; $i++) {
        array_push($numeros, $valor);
        $valor++;
    }
    //lo imprimimos
    //print_r($numeros);
    //hacemos la separación de indice pares e impares y hacemos la media
    echo "<p><b>Números impares: </b>";
    foreach ($numeros as $indice => $valor) {
        if ($indice % 2 != 0) {
            $suma_par += $valor;
            $indices_pares++;
        } else {
            echo $valor . " ";
        }
    }
    echo "</p>";
    $media = $suma_par / $indices_pares;
    echo "<p>El resultado de la media es: " . $media . "</p>";
    ?>
</body>

</html>