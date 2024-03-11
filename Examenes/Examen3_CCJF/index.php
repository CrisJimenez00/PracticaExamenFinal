<?php
function error_page($title, $body)
{
    $html = '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html .= '<title>' . $title . '</title></head>';
    $html .= '<body>' . $body . '</body></html>';
    return $html;
}
session_name("examen3_22_23");
session_start();
//Conectamos la bbdd con la página
try {
    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_libreria_exam");
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Error de conexión", "No se ha podido conectar con la base de datos"));
}
//Control de errores del formulario login
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_login = $error_usuario || $error_clave;
}
if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicio</title>
    <style>
        div img {
            width: 150px;
            height: auto;
        }

        .hijo {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php

    //Comprobar existencia del usuario
    if (isset($_POST["btnEntrar"]) && !$error_login) {
        try {
            $consulta = "select * from usuarios where `lector`='" . $_POST["usuario"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
            if (mysqli_num_rows($resultado) == 0) {
                echo "El usuario no existe en la base de datos";
            } else {
                while ($tupla = mysqli_fetch_assoc($resultado)) {
                    if (md5($_POST["clave"]) == $tupla["clave"]) {
                        $_SESSION["usuario"] = $tupla["lector"];
                        $_SESSION["clave"] = $tupla["clave"];
                        $_SESSION["tipo"] = $tupla["tipo"];
                        $_SESSION["id_usuario"] = $tupla["id_usuario"];
                    } else {
                        echo "La contraseña y el usuario no coinciden";
                    }
                }
            }
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("No se ha podido consultar correctamente los usuarios");
        }
    }
    ?>
    <h1>Librería</h1>

    <?php
    if (isset($_SESSION["usuario"])) { ?>
        <form action="index.php" method="post">
            <p>Bienvenido <b> <?php echo $_SESSION["usuario"] ?></b><button type="submit" name="btnSalir">Salir</button>
        </form>
        </p>


        <?php

        if ($_SESSION["tipo"] == "admin") {
            header("Location:admin/get_libros.php");
        }
    } else {
        ?>
        <form action="index.php" method="post">
            <p><label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?php
                                                                        if (isset($_POST["usuario"])) {
                                                                            echo $_POST["usuario"];
                                                                        }
                                                                        ?>">
                <?php
                if (isset($_POST["btnEntrar"]) && $error_login) {
                    if ($_POST["usuario"] == "") {
                        echo "No puede dejar el campo vacío";
                    } else {
                        echo "El usuario no existe y/o no coinciden usuario y contraseña";
                    }
                }
                ?>
            </p>
            <p><label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave" value="<?php
                                                                        if (isset($_POST["clave"])) {
                                                                            echo $_POST["clave"];
                                                                        }
                                                                        ?>">
                <?php
                if (isset($_POST["btnEntrar"]) && $error_login) {
                    if ($_POST["clave"] == "") {
                        echo "No puede dejar el campo vacío";
                    }
                }
                ?>
            </p>
            <button type="submit" name="btnEntrar">Entrar</button>
        </form>
    <?php
    }
    ?>


    <!--Listado de libros-->
    <h2>Listado de los Libros</h2>
    <div class="libros">
        <?php
        try {
            $consulta = "select * from libros";
            $resultado = mysqli_query($conexion, $consulta);
            while ($tupla = mysqli_fetch_assoc($resultado)) {
                echo "<div class='padre'>";
                echo "<img src='Images/" . $tupla["portada"] . "' alt='Sin portada'>";
                echo "<br/><div class='hijo'>" . $tupla["titulo"] . " - " . $tupla["precio"] . " €</div>";
                echo "<div>";
            }
        } catch (Exception $e) {
            die(error_page("Error de consulta", "No se ha podido consultar correctamente los libros"));
        }
        ?></div>
    <?php
    mysqli_close($conexion);
    ?>
</body>

</html>