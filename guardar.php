<?php
// Se incluye el archivo donde esta la funcion
include "conexiondb.php";

// Se guardan los datos de los inputs de form nuevo.php en una variable por cada input para poder 
// usarlos despues
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

//Recibimos el archivo enviado desde el formulario y del archivo obtemeos el nombre y el tipo
$nombre_archivo = $_FILES["archivo"]["name"];
$tipo_archivo = $_FILES["archivo"]["type"];



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

        date_default_timezone_set('America/Argentina/Buenos_Aires');
        //Obtenemos la fecha y hora para agregarle al archivo para poder diferenciarlo si se suben 2 archivos con el mismo nombre
        $fecha = new DateTime();
        $timestamp = $fecha->format('dmYHis');
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

// Se estable la conexion y se la guarda en una variable para poder usarla
$mysqli = conexiondb();

// Se ejecuta el insert en la tabla productos 
$mysqli->query("INSERT INTO productos (producto,cantidad,precio,ruta_imagen) VALUES ('$producto','$cantidad','$precio','$target_path')");

// Esta funcion sirve para hacer una redireccion hacia una pagina, en este caso queres que luego de guardar
// sea redireccionado el usuario al index para ver el nuevo registro
header('Location: index.php');
