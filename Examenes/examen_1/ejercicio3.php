<?php
if (isset($_POST["btnCodificar"])) {
    //Errores del texto
    $error_texto = $_POST["texto"] == "";
    //Errores del campo numérico
    $error_numerico = $_POST["mov"] == "" || !is_numeric($_POST["mov"]) || $_POST["mov"] < 1 || $_POST["mov"] > 26;
    //Errores generales y de archivo
    $error_form = $error_texto || $error_numerico || $_FILES["archivo"] == "" || $_FILES["archivo"]["error"] || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] > 1250 * 1024;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 examen</title>
</head>

<body>
    <h1>Ejercicio 3.Codifica una frase</h1>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <p><label for="texto">Introduzca un texto</label>
            <input type="text" name="texto" id="texto" value="<?php
                                                                if (isset($_POST["texto"])) {
                                                                    echo $_POST["texto"];
                                                                } ?>">
            <?php
            //Errores del texto
            if (isset($_POST["btnCodificar"]) && $_POST["texto"] == "") {
                echo "*Campo vacío, por favor introduzca texto*";
            }
            ?>
        </p>
        <p><label for="mov">Desplazamiento</label>
            <input type="text" name="mov" id="mov" value="<?php
                                                            if (isset($_POST["mov"])) {
                                                                echo $_POST["mov"];
                                                            }
                                                            ?>">
            <?php
            //Errores del campo numérico
            if (isset($_POST["btnCodificar"]) && $error_numerico) {
                if ($_POST["mov"] == "") {
                    echo "*No puede dejar este campo vacío*";
                } else if (!is_numeric($_POST["mov"])) {
                    echo "*Tiene que ser numérico este campo*";
                } else if ($_POST["mov"] < 1 || $_POST["mov"] > 26) {
                    echo "*Solo son válidos números entre el 1 y el 26 incluyendo ambos*";
                }
            } ?>
        </p>
        <p>Seleccione el archivo de claves(.txt y menor 1,25MB) <input type="file" name="archivo" id="archivo" accept=".txt">
            <?php
            if (isset($_POST["btnCodificar"]) && $error_form) {
                if ($_FILES["archivo"] == "") {
                    echo "*No puede dejar este campo vacío*";
                } else if ($_FILES["archivo"]["type"] != "text/plain") {
                    echo "*Solo es válido un archivo con extensión .txt*";
                } else if ($_FILES["archivo"]["size"] > 1250 * 1024) {
                    echo "*El archivo es demasiado pesado*";
                }
            }
            ?>
        </p>
        <p><button type="submit" name="btnCodificar">Codificar</button></p>
    </form>
    <?php
    if (isset($_POST["btnCodificar"]) && !$error_form) {
        echo "<h2>Resultado</h2>";
        echo "<p>El texto codificado sería</p>";
        $texto = $_POST["texto"];
        $plus = $_POST["mov"];
        @$fd = fopen("claves_cesar.txt", "r");

        if (!$fd) {
            die("No se ha podido abrir el archivo correctamente");
        } else {
            //Para quitar la línea de título
            $linea = fgets($fd);
            while ($linea = fgets($fd)) {
                $leyendo = explode(";", $linea);
                for ($i = 0; $i < strlen($texto); $i++) {
                    for ($j = 0; $j < count($leyendo); $j++) {
                        if ($texto[$i] == $leyendo[0] && $plus < count($leyendo)-1) {
                            $texto[$i] = $leyendo[$j + $plus];
                        }
                    }
                }
            }
            echo $texto;
        }
    }
    ?>
</body>

</html>