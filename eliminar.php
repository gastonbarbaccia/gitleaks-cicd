<?php
// Incluimos el archivo donde se encuentra la funcion a usar
include "conexiondb.php";

/* obtenemos la variable id que pasa en el boton eliminar, que seria esta  ?id=<?php echo $filas['id']?>
Esta variable en este caso se la debe de recibir con el metodo GET
*/
$id = $_GET['id'];

// Se estable la conexion con la base de datos
$mysqli = conexiondb();

$archivo_nombre = $mysqli->query("SELECT * FROM productos WHERE id ='$id'");

$archivo = $archivo_nombre-> fetch_assoc();

$imagen = $archivo['ruta_imagen'];

unlink($imagen);

//Se ejecuta la consulta, en este caso es del tipo delete o sea eliminar registros en base al id
$eliminar = $mysqli->query("DELETE FROM productos WHERE id LIKE '$id'");



//Luego una vez ejecutada la eliminacion se procede a hacer una redireccion al index
header('Location: index.php');