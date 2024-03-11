<?php

    define('DIR_SERV', "http://localhost/Proyectos/Semana_3_Enero/SERVICIOS_WEB/api");

    //función consumir servicios
    function consumir_servicios_REST($url,$metodo,$datos=null){
        $llamada=curl_init();
        curl_setopt($llamada,CURLOPT_URL,$url);
        curl_setopt($llamada,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($llamada,CURLOPT_CUSTOMREQUEST,$metodo);
        if(isset($datos))
            curl_setopt($llamada,CURLOPT_POSTFIELDS,http_build_query($datos));
        $respuesta=curl_exec($llamada);
        curl_close($llamada);
        return $respuesta;
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

    <h1>Login</h1>
    <?php
    
    $url=DIR_SERV."/login";

    $datos_login["usuario"]="normal";
    $datos_login["clave"]=md5("normal");

    $respuesta=consumir_servicios_REST($url, 'POST', $datos_login);
    $obj=json_decode($respuesta);
    if(!$obj){
        die("<p>Error consumiendo el servicio: ".$url."</p>".$respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>".$obj->mensaje_error."</p>");
    }
    if (isset($obj->mensaje)) {
        echo "<p>Mensaje:".$obj->mensaje."</p>";
    }

    echo "<h2>El usuario ".$obj->usuario->usuario." con id ".$obj->usuario->id_usuario." y de tipo ".$obj->usuario->tipo." </h2>";

    
    ?>

</body>
</html>