<?php
function generar_fichero()
{
    //generamos el fichero con la preferencia a escritura
    @$fd = fopen("claves_cesar.txt", "w");
    if (!$fd) {
        //En caso de que no se genere correctamente se muestra este mensaje
        die("<p>No se ha podido crear el fichero correctamente</p>");
    } else {
        $linea = "Letra/Desplazamiento";
        for ($i = 1; $i < 27; $i++) {
            $linea .= ";" . $i;
        }
        fwrite($fd, $linea . PHP_EOL);
        
        for ($i = 65; $i < 91; $i++) {
            $linea="";
            //Comenzamos con la A
            $linea.= chr($i);
            for ($j = $i + 1; $j <= 90; $j++) {
                $linea.=";".chr($j);
            }
            fwrite($fd, $linea.PHP_EOL);
        }

        echo "<p>Fichero generado con éxito</p>";
        //Cerramos el fichero
        fclose($fd);
    }
    return file_get_contents("claves_cesar.txt");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 examen</title>
</head>

<body>
    <h1>Ejercicio1. Generador de "claves_cesar.txt"</h1>
    <form action="ejercicio1.php" method="post">
        <button type="submit" name="btnGenerar">Generar</button>
    </form>
    <?php
    if (isset($_POST["btnGenerar"])) {
        echo "<h2>Resultado</h2>";
        echo "<textarea>".generar_fichero()."</textarea>";
    }
    ?>
</body>

</html>