<?php
if (isset($_POST["btnSalir"])) {
    session_destroy();
}
try {
    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_libreria_exam");
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Error de conexión", "No se ha podido conectar con la base de datos"));
}
if (isset($_POST["btnAgregar"])) {
    $error_ref = $_POST["ref"] == "" || $_POST["ref"] <= 0;
    $error_titulo = $_POST["titulo"] == "";
    $error_autor = $_POST["autor"] == "";
    $error_descripcion = $_POST["descripcion"] == "";
    $error_precio = $_POST["precio"] == "" || $_POST["precio"] <= 0;
    $error_portada = $_FILES["portada"]["size"] > 750 * 1024;
    $error_form = $error_ref || $error_titulo || $error_autor || $error_descripcion || $error_precio || $error_portada;
}

session_name("examen3_22_23");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Libros</title>
    <style>
        table,
        th,
        td,
        tr {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <form action="../index.php" method="post">
        <p>Bienvenido <b> <?php echo $_SESSION["usuario"] ?></b><button type="submit" name="btnSalir">Salir</button></p>

    </form>
    <?php
    //Mensajes de borrar y editar
    if (isset($_POST["btnBorrar"])) {
        echo "<p>La película con Referencia " . $_POST["referencia"] . " ha sido borrada con éxito<p>";
    }
    if (isset($_POST["btnEditar"])) {
        echo "<p>La película con Referencia " . $_POST["referencia"] . " ha sido editada con éxito<p>";
    }
    ?>
    <h3>Listado de los libros</h3>
    <table>
        <tr>
            <th>Red</th>
            <th>Título</th>
            <th>Acción</th>
        </tr>
        <?php
        try {
            $consulta = "select * from libros";
            $resultado = mysqli_query($conexion, $consulta);
            while ($tupla = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $tupla["referencia"] . "</td>";
                echo "<td>" . $tupla["titulo"] . "</td>";
                echo "<td><form action='get_libros.php' method='post'><button type='submit' name='btnBorrar'>Borrar</button><button type='submit' name='btnEditar'>Editar</button><input type='hidden' name='referencia' value=" . $tupla["referencia"] . "></form></td>";
                echo "<tr>";
            }
        } catch (Exception $e) {
            die(error_page("Error de consulta", "No se ha podido consultar correctamente los libros"));
        }
        ?>
    </table>
    <?php
    if (isset($_POST["btnNuevoLibro"]) || isset($_POST["btnAgregar"])) {
    ?>
        <h3>Agregar un libro nuevo</h3>
        <form action="get_libros.php" method="post" enctype="multipart/form-data">
            <p><label for="ref">Referencia:</label>
                <input type="text" name="ref" id="ref" value=<?php
                                                                if (isset($_POST["ref"])) {
                                                                    echo $_POST["ref"];
                                                                }
                                                                ?>>
                <?php
                if (isset($_POST["btnAgregar"]) && $error_ref) {
                    if ($_POST["ref"] < 0) {
                        echo "No puede ser un número inferior a 0";
                    } else {
                        echo "No puede dejar este campo vacío";
                    }
                }
                //Para comprobar el numero de referencia
                if (isset($_POST["btnAgregar"]) && !$error_titulo) {
                    try {
                        $consulta = "select * from libros";
                        $resultado = mysqli_query($conexion, $consulta);
                        while ($tupla = mysqli_fetch_assoc($resultado)) {
                            if ($_POST["ref"] == $tupla["referencia"]) {
                                echo "la referencia está repetida";
                            }
                        }
                    } catch (Exception $e) {
                        die(error_page("Error de consulta", "No se ha podido consultar correctamente los libros"));
                    }
                }

                ?>
            </p>
            <p><label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value=<?php
                                                                    if (isset($_POST["titulo"])) {
                                                                        echo $_POST["titulo"];
                                                                    }
                                                                    ?>>
                <?php
                if (isset($_POST["btnAgregar"]) && $error_titulo) {
                    echo "No puede dejar este campo vacío";
                }
                ?>
            </p>
            <p><label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" value=<?php
                                                                    if (isset($_POST["autor"])) {
                                                                        echo $_POST["autor"];
                                                                    }
                                                                    ?>>
                <?php
                if (isset($_POST["btnAgregar"]) && $error_autor) {
                    echo "No puede dejar este campo vacío";
                }
                ?>
            </p>
            <p><label for="descripcion">Descripcion:</label>
                <input type="text" name="descripcion" id="descripcion" value=<?php
                                                                                if (isset($_POST["descripcion"])) {
                                                                                    echo $_POST["descripcion"];
                                                                                }
                                                                                ?>>
                <?php
                if (isset($_POST["btnAgregar"]) && $error_descripcion) {
                    echo "No puede dejar este campo vacío";
                }
                ?>
            </p>
            <p><label for="precio">Precio:</label>
                <input type="text" name="precio" id="precio" value=<?php
                                                                    if (isset($_POST["precio"])) {
                                                                        echo $_POST["precio"];
                                                                    }
                                                                    ?>>
                <?php
                if (isset($_POST["btnAgregar"]) && $error_precio) {
                    if ($_POST["precio"] <= 0) {
                        echo "No puede ser un número inferior o igual a 0";
                    } else {
                        echo "No puede dejar este campo vacío";
                    }
                }
                ?>
            </p>
            <p><label for="portada">Portada:</label>
                <input type="file" name="portada" id="portada" type="images">
            </p>
            <button type="submit" name="btnAgregar">Agregar</button>
        </form>
    <?php
    } else {
    ?>
        <form action='get_libros.php' method='post'>
            <button type='submit' name='btnNuevoLibro'>Nuevo Libro</button>
        </form>
    <?php
    }
    //Si no hay errores agregamos el libro
    if (isset($_POST["btnAgregar"]) && !$error_form) {
        try {
            $consulta = "INSERT INTO `libros` (`referencia`, `titulo`, `autor`, `descripcion`, `precio`, `portada`) VALUES ('" . $_POST["ref"] . "', '" . $_POST["titulo"] . "', '" . $_POST["autor"] . "', '" . $_POST["descripcion"] . "', '" . $_POST["precio"] . "', '') ";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            die(error_page("Error de consulta", "No se ha podido consultar correctamente los libros"));
        }
    }
    mysqli_close($conexion);
    session_unset();
    ?>
</body>

</html>