<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teoría fechas</title>
</head>

<body>
    <?php
    //Da la resta en segundo de la fecha actual al 1/1/1970
    echo "<p>" . time() . "</p>";

    //Así se imprime la fecha separada por / y la hora separada por : incluyendo los segundos
    //Si se le pone un segnudo argumento separado por , lo resta a la fecha del 1/1/1970 
    //Si ponemos Y nos sale el año con los 4 dígitos, si ponemos y nos sale solo los dos últimos dígitos del año
    echo "<p>" . date("d/m/y h:i:s") . "</p>";

    if (checkdate(2, 29, 2023)) {
        echo "<p>Fecha buena</p>";
    } else {
        echo "<p>Fecha mala</p>";
    }
    //mktime(hora, minuto, seg, mes, dia, año)
    echo "<p>" . date("d/m/Y", mktime(0, 0, 0, 1, 17, 2000)) . "</p>";

    //hace lo mismo que mktime, solo que metes la fecha y te da la resta en segundos automáticamente
    echo "<p>" . strtotime("01/17/2000") . "</p>";

    //redondea hacia abajo
    echo "</p>" . floor(6.5) . "</p>";

    //redondea hacia arriba
    echo "</p>" . ceil(6.5) . "</p>";
    //Valor absoluto
    echo "</p>" . abs(-6.5) . "</p>";

    //te muestra como si fuera x, es para modificar el formato en el que aparece por pantalla
    printf("<p>%.2f</p>", 5.6666 * 7.8888);

    //Almacena el string que contiene ese printf
    $resultado = sprintf("<p>%.2f</p>", 5.6666 * 7.8888);
    echo $resultado;
    //ejemplo de caso de uso de printf y sprintf
    for ($i = 1; $i <= 20; $i++) {
        //Dos formas de mostrar lo mismo por pantalla
        /*if ($i < 10) {
            echo "<p>0" . $i . "</p>";
        } else {
            echo "<p>" . $i . "</p>";
        }*/
        //La condición de aquí significa 2 dígitos y en los que no haya nada delante que lo rellene de 0
        echo "<p>" .sprintf("%02d", $i). "</p>";
    }
    ?>
</body>

</html>