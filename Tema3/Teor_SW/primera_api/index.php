<?php
/*Hay 3 sentencias que no deben de faltar:

require __DIR__ . '/Slim/autoload.php';
$app= new \Slim\App;
$app->run();
-----------------------------------------------------

Las sentencias pueden ser:
-get    ->Recoge datos  ->Siempre 2 argumentos (cadena, function(){})
-post   ->Envía datos
-put    ->Modifica datos
-delete ->Elimina datos

*/
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;
/*
Ejemplo de las sentencias: 
$app->get('/nombreFuncion',function($request){})
$app->post($request)
$app->put()
$app->delete()
*/

//-------------------GET------------------------------
$app->get('/saludo', function () {

    //Con get casi siempre tiene echo para mostrar por pantalla, si no, no devuelve nada
    //Devuelve json la api, por eso se usa json_encode
    $respuesta["mensaje"] = "Hola"; //-> Esta línea es igual a hacer array("mensaje"=> "Hola"); .$request->getAttribute('codigo')

    echo json_encode($respuesta);
});

//-----------Con parámetros
$app->get('/saludo/{nombre}', function ($request) {
    $valor_recibido = $request->getAttribute("nombre");
    $respuesta["mensaje"] = "Hola " . $valor_recibido; //-> Esta línea es igual a hacer array("mensaje"=> "Hola"); 

    echo json_encode($respuesta);
});

//------------------POST-------------------------------
$app->post('/saludo', function ($request) {

    $valor_recibido = $request->getParam('nombre');
    $respuesta["mensaje"] = "Hola " . $valor_recibido;
    echo json_encode($respuesta);
});

//------------------DELETE-----------------------------
$app->delete('/borrar_saludo/{id}', function ($request) {

    $id_recibido = $request->getAttribute('id');
    $respuesta["mensaje"] = "Se ha borrado el saludo con id: " . $id_recibido;
    echo json_encode($respuesta);
});

//------------------PUT--------------------------------
$app->put('/actualizar_saludo/{id}', function ($request) {

    $id_recibido = $request->getAttribute('id');
    $nombre_nuevo = $request->getParam('nombre');
    $respuesta["mensaje"] = "Se ha actualizado el saludo con nombre: " . $id_recibido . " al nombre de: " . $nombre_nuevo;
    echo json_encode($respuesta);
});

// Una vez creado servicios los pongo a disposición
$app->run();
