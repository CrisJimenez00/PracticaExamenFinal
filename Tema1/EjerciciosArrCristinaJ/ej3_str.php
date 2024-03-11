<?php
//En caso de que se señale el boton de submit, entra aquí
if(isset($_POST["submit"])){
    $palabra=trim($_POST["palabra"]);
    $strlen=strlen($palabra);
    $error_form=$palabra=="" || $strlen<3;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .div1{background-color:lightblue; border:solid; text-align:center} 
        .div2{background-color:lightgreen; border:solid; text-align:center}
        .error{color:red}
    </style>
</head>
<body>
    <div class="div1">
        <h2>Palíndromos y capicúas</h2>
        <p>Introduce palabra o número</p>
        <form action="ej3_str.php" method="post">
        <label for="palabra">Palabra:</label>
        <input type="text" name="palabra" id="palabra" value="<?php if(isset($_POST["palabra"])) echo $_POST["palabra"];?>"/>
        <?php
        //Se ponen los dos casos de error que puede haber y el por qué
        if(isset($_POST["submit"]) && $error_form){
            if ($palabra == "") {
                echo "<p class='error'>Campo vacío</p>";
            } else {
                echo "<p class='error'>introduce más de 3 caracteres</p>";
            }
           
        }
        ?>
        <br><br>
        <input type="submit" value="Comprobar" name="submit" id="submit"/>
        </form>
    </div>

    <?php
    //Si se presiona el botón submit y no se encuentran errores en el formulario esntra aquí
        if(isset($_POST["submit"]) && !$error_form){
            //Esto continúa igual
            $palabra_m=strtoupper($palabra);
            //El boolean no cambia tampoco
            $bien=true;
            //creamos la variable vacía
            $texto = "";

            //recorremos el input para quitar los espacios(Nos basamos en mayúsculas porque es la última modificación aunque sirven ambas)
            for ($i=0; $i < strlen($palabra_m) ; $i++){ 
                if($palabra_m[$i]!=" "){
                    $texto.=$palabra_m[$i];
                }
            }
            
            //Declaramos i y j después del for(en verdad solo es obligatorio el j, pero como suele venir junto con i ya bajo ambos)
            $i=0;
            //CORRECCION!!!!!! version anterior:  $j=$strlen-1;
            //Aquí cambia debido a que lo que queremos recorrer es la palabra ya con los espacios retirados
            $j=strlen($texto)-1;

            //El resto continúa igual
            while($i<$j && $bien){
                if($texto[$i]==$texto[$j]){
                    $i++;
                    $j--;
                }
                else{
                    $bien=false;
                }
            }

            //Respuesta
            if($bien){
                $respuesta="la palabra <strong>".$palabra."</strong> es palíndroma";
            }else{
                $respuesta="la palabra <strong>".$palabra."</strong> no es palíndroma";
            }

            echo "<br/>";
            echo "<br/>";
            echo "<div class='div2'>";
            echo "<h2>Respuesta</h2>";
            echo "<p>".$respuesta."</p>";
            echo "</div>";

        }
    ?>
    
</body>
</html>