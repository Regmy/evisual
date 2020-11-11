<html>
    <head>
        <title>Agregar Valor a campo</title>
        <link rel="stylesheet" type="text/css" href="../../estilos.css">
    </head>

    <body>
        <?php
//including the database connection file
        include_once("../../bd/config.php");

        $campo = @$_GET["id"];

        if (isset($_POST['Submit'])) {
            $sede = mysqli_real_escape_string($mysqli, $_POST['sede']);
            $inicio = mysqli_real_escape_string($mysqli, $_POST['inicio']);
            $fin = mysqli_real_escape_string($mysqli, $_POST['fin']);
            $texto = mysqli_real_escape_string($mysqli, $_POST['texto']);
            $prefijo = mysqli_real_escape_string($mysqli, $_POST['prefijo']);
            $resolucion = mysqli_real_escape_string($mysqli, $_POST['resolucion']);
            $iva = mysqli_real_escape_string($mysqli, $_POST['iva']);
            $rcinicio = mysqli_real_escape_string($mysqli, $_POST['rcinicio']);
            $rcfin = mysqli_real_escape_string($mysqli, $_POST['rcfin']);

            $textoDv = mysqli_real_escape_string($mysqli, $_POST['texto_devolucion']);
            $textoHor = mysqli_real_escape_string($mysqli, $_POST['texto_horarios']);

            echo "<pre>";
            print_R($_FILES);
            echo "</pre>";
            die;
            if (isset($_FILES['imagen_logo']['name']) && $_FILES['imagen_logo']['name'] != "") {
                $image = $_FILES['imagen_logo']['name'];
                $target = "../../images/" . basename($image);
                move_uploaded_file($_FILES['imagen_logo']['tmp_name'], $target);
            } else {
                $image = $imagenOld;
            }

            if (isset($_FILES['imagen_datos']['name']) && $_FILES['imagen_datos']['name'] != "") {
                $imageDatos = $_FILES['imagen_datos']['name'];
                $target = "../../images/" . basename($imageDatos);
                move_uploaded_file($_FILES['imagen_datos']['tmp_name'], $target);
            } else {
                $imageDatos = $imagenDatosOld;
            }
            // if all the fields are filled (not empty) 
            //insert data to database	
            $sql = "INSERT INTO facturas_rango(id_fct,sede,inicio,fin,texto,prefijo,resolucion,iva,rango_rc_inicio,rango_rc_fin,texto_devolucion, texto_horarios) VALUES(NULL,'$sede','$inicio','$fin','$texto','$prefijo','$resolucion','$iva','$rcinicio','$rcfin','$textoDv','$textoHor')";
            $result = mysqli_query($mysqli, $sql);
//            echo $sql;
//            die;
            //display success message
            echo "<font color='green'>El nuevo valor ha sido creado de manera correcta.";
            echo "<br/><br/><a href='consolidado_facturas_rango.php'></a>";
        }
        ?>

        <table class="menu"><tr><td width="115"><a href="<?php echo $_SESSION["URL_INICIO"] ?>" ><img src="../../logo.png" width="112"></a></td><td> 
                    <font color="orange"> | </font> <a href="consolidado_facturas_rango.php">Regresar</a>
                    <font color="orange"> | AGREGAR UN VALOR A LISTA SELECCIONABLE:  <?php echo $campo; ?> </font> 
                </td></tr></table>

        <form action="add.php" method="post" name="form1" enctype="multipart/form-data">
            <table width="25%" border="0">
                <tr> 
                    <td style="width:22%">SEDE</td>
                    <td><input type="text" name="sede"></td>
                </tr>
                <tr> 
                    <td style="width:22%">INICIO</td>
                    <td><input type="text" name="inicio"></td>
                </tr>
                <tr> 
                    <td style="width:22%">FIN</td>
                    <td><input type="text" name="fin"></td>
                </tr>
                <tr> 
                    <td style="width:22%">LEYENDA</td>
                    <td><input type="text" name="texto"></td>
                </tr>

                <td style="width:22%">PREFIJO</td>
                <td><input type="text" name="prefijo"></td>
                </tr>
                <tr> 
                    <td style="width:22%">RESOLUCIÓN</td>
                    <td><input type="text" name="resolucion"></td>
                </tr>
                <tr> 
                    <td style="width:22%">IVA</td>
                    <td><input type="text" name="iva"></td>
                </tr>
                <tr> 
                    <td style="width:22%">RANGO RECIBO DE CAJA INICIO</td>
                    <td><input type="text" name="rcinicio"></td>
                </tr>
                <tr> 
                    <td style="width:22%">RANGO RECIBO DE CAJA FIN</td>
                    <td><input type="text" name="rcfin" ></td>
                </tr>
                <tr> 
                    <td style="width:22%">TEXTO DEVOLUCION</td>
                    <td><input type="text" name="texto_devolucion" value="<?php echo "" ?>"></td>
                </tr>
                <tr> 
                    <td style="width:22%">TEXTO HORARIOS</td>
                    <td><input type="text" name="texto_horarios" value="<?php echo "" ?>"></td>
                </tr>
                <tr> 
                    <td style="width:22%">LOGO</td>
                    <td><input type="file" name="imagen_logo" ></td>
                </tr>
                <tr> 
                    <td style="width:22%">IMAGEN DATOS</td>
                    <td><input type="file" name="imagen_datos" ></td>
                </tr>
                <tr> 
                    <td></td>
                    <td>
                        <input type="hidden" value="<?php echo $campo; ?>" name="campo">
                        <input type="submit" name="Submit" value="Crear"></td>
                </tr>
            </table>
        </form>
    </body>
</html>