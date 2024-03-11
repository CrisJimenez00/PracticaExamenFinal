<?php

//require de funciones
require "../src/funciones_ctes.php";

//require
require __DIR__ . '/Slim/autoload.php';

//crear app
$app= new \Slim\App;

$app->post('/salir', function($request){
    //comprobar token
    $api_key=$request->getParam("api_key");
    session_id($api_key);
    session_start();
    //cotejar
    session_destroy();
    echo json_encode(array("logout"=>"Close session"));
});

$app->post('/login',function($request){
    
    $usuario=$request->getParam('usuario');
    $clave=$request->getParam('clave');

    echo json_encode(login($usuario, $clave));
});

$app->post('/logueado', function($request){
    //comprobar token (api_key)
    $api_key=$request->getParam("api_key");
    session_id($api_key);
    session_start();
    //cotejar
    if (isset($_SESSION["usuario"])) {
        echo json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        echo json_encode(array("no_login"=>"No tienes permisos para usar este servicio."));
    }
});

$app->get('/productos', function($request){
    //comprobar token
    $api_key=$request->getParam("api_key");
    session_id($api_key);
    session_start();
    //cotejar
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"]=="admin" ) {
        echo json_encode(obtener_productos());
    } else {
        echo json_encode(array("no_login"=>"No tienes permisos para usar este servicio."));
    }

});

$app->post('/crearUsuario', function($request){
    //comprobar token
    $api_key=$request->getParam("api_key");
    session_id($api_key);
    session_start();
    //cotejar
    if (isset($_SESSION["usuario"]) && $_SESSION["tipo"]=="admin" ) {
        $datos[]=$request->getParam("nombre");
        $datos[]=$request->getParam("usuario");
        // etc ...
        // si existiese la función -> echo json_encode(crearUsuario($datos))
    } else {
        echo json_encode(array("no_login"=>"No tienes permisos para usar este servicio."));
    }
});

// Una vez creado servicios los pongo a disposición
$app->run();
?>