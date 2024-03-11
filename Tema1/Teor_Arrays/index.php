<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria Array</title>
</head>

<body>
    <?php
    //Array escalar
    /*$nota[0] = 5;
    $nota[1] = 9;
    $nota[2] = 8;
    $nota[3] = 5;
    $nota[4] = 6;
    $nota[5] = 7;*/

    //Otra forma de declarar el array
    $nota = array(0 => 5, 9, 8, 5, 6, 7);

    /*print_r($nota);
    echo "<br>";
    var_dump($nota);*/

    echo "<h1>Recorrido de un array escalar con sus indices correlativos</h1>";
    for ($i = 0; $i < count($nota); $i++) {
        echo "<p>En la posicion " . $i . " tiene el valor: " . $nota[$i] . "</p>";
    }

    //Muestra de que los Arrays pueden ser mezclados el tipo de dato
    /*$valor[0] = 18;
    $valor[1] = "Hola";
    $valor[2] = true;
    $valor[3] = 3.4;*/

    /*$valor[] = 18;
    $valor[99] = "Hola";
    $valor[] = true;
    $valor[200] = 3.4;*/
    $valor = array(18, 99 => "Hola", false, 200 => 3.4);

    /*echo "<br>";
    var_dump($valor);*/

    echo "<h1>Recorrido de un array escalar con sus indices NO correlativos</h1>";
    foreach ($valor as $indice => $contenido) {
        echo "<p>en la posición: " . $indice . " tiene el valor: " . $contenido . "</p>";
    }

    echo "<h1>Notas de los alumnos</h1>";
    $notas["Antonio"]["DWESE"] = 5;
    $notas["Antonio"]["DWEC"] = 7;
    $notas["Luis"]["DWESE"] = 9;
    $notas["Luis"]["DWEC"] = 7;
    $notas["Ana"]["DWESE"] = 9;
    $notas["Ana"]["DWEC"] = 8;
    $notas["Eloy"]["DWESE"] = 5;
    $notas["Eloy"]["DWEC"] = 6;
    $contador = 0;
    /*echo "<br>";
    var_dump($notas);*/
    foreach ($notas as $indice => $contenido) {
            echo "<p>" . $indice;
            echo "<ul>";
            foreach ($notas[$indice] as $indice2 => $contenido2) {
                echo "<li>";
                echo $indice2."=>".$contenido2;
                echo "</li>";
            }
            echo "</ul>";
         echo "</p>";
    }

    $capital=array("Castilla y Leon"=>"Valladolid", "Asturias"=>"Oviedo", "Aragón"=>"Zaragoza");
    echo "<p>Ultimo valor del array: ".end($capital)."</p>";
    echo "<p>Valor actual al que apunta: ".current($capital)."</p>";
    echo "<p>Indice del que está apuntando: ".key($capital)."</p>";
    echo "<p>Primer valor del array: ".reset($capital)."</p>";
    echo "<p>Para moverme una posición en el array: ".next($capital)."</p>";
    echo "<p>Para volver una posición en el array: ".prev($capital)."</p>";
    while(current($capital)){
        echo "<strong>".current($capital)."</strong><br/>";
        next($capital);
    }
    ?>
</body>

</html>