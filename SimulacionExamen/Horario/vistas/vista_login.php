<?php
if(isset($_POST["btnEnviar"])){
    $error_usuario=$_POST["usuario"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_form=$error_clave||$error_usuario;
    if(!$error_form){
        consumir_servicios_REST(DIR_SERV.'/login','POST',$datos=null)
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 23_24</title>
</head>

<body>
    <h1>Horarios</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) {
                                                                        echo $_POST["usuario"];
                                                                    } ?>">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_form) {
                if ($_POST["usuario"] == "") {
                    echo "Campo vacío";
                } else {
                    echo "Usuario/clave incorrectos ";
                }
            }

            ?>

        </p>
        <p>
            <label for="clave">Clave:</label>
            <input type="password" name="clave" id="clave">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_form) {
                if ($_POST["clave"] == "") {
                    echo "Campo vacío";
                } else {
                    echo "Usuario/clave incorrectos ";
                }
            }

            ?>

        </p>
        <p><button type="submit" name="btnEnviar">Entrar</button></p>
    </form>
    <?php
    if (isset($_SESSION["seguridad"])) {
        echo $_SESSION["seguridad"];
        session_destroy();
    }
    ?>
</body>

</html>