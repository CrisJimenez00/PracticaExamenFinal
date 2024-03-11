<?php
function crea_pares($cantidad)
{
    for ($i = 0; $i < 2 * $cantidad; $i += 2) {
        $pares[] = $i;
    }
    return $pares;
}
define('Impares', 10);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <?php
    $pares = crea_pares(Impares);
    echo "<p>";
    for ($i = 0; $i < count($pares); $i++) {
        echo $pares[$i] . "<br/>";
    }
    echo "</p>";
    ?>
</body>

</html>