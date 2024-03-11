<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    define("PI", 3.1415);
    echo "<h1>Apuntes tema 1 part 1</h1>";

    //Variables
    $a = 8;
    $b = 9;

    //Ejecución de la suma
    $c = $b + $a;

    //Muestra del resultado
    echo "<p>El resultado de sumar " . $a . " + " . $b . " es: " . $c . "<p>";

    //Sentencia condicional
    if (3 > $c) {
        echo "<p> 3 es mayor que " . $c . "</p>";
    } else if (3 == $c) {
        echo "<p>3 es igual que " . $c . "</p>";
    } else {
        echo "<p>3 es menor que " . $c . "</p>";
    }

    //Switch
    $d=3;
    switch ($d) {
        case 1:
            $c = $a - $b;
            break;
        case 2:
            $c = $a / $b;
            break;
        case 3:
            $c = $a * PI;
            break;
        default:
            $c = $a + $b;
            break;
    }
    echo "<p>El resultado del switch es: ".$c."</p>";

    //Bucle for
    for ($i=0; $i < 8; $i++) { 
        echo "<p>Hola ".($i+1)."</p>";
    }
    //Bucle while
    $i=0;
    while($i<=8){
        echo "<p>Hola nº ".($i+1)."</p>";
        $i++;
    }
    ?>
</body>

</html>