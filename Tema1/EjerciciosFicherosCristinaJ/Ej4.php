<?php
if (isset($_POST["btnContar"])) {
    echo "<h1>".$_FILES["fichero"]["type"]."</h1>";
    $error_form = $_FILES["fichero"]["name"] == "" || $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] != "text/plain" || $_FILES["fichero"]["size"] > 2500 * 1024;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 ficheros</title>
</head>

<body>
    <form action="Ej4.php" method="post" enctype="multipart/form-data">
        <p><label for="fichero">Seleccione un fichero de texto para contar sus palabras(Máx.2,5MB)</label>
            <input type="file" name="fichero" id="fichero" accept=".txt">
            <?php
            if (isset($_POST["btnContar"]) && $error_form) {
                if ($_FILES["fichero"]["name"] == "") {
                    echo "<p>No se ha seleccionado ningún fichero</p>";
                } else if ($_FILES["fichero"]["error"]) {
                    echo "<p>No se ha podido subir correctamente al servidor</p>";
                } else if ($_FILES["fichero"]["type"] != "text/plain") {
                    echo "<p>No has seleccionado un fichero txt</p>";
                }else{
                    echo "<p>El tamaño del fichero supera los 2,5MB</p>";
                }
            }
            ?>
        </p>
        <p><button type="submit" name="btnContar">Contar palabras</button></p>
    </form>
    <?php
        if(isset($_POST["btnContar"])&&!$error_form){
            //Con método
            //$contenido_fichero=file_get_contents($_FILES["fichero"]["tmp_name"]);
            //Sin método
            @$fd=fopen($_FILES["fichero"]["tmp_name"],"r");
            if(!$fd){
                die("<h3>No se puede abrir el archivo subido al servidor</h3>");
            }
            $contenido_fichero="";
            $n_palabras=0;
            while($linea=fgets($fd)){
                //$contenido_fichero.=$linea;
                $n_palabras+=str_word_count($linea);
            }
            echo "<h3>El numero de palabras que contiene el archivo seleccionado es de: ".$n_palabras."</h3>";
        }
    ?>
</body>

</html>