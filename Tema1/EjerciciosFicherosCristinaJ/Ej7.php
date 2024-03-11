<?php
//Hay que hacer une ejercicio con un input el cual recorra el $_POST y mire si se repiten o no carácteres
    if(isset($_POST["btnEnviar"])){
        $error_form=$_POST["texto"]==""||is_numeric($_POST["texto"]);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Prueba</title>
</head>

<body>
    <form action="Ej7.php" method="post">
        <p><label for="texto">Introduzca una oración para ver si se repiten carácteres o no</label>
            <input type="text" name="texto" id="texto" value="<?php
                if(isset($_POST["texto"])){
                    echo $_POST["texto"];
                }
            ?>">
            <?php
                if(isset($_POST["btnEnviar"])&&$error_form){
                    if($_POST["texto"]==""){
                        echo "<span>Campo vacío</span>";
                    }else{
                        echo "<span>El valor introducido no es válido</span>";
                    }
                }
            ?>
        </p>
        <p><button type="submit" name="btnEnviar">Comprobar</button></p>
    </form>
                <?php
                    if(isset($_POST["btnEnviar"])&&!$error_form){
                        $valido=false;
                        for ($i=0; $i < strlen($_POST["texto"])-1; $i++) {   
                            for ($j=$i+1; $j < strlen($_POST["texto"]); $j++) { 
                                if($_POST["texto"][$i]==$_POST["texto"][$j]){
                                    $valido=true;
                                
                                }
                            }
                        }
                        if($valido){
                            echo "<p>Texto</p>";
                        }
                    }
                ?>
</body>

</html>