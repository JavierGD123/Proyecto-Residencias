<?php
	// Parametros a configurar para la conexion de la base de datos
	$host = "localhost";    // sera el valor de nuestra BD
	$basededatos = "Sindicato";    // sera el valor de nuestra BD
	$usuariodb = "SecreTrabajo";    // sera el valor de nuestra BD
	$clavedb = "Sindicato-$20#20&20#21";    // sera el valor de nuestra BD

	$conexionadm = new MySQLi($host,$usuariodb,$clavedb,$basededatos) or die( " No se puede encontrar al servidor de Base de datos");

	/** cambio del juego de caracteres a utf8 */
	
	if (!mysqli_set_charset($conexionadm, "utf8")) {
	   // printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexionadm));
	    exit();
	} else {
	   // printf("Conjunto de caracteres actual: %s\n", mysqli_character_set_name($conexionadm));
	}

	//$db = mysqli_select_db( $conexion , $basededatos ) or die("¡Upps! No se puede encontrar en la base de datos");
?>