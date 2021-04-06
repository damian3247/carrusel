<?php



if ($_FILES) {
    $pastaDestino = "imagenProvisoria/";
    if (!dir($pastaDestino)) {
        mkdir($pastaDestino, 0777, true);
    }
    $nombreArchivo = $pastaDestino . "/" . $_FILES["imagen"]["name"];
    if (file_exists($nombreArchivo)) {
        unlink($nombreArchivo);
    }

    if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $nombreArchivo)) {
        echo "Hubo un problema con el archivo";
    } else {
        echo "Archivo guardado en " . $nombreArchivo;
        header("location: panel.php");
    }
}
if ($_POST) {
    if (isset($_POST['operacion'])) {
        if($_POST['operacion']=="enviar"){
            enviarTodo("imagenProvisoria", "imagen");
        }
        elseif($_POST['operacion']=="recibir"){
            enviarTodo("imagen", "imagenProvisoria");
        }
        else
        {
            echo "opción incorrecta, ni enviar ni recibir";
        }
    }
    if (isset($_POST['nombreImagen'])) {
        if(unlink($_POST['nombreImagen']))
        {
            echo "eliminado";
        }
        else
        {
            echo "problema al eliminar";
        }
    }
}

function enviarTodo($carpetaOrigen, $carpetaDestino)
{
    if (!(dir($carpetaOrigen) && dir($carpetaDestino))) {
        echo "alguna no es directorio";
        exit;
    }
    $abreDestino = opendir($carpetaDestino);
    while (($archivo = readdir($abreDestino)) !== false) {
        if ($archivo != "." && $archivo != "..") {
            unlink($carpetaDestino."/".$archivo);
        }
    }
    closedir($abreDestino);

    $abreOrigen = opendir($carpetaOrigen);
    while (($archivo = readdir($abreOrigen)) !== false) {
        if ($archivo != "." && $archivo != "..") {
            copy($carpetaOrigen . "/" . $archivo, $carpetaDestino . "/" . $archivo);
        }
    }
    closedir($abreOrigen);
}


?>