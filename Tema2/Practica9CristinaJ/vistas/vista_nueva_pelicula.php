<h2>Agregar Nueva Pelicula</h2>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="titulo">Titulo de la pelicula</label><br/>
            <input type="text" name="titulo" id="titulo" maxlength="50" value="<?php if(isset($_POST["titulo"])) echo $_POST["titulo"];?>"/>
            <?php
            if(isset($_POST["btnContNuevo"])&& $error_titulo)
            {
                if($_POST["titulo"]=="")
                    echo "<span class='error'> Campo vacío </span>";
                else
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="director">Director</label><br/>
            <input type="text" name="director" id="director" maxlength="50" value="<?php if(isset($_POST["director"])) echo $_POST["director"];?>"/>
            <?php
            if(isset($_POST["btnContNuevo"])&& $error_director)
            {
                if($_POST["director"]=="")
                    echo "<span class='error'> Campo vacío </span>";
                elseif(strlen($_POST["director"])>50)
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                
            }
                
            ?>
        </p>
        <p>
            <label for="tema">Temática de la pelicula</label><br/>
            <input type="text" name="tema" id="tema" maxlength="50" value="<?php if(isset($_POST["tema"])) echo $_POST["tema"];?>"/>
            <?php
            if(isset($_POST["btnContNuevo"])&& $error_tema)
            {
                if($_POST["tema"]=="")
                    echo "<span class='error'> Campo vacío </span>";
                else
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="sinopsis">Sinopsis</label><br/>
            <input type="text" name="sinopsis" id="sinopsis"  value="<?php if(isset($_POST["sinopsis"])) echo $_POST["sinopsis"];?>"/>
            <?php
            if(isset($_POST["btnContNuevo"])&& $error_sinopsis)
            {
                if($_POST["sinopsis"]=="")
                    echo "<span class='error'> Campo vacío </span>";
                
            }
                
            ?>
        </p>
    

       
        <p>
            <label for="foto">Incluir mi foto (Max. 500KB)</label>
            <input type="file" name="foto" id="foto" accept="image/*"/>
            <?php
            if(isset($_POST["btnContNuevo"]) && $error_foto)
            {
                if($_FILES["foto"]["error"])
                    echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                elseif(!getimagesize( $_FILES["foto"]["tmp_name"]))
                    echo "<span class='error'> No has seleccionado un archivo de tipo imagen</span>";
                elseif(!tiene_extension($_FILES["foto"]["name"]))
                    echo "<span class='error'> Has seleccionado un archivo imagen sin extensión</span>";
                else
                    echo "<span class='error'> El archivo seleccionado supera los 500KB</span>";
            }
            ?>
        </p>
        
        
        <p>
            <button type="submit" name="btnContNuevo">Guardar Cambios</button>
            <button type="submit" >Atras</button>
        </p>
        
    </form>