<?php
//3 letras iguales rima, 2 riman un poco, tildes da igual, mayus da igual
$error_formulario = false;
if (isset($_POST["btnGuardar"])) {
    //Quitamos espacios
    $texto1 =  trim($_POST["palabra1"]);


    //Medimos la longitud de la palabra
    $l_texto1 = strlen($_POST["palabra1"]);


    //miramos los posibles errores
    $error_palabra1 = $texto1 == "";

    //Hacemos el error del formulario en general
    $error_formulario = $error_palabra1;
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

        div {
            background-color: lightgreen;
            border: 1px solid black;
            padding: 2em;
        }
    </style>
</head>

<body>


    <form action="Ej2.php" method="post">
        <h1>Palíndromos/capícuas-Formulario</h1>
        <p>Dime una palabra o un número y te diré si es un palíndromo o un número capicúa</p>
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

        <button type="submit" name="btnGuardar">Comparar</button>
    </form>
    <?php
    if (isset($_POST["btnGuardar"]) && !$error_formulario) {
        $texto1_m = strtoupper($texto1);
        $i = 0;
        $j = $l_texto1 - 1;
        $bien = true;
        $respuesta_numero = "no es un número capicúa";
        $respuesta_palabra = "no es un palíndormo";
        //Si es númerico
        while ($i < $j && $bien) {
            if ($texto1_m[$i] == $texto1_m[$j]) {
                $i++;
                $j--;
            } else {
                $bien = false;
            }
        }
        if($bien){
            if (is_numeric($texto1)) {
                $respuesta = "Es capicúa";
            } else {
                $respuesta = "Espalíndroma";
            }
        }else{
            if (is_numeric($texto1)) {
                $respuesta = "No es capicúa";
            } else {
                $respuesta = "No es palíndormo";
            }
        }
        
        echo "<br/>";
        echo "<br/>";
        echo "<div class='verdoso'>";
        echo "<h1>Palíndromos/capícuas-Resultado</h1>";
        echo "<p>El texto: <strong>$respuesta</strong></p>";
        echo "</div>";
    }
    ?>
</body>

</html>