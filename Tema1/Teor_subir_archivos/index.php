<?php
if (isset($_POST["btnEnviar"])) {
    /*
    Se usa $_FILES y no $_POST debido a que ese input recoge un archivo y no un contenido válido para $_POST
        Tipos de errores con los file
        $_FILE["nombreArchivo"]["name"]    -> Nombre que tiene el archivo en el ordenador del usuario
        ---------------------->["error"]   -> Error al subirse al servidor
        ---------------------->["size"]    -> Tamaño del archivo
        ---------------------->["type"]    -> Tipo de archivo
        ---------------------->["tmp_name"]->Nombre con el que se almacena en el servidor (dice la dirección, dónde está y con qué nombre)

    */
    $error_archivo = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024;
}
//Si no hay errores y se le ha dado al botón enviar entra ahí
if (isset($_POST["btnEnviar"]) && !$error_archivo) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=º, initial-scale=1.0">
        <title>Datos enviados</title>
        <style>
            .tam_img{width:35%;}
        </style>
    </head>

    <body>
        <h1>Teoría subir ficheros al sevidor</h1>
        <h2>Datos del archivo subido</h2>
        <?php

            //creamos una variable donde creemos un nombre único(asegurandonos usando doble uniqid) y lo descriframos con md5 por seguridad
            $nombre_nuevo=md5(uniqid(uniqid(), true));

            //Separamos el nombre del archivo en un array de dos partes según la separación que deja el nombre separado por puntos
            $array_nombre=explode(".", $_FILES["archivo"]["name"]);

            //Creamos una variable vacía para almarcenar el tipo de extension
            $ext="";

            //Contamos que el array tenga más de una parte(Es decir que como mínimo tenga nombre y extensión)
            if (count($array_nombre)>1) {

                //Almacenamos la última parte del array(donde se situaría la extension) y la alamacenamos en la variable extensión
                    $ext=".".end($array_nombre);
            }
            //le creamos un nombre nuevo añadiendo la extensión que hemos almacenado anteriormente
            $nombre_nuevo.=$ext;

            //Se usa este método para mover todos los archivos a la acarpeta que deseamos con el nombre que deseamos
            //Si usamos @$var nos ahorramos tener que darle permisos al archivo para subir archivos(no lo va a mover, pero no explota ya)
            //No nos podemos olvidar de darle permisos al archivo desde la terminal con la sentencia:
            //sudo chmod 777 -R *Inserte nombre carpeta*
            @$var=move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/".$nombre_nuevo);
            if($var){
                echo "<h3>Info Foto</h3>";
                echo "<p><strong>Nombre: </strong>". $_FILES["archivo"]["name"]."</p>";
                echo "<p><strong>Tipo: </strong>". $_FILES["archivo"]["type"]."</p>";
                echo "<p><strong>Tamaño: </strong>". $_FILES["archivo"]["size"]."</p>";
                echo "<p><strong>Error: </strong>". $_FILES["archivo"]["error"]."</p>";
                echo "<p><strong>Nombre temporal: </strong>". $_FILES["archivo"]["tmp_name"]."</p>";
                echo "<p>La imagen ha sido subida con éxito</p>";
                echo "<p><img class='tam_img' src='images/".$nombre_nuevo."' alt='foto' title='foto'/></p>";
            }else{
                echo "No se ha podido mover la imagen al destino deseado";
            }
        ?>
    </body>

    </html>

<?php

} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Teoria subir Archivos</title>
    </head>

    <body>
        <h1>Teoría subir ficheros al sevidor</h1>
        <!--Es obligatorio usar el enctype="multipart/form-data" para que podamos trabajar con archivo(si no, no funciona)-->
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="archivo">Seleccione un archivo</label>
                <input type="file" name="archivo" id="archivo" accept="image/*">
                <?php
                //La condición de $error_archivo es redundante debido a que solamente se pasa si 
                //no hay errores(si sigues en la página significa que hay errores)
                if (isset($_POST["btnEnviar"]) && $error_archivo) {
                    if ($_FILES["archivo"]["name"] != "") {

                        //Si hay algún error al subir en el servidor
                        if ($_FILES["archivo"]["error"]) {
                            echo "No se ha podido subir el archivo al servidor";

                            //Si no se almacena en el servidor correctamente
                        } else if (!getimagesize($_FILES["archivo"]["tmp_name"])) {
                            echo "No se ha subido el archivo al servidor";

                            //El caso que queda es que supere el peso límite
                        } else {
                            echo "El archivo seleccionado supera el peso límite";
                        }
                        //Si el nombre es =="" significa que no se ha subido ningún archivo
                    } else {
                        echo "No has seleccionado un archivo";
                    }
                }
                ?>
            </p>
            <p><button type="submit" name="btnEnviar">Enviar</button></p>

        </form>
    </body>

    </html>
<?php
}
?>