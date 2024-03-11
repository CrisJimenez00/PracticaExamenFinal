<?php
require "src/ctes_funciones.php";
if(isset($_POST["btnContNuevo"])){
    $error_titulo=$_POST["titulo"]==""||$_POST["titulo"]>strlen(15);
    $error_director=$_POST["director"]==""||$_POST["director"]>strlen(20);
    $error_tema=$_POST["tema"]==""||$_POST["tema"]>strlen(15);
    $error_sinopsis=$_POST["sinopsis"]=="";
    $error_foto=$_FILES["foto"]["name"]!="" && ($_FILES["foto"]["error"] || !getimagesize($_FILES["foto"]["tmp_name"]) || !tiene_extension($_FILES["foto"]["name"]) || $_FILES["foto"]["size"]>500 *1024);
}
if (isset($_POST["btnContBorrar"])) {
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    try {
        $consulta = "delete from peliculas where idPelicula='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No ha podido realizarse la consulta: " . $e->getMessage() . "</p>"));
    }

    if ($_POST["nombre_foto"] != "no_imagen.jpg")
        unlink("Img/" . $_POST["nombre_foto"]);

    mysqli_close($conexion);
    header("Location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 9</title>
    <style>
        table,
        th,
        td,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }

        table {
            width: 100%;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline
        }

        img {
            height: 250px
        }
    </style>
</head>

<body>
    <h1>Video Club</h1>
    <h2>Películas</h2>
    <!--Tabla principal-->
    <p><strong>Listado de Películas</strong></p>
    <?php
    require "vistas/vista_tabla_principal.php";
    
    if(isset($_POST["btnNuevaPelicula"]) || isset($_POST["btnContNuevo"]))
    {
        require "vistas/vista_nueva_pelicula.php";
    }
    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_conf_borrar.php";
    }
    ?>
</body>

</html>