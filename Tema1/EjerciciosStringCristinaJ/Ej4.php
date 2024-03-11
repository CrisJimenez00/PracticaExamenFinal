<?php
//3 letras iguales rima, 2 riman un poco, tildes da igual, mayus da igual
$error_formulario = false;

//POnemos las letras y sus valores correspondientes en un array
const VALOR=array("M"=>1000,"D"=>500, "C"=>100, "L"=>50, "X"=>10, "V"=>5, "I"=>1);

if (isset($_POST["btnGuardar"])) {
    //Quitamos espacios
    $texto1 =  trim($_POST["palabra1"]);
    $texto1_m = strtoupper($texto1);


    //miramos los posibles errores
    $error_palabra1 = $texto1 == "";

    //Hacemos el error del formulario en general
    $error_formulario = $error_palabra1 || !es_correcto_romano($texto1_m);
}

//Método el cual comprueba posición por posición del string por si existe
function letras_bien($texto){
    $bien= true;
    for ($i=0; $i < strlen($texto); $i++) { 
        if(!isset(VALOR[$texto[$i]])){
            $bien=false;
            break;
        }
    }
    return $bien;
}

//Para comprobar el orden de los valores está puesto correctamente
function orden_bueno($texto){
    $bien=true;
    for ($i=0; $i < strlen($texto)-1; $i++) { 
        if(VALOR[$texto[$i]]<VALOR[$texto[$i+1]]){
            $bien=false;
            break;
        }
    }
    return $bien;
}
//Método el cual nos aseguramos que no se repita más de 3 veces una letra
function repite_bien($texto){
    $veces["I"]=4;
    $veces["V"]=1;
    $veces["X"]=4;
    $veces["L"]=1;
    $veces["C"]=4;
    $veces["D"]=1;
    $veces["M"]=4;
    $bien=true;
    for ($i=0; $i < strlen($texto); $i++) { 
        $veces[$texto[$i]]--;
        if($veces[$texto[$i]]==-1){
            $bien=false;
            break;
        }
    }
    return $bien;
}
//Método que comprueba que todo esté correcto
function es_correcto_romano($texto)
{
    return letras_bien($texto) && orden_bueno($texto) && repite_bien($texto);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <style>
        h1 {
            text-align: center;
        }

        form {
            background-color: lightblue;
            border: 1px solid black;
            padding: 2em;
        }

        div {
            background-color: lightgreen;
            border: 1px solid black;
            padding: 2em;
        }
    </style>
</head>

<body>
    <form action="Ej4.php" method="post">
        <h1>Romanos a árabes-Formulario</h1>
        <p>Dime una número y lo convertiré en cifras árabes</p>
        <p>
            <label for="palabra1">Número: </label>
            <input type="text" name="palabra1" id="palabra1" value="<?php
                                                                    if (isset($_POST["palabra1"])) {
                                                                        echo $_POST["palabra1"];
                                                                    }
                                                                    ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_formulario) {
                if ($texto1 == "") {
                    echo "<span>Campo vacío</span>";
                } else {
                    echo "<span>No has escrito un número romano correcto</span>";
                }
            }
            ?>
        </p>

        <button type="submit" name="btnGuardar">Convertir</button>
    </form>
    <?php
    if (isset($_POST["btnGuardar"]) && !$error_formulario) {
        $res=0;
        for ($i=0; $i < strlen($texto1_m); $i++) { 
            $res+=VALOR[$texto1_m[$i]];
        }
        echo "<br/>";
        echo "<br/>";
        echo "<div class='verdoso'>";
        echo "<h1>Romanos a árabes-Resultado</h1>";
        echo "<p>El número ". $texto1_m." se describe en cifras árabes como: <strong>$res</strong></p>";
        echo "</div>";
    }
    ?>
</body>

</html>