<?php
if (isset($_POST["btnEnviar"])) {
    // IMPORTA EL ORDEN, NO ESTA VACIO, ES UN NUMERO Y ESTA ENTRE 1 Y 10
    $error_num1 = $_POST["num1"] == "" || !is_numeric($_POST["num1"]) || $_POST["num1"] <= 0 || $_POST["num1"] > 10;
    $error_num2 = $_POST["num2"] == "" || !is_numeric($_POST["num2"]) || $_POST["num2"] <= 0 || $_POST["num2"] > 10;
    $error_form = $error_num1 || $error_num2;
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
    <form action="Ej3.php" method="post">
        <p>
            <label for="num1">Introduzca un número entre 1 y 10</label>
            <input type="text" name="num1" id="num1" value="<?php
                                                            if (isset($_POST["num1"])) {
                                                                echo $_POST["num1"];
                                                            }
                                                            ?>">
        </p>
        <p>
            <label for="num2">Introduzca un número entre 1 y 10</label>
            <input type="text" name="num2" id="num2" value="<?php
                                                            if (isset($_POST["num2"])) {
                                                                echo $_POST["num2"];
                                                            }
                                                            ?>">

        </p>
        <p><button type="submit" name="btnEnviar">Crear</button></p>
        <p>
            <?php
            if (isset($_POST["btnEnviar"]) && !$error_form) {
                @$fd1 = fopen("Tablas/tabla_" . $_POST["num1"] . ".txt", "r+");
                if (!$fd1) {
                    die("No se ha podido abrir el fichero prueba.txt");
                } else {
                    echo "<h1>la fila " . $_POST["num2"] . " de la tabla del " . $_POST["num1"] . "</h1>";
                    //Se hace un do while
                    $contador = 0;
                    while ($contador <= $_POST["num2"]) {
                        $linea = fgets($fd1);
                        $contador++;
                    }
                    echo "<p>$linea</p>";
                    //Método el cual cierra el fichero, es obligatorio
                    fclose($fd1);
                }
            }
            ?>
        </p>
    </form>
</body>

</html>