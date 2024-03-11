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

    if (isset($_POST["btnGuardar"])) {
        echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
        echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
        echo "<p><strong>DNI: </strong>" . $_POST["dni"] . "</p>";
        echo "<p><strong>Contraseña: </strong>" . $_POST["clave"] . "</p>";
        echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
        echo "<p><strong>Nacimiento: </strong>" . $_POST["nacimiento"] . "</p>";
        echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";
        if (isset($_POST["subscripcion"])) {
            echo "<p><strong>Subscripcion: </strong> Si </p>";
        } else {
            echo "<p><strong>Subscripcion: </strong> No </p>";
        }
        //creamos una variable donde creemos un nombre único(asegurandonos usando doble uniqid) y lo descriframos con md5 por seguridad
        $nombre_nuevo = md5(uniqid(uniqid(), true));

        //Separamos el nombre del archivo en un array de dos partes según la separación que deja el nombre separado por puntos
        $array_nombre = explode(".", $_FILES["archivo"]["name"]);

        //Creamos una variable vacía para almarcenar el tipo de extension
        $ext = "";

        //Contamos que el array tenga más de una parte(Es decir que como mínimo tenga nombre y extensión)
        if (count($array_nombre) > 1) {

            //Almacenamos la última parte del array(donde se situaría la extension) y la alamacenamos en la variable extensión
            $ext = "." . end($array_nombre);
        }
        //le creamos un nombre nuevo añadiendo la extensión que hemos almacenado anteriormente
        $nombre_nuevo .= $ext;

        //Se usa este método para mover todos los archivos a la acarpeta que deseamos con el nombre que deseamos
        //Si usamos @$var nos ahorramos tener que darle permisos al archivo para subir archivos(no lo va a mover, pero no explota ya)
        //No nos podemos olvidar de darle permisos al archivo desde la terminal con la sentencia:
        //sudo chmod 777 -R *Inserte nombre carpeta*
        @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/" . $nombre_nuevo);

        if ($_FILES["archivo"]["name"] != "") {
            if ($var) {
                echo "<h3>Info Foto</h3>";
                echo "<p><strong>Nombre: </strong>" . $_FILES["archivo"]["name"] . "</p>";
                echo "<p><strong>Tipo: </strong>" . $_FILES["archivo"]["type"] . "</p>";
                echo "<p><strong>Tamaño: </strong>" . $_FILES["archivo"]["size"] . "</p>";
                echo "<p><strong>Error: </strong>" . $_FILES["archivo"]["error"] . "</p>";
                echo "<p><strong>Nombre temporal: </strong>" . $_FILES["archivo"]["tmp_name"] . "</p>";
                echo "<p>La imagen ha sido subida con éxito</p>";
                echo "<p><img class='tam_img' src='images/" . $nombre_nuevo . "' alt='foto' title='foto'/></p>";
            } else {
                echo "No se ha podido mover la imagen al destino deseado";
            }
        }
    } else {
        header("Location:index.php");
    }
    ?>
</body>

</html>