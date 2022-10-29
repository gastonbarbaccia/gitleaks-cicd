<?php
include "conexiondb.php";

$id = $_POST['id'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];


$nombre_archivo = $_FILES["archivo"]["name"];
$tipo_archivo = $_FILES["archivo"]["type"];
$tamano_archivo = $_FILES["archivo"]["size"];


if($tipo_archivo == "image/jpeg"){
    //Validamos que el archivo exista
    if($_FILES["archivo"]["name"]) {
        $filename = $_FILES["archivo"]["name"]; //Obtenemos el nombre original del archivo
        $source = $_FILES["archivo"]["tmp_name"]; //Obtenemos un nombre temporal del archivo
        
        $directorio = 'imagenes/'; //Declaramos un  variable con la ruta donde guardaremos los archivos
        
        //Validamos si la ruta de destino existe, en caso de no existir la creamos
        if(!file_exists($directorio)){
            mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");	
        }

        //Obtenemos la fecha y hora para agregarle al archivo para poder diferenciarlo si se suben 2 archivos con el mismo nombre
        $fecha = new DateTime();
        $timestamp = $fecha->getTimestamp();
        $archivo_timestamp = $timestamp.'_'.$filename;
        
        $dir=opendir($directorio); //Abrimos el directorio de destino
        $target_path = $directorio.$timestamp.'_'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo
        
        //Movemos y validamos que el archivo se haya cargado correctamente
        //El primer campo es el origen y el segundo el destino
        if(move_uploaded_file($source, $target_path)) {	
            echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
            } else {	
            echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
        }
        closedir($dir); //Cerramos el directorio de destino
    }
}else{
    echo "No se admiten archivos que no sean JPG.";
}


$mysqli = conexiondb();

$archivo_nombre = $mysqli->query("SELECT * FROM productos WHERE id ='$id'");

$archivo = $archivo_nombre-> fetch_assoc();

$imagen = $archivo['ruta_imagen'];

unlink($imagen);

$actualizar = $mysqli->query("UPDATE productos SET producto='$producto', cantidad='$cantidad',precio ='$precio', ruta_imagen ='$target_path' WHERE id='$id'");

header('Location: index.php');

?>