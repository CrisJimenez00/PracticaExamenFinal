<?php
session_start();
if (isset($_POST["btnBorrarSesion"])) {
    //session_destroy() -->Lo elimina pero no lo muestra
    session_unset();//-->Lo elimina pero lo muestra una vez
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Teoria de sesiones</h1>
    <h2>Se ha recibido los siguientes datos:</h2>
    <p>
        <?php
        if (isset($_SESSION["nombre"])) {
            echo "<strong>Nombre:</strong>" . $_SESSION["nombre"] . "<br/>";
            echo "<strong>Clave:</strong>" . $_SESSION["clave"] . "<br/>";
        } else {
            echo "<p>Se han borrado los valores de sesion</p>";
        }
        ?>
    </p>
    <form action="index.php" method="post">
        <button type="submit">Volver</button>
    </form>
</body>

</html>