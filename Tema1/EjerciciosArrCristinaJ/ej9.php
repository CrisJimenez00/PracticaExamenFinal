<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
    <style>
        table,tr,td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    $lenguaje_cliente = array("LCI" => "Lenguaje Cliente", "LCI2" => "Lenguaje Cliente2", "LCI3" => "Lenguaje Cliente3", "LCI4" => "Lenguaje Cliente4");
    $lenguajes_servidor = array("LSI" => "Lenguaje Servidor", "LSI2" => "Lenguaje Servidor2", "LSI3" => "Lenguaje Servidor3", "LSI4" => "Lenguaje Servidor4");
    /*
    Forma 1
    $lenguajes=$lenguaje_cliente;
    

    foreach ($lenguajes_servidor as $leng => $de) {
        $lenguajes[$leng]=$de;
        
    }*/
    //forma 2(Más sencilla)
    $lenguajes = $lenguaje_cliente + $lenguajes_servidor;

    //mostramos en común
    echo "<table>";
    echo "<tr><th>Lenguajes</th></tr>";
    
    foreach ($lenguajes as $indice => $contenido) {
        echo "<tr>";
        echo "<td>" . $contenido . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    ?>
</body>

</html>