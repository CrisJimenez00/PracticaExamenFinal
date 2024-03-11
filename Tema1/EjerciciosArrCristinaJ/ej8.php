<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<body>
    <?php
    $lista=array("Pedro", "Ismael", "Sonia", "Clara", "Susana", "Alfonso", "Teresa");
    echo "La lista tiene un total de: ". count($lista). " elementos";
    for ($i=0; $i < count($lista); $i++) { 
        echo $lista[$i]."<br/>";
    }
    ?>
</body>
</html>