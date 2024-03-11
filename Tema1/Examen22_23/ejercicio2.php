<?php
if (isset($_POST["btnContar"])) {
    $error_form = $_POST["texto"] == "";
}
//Método el cual calcula como un strlen
function contador($texto)
{
    $contador = 0;
    while (isset($texto[$contador])) {
        $contador++;
    }
    return $contador;
}
function mi_explode($separador, $texto)
{
    $res = array();

    //No cuento los separadores que pudiera haber inicialmente
    $j = 0;
    $long_texto = contador($texto);
    while ($j < $long_texto && $texto[$j] == $separador)
        $j++;

    if ($j < $long_texto) {
        $cont = 0;
        $res[$cont] = $texto[$j];
        $j++;
        while ($j < $long_texto) {
            if ($texto[$j] != $separador) {
                $res[$cont] .= $texto[$j];
                $j++;
            } else {
                $j++;
                while ($j < $long_texto && $texto[$j] == $separador)
                    $j++;

                if ($j < $long_texto) {
                    $cont++;
                    $res[$cont] = $texto[$j];
                    $j++;
                }
            }
        }
    }
    return $res;

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
        <p>Elija un separador:
            <select name="separador" id="separador">
                <option value="," <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ",") {
                    echo "selected";
                } ?>>
                    ,(Coma)</option>
                <option value="." <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ".") {
                    echo "selected";
                } ?>>.(Punto)</option>
                <option value=" " <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == " ") {
                    echo "selected";
                } ?>> (Espacio)</option>
                <option value=";" <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ";") {
                    echo "selected";
                } ?>>;(Punto y Coma)</option>
                <option value=":" <?php if (isset($_POST["btnContar"]) && $_POST["separador"] == ":") {
                    echo "selected";
                } ?>>:(Dos Puntos)</option>
            </select>
        </p>
        <button type="submit" name="btnContar">Contar</button>
    </form>
    <?php
    if (isset($_POST["btnContar"]) && !$error_form) {
        echo "La palabra tiene una longitud de: " . contador($_POST["texto"]);
        $palabras = mi_explode($_POST["separador"], $_POST["texto"]);
        foreach ($palabras as $indice => $contenido) {
            echo "<p>$contenido</p>";
        }

    }
    ?>
</body>

</html>