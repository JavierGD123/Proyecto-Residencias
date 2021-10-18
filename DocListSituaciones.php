<?php
session_start();
if(!isset($_SESSION['iduserreg'])){
  header("location:Index.html");
}

if(isset($_POST['GenDocSit'])){
   $_SESSION['nomsit'] = $_POST['NomSitu'];
  } 

function fechahoy(){

  $diassemana = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SÁBADO");
$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOBIEMBRE","DICIEMBRE");
 
$fecha = date('d')." DE ".$meses[date('n')-1]. " DEL ".date('Y') ;

return $fecha;


}  

//ObtenerDatosR($_SESSION['nomsit']);
//Agregamos la libreria FPDF
require('fpdf/fpdf.php');
require('fpdf/AlphaPDFDocList.php');
//$pdf = new FPDF('L'); //Creamos un objeto de la librería
$pdf = new AlphaPDF('L');

//$pdf = new PDF();
 $pdf->AliasNbPages();
 $pdf->AddPage(); //Agregamos una Pagina
 //$pdf->AddFont('Calibri Light (Títulos)','I');

 $TamañoFuente = 7;
 $TipoFuente = "Arial";

 $AjutarTablaX = 10;
 $SiguinteFila = 30;
 $Inclemento = 5;

 $EncabezadoTablaAncho = 15;

 $DatoBuscarI = $_SESSION['nomsit'];

 $pdf->SetFont($TipoFuente,'',12);
 $pdf->SetDrawColor(0,0,0);

 //$pdf->Image('img/LogoCabecera.jpg',20,6,24,24);

 $pdf->SetXY(90,20); 
 $pdf->Cell(1,1,utf8_decode("ESCALAFON-SITUACIÓN: ".$DatoBuscarI),0,0,'L',false);

 $pdf->SetXY(200,20); 
 $pdf->Cell(1,1,utf8_decode(fechahoy()),0,0,'L',false);

 $pdf->SetFont($TipoFuente,'',8);
 $pdf->SetDrawColor(0,0,0);

  include("abrir_conexion_adm.php");

  //Cabecera tabala
 $pdf->SetTextColor(255,255,255);
 $pdf->SetXY($AjutarTablaX,$SiguinteFila); 

 $pdf->Cell(5,$Inclemento,'#',1,0,'L',true);
 $pdf->Cell(15,$Inclemento,'NumTra',1,0,'L',true);
 $pdf->Cell(30,$Inclemento,'Nombre',1,0,'L',true);
 $pdf->Cell(75,$Inclemento,utf8_decode('Categoría'),1,0,'L',true);
 $pdf->Cell(15,$Inclemento,utf8_decode('Salario'),1,0,'L',true);
 $pdf->Cell(25,$Inclemento,'Departamento',1,0,'L',true);
 $pdf->Cell(15,$Inclemento,'FechIA',1,0,'L',true);
 $pdf->Cell(15,$Inclemento,'FechIS',1,0,'L',true);
 $pdf->Cell(15,$Inclemento,'FechID',1,0,'L',true);
 $pdf->Cell(15,$Inclemento,'FechAC',1,0,'L',true);
 $pdf->Cell(20,$Inclemento,utf8_decode('Situación'),1,0,'L',true);
 $pdf->Cell(18,$Inclemento,'CubreTemp',1,0,'L',true);
 $pdf->Cell(18,$Inclemento,'CubreFam',1,0,'L',true);
 //$pdf->Cell(20,10,'',1,0,'L',true);

 // $array = array();
 //    // Agregar un elemento (note que la nueva clave es 5, en lugar de 0).
 //    $Consulta = "SELECT Nombre_Categoria FROM empleados,categorias,situacion WHERE empleados.ID_Situacion = situacion.ID_Situacion AND empleados.Cubre_Temp_Def = categorias.ID_Categoria order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

 //    $Resultado = mysqli_query($conexionadm, $Consulta) or die("Algo ha ido mal en la consulta1 a la base de datos");
 //    $un = 1;
 //     while($datos1 = mysqli_fetch_array($Resultado)){
 //        $array[$un] = $datos1['Nombre_Categoria'];
 //        $un++;
 //     }


$consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND Nombre_Situacion = '$DatoBuscarI' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){

       $NombreCompleto = utf8_decode($datos1['Nombre'])." ".utf8_decode($datos1['ApellidoP'])." ".utf8_decode($datos1['ApellidoM']);

      fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,
        $uno++,
        utf8_decode($datos1['Num_Emple']),
        $NombreCompleto,
        utf8_decode($datos1['Nombre_Categoria']),
        utf8_decode($datos1['Salario']),
        utf8_decode($datos1['Nombre_Depto']),  
        utf8_decode($datos1['Fech_Ingre_Ayunt']),
        utf8_decode($datos1['Fecha_Ingre_Sind']),
        utf8_decode($datos1['Fecha_Ingre_Dep']),
        utf8_decode($datos1['Fecha_Asig_Cat']),
        utf8_decode($datos1['Nombre_Situacion']),
        utf8_decode($datos1['Nombre_TemCat']),
        utf8_decode($datos1['Cubre_Fam_Temp']));

       // $pdf->SetFont($TipoFuente,'',$TamañoFuente); 
       // $pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
       // $pdf->SetTextColor(0,0,0);

       // $pdf->Cell(5,15,$uno++,0,0,'L'); 
       // $pdf->Cell(15,15,utf8_decode($datos1['Num_Emple']),0,0,'L');
       // $pdf->Cell(30,15,$NombreCompleto,0,0,'L');
       // $pdf->Cell(25,15,utf8_decode($datos1['Nombre_Categoria']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Salario']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Nombre_Depto']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Fech_Ingre_Ayunt']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Fecha_Ingre_Sind']),8,0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Fecha_Ingre_Dep']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Fecha_Asig_Cat']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Nombre_Situacion']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Cubre_Temp_Def']),0,0,'L');
       // $pdf->Cell(15,15,utf8_decode($datos1['Cubre_Fam_Temp']),0,0,'L');
    
    }      
  
      mysqli_close($conexionadm);


// $pdf->SetAlpha(0.1);
// $pdf->Image('img/logocrede.png',28,90,160);
// $pdf->SetAlpha(1);

$pdf->Output("DocumentoSituacion.pdf","I");
  //$pdf->Output("Ficha-.pdf","I");

function CalcularDias($Tiempo){
  $date1 = new DateTime($Tiempo);
  $hoy = date("yy-m-d");
  $date2 = new DateTime($hoy);
  $diff = $date1->diff($date2);
  // will output 2 days
  $dias = $diff->days;

  return $dias; 
} 

function fila($pdf, $TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila,$Dato1,$Dato2,$Dato3,$Dato4,$Dato5,$Dato6,$Dato7,$Dato8,$Dato9,$Dato10,$Dato11,$Dato12,$Dato13){
 $pdf->SetFont($TipoFuente,'',$TamañoFuente); 
 $pdf->SetXY($AjutarTablaX,$SiguinteFila);
 $pdf->SetTextColor(0,0,0);
 $pdf->Cell(5,15,$Dato1,0,0,'L'); 
 $pdf->Cell(15,15,$Dato2,0,0,'L');
 $pdf->Cell(30,15,$Dato3,0,0,'L');
 $pdf->Cell(75,15,$Dato4,0,0,'L');
 $pdf->Cell(15,15,$Dato5,0,0,'L');
 $pdf->Cell(25,15,$Dato6,0,0,'L');
 $pdf->Cell(15,15,$Dato7,0,0,'L');
 $pdf->Cell(15,15,$Dato8,0,0,'L');
 $pdf->Cell(15,15,$Dato9,0,0,'L');
 $pdf->Cell(15,15,$Dato10,0,0,'L');
 $pdf->Cell(20,15,$Dato11,0,0,'L');
 $pdf->Cell(18,15,$Dato12,0,0,'L');
 $pdf->Cell(18,15,$Dato13,0,0,'L');

 // $pdf->MultiCell(5,15,utf8_decode($Dato1),1,'L',0); 
 // $pdf->MultiCell(15,15,utf8_decode($Dato2),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato3),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato4),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato5),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato6),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato7),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato8),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato9),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato10),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato11),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato12),0,'L',0);
 // $pdf->MultiCell(15,15,utf8_decode($Dato13),0,'L',0);


 // $pdf->Cell(3,$Inclemento,'#',1,0,'L',true);
 // $pdf->Cell(15,$Inclemento,'NumTra',1,0,'L',true);
 // $pdf->Cell(15,$Inclemento,'Nombre',1,0,'L',true);
 // $pdf->Cell(17,$Inclemento,utf8_decode('Categoría'),1,0,'L',true);
 // $pdf->Cell(13,$Inclemento,utf8_decode('Salario'),1,0,'L',true);
 // $pdf->Cell(20,$Inclemento,'Departamento',1,0,'L',true);
 // $pdf->Cell(15,$Inclemento,'FechIA',1,0,'L',true);
 // $pdf->Cell(15,$Inclemento,'FechIS',1,0,'L',true);
 // $pdf->Cell($EncabezadoTablaAncho,$Inclemento,'FechID',1,0,'L',true);
 // $pdf->Cell($EncabezadoTablaAncho,$Inclemento,'FechAC',1,0,'L',true);
 // $pdf->Cell($EncabezadoTablaAncho,$Inclemento,utf8_decode('Situación'),1,0,'L',true);
 // $pdf->Cell($EncabezadoTablaAncho,$Inclemento,'CubreTemp',1,0,'L',true);
 // $pdf->Cell($EncabezadoTablaAncho,$Inclemento,'CubreFam',1,0,'L',true);
 
 //$pdf->MultiCell(113,5,utf8_decode($InofrmacionDato),0,1,'L',false);

}

// function ObtenerDatosR($numtrareg){
//   include("abrir_conexion_adm.php");

//   //$numtrareg = $_SESSION['numtrareg'];

//   $ID_Persona = "";
//   $ID_Cat = "";
//   $ID_Dep = "";
//   $ID_Sit = "";

//   // 2) Preparar la orden SQL
//   //$consulta= "SELECT* FROM Empleados WHERE Num_Emple = '$numtrareg'";
//   $consulta = "SELECT * FROM empleados WHERE Num_Emple = '$numtrareg'";

//   $datos= mysqli_query($conexionadm, $consulta);

//   while ($fila =mysqli_fetch_array($datos)){
//     $ID_Persona =  $fila ['ID_Persona'];
//     $ID_Cat =  $fila ['ID_Categoria'];
//     $ID_Dep =  $fila ['ID_Departamento'];
//     $ID_Sit =  $fila ['ID_Situacion'];

//     $_SESSION['Num_EmpleR']= $fila ['Num_Emple'];
//     $_SESSION['SalarioR']= $fila ['Salario'];
//     $_SESSION['RamaR'] = $fila ['Rama'];
//     $_SESSION['Fech_Ingre_AyuntR']= $fila ['Fech_Ingre_Ayunt'];
//     $_SESSION['Fecha_Ingre_SindR']= $fila ['Fecha_Ingre_Sind'];
//     $_SESSION['Fecha_Ingre_DepR']= $fila ['Fecha_Ingre_Dep'];
//     $_SESSION['Fecha_Asig_CatR']= $fila ['Fecha_Asig_Cat'];
//     $_SESSION['Cubre_Fam_TempR']= $fila ['Cubre_Fam_Temp'];
//     $_SESSION['Cubre_Temp_DefR']= $fila ['Cubre_Temp_Def'];
//     $_SESSION['ObservacionesR']= $fila ['Observaciones'];
//   }

//   //Datos personales
//   $consulta = "SELECT * FROM personas WHERE ID_Persona = '$ID_Persona'";

//   $datos= mysqli_query($conexionadm, $consulta);

//   while ($fila =mysqli_fetch_array($datos)){
//     $ID_Persona =  $fila ['ID_Persona'];

//     $_SESSION['NombreCR']= $fila ['Nombre'] . " ". $fila ['ApellidoP'] . " " . $fila ['ApellidoM'];
//     $_SESSION['NombreR']= $fila ['Nombre'];
//     $_SESSION['ApellidoPR']= $fila ['ApellidoP'];
//     $_SESSION['ApellidoMR']= $fila ['ApellidoM'];
//     $_SESSION['EdadR']= $fila ['Edad'];
//     $_SESSION['SexoR']= $fila ['Sexo'];
//     $_SESSION['Numero_IMSSR']= $fila ['Numero_IMSS'];
//     $_SESSION['DireccionR']= $fila ['Direccion'];
//     $_SESSION['Tipo_SangreR']= $fila ['Tipo_Sangre'];
//     $_SESSION['DonanteR']= $fila ['Donante'];
//     $_SESSION['AlergiasR']= $fila ['Alergias'];
//     $_SESSION['Link_FotoR']= $fila ['Link_Foto'];
//   }

//   //Datos de contacto
//   $consulta = "SELECT * FROM contactos WHERE ID_Persona = '$ID_Persona'";

//   $datos= mysqli_query($conexionadm, $consulta);

//   while ($fila =mysqli_fetch_array($datos)){
//     $_SESSION['Num_TelefonoR']= $fila ['Num_Telefono'];
//     $_SESSION['Num_CelularR']= $fila ['Num_Celular'];
//     $_SESSION['CorreoR']= $fila ['Correo'];
//   }

//   //Datos de padecimientos
//   $consulta = "SELECT * FROM padecimientos WHERE ID_Persona = '$ID_Persona'";

//   $datos= mysqli_query($conexionadm, $consulta);

//   $_SESSION['TotalPadecimientosR'] = mysqli_num_rows($datos);

//   $i = 1;
//   while ($fila =mysqli_fetch_array($datos)){
//     $_SESSION['Nombre_PadecimientoR'.$i]= $fila ['Nombre_Padecimiento'];
//     $_SESSION['Tiempo_EvolucionR'.$i]= $fila ['Tiempo_Evolucion'];
//     $i = $i + 1;
//   }

//   $_SESSION['Talla_CamisaAR'] = "";
//   $_SESSION['Talla_PantalonAR'] = "";
//   $_SESSION['Talla_FaldaR'] = "";

//   $_SESSION['Talla_CamisaCR'] = "";
//   $_SESSION['Talla_CamisolaR'] = "";
//   $_SESSION['Talla_PantalonCR'] = "";
//   $_SESSION['Talla_ShortR'] = "";
//   $_SESSION['Talla_MandilR'] = "";
//   $_SESSION['Talla_BataR'] = "";
//   $_SESSION['Talla_CalzadoR'] = "";
//   $_SESSION['Tipo_CalzadoR'] = "";


//   if($_SESSION['RamaR'] == "Campo"){
//   //Datos de RopaCampo
//     $consulta = "SELECT * FROM ropacampo WHERE ID_Persona = '$ID_Persona'";

//     $datos= mysqli_query($conexionadm, $consulta);

//     while ($fila =mysqli_fetch_array($datos)){
//       $_SESSION['Talla_CamisaCR']= $fila ['Talla_Playera'];
//       $_SESSION['Talla_CamisolaR']= $fila ['Talla_Camisola'];
//       $_SESSION['Talla_PantalonCR']= $fila ['Talla_Pantalon'];
//       $_SESSION['Talla_ShortR']= $fila ['Short'];
//       $_SESSION['Talla_MandilR']= $fila ['Mandil'];
//       $_SESSION['Talla_BataR']= $fila ['Bata'];
//       $_SESSION['Talla_CalzadoR']= $fila ['Talla_Calzado'];
//       $_SESSION['Tipo_CalzadoR']= $fila ['Tipo_Calzado'];
//     }

    
//   }else{
//   //Datos de RopaAdministrativo
//     $consulta = "SELECT * FROM ropaadministrativo WHERE ID_Persona = '$ID_Persona'";

//     $datos= mysqli_query($conexionadm, $consulta);

//     while ($fila =mysqli_fetch_array($datos)){
//       $_SESSION['Talla_CamisaAR']= $fila ['Talla_Camisa'];
//       $_SESSION['Talla_PantalonAR']= $fila ['Talla_Pantalon'];
//       $_SESSION['Talla_FaldaR']= $fila ['Falda'];
//     }

//   }

//   //Datos de Categoria
//   $consulta = "SELECT Nombre_Categoria FROM categorias WHERE ID_Categoria = '$ID_Cat'";

//   $datos= mysqli_query($conexionadm, $consulta);

//   while ($fila =mysqli_fetch_array($datos)){
//     $_SESSION['Nombre_CategoriaR']= $fila ['Nombre_Categoria'];
//   }

//   //Datos de Departamento
//   $consulta = "SELECT Nombre_Depto FROM departamentos WHERE ID_Departamento = '$ID_Dep'";

//   $datos= mysqli_query($conexionadm, $consulta);

//   while ($fila =mysqli_fetch_array($datos)){
//     $_SESSION['Nombre_DeptoR']= $fila ['Nombre_Depto'];;
//   }

//   //Datos de Situacion
//   $consulta = "SELECT Nombre_Situacion FROM situacion WHERE ID_Situacion = '$ID_Sit'";

//   $datos= mysqli_query($conexionadm, $consulta);
//   $_SESSION['Nombre_SituacionR'] = "";
//   while ($fila =mysqli_fetch_array($datos)){
//     $_SESSION['Nombre_SituacionR']= $fila ['Nombre_Situacion'];;
//   }

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

//   mysqli_close($conexionadm);

// } 

?>
