<?php
session_start();
if(!isset($_SESSION['iduserreg'])){
  header("location:Index.html");
}

if(isset($_POST['GenFicha'])){
   $_SESSION['numtrareg'] = $_POST['NumeroEmpleadoGenFich'];
  } 

 ObtenerDatosR($_SESSION['numtrareg']);
//Agregamos la libreria FPDF
require('fpdf/fpdf.php');
require('fpdf/AlphaPDF.php');
//$pdf = new FPDF(); //Creamos un objeto de la librería
$pdf = new AlphaPDF();

$dateA = date_create($_SESSION['Fech_Ingre_AyuntR']);
$dateS = date_create($_SESSION['Fecha_Ingre_SindR']);
$dateD = date_create($_SESSION['Fecha_Ingre_DepR']);
$dateC = date_create($_SESSION['Fecha_Asig_CatR']);


//$pdf = new PDF();
$pdf->AliasNbPages();
 $pdf->AddPage(); //Agregamos una Pagina
 //$pdf->AddFont('Calibri Light (Títulos)','I');
 
 $pdf->SetXY(50,45);
 $pdf->Image('img/LogoCabecera.jpg',85,7,35,35);

 $pdf->Line(30,42,180,42);


 $pdf->SetFont('Arial','B',12); //Establecemos tipo de fuente, negrita y tamaño 16
 $pdf->SetXY(50,45);
 $pdf->Cell(0,0,utf8_decode('SINDICATO DE EMPLEADOS DEL H. AYUNTAMIENTO
  '),0,1);
 $pdf->SetXY(73,50) ;
 $pdf->Cell(0,0,utf8_decode('DE LÁZARO CÁRDENAS, MICH.'),0,1);

 //DatosPersonales($pdf,$TamañoFuente,$TipoFuente);

 $pdf->Image($_SESSION['Link_FotoR'],85,53,30,30);
 $pdf->SetFont('Arial','B',12);

  $pdf->SetXY(75,86) ;
 $pdf->Cell(0,0,utf8_decode('MEMORIAL DE SERVICIOS'),0,1);

 // $pdf->SetXY(10,95) ;
 // $pdf->Cell(1,0,utf8_decode($_SESSION['NombreC']),0,1,'L'); 

 $TamañoFuente = 8;
 $TipoFuente = "Arial";

 $AjutarTablaX = 20;
 $SiguinteFila = 89;
 $Inclemento = 5;

 $EncabezadoTablaAncho = 170;

 $pdf->SetFont($TipoFuente,'',8);
 $pdf->SetDrawColor(0,0,0);

 //DATOS PERSONALES
 $pdf->SetTextColor(255,255,255);
 $pdf->SetXY($AjutarTablaX,$SiguinteFila); 
 $pdf->Cell($EncabezadoTablaAncho,$Inclemento,'Datos personales',1,0,'L',true);
 //$pdf->Cell(20,10,'',1,0,'L',true);
  fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Nombre",$_SESSION['NombreCR']);

 fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Edad",$_SESSION['EdadR']);

 fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Sexo",$_SESSION['SexoR']);

 fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Dirección",$_SESSION['DireccionR']);

 fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"CURP",$_SESSION['Curp']);

 fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"RFC",$_SESSION['Rfc']);

 $pdf->SetDrawColor(0,0,0);
 $pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
 $pdf->SetTextColor(255,255,255);
 $pdf->Cell($EncabezadoTablaAncho,$Inclemento,'Datos de seguridad e higiene',1,1,'L',true);

 fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla playera",$_SESSION['Talla_CamisaCR']);

 if($_SESSION['RamaR'] == "Campo"){
   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla camisola",$_SESSION['Talla_CamisolaR']);

   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla pantalon",$_SESSION['Talla_PantalonCR']);

   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla short",$_SESSION['Talla_ShortR']);

   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla mandil",$_SESSION['Talla_MandilR']);

   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla bata",$_SESSION['Talla_BataR']);

   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla calzado",$_SESSION['Talla_CalzadoR']);

   fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Tipo calzado",$_SESSION['Tipo_CalzadoR']);

 }else{
  fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla de Camisa",$_SESSION['Talla_CamisaAR']);

  fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla de Pantalon",$_SESSION['Talla_PantalonAR']);

  fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Talla de falda",$_SESSION['Talla_FaldaR']);

}

$pdf->SetDrawColor(0,0,0);
$pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
$pdf->SetTextColor(255,255,255);
$pdf->Cell($EncabezadoTablaAncho,$Inclemento,'Padecimientos',1,1,'L',true);

for ($i=1; $i <= $_SESSION['TotalPadecimientosR']; $i++){ 

  $pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
  $pdf->SetTextColor(0,0,0);
  $pdf->Cell(55,$Inclemento,utf8_decode('Padecimiento '.$i),0,0,'L'); 
  $pdf->Cell(55,$Inclemento,utf8_decode($_SESSION['Nombre_PadecimientoR'.$i].", padece desde ".$_SESSION['Tiempo_EvolucionR'.$i].", tiempo de evolución ".CalcularDias($_SESSION['Tiempo_EvolucionR'.$i])." días"),0,1,'L');
} 

//DATOS DE CONTCATO 
$pdf->SetDrawColor(0,0,0);
$pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
$pdf->SetTextColor(255,255,255);
$pdf->Cell($EncabezadoTablaAncho,$Inclemento,'Datos de contacto',1,1,'L',true);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Número de telefono",$_SESSION['Num_TelefonoR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Número de celular",$_SESSION['Num_CelularR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Correo Electrónico",$_SESSION['CorreoR']);

//DATOS DE ESCALAFON
$pdf->SetDrawColor(0,0,0);
$pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
$pdf->SetTextColor(255,255,255);
$pdf->Cell($EncabezadoTablaAncho,$Inclemento,'Datos de escalafon',1,1,'L',true);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Número de empleado: ",$_SESSION['Num_EmpleR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Categoría",$_SESSION['Nombre_CategoriaR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Departamento",$_SESSION['Nombre_DeptoR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Ingreso al Ayuntamiento",date_format($dateA, "d/m/Y"));

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Ingreso al Sindicato",date_format($dateS, "d/m/Y"));

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Ingreso al Departamento",date_format($dateD, "d/m/Y"));

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Asignación a la categoría",date_format($dateC, "d/m/Y"));

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Situación",$_SESSION['Nombre_SituacionR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Cubre Familiar Temporal",$_SESSION['Cubre_Fam_TempR']);

fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Cubre Temporal Defunción",$_SESSION['Cubre_Temp_DefR']);

// // fila($pdf,$TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila+=$Inclemento,"Observaciones",$_SESSION['ObservacionesR']);

 $pdf->SetFont($TipoFuente,'',$TamañoFuente); 
 $pdf->SetXY($AjutarTablaX,$SiguinteFila+=$Inclemento);
 $pdf->SetTextColor(0,0,0);
 $pdf->Cell(55,5,utf8_decode("Observaciones"),0,0,'L'); 
 //$pdf->Cell(113,5,utf8_decode("Observaciones"),1,1,'L');
 $pdf->MultiCell(113,5,utf8_decode($_SESSION['ObservacionesR']),0,'J',0);


$pdf->SetAlpha(0.1);
$pdf->Image('img/logocrede.png',28,90,160);
$pdf->SetAlpha(1);

$pdf->Output("Ficha-".utf8_decode($_SESSION['NombreCR']).".pdf","I");
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

function fila($pdf, $TipoFuente,$TamañoFuente,$AjutarTablaX,$SiguinteFila,$Dato,$InofrmacionDato){
 $pdf->SetFont($TipoFuente,'',$TamañoFuente); 
 $pdf->SetXY($AjutarTablaX,$SiguinteFila);
 $pdf->SetTextColor(0,0,0);
 $pdf->Cell(55,5,utf8_decode($Dato),0,0,'L'); 
 $pdf->Cell(113,5,utf8_decode($InofrmacionDato),0,1,'L');
 //$pdf->MultiCell(113,5,utf8_decode($InofrmacionDato),0,1,'L',false);

}

function ObtenerDatosR($numtrareg){
  include("abrir_conexion_adm.php");

  //$numtrareg = $_SESSION['numtrareg'];

  $ID_Persona = "";
  $ID_Cat = "";
  $ID_Dep = "";
  $ID_Sit = "";
  $ID_CubreTem = "";

  // 2) Preparar la orden SQL
  //$consulta= "SELECT* FROM Empleados WHERE Num_Emple = '$numtrareg'";
  $consulta = "SELECT * FROM empleados WHERE Num_Emple = '$numtrareg'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $ID_Persona =  $fila ['ID_Persona'];
    $ID_Cat =  $fila ['ID_Categoria'];
    $ID_Dep =  $fila ['ID_Departamento'];
    $ID_Sit =  $fila ['ID_Situacion'];
    $ID_CubreTem =  $fila ['ID_CubreTemp'];

    $_SESSION['Num_EmpleR']= $fila ['Num_Emple'];
    $_SESSION['SalarioR']= $fila ['Salario'];
    $_SESSION['RamaR'] = $fila ['Rama'];
    $_SESSION['Fech_Ingre_AyuntR']= $fila ['Fech_Ingre_Ayunt'];
    $_SESSION['Fecha_Ingre_SindR']= $fila ['Fecha_Ingre_Sind'];
    $_SESSION['Fecha_Ingre_DepR']= $fila ['Fecha_Ingre_Dep'];
    $_SESSION['Fecha_Asig_CatR']= $fila ['Fecha_Asig_Cat'];
    $_SESSION['Cubre_Fam_TempR']= $fila ['Cubre_Fam_Temp'];
    $_SESSION['ObservacionesR']= $fila ['Observaciones'];
  }

  //Datos personales
  $consulta = "SELECT * FROM personas WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $ID_Persona =  $fila ['ID_Persona'];

    $_SESSION['NombreCR']= $fila ['Nombre'] . " ". $fila ['ApellidoP'] . " " . $fila ['ApellidoM'];
    $_SESSION['NombreR']= $fila ['Nombre'];
    $_SESSION['ApellidoPR']= $fila ['ApellidoP'];
    $_SESSION['ApellidoMR']= $fila ['ApellidoM'];
    $_SESSION['EdadR']= $fila ['Edad'];
    $_SESSION['SexoR']= $fila ['Sexo'];
    $_SESSION['Numero_IMSSR']= $fila ['Numero_IMSS'];
    $_SESSION['Curp'] = $fila ['Curp'];
    $_SESSION['Rfc'] =  $fila ['Rfc'];
    $_SESSION['DireccionR']= $fila ['Direccion'];
    $_SESSION['Tipo_SangreR']= $fila ['Tipo_Sangre'];
    $_SESSION['DonanteR']= $fila ['Donante'];
    $_SESSION['AlergiasR']= $fila ['Alergias'];
    $_SESSION['Link_FotoR']= $fila ['Link_Foto'];
  }

  //Datos de contacto
  $consulta = "SELECT * FROM contactos WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Num_TelefonoR']= $fila ['Num_Telefono'];
    $_SESSION['Num_CelularR']= $fila ['Num_Celular'];
    $_SESSION['CorreoR']= $fila ['Correo'];
  }

  //Datos de padecimientos
  $consulta = "SELECT * FROM padecimientos WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  $_SESSION['TotalPadecimientosR'] = mysqli_num_rows($datos);

  $i = 1;
  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_PadecimientoR'.$i]= $fila ['Nombre_Padecimiento'];
    $_SESSION['Tiempo_EvolucionR'.$i]= $fila ['Tiempo_Evolucion'];
    $i = $i + 1;
  }

  $_SESSION['Talla_CamisaAR'] = "";
  $_SESSION['Talla_PantalonAR'] = "";
  $_SESSION['Talla_FaldaR'] = "";

  $_SESSION['Talla_CamisaCR'] = "";
  $_SESSION['Talla_CamisolaR'] = "";
  $_SESSION['Talla_PantalonCR'] = "";
  $_SESSION['Talla_ShortR'] = "";
  $_SESSION['Talla_MandilR'] = "";
  $_SESSION['Talla_BataR'] = "";
  $_SESSION['Talla_CalzadoR'] = "";
  $_SESSION['Tipo_CalzadoR'] = "";


  if($_SESSION['RamaR'] == "Campo"){
  //Datos de RopaCampo
    $consulta = "SELECT * FROM ropacampo WHERE ID_Persona = '$ID_Persona'";

    $datos= mysqli_query($conexionadm, $consulta);

    while ($fila =mysqli_fetch_array($datos)){
      $_SESSION['Talla_CamisaCR']= $fila ['Talla_Playera'];
      $_SESSION['Talla_CamisolaR']= $fila ['Talla_Camisola'];
      $_SESSION['Talla_PantalonCR']= $fila ['Talla_Pantalon'];
      $_SESSION['Talla_ShortR']= $fila ['Short'];
      $_SESSION['Talla_MandilR']= $fila ['Mandil'];
      $_SESSION['Talla_BataR']= $fila ['Bata'];
      $_SESSION['Talla_CalzadoR']= $fila ['Talla_Calzado'];
      $_SESSION['Tipo_CalzadoR']= $fila ['Tipo_Calzado'];
    }

    
  }else{
  //Datos de RopaAdministrativo
    $consulta = "SELECT * FROM ropaadministrativo WHERE ID_Persona = '$ID_Persona'";

    $datos= mysqli_query($conexionadm, $consulta);

    while ($fila =mysqli_fetch_array($datos)){
      $_SESSION['Talla_CamisaAR']= $fila ['Talla_Camisa'];
      $_SESSION['Talla_PantalonAR']= $fila ['Talla_Pantalon'];
      $_SESSION['Talla_FaldaR']= $fila ['Falda'];
    }

  }

  //Datos de Categoria
  $consulta = "SELECT Nombre_Categoria FROM categorias WHERE ID_Categoria = '$ID_Cat'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_CategoriaR']= $fila ['Nombre_Categoria'];
  }

  //Datos de Departamento
  $consulta = "SELECT Nombre_Depto FROM departamentos WHERE ID_Departamento = '$ID_Dep'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_DeptoR']= $fila ['Nombre_Depto'];;
  }

  //Datos de Situacion
  $consulta = "SELECT Nombre_Situacion FROM situacion WHERE ID_Situacion = '$ID_Sit'";

  $datos= mysqli_query($conexionadm, $consulta);
  $_SESSION['Nombre_SituacionR'] = "";
  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_SituacionR']= $fila ['Nombre_Situacion'];;
  }

  //Datos de CubreTemp
  $consulta = "SELECT Nombre_TemCat  FROM cubre_tem WHERE ID_CubreTemp = '$ID_CubreTem'";

  $datos= mysqli_query($conexionadm, $consulta);
   

   $_SESSION['Cubre_Temp_DefR'] = "";
  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Cubre_Temp_DefR']= $fila ['Nombre_TemCat'];
  }

 

//Datos de usuario
  $consulta = "SELECT Nom_Usuario, Password,Tipo_Usuario FROM empleados,usuarios WHERE Num_Emple = '$numtrareg' AND empleados.ID_Empleado = usuarios.ID_Empleado";

  $datos = mysqli_query($conexionadm, $consulta);
  $_SESSION['Nom_UsuarioR'] = "Sin usuario";
  $_SESSION['PasswordR'] = "";
  while ($fila = mysqli_fetch_array($datos)){

    $_SESSION['Nom_UsuarioR']= $fila ['Nom_Usuario'];
    $_SESSION['PasswordR']= $fila ['Password'];
    $_SESSION['TipoUserR']= $fila['Tipo_Usuario'];

  }

  mysqli_close($conexionadm);

} 

?>
