<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APP Login SW - Admin</title>
    <style>
        .enlace {
            background: none;
            border: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }

        .enlinea {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>App Login SW - Admin</h1>
    <div>Bienvenido <strong><?php echo $datos_usuario_log->usuario; ?></strong> -
        <form action="index.php" method="post" class="enlinea"><button class="enlace" type="submit" name="btnSalir">Salir</button></form>
    </div>
</body>

</html>