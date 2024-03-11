<?php
//Metodo el cual crea la primera línea del fichero 
function primera_linea()
{
    $resultado = "i/j";
    for ($i = 1; $i <= 5; $i++) {
        $resultado .= ";" . $i;
    }
    return $resultado;
}
//Método el cual genera el fichero la completo
function generar_fichero()
{
    //Abrimos el archivo buscando modificarlo
    @$fd = fopen("claves_polybios.txt", "w");
    if (!$fd) {
        die("No se ha podido crea el fichero 'claves_polybios.txt'");
    } else {
        //La primera línea la ponemos como se desea, el resto ya sería como a través de bucles
        $linea = primera_linea();
        fwrite($fd, $linea . PHP_EOL);
        $letra = ord('A');
        for ($i = 1; $i < 6; $i++) {
            $linea = $i;
            for ($j = 1; $j < 6; $j++) {
                if ($i == 2 && $j == 5) {
                    $letra++;
                }
                $linea .= ";" . chr($letra);
                $letra++;
            }
            fputs($fd, $linea . PHP_EOL);
        }
        fclose($fd);
        return file_get_contents("claves_polybios.txt");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 php</title>
</head>

<body>
    <h1>Ejercicio 1. Generador de "claves_polybios.txt"</h1>
    <?php
    //Si se ha pulsado el botón
    if (isset($_POST["btnGenerar"])) {
        echo "<textarea>" . generar_fichero() . "</textarea>";
        //Si no se pulsa aparece el botón
    } else {
        ?>
        <form action="ejercicio1.php" method="post" enctype="multipart/form-data
        ">
            <button type="submit" name="btnGenerar">Generar</button>
        </form>

        <?php
    }
    ?>
</body>

</html>