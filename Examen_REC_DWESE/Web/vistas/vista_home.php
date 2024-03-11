<?php
if (isset($_POST["btnEntrar"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {
        $url = DIR_SERV . "/login";
        $datos["usuario"] = $_POST["usuario"];
        $datos["clave"] = md5($_POST["clave"]);
        $respuesta = consumir_servicios_REST($url, "POST", $datos);
        $obj = json_decode($respuesta);
        if (!$obj) {
            session_destroy();
            echo "Error al consumir servicio: " . $url;
        }
        if (isset($obj->error)) {
            session_destroy();
            echo $obj->error;
            exit();
        }
        if (isset($obj->mensaje)) {
            session_unset();
            $error_usuario = true;
        } else {
            $_SESSION["usuario"] = $obj->usuario->usuario;
            $_SESSION["clave"] = $obj->usuario->clave;
            $_SESSION["api_session"] = $obj->api_session;
            $_SESSION["ultima_accion"] = time();
            header("Location:index.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Guardias</title>
</head>

<body>
    <h1>Gestión de Guardias</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php
                                                                    if (isset($_POST["usuario"])) {
                                                                        echo $_POST["usuario"];
                                                                    }
                                                                    ?>">

            <?php
            if (isset($_POST["btnEntrar"]) && $error_usuario) {
                if ($_POST["usuario"] == "") {
                    echo "*Campo vacío*";
                }
                if (isset($obj->error)) {
                    echo $obj->error;
                }
                if (isset($obj->mensaje)) {
                    echo $obj->mensaje;
                }
            }
            ?>
        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave">

            <?php
            if (isset($_POST["btnEntrar"]) && $error_clave) {
                if ($_POST["clave"] == "") {
                    echo "*Campo vacío*";
                }
            }
            ?>
        </p>
        <button type="submit" name="btnEntrar">Entrar</button>
    </form>
    <?php
    if (isset($_SESSION["seguridad"])) {
        echo "Usted ha sido baneado";
        header("Location:index.php");
    }
    ?>
</body>

</html>