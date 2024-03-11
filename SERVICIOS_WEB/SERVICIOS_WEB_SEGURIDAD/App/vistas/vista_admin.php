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
    <?php
        echo "<h1>ADMIN - Bienvenido ".$_SESSION["usuario"]."</h1>"
    ?>
    <form action="index.php" method="post">
        <button type="submit" name="btnSalir">Salir</button>
    </form>
    <?php
    $datos_seguridad["api_key"]=$_SESSION["api_key"];
    $url=DIR_SERV."/productos";
    $respuesta=consumir_servicios_REST($url, "GET", $datos_seguridad);
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
        echo "<p>".$obj->mensaje."</p>";
    } else {
        echo "<ul>";
        foreach($obj->productos as $tupla){
            echo "<li>".$tupla->nombre_corto."</li>";
        }
        echo "</ul>";
    }

    ?>
</body>
</html>