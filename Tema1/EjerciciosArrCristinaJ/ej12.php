<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<body>
    <?php
        $animales=array("Lagartija", "Araña", "Perro", "Gato", "Ratón");
        $numeros= array("12", "34", "45", "52", "12");
        $arboles=array("Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34");
        $lista_completa=array();
        for ($i=0; $i < count($animales); $i++) { 
            array_push($lista_completa, $animales[$i]);
        }
        for ($i=0; $i < count($numeros); $i++) { 
            array_push($lista_completa, $numeros[$i]);
        }
        for ($i=0; $i < count($arboles); $i++) { 
            array_push($lista_completa, $arboles[$i]);
        }
        echo "<p>";
        for ($i=0; $i < count($lista_completa); $i++) { 
            echo $lista_completa[$i].", ";
        }
        echo "</p>";
    ?>
</body>
</html>