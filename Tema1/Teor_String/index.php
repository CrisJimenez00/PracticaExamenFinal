<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria String</title>
</head>
<body>
    <?php
        $str1="Hola";
        //Quita los espacios
        $str1=trim($str1);
        $str2="Juan";
        echo "<h1>".$str1." ".$str2."</h1>";

        //funciones String
        //Calcula longitud
        $longitud=strlen($str1);
        echo "<p>La longitud del String '".$str1."' es: ".$longitud."</p>";
        //Añadimos un caracter en una posición concreta
        $str1[4]="!";
        echo "<p>".$str1."</p>";
        //Todo a mayus
        echo "<p>".strtoupper($str1)."</p>";
        //Todo en minus
        echo "<p>".strtolower($str1)."</p>";
$sep_arr=explode(" ", $str1);
    ?>
</body>
</html>