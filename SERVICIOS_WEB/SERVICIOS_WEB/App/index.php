<?php

    session_name("App_Login_23_24");
    session_start();

    define('DIR_SERV', "http://localhost/Proyectos/Semana_3_Enero/SERVICIOS_WEB/api");
    define("MINUTOS", 5);
     
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

    if (isset($_POST["btnSalir"])) {
        session_unset();
        header('Location: index.php');
        exit;
    }

    if (isset($_SESSION["usuario"])) {
        $datos_seguridad["usuario"]=$_SESSION["usuario"];
        $datos_seguridad["clave"]=$_SESSION["clave"];
        $url=DIR_SERV."/login";
        $respuesta=consumir_servicios_REST($url, "POST", $datos_seguridad);
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
            session_unset();
            $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
            header('Location: index.php');
            exit;
        } else {
            $datos_usuario_log=$obj->usuario;
            
            if (time()-$_SESSION["ult_accion"]>MINUTOS*60) {
                session_unset();
                $_SESSION["seguridad"]="Ha superado el tiempo";
                header('Location: index.php');
                exit;
            }

            $_SESSION["ult_accion"] = time();

            if ($datos_usuario_log->tipo == 'admin') {
                require "vistas/vista_admin.php";
            } else {
                require "vistas/vista_normal.php";
            }


        }
    } else {
        require "vistas/vista_login.php";
    }

    ?>
