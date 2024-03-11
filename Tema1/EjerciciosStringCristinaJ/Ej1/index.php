<?php
//3 letras iguales rima, 2 riman un poco, tildes da igual, mayus da igual
$error_formulario = false;
if (isset($_POST["btnGuardar"])) {
    //Quitamos espacios
    $texto1 =  trim($_POST["palabra1"]);
    $texto2 =  trim($_POST["palabra2"]);

    //Medimos la longitud de la palabra
    $l_texto1 = strlen($_POST["palabra1"]);
    $l_texto2 = strlen($_POST["palabra2"]);

    //miramos los posibles errores
    $error_palabra1 = $texto1 == "" || $l_texto1 < 3;
    $error_palabra2 = $texto2 == "" || $l_texto2 < 3;

    //Hacemos el error del formulario en general
    $error_formulario = $error_palabra1 || $error_palabra2;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        h1 {
            text-align: center;
        }

        form {
            background-color: lightblue;
            border: 1px solid black;
            padding: 2em;
        }
        div{
            background-color: lightgreen;
            border: 1px solid black;
            padding: 2em;
        }
    </style>
</head>

<body>


    <form action="index.php" method="post">
        <h1>Ripidios-formulario</h1>
        <p>Dime dos palabras y te diré si riman o no</p>
        <p>
            <label for="palabra1">Primera Palabra: </label>
            <input type="text" name="palabra1" id="palabra1" value="<?php
                                                                    if (isset($_POST["palabra1"])) {
                                                                        echo $_POST["palabra1"];
                                                                    }
                                                                    ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_palabra1) {
                if ($texto1 == "") {
                    echo "<span>Campo vacío</span>";
                } else {
                    echo "<span>Debes de teclear al menos 3 carácteres</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="palabra2">Primera Palabra: </label>
            <input type="text" name="palabra2" id="palabra2" value="<?php
                                                                    if (isset($_POST["palabra2"])) {
                                                                        echo $_POST["palabra2"];
                                                                    }
                                                                    ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_palabra2) {
                if ($texto2 == "") {
                    echo "<span>Campo vacío</span>";
                } else {
                    echo "<span>Debes de teclear al menos 3 carácteres</span>";
                }
            }
            ?>
        </p>
        <button type="submit" name="btnGuardar">Comparar</button>
    </form>
    <?php
    if (isset($_POST["btnGuardar"]) && !$error_formulario) {
        $texto1_m = strtoupper($texto1);
        $texto2_m = strtoupper($texto2);
        $respuesta = "no riman";
        if ($texto1_m[$l_texto1 - 1] == $texto2_m[$l_texto2 - 1] && $texto1_m[$l_texto1 - 2] == $texto2_m[$l_texto2 - 2]) {
            $respuesta = "riman un poco";
            if ($texto1_m[$l_texto1 - 3] == $texto2_m[$l_texto2 - 3]) {
                $respuesta = "riman";
            }
        }
        echo "<br/>";
        echo "<br/>";
        echo "<div class='verdoso'>";
        echo "<h1>Ripios_Respuesta</h1>";
        echo "<p>Las palabras: <strong>$respuesta</strong></p>";
        echo "</div>";
    }
    ?>
</body>

</html>