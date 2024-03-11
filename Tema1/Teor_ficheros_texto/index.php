<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria ficheros texto</title>
</head>

<body>
    <?php
    //En modo lectura si no existe peta, en modo escritura si no existe y tiene los permisos lo crea
    //El comando de terminal es: sudo chmod 777 -R *inserte ruta del archivo*
    $fd1 = fopen("prueba.txt", "r+");
    //$fd3=fopen("prueba3.txt", "a");
    //Si no existe, hacemos que muera(es igual a exit)
    if (!$fd1) {
        die("No se ha podido abrir el fichero prueba.txt");
    } else {
        echo "Ha entrado";
        //con el comando fgets se recoge línea por línea
        $linea = fgets($fd1);
        //te vas a la primera línea del fichero con este método(despues de la , pones la línea en la que quieres qu ese encuentre)
        fseek($fd1, 0);
        //Se hace un do while
        while ($linea = fgets($fd1)) {
            echo "<p>$linea</p>";
        }
        //método el cual te escribe en el fichero una línea en específico
        fwrite($fd1, "Texto random");

        //Método el cual cierra el fichero, es obligatorio
        fclose($fd1);
    }
    /*if(!$fd3){
            die("No se ha podido escribir el fichero prueba.txt");
        }else{
            echo "Ha entrado";
        }*/
    ?>
</body>

</html>