<?php
if (isset($_POST["btnSeparar"])) {
    $error_formulario = $_POST["texto"] == "";
}
function contador($texto)
{
    $contador = 0;
    //Mientras exista la posición de $texto
    while (isset($texto[$contador])) {
        $contador++;
    }
    return $contador;
}
function mi_explode($texto,$sep){
    $aux = [];
    $l_texto = contador($texto);
    $i = 0;

    // QUITAR SEPARADORES DEL PRINCIPIO ,,,,
    while ($i<$l_texto && $texto[$i]==$sep) {
        $i++;
    }
    // YA QUITADOS LOS DE ALANTE:
    if($i<$l_texto){
        $j = 0;
        // METE LA PRIMERA LETRA
        $aux[$j] = $texto[$i];
        // HASTA EL FINAL
        for ($i=$i+1; $i<$l_texto ; $i++) { 
            // SI NO ES SEPARADOR LO METE EN AUX
            if($texto[$i]!=$sep){
                $aux[$j] .=$texto[$i];
            }else{
                // HE ENCONTRADO UN SEPARADPOR
                // LOS QUITO OTRA VEZ
                while ($i<$l_texto && $texto[$i]==$sep) {
                    $i++;
                }
                // PARA LOS QUE SE REPITEN AL FINAL
                if($i<$l_texto){
                    $j++;
                    $aux[$j]=$texto[$i];
                }
            }
        }
    }

    

    return $aux;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 examen</title>
</head>

<body>
    <form action="ejercicio3.php" method="post">
        <p>
            Elija separador: <select name="separador" id="separador">
                <option <?php if (isset($_POST["btnSeparar"]) && $_POST["separador"] == ".") {
                            echo "selected";
                        } ?> value=".">.(punto)</option>
                <option <?php if (isset($_POST["btnSeparar"]) && $_POST["separador"] == ",") {
                            echo "selected";
                        } ?> value=",">,(coma)</option>
                <option <?php if (isset($_POST["btnSeparar"]) && $_POST["separador"] == ";") {
                            echo "selected";
                        } ?> value=";">;(punto y coma)</option>
                <option <?php if (isset($_POST["btnSeparar"]) && $_POST["separador"] == ":") {
                            echo "selected";
                        } ?> value=":">:(dos puntos)</option>
                <option <?php if (isset($_POST["btnSeparar"]) && $_POST["separador"] == " ") {
                            echo "selected";
                        } ?> value=" "> (espacio)</option>
            </select>
        </p>
        <p>
            <label for="texto">Inserte un texto</label>
            <input type="text" name="texto" id="texto" value="<?php
                                                                if (isset($_POST["texto"])) {
                                                                    echo $_POST["texto"];
                                                                }
                                                                ?>">
            <?php
            if (isset($_POST["btnSeparar"])) {
                if ($_POST["texto"] == "") {
                    echo "<span>*Campo vacío*</span>";
                }
            }
            ?>
        </p>

        <button type="submit" name="btnSeparar">Separar</button>
    </form>
    <?php
    if (isset($_POST["btnSeparar"]) && !$error_formulario) {
        echo "<p>El número de palabras diferenciadas por " . $_POST["separador"] . " es de " . count(mi_explode($_POST["texto"], $_POST["separador"])) . "</p>";
       
    }
    ?>
</body>

</html>