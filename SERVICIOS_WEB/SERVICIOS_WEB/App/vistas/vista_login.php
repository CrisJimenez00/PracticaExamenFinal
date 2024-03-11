<?php

if (isset($_POST["btnLogin"])) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];

    $error_usuario = $usuario == "";
    $error_clave = $clave == "";

    $error_form = $error_usuario || $error_clave;

    if (!$error_form) {

        $datos["usuario"]=$usuario;
        $datos["clave"]=md5($clave);
        $url=DIR_SERV."/login";
        $respuesta=consumir_servicios_REST($url, "POST", $datos);
        $obj=json_decode($respuesta);
        if(!$obj){
            session_destroy();
            die("<p>Error consumiendo el servicio: ".$url."</p>".$respuesta);
        }
        if (isset($obj->mensaje_error)) {
            session_destroy();
            die("<p>".$obj->mensaje_error."</p>");
        }
        if (isset($obj->mensaje)) {
            //echo "<p>Mensaje: ".$obj->mensaje."</p>";
            $error_usuario = true;
        } else {
            $_SESSION["usuario"]=$obj->usuario->usuario;
            $_SESSION["clave"]=$obj->usuario->contrasena;
            $_SESSION["ult_accion"]=time();
            header('Location: index.php');
            exit;
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - API</title>
    <style>
        table,td,th{border:1px solid black;}
        table{border-collapse:collapse;text-align:center;width:50%;margin:0}
        th{background-color:#CCC}
        table img{width:100px;}
        .btnEnlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color: red}
        .aux{color: blue}
    </style>
</head>
<body>
    <h1>LOGIN</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario" >Usuario: </label>
            <input type="text" id="usuario" name="usuario"
            value="<?php
            if (isset($usuario)) {
                echo $usuario;
            }
            ?>"/>
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($usuario == "") {
                    echo "<span class='error'>Campo vacío</span>";
                } else {
                    echo "<span class='error'>Usuario no válido</span>";
                }
            }
            ?>
        </p>
        <p>
            <label for="clave" >Clave: </label>
            <input type="password" id="clave" name="clave"/>
            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'>Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Login</button>
        </p>
    </form>

<?php
    if (isset($_SESSION["seguridad"])) {
        echo "<p class='aux'>".$_SESSION["seguridad"]."</p>";
        session_destroy();
    }
?>

</body>
</html>