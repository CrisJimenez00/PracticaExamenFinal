<?php
if (isset($_POST["btnSubir"])) {
    //1º name
    //2º error
    //3º type "text/plain"
    //4º Tamaño
    $error_form = $_FILES["documento"]["name"] == "" || $_FILES["documento"]["error"] || $_FILES["documento"]["type"] != "text/plain" || $_FILES["documento"]["size"] > 1000 * 1024;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio2 examen</title>
</head>

<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <p><label for="documento">Seleccione un documento(mán 1MB):</label>
            <input type="file" name="documento" id="documento" accept=".txt">
            <?php
            if (isset($_POST["btnSubir"]) && $error_form) {
                if ($_FILES["documento"]["name"] == "") {
                    echo "<p>No se ha seleccionado ningún fichero</p>";
                } else if ($_FILES["documento"]["error"]) {
                    echo "<p>No se ha podido subir correctamente al servidor</p>";
                } else if ($_FILES["documento"]["type"] != "text/plain") {
                    echo "<p>No has seleccionado un fichero txt</p>";
                } else {
                    echo "<p>El tamaño del fichero supera el 1MB</p>";
                }
            }
            ?>
        </p>
        <p><button type="submit" name="btnSubir">Subir</button></p>
    </form>
    <?php
    if (isset($_POST["btnSubir"]) && !$error_form) {
       
        @$var = move_uploaded_file($_FILES["documento"]["tmp_name"], "Ficheros/archivo.txt");
        if ($var) {
            echo "<p>Archivo subido con éxito<p>";
        } else {
            echo "<p>Error al subir el archivo</p>";
        }
    }
    ?>
</body>

</html>