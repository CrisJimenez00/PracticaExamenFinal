<?php
$error_formulario = false;
if (isset($_POST["btnGuardar"])) {
    //Quitamos espacios
    $texto1 =  trim($_POST["numero"]);

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
    <form action="Ej7.php" method="post">
        <label for="numero">Introduce el número a corregir:</label>
        <input type="text" name="numero" id="numero" required value="<?php
        if (isset($_POST['numero'])) {
            echo $_POST['numero'];
        } 
        ?>">
        <input type="submit" value="Comprobar" name="submit">
    </form>

    <?php
     if (isset($_POST['submit'])&& !$error_formulario) {
        $input = $_POST['numero'];
        $input = str_replace(',', '.', $input); // Reemplaza comas por puntos
        if (isset($input)) {
            echo "<p>El número corregido es: $input</p>";
        } 
    }
    ?>
</body>

</html>