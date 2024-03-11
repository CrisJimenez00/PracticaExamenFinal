<?php
if (isset($_POST["btnContar"])) {
    //Controlamos los errores del texto
    $error_form = $_POST["texto"] == "";
}
function lee_vocal($texto)
{
    $plus = true;
    for ($i = 0; $i < strlen($texto); $i++) {
        if ($texto[$i] == "a" || $texto[$i] == "A" || $texto[$i] == "e" || $texto[$i] == "E" || $texto[$i] == "i" || $texto[$i] == "I" || $texto[$i] == "o" || $texto[$i] == "O" || $texto[$i] == "u" || $texto[$i] == "U") {
            $plus = false;
        }
    }
    return $plus;
}
function mi_explode_exam($separador, $texto)
{
    $array = [];
    $i = 0;
    $palabra = "";
    while ($i < strlen($texto) && $texto[$i] == $separador) {
        $i++;
    }
    for ($j = $i; $j < strlen($texto); $j++) {
        if ($texto[$j] != $separador&&$texto[$i] != "."&&$texto[$i] != ","&&$texto[$i] != ";"&&$texto[$i] != ":"&&$texto[$i] != " "&&$texto[$i] != "") {
            $palabra .= $texto[$i];
            $i++;
        } else {
            //Miras que lo que se añade no sea vacío
            if ($palabra != ""&&$palabra != "."&&$palabra != ","&&$palabra != ";"&&$palabra != ":"&&$palabra != " ") {
                //Ahora se mira que no tenga vocales
                if (lee_vocal($palabra)) {
                    array_push($array, $palabra);
                }
            }
            $palabra = "";
            $i++;
        }
        if ($texto[$j] != $separador) {
            if ($j == strlen($texto) - 1) {
                $palabra .= $texto[$i];
                if (lee_vocal($palabra)) {
                    array_push($array, $palabra);
                }
                $palabra="";
            }
        }
    }
    return $array;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 examen</title>
</head>

<body>
    <form action="ejercicio2.php" method="post">
        <p><label for="texto">Introduzca un texto</label>
            <input type="text" name="texto" id="texto" value="<?php
                                                                if (isset($_POST["texto"])) {
                                                                    echo $_POST["texto"];
                                                                }
                                                                ?>">
            <?php
            if (isset($_POST["btnContar"]) && $error_form) {
                echo "*Campo vacío*";
            }
            ?>
        </p>
        <p>Elija el Separador <select name="separador" id="separador">
                <option value=";" <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ";") {
                                        echo "selected";
                                    } ?>>; (Punto y Coma)</option>
                <option value=":" <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ":") {
                                        echo "selected";
                                    } ?>>: (Dos puntos)</option>
                <option value="." <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ".") {
                                        echo "selected";
                                    } ?>>. (Punto)</option>
                <option value="," <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ",") {
                                        echo "selected";
                                    } ?>>, (Coma)</option>
                <option value=" " <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == " ") {
                                        echo "selected";
                                    } ?>> (Espacio)</option>
            </select></p>
        <p><button type="submit" name="btnContar">Contar</button></p>
    </form>
    <?php
    if (isset($_POST["btnContar"]) && !$error_form) {
        $explode = mi_explode_exam($_POST["separador"], $_POST["texto"]);

        //print_r($explode);
        echo "<p>El texto <strong>".$_POST["texto"]."</strong> con el separador <strong>".$_POST["separador"]." </strong> contiene " . count($explode) . " palabras sin vocales</p>";
    }
    ?>
</body>

</html>