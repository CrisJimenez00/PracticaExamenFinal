<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer SW</title>
</head>

<body>
    <?php
    define("DIR_SERV", "http://localhost/Proyectos/Tema3/Teor_SW/primera_api");
    function consumir_servicios_REST($url, $metodo, $datos = null)
    {
        $llamada = curl_init();
        curl_setopt($llamada, CURLOPT_URL, $url);
        curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
        if (isset($datos))
            curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
        $respuesta = curl_exec($llamada);
        curl_close($llamada);
        return $respuesta;
    }


    //-----------------------------GET---------------------
    //Llamamos a la direccion definida y el método creado
    $url = DIR_SERV . "/saludo";
    //Accedemos al contenido del archivo
    // $respuesta=file_get_contents($url);
    $respuesta = consumir_servicios_REST($url, "GET");
    //Decodificamos
    $obj = json_decode($respuesta);
    //Si el objeto no existe significa que no hay nada almacenado, con lo cual hay un error
    if (!$obj) {
        die("<p>Error consumiendo el servicio web: " . $url . "</p>" . $respuesta);
    }
    echo "<p>El saludo recibido ha sido: <strong>" . $obj->mensaje . "</strong></p>";


    //-----------------------------------------------

    //Ejemplo con variable
    $url = DIR_SERV . "/saludo/Manoli";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio web: " . $url . "</p>" . $respuesta);
    }
    echo "<p>El saludo recibido ha sido: <strong>" . $obj->mensaje . "</strong></p>";

    //-----------------------------------

    //Ejemplo con variable con espacio(así aunque haya espacios lo lee como url)
    $url = DIR_SERV . "/saludo/" . urlencode("Manoli Josefa");
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio web: " . $url . "</p>" . $respuesta);
    }
    echo "<p>El saludo recibido ha sido: <strong>" . $obj->mensaje . "</strong></p>";

    //-------------------------------POST----------------------------------------
    $url = DIR_SERV . "/saludo";
    $datos["nombre"] = "Pepito";
    $respuesta = consumir_servicios_REST($url, "POST", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio web: " . $url . "</p>" . $respuesta);
    }
    echo "<p>El saludo recibido ha sido: <strong>" . $obj->mensaje . "</strong></p>";


    //----------------------------------DELETE-------------------------------
    $url = DIR_SERV . "/borrar_saludo/37";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio web: " . $url . "</p>" . $respuesta);
    }
    echo "<p><strong>" . $obj->mensaje . "</strong></p>";

    //---------------------------PUT---------------------
    $url = DIR_SERV . "/actualizar_saludo/78";
    $datos["nombre"] = "Juanita";
    $respuesta = consumir_servicios_REST($url, "PUT", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio web: " . $url . "</p>" . $respuesta);
    }
    echo "<p><strong>" . $obj->mensaje . "</strong></p>";
    ?>
</body>

</html>