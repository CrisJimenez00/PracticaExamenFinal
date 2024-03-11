<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos</title>
</head>

<body>
    <h1>Datos recogidos</h1>
    <?php
    /*
    //Array con  indice escalar
    $a[0] = 3;
    $a[1] = 6;
    $a[2] = -1;
    $a[3] = 8;

    for ($i=0; $i < count($a); $i++) { 
        echo "<p>Número: ".$a[$i]."</p>";
    }
*/
    if (isset($_POST["btnGuardar"])) {
        echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
        echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
        echo "<p><strong>DNI: </strong>" . $_POST["dni"] . "</p>";
        echo "<p><strong>Contraseña: </strong>" . $_POST["clave"] . "</p>";

        //Con checkbox y radio si no existe peta el programa, se tiene que usar isset si o si
        if (isset($_POST["sexo"])) {
            echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
        } else {
            echo "<p><strong>Sexo: </strong> No seleccionado</p>";
        }

        echo "<p><strong>Nacimiento: </strong>" . $_POST["nacimiento"] . "</p>";
        echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
        if (isset($_POST["subscripcion"])) {
            echo "<p><strong>Subscripcion: </strong> Si </p>";
        } else {
            echo "<p><strong>Subscripcion: </strong> No </p>";
        }
    } else {
        header("Location:index.php");
    }
    ?>
</body>

</html>