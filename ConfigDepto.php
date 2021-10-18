<?php
session_start();
if(!isset($_SESSION['iduserreg'])){
  header("location:index.html");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Configuracion</title>

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

  <!--Barra de navegacioón general-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Configuraciones</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
       <a class="nav-link " type="button" href="ConfigCategorias.php">Categorías<span class="sr-only">(current)</span></a>

       <a class="nav-link" type="button" href="ConfigSituaciones.php">Situaciones</a>
       <a class="nav-link" type="button" href="ConfigUsuarios.php">Usuarios</a>
       <a class="nav-link" type="button" href="VistaAdminGen.php">Salir</a>
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

  <div id="container-fluid">

    <div  style="height: 100%; width: 70%; margin: 0 auto; margin-top: 2%;">

    	<!--Seccion de confuguracion-------------------------------------------------->
<!--
actualizar contraseña
agregar nueva categoria o actualizar nombre o eliminar
Agregar, eliminar, actualizar nombre de alergia
Agregar, eliminar, actualizar nombre de padecimiento
Agregar, eliminar, actualizar nombre de situaciones
Agregar, eliminar, actualizar nombre de usuario,contra, tipo
-->   


<!-- Sección de Contras departamentos--------------------------->
<div class="shadow p-3 mb-5 bg-white rounded" style="width: 100%;" id="SecDepConf">
  <fieldset style="margin-top: 2%;">

    <legend>Contraseña de los departamentos</legend>


    <div class="form-row align-items-center">

      <div class="col-auto"> 
        <form action="ConfigDepto.php" method="POST">
          <div class="col-auto">  
            <label>Departamento</label>
            <input type="text" id="itemcat" name="NomDeptoBus" class="form-control"  placeholder="Nombre del departamento" minlength="3" maxlength="30" list="ListaDepartamentos" title="Ingresa un nombre válido (De entre 3 a 45 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,30}" required="">
          </div>  

          <div class="col-auto" style="margin-top: 2%;">
            <input type="submit" name="btnBusContraDepto" class="btn btn-primary mb-2" value="Buscar">
          </div>
        </form>
      </div>  


      <div class="col-auto" id="IDContraDepto" style="display: none;">
       <form action="ConfigDepto.php" method="POST">
        <div class="col-auto">
          <label>Contraseña</label>
          <input type="password" name="contradep" class="form-control" id="txtPassworddepto" minlength="8" maxlength="15" placeholder="Contraseña" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{8,15}" title="Ingresa una contraseña válida (De entre 8 a 15 caracteres), ¡Solo letras, espacios, guiones y números!" value="" required>

          <p></p>
          <div style="width: 100%;" align="center">
            <button  id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassworddepto()"> <span class="fa fa-eye-slash icon"></span> </button>
            <label>Mostrar/Ocultar contraseña</label>
          </div> 
        </div>

        <div class="col-auto" style="margin-top: 2%;">
          <input type="submit" name="btnActualizarContraDep" class="btn btn-primary mb-2" value="Actualizar">
        </div>
      </form>  
    </div>  

    <?php 
          //$NomDeptoGuia = "";

    if(isset($_POST['btnBusContraDepto'])){

      $DatoBuscar = $_POST['NomDeptoBus'];

      $NomCate = ObtencionDato($DatoBuscar,"departamentos", "Nombre_Depto");

      if($DatoBuscar == $NomCate){

       $_SESSION['NomDeotoGuia'] = $DatoBuscar; 

       include("EncriptarDesencriptar.php");

       $ClaveCifrada = ObtenciondeUnDato($DatoBuscar,"departamentos","Nombre_Depto", "Contra_Depto");

       $Clave = ED::Desencritar($ClaveCifrada);

       echo "
       <script> 
       document.getElementById('IDContraDepto').style.display = 'block';

       document.getElementById('txtPassworddepto').value =  '$Clave';

                      //document.getElementById(ID1).style.display = 'none';
       </script>";
     }else{
      echo "<script>alert('Nombre de departamento: **NO EXISTENTE**');</script>";
    }  
  }

  if(isset($_POST['btnActualizarContraDep'])){

    include("EncriptarDesencriptar.php");

    $NuvaContra = ED::Encriptar($_POST['contradep']);

             //echo "<script>alert('$NuvaContra,".$_SESSION['NomDeotoGuia']." ');</script>";

    ActuazlizarDato($NuvaContra,"departamentos", "Contra_Depto",$_SESSION['NomDeotoGuia'],"Nombre_Depto");
  }

  ?>      

</fieldset>

</div>
<!-- Fin Sección de Contras departamentos--------------------------->

<!---------------------------------------------------------------------------->
<!--Lista Deptartamentos-------------------------------------------------->
<datalist id="ListaDepartamentos">
 <?php ListaOpcionesConf("Nombre_Depto","departamentos");?>
</datalist>
<!---------------------------------------------------------------------------->
<!-- <a href="VistaAdminGen.php" class="btn btn-secondary"> ← Página anterior</a> -->
</div>

</div>    
</body>
</html>

<script type="text/javascript">

	//Funcion para el mostrar la contraseña para editar o actualizar/////////////////////////
  function mostrarPassworddepto(){
    var cambio = document.getElementById("txtPassworddepto");
    if(cambio.type == "password"){
      cambio.type = "text";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  }

  function MostrarPassworNewUser(){
    var cambio = document.getElementById("txtPassworNewUser");
    if(cambio.type == "password"){
      cambio.type = "text";
      $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
      cambio.type = "password";
      $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  }

  $(document).ready(function () {
      //CheckBox mostrar contraseña
      $('#ShowPassword').click(function () {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
      });
    });

//////////////////////////////////////////////////////////////////

function MostrarOcultar(IDMostrar,ID1,ID2){
  var contenedor = document.getElementById(IDMostrar);
  contenedor.style.display = "block";

  document.getElementById(ID1).style.display = "none";
  document.getElementById(ID2).style.display = "none";

}

function MostrarConfig(IDMostrar,ID1,ID2,ID3,ID4,ID5){
  var contenedor = document.getElementById(IDMostrar);
  contenedor.style.display = "block";

  document.getElementById(ID1).style.display = "none";
  document.getElementById(ID2).style.display = "none";
  document.getElementById(ID3).style.display = "none";
  document.getElementById(ID4).style.display = "none";
  document.getElementById(ID5).style.display = "none";

}

</script>
<?php

//////////////////////////////////////////////////
function ListaOpcionesConf($NombreOpcion,$Tabla){
  include("abrir_conexion_adm.php");

  $ConsultaOpcion = "SELECT $NombreOpcion FROM $Tabla";

  $dato1 = mysqli_query($conexionadm, $ConsultaOpcion) or die("Algo ha ido mal en la ConsultaOpciones a la base de datos");

  while($datos1 = mysqli_fetch_array($dato1)){
    echo "<option value='".AjustarTextoConf($datos1[$NombreOpcion])."'>".AjustarTextoConf($datos1[$NombreOpcion])."</option>";
  }

  mysqli_close($conexionadm);                                      
}
//////////////////////////////////////////////////

///////////////////
function AjustarTextoConf($Texto){
  $NuevoTexo = $Texto;
  //$NuevoTexo = utf8_encode($Texto);
  utf8_decode($NuevoTexo);
  return $NuevoTexo;
}
//////////////////

/////////////////
function ObtenciondeUnDato($DatoGuia,$Tabla, $ColumnaGuia,$ColumnaDatoOptener){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
  $ID_Optenido = "";

  include("abrir_conexion_adm.php");

  $consulta = "SELECT $ColumnaDatoOptener FROM $Tabla WHERE $ColumnaGuia = '$DatoGuia'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  while($datos = mysqli_fetch_array($dato)){
    $ID_Optenido = $datos[$ColumnaDatoOptener];
  }

  mysqli_close($conexionadm);

  if($ID_Optenido == ""){
   $ID_Optenido = "Disponible ".$DatoGuia;
 }

 return $ID_Optenido;
}


function ActuazlizarDato($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia){

  include("abrir_conexion_adm.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

function RegistarDato($DatoNuevo,$NomColumna,$Tabla){
 include("abrir_conexion_adm.php");

 $consulta =  "INSERT INTO $Tabla ($NomColumna) VALUES ('$DatoNuevo')";

 mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro a la $Tabla de la base de datos");

 mysqli_close($conexionadm);
}

function ObtencionDato($Nombre,$Tabla, $Columna){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
  $ID_Optenido = "";

  include("abrir_conexion_adm.php");

  $consulta = "SELECT $Columna FROM $Tabla WHERE $Columna = '$Nombre'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  while($datos = mysqli_fetch_array($dato)){
    $ID_Optenido = $datos[$Columna];
  }

  mysqli_close($conexionadm);

    /*if($ID_Optenido == ""){
        $ID_Optenido = "Disponible ".$Nombre;
      }*/

      return $ID_Optenido;
    } 

    ?>