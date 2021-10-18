<?php
session_start();
if(!isset($_SESSION['iduserreg'])){
  header("location:Index.html");
}
//include("php/Funciones.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>ConfigPadecimientos</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/MostrarOcultarLogin.js"></script>
  <script type="text/javascript" src="js/MostrarOcultarOjito.js"></script>

  <link rel="stylesheet" href="css/TituloDiv.css">
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->    

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <div class="container-fluid" style="background: #2E4053;" align="center">
    <img src="img/Logo.PNG" class="img-fluid" alt="Responsive image">
  </div>

  <!--Barra de navegacioón-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" >Padecimientos del trabajador <?php echo $_SESSION['numtrareg'];?> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkupConfigCat" aria-controls="navbarNavAltMarkupConfigCat" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkupConfigCat">
      <div class="navbar-nav">
        <a class="nav-link " type="button" onclick="MostrarOcultar('IDSecActualizarPade','IDSecNuevoPade','IDEliPade')">Actualizar<span class="sr-only">(current)</span></a> 
        <a class="nav-link" type="button" onclick="MostrarOcultar('IDSecNuevoPade','IDSecActualizarPade','IDEliPade')">Nuevo padecimiento</a>
        <a class="nav-link" type="button" onclick="MostrarOcultar('IDEliPade','IDSecNuevoPade','IDSecActualizarPade')">Eliminar</a>
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </div>
    </div>
  </nav>

  <div style="background:#f2f1f1;"><h2 style=""></h2></div>
</head>
<body style="background:#f2f1f1;">
 <!-- jQuery first, then Tether, then Bootstrap JS. -->
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
 <script src="js/bootstrap.min.js"> </script>

 <!----------------------------------------------------------->
 <div  style="height: 100%; width: 70%; margin: 0 auto; margin-top: 2%;">

  <!--Sección de mofificacion de Padecimientos--------------------------->
  
  <!--Fin Sección de mofificacion de padecimientos--------------------------->

  <div class="shadow p-3 mb-5 bg-white rounded"  id="IDSecNuevoPade" style="display: none;">
    <!--Seccion de nuevo nombre de padecimiento-->
    <div>
     <div class="col-auto" id="IDSecNuevoPade" style="display: none;">
       <form action="ConfigPadecimientos.php" method="POST">
        <div class="col-auto">
          <label>Nombre del nuevo padecimiento</label>
          <input type="text" id="txtNombrePadNuevo" name="NombrePadecimiemtoNuevo" class="form-control"  placeholder="Ejemplo: Asma" minlength="3" maxlength="20" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{3,20}" title="Ingresa un texto válido (De entre 5 a 20 caracteres), ¡Solo letras, espacios y números!" required>
        </div>

        <div class="col-auto" style="margin-top: 2%;">
          <label for="exampleFormControlFile1">Nueva fecha de inicio del padecimiento</label>
          <input id="txtFechaPadNuevoNuevo" type="date" name="FechaPadecimientoNueva" class="form-control"  placeholder="Ingreso al ayuntamiento" minlength="1"maxlength="10" title="fecha" required> 
        </div> 

        <div class="col-auto" style="margin-top: 2%;">
          <input type="submit" name="btnNuevoPadecimiento" class="btn btn-primary mb-2" value="Agregar">
        </div>
      </form>  
    </div>
  </div>
  <!--Fin Seccion de nuevo nombre de Padecimiento-->
</div> 

<div class="shadow p-3 mb-5 bg-white rounded"  id="IDEliPade" style="display: none;">
  <!--Seccion de aliminar nombre de Padecimientos-->
  <div >
   <div class="col-auto">
     <form action="ConfigPadecimientos.php" method="POST">
      <div class="col-auto">
        <label>Nombre de padecimiento a eliminar</label>
        <input type="text" id="txtNomCatNuevo" name="Nom_a_Eliminar" class="form-control"  placeholder="Nombre del padecimiento" minlength="3" maxlength="150" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,150}" required="" list="ListaPdecimientos">
      </div>

      <div class="col-auto" style="margin-top: 2%;">
        <input type="submit" name="btnEliminar" class="btn btn-primary mb-2" value="Eliminar">
      </div>
    </form>  
  </div>
</div>   
<!--Fin Seccion de eliminar nombre de padecimientos-->
</div>  

<div class="shadow p-3 mb-5 bg-white rounded"  id="IDSecActualizarPade">

 <!--Seccion de actualizar nombre de Padecimientos-->
 <div>
   <div class="col-auto"> 
    <form action="ConfigPadecimientos.php" method="POST">
      <div class="col-auto">  
        <label>Padecimiento a buscar</label>
        <input type="text" id="itemcat" name="NomPadBuscar" class="form-control"  placeholder="Nombre del padecimiento a buscar" minlength="1" maxlength="5" list="ListaPdecimientos" title="Ingresa un texto válido (De entre 3 a 20 caracteres), ¡Solo letras, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{3,20}" required="">
      </div>  

      <div class="col-auto" style="margin-top: 2%;">
        <input type="submit" name="btnBusPadEmp" class="btn btn-primary mb-2" value="Buscar">
      </div>
    </form>
  </div>

  <div class="col-auto" id="IDCategoriaMos" style="display: none;">
   <form action="ConfigPadecimientos.php" method="POST">
    <div class="col-auto">
      <div class="col-auto" style="margin-top: 2%;">
        <label for="exampleFormControlFile1">Nuevo nombre del Padecimiento</label>
        <input type="text" id="txtNombrePad" name="NuevoNombrePadecimiemto" class="form-control"  placeholder="Ejemplo: Asma" minlength="3" maxlength="20" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{3,20}" title="Ingresa un texto válido (De entre 5 a 20 caracteres), ¡Solo letras, espacios y números!" required>
      </div>

      <div class="col-auto" style="margin-top: 2%;">
        <label for="exampleFormControlFile1">NUeva fecha de inicio del padecimiento</label>
        <input id="txtFechaPad" type="date" name="NuevoFechaPadecimiento" class="form-control"  placeholder="Ingreso al ayuntamiento" minlength="1"maxlength="10" title="fecha" required> 
      </div> 

      <div class="col-auto" style="margin-top: 2%;">
        <input type="submit" name="btnActualizarPad" class="btn btn-primary mb-2" value="Actualizar">
      </div>
    </form>  
  </div>
</div> 
<!--Fin Seccion de actualizar nombre de padecimientos-->
</div>  



</div>	

<!--Lista Pdecimientos-------------------------------------------------->
<datalist id="ListaPdecimientos">
  <?php ListaOpciones("Nombre_Padecimiento","padecimientos");?>
</datalist>
<!---------------------------------------------------------------------------->

</body>

<a href="VistaAdminGen.php" class="btn btn-secondary"> ← Página anterior</a>

</html>

<script type="text/javascript">

  function MostrarOcultar(IDMostrar,ID1,ID2){
    document.getElementById(IDMostrar).style.display = "block";

    document.getElementById(ID1).style.display = "none";
    document.getElementById(ID2).style.display = "none";

  }
</script>

<?php

if(isset($_POST['btnBusPadEmp'])){

  $DatoBuscar = $_POST['NomPadBuscar'];

  $IDPer = ObtencionDatoNuevo($_SESSION['numtrareg'],"empleados", "Num_Emple","ID_Persona");

  $NomPade = ObtencionDato($DatoBuscar,"padecimientos", "Nombre_Padecimiento", $IDPer);
              //echo "NomCategoaria: $NomCate<br>";

  if($DatoBuscar == $NomPade){

   $_SESSION['NomDatoGuia'] = $IDPer;

   $NombrPad = $NomPade;
   $_SESSION['NomDatoNomPade'] = $NombrPad;

   include("abrir_conexion_adm.php");

   $consulta = "SELECT Tiempo_Evolucion FROM padecimientos WHERE Nombre_Padecimiento = '$NombrPad' and ID_Persona = '$IDPer'";

   $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

   while($datos = mysqli_fetch_array($dato)){
    $FechaPad = $datos["Tiempo_Evolucion"];
  }

  mysqli_close($conexionadm); 

  if($FechaPad != ""){
   echo "
   <script> 
   document.getElementById('IDCategoriaMos').style.display = 'block';

   document.getElementById('txtNombrePad').value =  '$NombrPad';
   document.getElementById('txtFechaPad').value =  '$FechaPad';

   </script>";
 }else{
  echo "<script>alert('No existe una fecha de evolución del padecimiento $NomPade');</script>";
}

}else{
  echo "<script>alert('Nombre de padecimiento: **NO EXISTENTE**');</script>";
}            

}

if(isset($_POST['btnActualizarPad'])){

  $NuevoDatoNom = $_POST['NuevoNombrePadecimiemto'];
  $NuevoDatoFech = $_POST['NuevoFechaPadecimiento'];
  
  $NomPad = ObtencionDato($NuevoDatoNom,"padecimientos", "Nombre_Padecimiento",$_SESSION['NomDatoGuia']);

  $fecha = ObtencionDato($NuevoDatoFech,"padecimientos", "Tiempo_Evolucion",$_SESSION['NomDatoGuia']);
//ActuazlizarDato($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia,$DatoGuia1,$ColumnaGuia1)
  if($NuevoDatoNom != $NomPad){
    ActuazlizarDato($NuevoDatoNom,"padecimientos","Nombre_Padecimiento","ID_Persona",$_SESSION['NomDatoGuia'],$_SESSION['NomDatoNomPade'],"Nombre_Padecimiento");
    //echo "<script>alert('**ACTUALIZACIÓN EXITOSA**');</script>";
  }

  if($NuevoDatoFech != $fecha){

    $IDPers = $_SESSION['NomDatoGuia'];
    $NomPadc = $_SESSION['NomDatoNomPade'];
    include("abrir_conexion_adm.php");

    $consulta = "SELECT Tiempo_Evolucion FROM padecimientos WHERE Nombre_Padecimiento = '$NomPadc' and ID_Persona = '$IDPers'";

    $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

    $fechaAntigua = "";

    while($datos = mysqli_fetch_array($dato)){
      $fechaAntigua = $datos["Tiempo_Evolucion"];
    }

    mysqli_close($conexionadm);

    ActuazlizarDato($NuevoDatoFech,"padecimientos", "Tiempo_Evolucion","ID_Persona",$_SESSION['NomDatoGuia'],$fechaAntigua, "Tiempo_Evolucion");
  }                              

  echo "<script>alert('**ACTUALIZACIÓN EXITOSA**');</script>";
}

if(isset($_POST['btnNuevoPadecimiento'])){

  $NuevoDato = $_POST['NombrePadecimiemtoNuevo'];
  $NuevaFecha = $_POST['FechaPadecimientoNueva'];

  $IDPer = ObtencionDatoNuevo($_SESSION['numtrareg'],"empleados", "Num_Emple","ID_Persona");

  $NomPadec = ObtencionDato($NuevoDato,"padecimientos", "Nombre_Padecimiento",$IDPer);

  if($NuevoDato != $NomPadec){
    RegistraNomPad($IDPer,$NuevoDato,$NuevaFecha);
    echo "<script>alert('**REGISTRO DE PADECIMIENTO EXITOSO**');</script>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=ConfigPadecimientos.php'>";
  }else{
    echo "<script>alert('Nombre de padecimiento: **EXISTENTE**');</script>";
  }  

}

if(isset($_POST['btnEliminar'])){
  $DatoGuia = "";
  $DatoGuia = $_POST['Nom_a_Eliminar'];

  $IDPer = ObtencionDatoNuevo($_SESSION['numtrareg'],"empleados", "Num_Emple","ID_Persona");

  $NomCate = ObtencionDato($DatoGuia,"padecimientos", "Nombre_Padecimiento",$IDPer);

  if($DatoGuia == $NomCate){
    EliminarDato("padecimientos",$DatoGuia,"Nombre_Padecimiento",$IDPer);
    echo "<script>alert('**ELIMINACIÓN DE PADECIMIENTO EXITOSO**');</script>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=ConfigPadecimientos.php'>";
  }else{
    echo "<script>alert('Nombre de padecimiento: **NO EXISTENTE**');</script>";
  }
}

///////////////////
function AjustarTextoConf($Texto){
  $NuevoTexo = $Texto;
  //$NuevoTexo = utf8_encode($Texto);
  utf8_decode($NuevoTexo);
  return $NuevoTexo;
}
//////////////////

 //////////////////////////////////////////////////
function ListaOpciones($NombreOpcion,$Tabla){

  include("abrir_conexion_adm.php");

  $ConsultaOpcion = "SELECT $NombreOpcion FROM $Tabla";

  $dato1 = mysqli_query($conexionadm, $ConsultaOpcion) or die("Algo ha ido mal en la ConsultaOpciones a la base de datos");

  while($datos1 = mysqli_fetch_array($dato1)){
    echo "<option value='".AjustarTextoConf($datos1[$NombreOpcion])."'>".AjustarTextoConf($datos1[$NombreOpcion])."</option>";
  }

  mysqli_close($conexionadm);                                      
}


function ActuazlizarDatoPad($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$ColumnaGuia,$DatoGuia,$DatoGuia1,$ColumnaGuia1){

  //echo "<script>alert('$DatoGuia1, $ColumnaGuia1');</script>";

  include("abrir_conexion_adm.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia' AND $ColumnaGuia1 = '$DatoGuia1'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

function RegistraNomPad($IDPersona,$NombrePade, $TiempoEvol){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
  include("abrir_conexion_adm.php");

  $consulta =  "INSERT INTO padecimientos (ID_Persona,Nombre_Padecimiento, Tiempo_Evolucion) VALUES ('$IDPersona', '$NombrePade', '$TiempoEvol')";

  mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro Padecimiento de la base de datos");

  mysqli_close($conexionadm);
} 

function EliminarDato($Tabla,$DatoGuia,$ColumnaGuia,$IDPer){

  include("abrir_conexion_adm.php");

  $consulta = "DELETE FROM $Tabla WHERE $ColumnaGuia = '$DatoGuia' AND ID_Persona = '$IDPer'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

function ObtencionDato($Nombre,$Tabla, $Columna,$IdPer){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
  $ID_Optenido = "";

  include("abrir_conexion_adm.php");

  $consulta = "SELECT $Columna FROM $Tabla WHERE $Columna = '$Nombre' and ID_Persona = '$IdPer'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  while($datos = mysqli_fetch_array($dato)){
    $ID_Optenido = $datos[$Columna];
  }

  mysqli_close($conexionadm);
  return $ID_Optenido;
} 

function ObtencionDatoNuevo($Nombre,$Tabla, $Columna,$ColumaDatoOptener){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
  $ID_Optenido = "";

  include("abrir_conexion_adm.php");

  $consulta = "SELECT $ColumaDatoOptener FROM $Tabla WHERE $Columna = '$Nombre'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  while($datos = mysqli_fetch_array($dato)){
    $ID_Optenido = $datos[$ColumaDatoOptener];
  }

  mysqli_close($conexionadm);
  return $ID_Optenido;
}  
?>