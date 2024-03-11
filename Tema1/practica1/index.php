<?php
//if(!isset($_POST["btnGuardar"])){
    ?>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Rellena tu CV</h1>
    <form action="recogida.php" method="post" enctype="multipart/form-data">
        <p><label for="nombre">Nombre:</label></br>
            <input type="text" name="nombre" id="nombre"/>
            </br>
            <label for="apellidos">Apellidos:</label>
            </br>
            <input type="text" name="apellidos" id="apellidos"/>
            </br>
            <label for="dni">DNI:</label>
            </br>
            <input type="text" name="dni" id="dni"/>
            </br>
            <label for="clave">Contraseña:</label>
            </br>
            <input type="password" name="clave" id="clave"/>
            </br>
            Sexo</br>
            <input type="radio" name="sexo" id="hombre"  value="Hombre"/>
            <label for="hombre">Hombre</label></br>
            <input type="radio" name="sexo" id="mujer" value="Mujer"/>
            <label for="mujer" >Mujer</label>
        </p>
        <p>
            <label for="foto">Incluir mi foto:</label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </p>
        <p>Nacido en:
            <select name="nacimiento" id="nacimiento">
                <option value="Málaga">Málaga</option>
                <option value="Sevilla">Sevilla</option>
                <option value="Cádiz" selected>Cádiz</option>
            </select>
        </p>
        <p>
            <label for="area">Comentarios:</label>
            <textarea name="comentarios" id="area"></textarea>
        </p>
        <p><input type="checkbox" name="subscripcion" id="boletin"/>
            <label for="boletin">Suscribirme al boletín de Novedades</label>
        </p>
        <button type="submit" name="btnGuardar">Guardar Cambios</button>
        <button type="reset" name="btnBorrar">Borrar los datos introducidos</button>
    </form>
</body>

</html>
    <?php
/*}else{
 header("Location:recogida.php");
}*/
?>
