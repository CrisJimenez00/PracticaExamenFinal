<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;



$app->get('/conexion_PDO', function ($request) {

    echo json_encode(conexion_pdo());
});

$app->post('/login', function ($request) {
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");
    echo json_encode(login($usuario, $clave));
});
$app->get('/logueado', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        print json_encode(logueado($_SESSION["usuario"], $_SESSION["clave"]));
    } else {
        session_destroy();
        print json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});
$app->post('/salir', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        session_destroy();
        print json_encode(array("log_out" => "Cerrada sesión en la API"));
    } else {
        print json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});
$app->get('/usuario/{id_usuario}', function ($request) {
});
$app->get('/usuariosGuardia/{dia}/{hora}', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        print json_encode(usuarios_guardia($request->getAttribute("dia"), $request->getAttribute("hora")));
    } else {
        print json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});
$app->get('/deGuardia/{dia}/{hora}/{id_usuario}', function ($request) {
    $api_session = $request->getParam("api_session");
    session_id($api_session);
    session_start();
    if (isset($_SESSION["usuario"])) {
        print json_encode(de_guardia($request->getAttribute("dia"), $request->getAttribute("hora"),$request->getAttribute("id_usuario")));
    } else {
        print json_encode(array("no_auth" => "No tienes permisos para usar este servicio"));
    }
});

// Una vez creado servicios los pongo a disposición
$app->run();
