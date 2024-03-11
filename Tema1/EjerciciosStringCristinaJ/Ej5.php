<?php
//3 letras iguales rima, 2 riman un poco, tildes da igual, mayus da igual
$error_formulario = false;


if (isset($_POST["btnGuardar"])) {
    //Quitamos espacios
    $texto1 =  trim($_POST["palabra1"]);

    //miramos los posibles errores
    $error_palabra1 = $texto1 == ""||$texto1<0||$texto1>5000;

    //Hacemos el error del formulario en general
    $error_formulario = $error_palabra1 ;
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


    <form action="Ej5.php" method="post">
        <h1>Árabes a romano-Formulario</h1>
        <p>Dime una número y lo convertiré en números romanos</p>
        <p>
            <label for="palabra1">Número: </label>
            <input type="text" name="palabra1" id="palabra1" value="<?php
                                                                    if (isset($_POST["palabra1"])) {
                                                                        echo $_POST["palabra1"];
                                                                    }
                                                                    ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_formulario) {
                if ($texto1 == "") {
                    echo "<span>Campo vacío</span>";
                } else {
                    echo "<span>No has escrito un número correcto</span>";
                }
            }
            ?>
        </p>

        <button type="submit" name="btnGuardar">Convertir</button>
    </form>
    <?php
     if (isset($_POST['btnGuardar'])&& !$error_formulario) {
        $numero = $texto1;
        if ($numero > 5000){
            echo "<p>El número introducido es mayor que 5000</p>";
        } else {
        $numeros = [
            "M" => 1000,
            "CM" => 900,
            "D" => 500,
            "CD" => 400,
            "C" => 100,
            "XC" => 90,
            "L" => 50,
            "XL" => 40,
            "X" => 10,
            "IX" => 9,
            "V" => 5,
            "IV" => 4,
            "I" => 1
        ];
        $romano = "";
        foreach ($numeros as $letra => $valor) {
            while ($numero >= $valor) {
                $numero -= $valor;
                $romano .= $letra;
            }
        }
    }
    
        echo "<br/>";
        echo "<br/>";
        echo "<div class='verdoso'>";
        echo "<h1>Romanos a árabes-Resultado</h1>";
        echo "<p>El número ". $texto1." se describe en cifras árabes como: <strong>$romano</strong></p>";
        echo "</div>";
    }
    ?>
</body>

</html>