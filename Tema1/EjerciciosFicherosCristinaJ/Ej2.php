<?php
if(isset($_POST["btnEnviar"])){
     // IMPORTA EL ORDEN, NO ESTA VACIO, ES UN NUMERO Y ESTA ENTRE 1 Y 10
     $error_form = $_POST["num"] == "" || !is_numeric($_POST["num"]) || $_POST["num"] <= 0 || $_POST["num"] > 10;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2 ficheros</title>
</head>

<body>
    <form action="Ej2.php" method="post">
        <p>
            <label for="num">Introduzca un número entre 1 y 10</label>
            <input type="text" name="num" id="num" value="<?php
                                                            if (isset($_POST["num"])) {
                                                                echo $_POST["num"];
                                                            }
                                                            ?>">
            <button type="submit" name="btnEnviar">Crear</button>
        </p>
        <p>
            <?php
            if (isset($_POST["btnEnviar"])&&!$error_form) {
                $fd1 = fopen("Tablas/tabla_" . $_POST["num"].".txt", "r+");
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
            }
            ?>
        </p>
    </form>
</body>

</html>