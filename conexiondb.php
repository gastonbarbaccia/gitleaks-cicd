<?php


//funcion que se encargar de crear la conexion de la base de datos 
function conexiondb(){
	//datos del servidor y de la base de datos
	$localhost = "localhost";
	$username = "root";
	$password = "";
	$database = "control_stock";
	
/*
	$localhost = "212.107.19.2";
	$username = "u463129590_curso_php";
	$password = "Inicio1234.";
	$database = "u463129590_curso_php";
*/
	// crea la conexion con los datos pasados en la funcion mysqli()
	$mysqli = new mysqli($localhost, $username ,$password , $database);

	//devuelve la cadena de conexion para ser usada en donde se llame la funcion
	return $mysqli;

}

