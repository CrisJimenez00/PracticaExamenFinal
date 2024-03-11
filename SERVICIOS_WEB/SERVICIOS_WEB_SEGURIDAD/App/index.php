<?php

    session_name("App_Login_KEY_23_24");
    session_start();

    define('DIR_SERV', "http://localhost/Proyectos/Semana_3_Enero/SERVICIOS_WEB_SEGURIDAD/api");
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
        $datos_salir["api_key"] = $_SESSION["api_key"];
        $url=DIR_SERV."/salir";
        $respuesta=consumir_servicios_REST($url, "POST", $datos_salir);
        
        session_destroy();
        header('Location: index.php');
        exit;
    }

    if (isset($_SESSION["usuario"])) {
        $datos_seguridad["api_key"]=$_SESSION["api_key"];
        $url=DIR_SERV."/logueado";
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
        if (isset($obj->no_login)) {
            session_unset();
            $_SESSION["seguridad"]="El tiempo de sesión de la api ha caducado";
            header("Location:index.php");
            exit;
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
