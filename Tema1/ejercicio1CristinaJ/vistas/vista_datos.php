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
    echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
    echo "<p><strong>Nacimiento: </strong>" . $_POST["nacimiento"] . "</p>";
    //Con checkbox y radio si no existe peta el programa, se tiene que usar isset si o si
    if (isset($_POST["sexo"])) {
        echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
    } else {
        echo "<p><strong>Sexo: </strong> No seleccionado</p>";
    }
    //Forma simple, no sé recorrer aficiones[] para que me diga lo que contiene

    //la forma más básica
    /*if (isset($_POST["deportes"])) {
            echo $_POST["deportes"] . ",";
        } 
        if (isset($_POST["lectura"])) {
            echo $_POST["lectura"] . ",";
        } 
         if (isset($_POST["otros"])) {
            echo $_POST["otros"] ;
        }*/
    if (!isset($_POST["aficiones"])) {
        echo "<p><b>No has seleccionado ninguna afición</b></p>";
    } else if (count($_POST["aficiones"]) == 1) {
        echo "<p><b>La afición seleccionada ha sido: </b></p>";
        echo "<ol>";
        echo "<li>" . $_POST["aficiones"][0] . "</li>";
        echo "</ol>";
    } else {
        echo "<p><b>Las aficiones seleccionadas han sido: </b></p>";
        echo "<ol>";
        for ($i = 0; $i < count($_POST["aficiones"]); $i++) {
            echo "<li>" . $_POST["aficiones"][$i] . "</li>";
        }
        echo "</ol>";
    }
    echo "</p>";

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

    if ($_POST["comentarios"] != "") {
        echo "<p><strong>El comentario ha sido: </strong>" . $_POST["comentarios"] . "</p>";
    } else {
        echo "<p><strong>No ha hecho ningún comentario </strong></p>";
    }

    ?>
</body>

</html>