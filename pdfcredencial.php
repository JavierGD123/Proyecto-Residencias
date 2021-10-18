<?php
session_start();
if(!isset($_SESSION['iduserreg'])){
  header("location:Index.html");
}	


if(isset($_POST['GenCrede'])){
   $_SESSION['numtrareg'] = $_POST['NumeroEmpleadoGenCre'];
  } 

 ObtenerDatosR($_SESSION['numtrareg']);

 //Agregamos la libreria FPDF
 require('fpdf/fpdf.php');


$incre = 102;
$increx = 108;
$hoy = date("yy-m-d");
$date2 = new DateTime($hoy);

function fechahoy(){

	$diassemana = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SÁBADO");
$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOBIEMBRE","DICIEMBRE");
 
$fecha = date('d')." DE ".$meses[date('n')-1]. " DEL ".date('Y') ;

return $fecha;


}

//Salida: Miercoles 05 de Septiembre del 2016
 $pdf = new FPDF('L'); //Creamos un objeto de la librería
 $pdf->AddPage(); //Agregamos una Pagina
 $pdf->SetFont('Arial','B',16); //Establecemos tipo de fuente, negrita y tamaño 16
//Agregamos texto en una celda de 40px ancho y 10px de alto, Con Borde, Sin salto de linea y Alineada a la derecha

 $NombreArchivo = utf8_decode($_SESSION['NombreCC']);

 $pdf->SetFont('Arial','',12);
 $pdf->SetTextColor(16,87,97);

 $pdf->Cell(0,0,'Credencial del Empleado',0,1,$align="C");

// PARTE DELANTERA DE LA CREDENCIAL
 $pdf->SetFont('Times','',9);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(65,26) ;
 $pdf->Cell(0,0,utf8_decode('Sindicado de Empleados del H. Ayuntamiento de '),0,1);
 $pdf->SetXY(78,29) ;
 $pdf->Cell(0,0,utf8_decode('Lázaro Cárdenas Michoacán'),0,1);

 $pdf->Image($_SESSION['Link_FotoC'],47,35,21,21);
 
 $pdf->Image('img/logocrede.png',126.5,24,15,15);

 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(85,40) ;
 $pdf->Cell(0,0,'Se acredita a:',0,1);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(70,45) ;
 $pdf->Cell(0,0,utf8_decode("C.".$_SESSION['NombreCC']),0,1);
 $pdf->Line(70,47,130,47); 

 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(70,50) ;
 $pdf->Cell(0,0,'No. De Empleado: ',0,1);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(95,50) ;
 $pdf->Cell(0,0,$_SESSION['Num_EmpleC'],0,1);

 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(70,55) ;
 $pdf->Cell(0,0,utf8_decode('Como socio activo de esta organización.'),0,1);

 $pdf->Image('img/firmasecregeneral.PNG',85,53,30,15);

 $pdf->Line(70,67,130,67);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(79,70) ;
 $pdf->Cell(0,0,'C. JOSE ABARCA GARCIA',0,1);

 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY(85,73) ;
 $pdf->Cell(0,0,'Secretario General',0,1);

 $pdf->Rect(45,23,96,53);

 //PARTE TRASERA DE LA CREDENCIAL
$pdf->Image('img/mich.png',(48+$incre),27.2,12,12);
 $pdf->SetFont('Times','',9);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((61+$incre),25) ;
 $pdf->Cell(0,0,utf8_decode('Registro H. Tribunal de Concilacion y Arbitraje 09/84'),0,1);
 $pdf->Line((47+$incre),27,(139+$incre),27);
 

 $pdf->SetFont('Arial','',5);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((70+$incre),30) ;
 $pdf->Cell(0,0,utf8_decode('Sindicato adherido a la Federación de Sindicatos de Empleados.'),0,1);

 $pdf->SetFont('Arial','',5);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((82+$incre),32) ;
 $pdf->Cell(0,0,utf8_decode('Gobierno del Estado y sus Municipios'),0,1);
 $pdf->SetFont('Arial','',5);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((91+$incre),34) ;
 $pdf->Cell(0,0,utf8_decode('F E S E G E M'),0,1);

 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((48+$increx),41) ;
 $pdf->Cell(0,0,utf8_decode('Suscrito a: '),0,1);
 $pdf->SetFont('Arial','B',8);
 $pdf->SetXY((65+$increx),40) ;
 $pdf->Cell(0,0,utf8_decode($_SESSION['Nombre_DeptoC']),0,1);
 $pdf->Line((65+$increx),42,(133+$increx),42);

 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((48+$increx),47) ;
 $pdf->Cell(0,0,utf8_decode('Categoria: '),0,1);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetXY((65+$increx),46) ;
 $pdf->Cell(0,0,utf8_decode($_SESSION['Nombre_CategoriaC']),0,1);
 $pdf->Line((65+$increx),48,(133+$increx),48);

 
 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((48+$increx),53) ;
 $pdf->Cell(0,0,utf8_decode('Fecha de ingreso: '),0,1);

  $pdf->SetFont('Arial','B',8);
 $pdf->SetXY((73+$increx),53) ;
 $pdf->Cell(0,0,$_SESSION['Fecha_Ingre_SindC'],0,1);
 $pdf->Line((72+$increx),55,(133+$increx),55);
 //utf8_decode('05 DE OCTUBRE DEL 2020')
 $pdf->SetFont('Arial','',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((48+$increx),60) ;
 $pdf->Cell(0,0,utf8_decode('Ciudad Lázaro Cárdenas, Mich, a '),0,1);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetXY((91+$increx),55) ;
 $pdf->Cell(40,10,utf8_decode(fechahoy()),0,1,'L');

 $pdf->Image('img/firmalcjclv.PNG',(45+$increx),58,30,15);

 $pdf->Line((92+$increx),62,(133+$increx),62);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((45+$incre),73) ;
 $pdf->Cell(0,0,utf8_decode('LIC. JUAN CARLOS LOPEZ V.'),0,1);

 $pdf->SetFont('Arial','B',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->SetXY((100+$incre),73) ;
 $pdf->Cell(0,0,utf8_decode('FIRMA DEL INTERESADO'),0,1);
 
 $pdf->Rect(45+$incre,23,96,53);

 $pdf->Line((47+$incre),70,(87+$incre),70);
 $pdf->Line((96+$incre),70,(139+$incre),70);

 $pdf->Output("Credencial-".$NombreArchivo.".pdf","I"); //Mostramos el PDF creado


function ObtenerDatosR($numtrareg){
  include("abrir_conexion_adm.php");

  //$numtrareg = $_SESSION['numtrareg'];

  $ID_Persona = "";
  $ID_Cat = "";
  $ID_Dep = "";
  $ID_Sit = "";

  // 2) Preparar la orden SQL
  //$consulta= "SELECT* FROM Empleados WHERE Num_Emple = '$numtrareg'";
  $consulta = "SELECT * FROM empleados WHERE Num_Emple = '$numtrareg'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $ID_Persona =  $fila ['ID_Persona'];
    $ID_Cat =  $fila ['ID_Categoria'];
    $ID_Dep =  $fila ['ID_Departamento'];

    $_SESSION['Num_EmpleC']= $fila ['Num_Emple'];
    $_SESSION['Fecha_Ingre_SindC']= $fila ['Fecha_Ingre_Sind'];

  }

  //Datos personales
  $consulta = "SELECT * FROM personas WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $ID_Persona =  $fila ['ID_Persona'];

    $_SESSION['NombreCC']= $fila ['Nombre'] . " ". $fila ['ApellidoP'] . " " . $fila ['ApellidoM'];
   
    $_SESSION['Link_FotoC']= $fila ['Link_Foto'];
  }

  // //Datos de contacto
  // $consulta = "SELECT * FROM contactos WHERE ID_Persona = '$ID_Persona'";

  // $datos= mysqli_query($conexionadm, $consulta);

  // while ($fila =mysqli_fetch_array($datos)){
  //   $_SESSION['Num_TelefonoR']= $fila ['Num_Telefono'];
  //   $_SESSION['Num_CelularR']= $fila ['Num_Celular'];
  //   $_SESSION['CorreoR']= $fila ['Correo'];
  // }

  // //Datos de padecimientos
  // $consulta = "SELECT * FROM padecimientos WHERE ID_Persona = '$ID_Persona'";

  // $datos= mysqli_query($conexionadm, $consulta);

  // $_SESSION['TotalPadecimientosR'] = mysqli_num_rows($datos);

  // $i = 1;
  // while ($fila =mysqli_fetch_array($datos)){
  //   $_SESSION['Nombre_PadecimientoR'.$i]= $fila ['Nombre_Padecimiento'];
  //   $_SESSION['Tiempo_EvolucionR'.$i]= $fila ['Tiempo_Evolucion'];
  //   $i = $i + 1;
  // }

  // $_SESSION['Talla_CamisaAR'] = "";
  // $_SESSION['Talla_PantalonAR'] = "";
  // $_SESSION['Talla_FaldaR'] = "";

  // $_SESSION['Talla_CamisaCR'] = "";
  // $_SESSION['Talla_CamisolaR'] = "";
  // $_SESSION['Talla_PantalonCR'] = "";
  // $_SESSION['Talla_ShortR'] = "";
  // $_SESSION['Talla_MandilR'] = "";
  // $_SESSION['Talla_BataR'] = "";
  // $_SESSION['Talla_CalzadoR'] = "";
  // $_SESSION['Tipo_CalzadoR'] = "";


  // if($_SESSION['RamaR'] == "Campo"){
  // //Datos de RopaCampo
  //   $consulta = "SELECT * FROM ropacampo WHERE ID_Persona = '$ID_Persona'";

  //   $datos= mysqli_query($conexionadm, $consulta);

  //   while ($fila =mysqli_fetch_array($datos)){
  //     $_SESSION['Talla_CamisaCR']= $fila ['Talla_Playera'];
  //     $_SESSION['Talla_CamisolaR']= $fila ['Talla_Camisola'];
  //     $_SESSION['Talla_PantalonCR']= $fila ['Talla_Pantalon'];
  //     $_SESSION['Talla_ShortR']= $fila ['Short'];
  //     $_SESSION['Talla_MandilR']= $fila ['Mandil'];
  //     $_SESSION['Talla_BataR']= $fila ['Bata'];
  //     $_SESSION['Talla_CalzadoR']= $fila ['Talla_Calzado'];
  //     $_SESSION['Tipo_CalzadoR']= $fila ['Tipo_Calzado'];
  //   }

    
  // }else{
  // //Datos de RopaAdministrativo
  //   $consulta = "SELECT * FROM ropaadministrativo WHERE ID_Persona = '$ID_Persona'";

  //   $datos= mysqli_query($conexionadm, $consulta);

  //   while ($fila =mysqli_fetch_array($datos)){
  //     $_SESSION['Talla_CamisaAR']= $fila ['Talla_Camisa'];
  //     $_SESSION['Talla_PantalonAR']= $fila ['Talla_Pantalon'];
  //     $_SESSION['Talla_FaldaR']= $fila ['Falda'];
  //   }

  // }

  //Datos de Categoria
  $consulta = "SELECT Nombre_Categoria FROM categorias WHERE ID_Categoria = '$ID_Cat'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_CategoriaC']= $fila ['Nombre_Categoria'];
  }

  //Datos de Departamento
  $consulta = "SELECT Nombre_Depto FROM departamentos WHERE ID_Departamento = '$ID_Dep'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_DeptoC']= $fila ['Nombre_Depto'];;
  }

  // //Datos de Situacion
  // $consulta = "SELECT Nombre_Situacion FROM situacion WHERE ID_Situacion = '$ID_Sit'";

  // $datos= mysqli_query($conexionadm, $consulta);
  // $_SESSION['Nombre_SituacionR'] = "";
  // while ($fila =mysqli_fetch_array($datos)){
  //   $_SESSION['Nombre_SituacionR']= $fila ['Nombre_Situacion'];;
  // }

// //Datos de usuario
//   $consulta = "SELECT Nom_Usuario, Password,Tipo_Usuario FROM empleados,usuarios WHERE Num_Emple = '$numtrareg' AND empleados.ID_Empleado = usuarios.ID_Empleado";

//   $datos = mysqli_query($conexionadm, $consulta);
//   $_SESSION['Nom_UsuarioR'] = "Sin usuario";
//   $_SESSION['PasswordR'] = "";
//   while ($fila = mysqli_fetch_array($datos)){

//     $_SESSION['Nom_UsuarioR']= $fila ['Nom_Usuario'];
//     $_SESSION['PasswordR']= $fila ['Password'];
//     $_SESSION['TipoUserR']= $fila['Tipo_Usuario'];

//   }

  mysqli_close($conexionadm);

} 
?>

