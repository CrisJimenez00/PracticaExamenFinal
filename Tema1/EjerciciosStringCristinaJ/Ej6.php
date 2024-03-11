<?php
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ejercicio</title>
    <style>
        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgb(112, 210, 255);
        }

        p {
            width: 400px;
            margin: 0 auto;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgb(179, 255, 172);
        }
    </style>
</head>

<body>
    <form action="Ej6.php" method="post">
        <label for="palabra">Introduce texto:</label>
        <textarea name="palabra" id="palabra" cols="30" rows="10" required value="<?php
        if (isset($_POST['palabra'])) {
            echo $_POST['palabra'];
        } else {
            echo "";
        }
        ?>"></textarea>
        <input type="submit" value="Comprobar" name="submit">
    </form>

    <?php
    if (isset($_POST['submit'])&&!$error_formulario) {
        $palabra = $_POST['palabra'];
        //vocal A
        $palabra = str_replace('á', 'a', $palabra);
        $palabra = str_replace('Á', 'A', $palabra);
        $palabra = str_replace('ä', 'a', $palabra);
        $palabra = str_replace('Ä', 'A', $palabra);
        //Vocal E
        $palabra = str_replace('é', 'e', $palabra);
        $palabra = str_replace('É', 'E', $palabra);
        $palabra = str_replace('ë', 'e', $palabra);
        $palabra = str_replace('Ë', 'E', $palabra);
        //Vocal I
        $palabra = str_replace('í', 'i', $palabra);
        $palabra = str_replace('Í', 'I', $palabra);
        $palabra = str_replace('ï', 'i', $palabra);
        $palabra = str_replace('Ï', 'I', $palabra);
        //Vocal O
        $palabra = str_replace('ó', 'o', $palabra);
        $palabra = str_replace('Ó', 'O', $palabra);
        $palabra = str_replace('ö', 'o', $palabra);
        $palabra = str_replace('Ö', 'O', $palabra);
        //Vocal U
        $palabra = str_replace('ú', 'u', $palabra);
        $palabra = str_replace('Ú', 'U', $palabra);
        $palabra = str_replace('ü', 'u', $palabra);
        $palabra = str_replace('Ü', 'U', $palabra);
        echo "<p>La palabra sin acentos es: $palabra</p>";
    }
    ?>
</body>

</html>