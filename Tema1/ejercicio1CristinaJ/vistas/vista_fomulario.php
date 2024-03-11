<?php
//Hacemos a mano la funcion in_array($valor, $array)
function en_array($valor, $arr)
{
    $esta = false;
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] == $valor) {
            $esta = true;
            break;
        }
    }
    return $esta;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Esta es mi super página</h1>
    <form action="index.php" method="post">
        <p><label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php
                                                                if (isset($_POST["nombre"])) {
                                                                    echo $_POST["nombre"];
                                                                }
                                                                ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_nombre) {
                echo "<span class='error'>Campo vacio</span>";
            }
            ?>
        </p>

        <p>Nacido en:
            <select name="nacimiento" id="nacimiento">
                <option value="Málaga" <?php
                                        if (isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Málaga") {
                                            echo "selected";
                                        }
                                        ?>>Málaga</option>
                <option value="Sevilla" <?php
                                        if (isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Sevilla") {
                                            echo "selected";
                                        }
                                        ?>>Sevilla</option>
                <option value="Cádiz" <?php
                                        if (!isset($_POST["nacimiento"]) || (isset($_POST["nacimiento"]) && $_POST["nacimiento"] == "Cádiz")) {
                                            echo "selected";
                                        }
                                        ?>>Cádiz</option>
            </select>
        </p>
        <p>Sexo
            <?php
            if (isset($_POST["btnGuardar"]) && $error_sexo) {
                echo "<span class='error'>Seleccione un sexo</span>";
            }
            ?>
            </br>

            <input type="radio" <?php
                                if (isset($_POST["sexo"]) && $_POST["sexo"] == "Hombre") {
                                    echo "checked";
                                }
                                ?> name="sexo" id="hombre" value="Hombre" />
            <label for="hombre">Hombre</label></br>
            <input <?php
                    if (isset($_POST["sexo"]) && $_POST["sexo"] == "Mujer") {
                        echo "checked";
                    }
                    ?> type="radio" name="sexo" id="mujer" value="Mujer" />
            <label for="mujer">Mujer</label>
        </p>
        <p>Aficiones:
            <!--<label for="deportes">Deportes</label>
            <input type="checkbox" name="deportes" id="deportes" value="deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="lectura" id="lectura" value="lectura">
            <label for="otros">Otros</label>
            <input type="checkbox" name="otros" id="otros" value="otros">-->
            <!--Corrección-->
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="Deportes" <?php
                                                                                        if (isset($_POST["aficiones"]) && en_array("Deportes", $_POST["aficiones"])) {
                                                                                            echo "checked";
                                                                                        }
                                                                                        ?>>
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="aficiones[]" id="lectura" value="Lectura" <?php
                                                                                    if (isset($_POST["aficiones"]) && en_array("Lectura", $_POST["aficiones"])) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>>
            <label for="otros">Otros</label>
            <input type="checkbox" name="aficiones[]" id="otros" value="Otros" <?php
                                                                                if (isset($_POST["aficiones"]) && en_array("Otros", $_POST["aficiones"])) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>>
        </p>
        <p>
            <label for="area">Comentarios:</label>
            <textarea name="comentarios" id="area"></textarea>
        </p>
        <button type="submit" name="btnGuardar">Enviar</button>
    </form>
</body>

</html>