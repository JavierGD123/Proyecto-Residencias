<?php
  session_start();
  if(!isset($_SESSION['iduserreg'])){
  header("location:index.html");
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>ConfigUsuarios</title>
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
      <a class="navbar-brand" >Configuración</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkupConfigCat" aria-controls="navbarNavAltMarkupConfigCat" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkupConfigCat">
        <div class="navbar-nav">
          <a class="nav-link " type="button" href="ConfigDepto.php">Contraseñas departamentos<span class="sr-only">(current)</span></a>	
          <a class="nav-link" type="button" href="ConfigCategorias.php">Categorías</a>
          <a class="nav-link" type="button" href="ConfigSituaciones.php">Situaciones</a>
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
<div  style="height: 100%; width: 70%; margin: 0 auto; margin-top: 2%;">

 <!--Sección de mofificacion de usuarios--------------------------->
      <div class="shadow p-3 mb-5 bg-white rounded"  id="SecUsuariosConf" >

          <fieldset style="margin-top: 2%;">
            <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Acrualizar" onclick="MostrarOcultar('IDSecActualizarUsu','IDSecNuevaUsu','IDEliUsu')" style="display: none;">
             
             <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Nuevo usuario" onclick="MostrarOcultar('IDSecNuevaUsu','IDSecActualizarUsu','IDEliUsu')">

             <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Eliminar usuario" onclick="MostrarOcultar('IDEliUsu','IDSecNuevaUsu','IDSecActualizarUsu')">
                  
          <legend>Usuarios</legend>

          <!--Seccion de actualizar nombre de usuarios-->
          <div class="form-row align-items-center" style="display: none;" id="IDSecActualizarUsu">
            <div class="col-auto"> 
                <form action="ConfigUsuarios.php" method="POST">
                  <div class="col-auto">  
                  <label>Usuarios</label>

                    <input type="text" id="itemcat" name="NomCatBuscar" class="form-control"  placeholder="Nombre de usuario" minlength="3" maxlength="50" list="ListaUsuarios" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,50}" required="">
                  </div>  

                  <div class="col-auto" style="margin-top: 2%;">
                    <input type="submit" name="btnBusCate" class="btn btn-primary mb-2" value="Buscar">
                  </div>
            </form>
            </div>

            <div class="col-auto" id="IDCategoriaMos" style="display: none;">
                 <form action="ConfigUsuarios.php" method="POST">
                  <div class="col-auto">
                    <label>Nuevo nombre de usuario</label>
                    <input type="text" id="txtNomCatNuevo" name="NomCatActualizada" class="form-control"  placeholder="Nombre de usuario" minlength="3" maxlength="50" list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,50}" required="">

                  </div>

                  <div class="col-auto" style="margin-top: 2%;">
                        <input type="submit" name="btnActualizarCat" class="btn btn-primary mb-2" value="Actualizar">
                  </div>
                 </form>  
            </div>
          </div>
          <!--Fin Seccion de actualizar nombre de usuarios-->

          <!--Seccion de nuevo nombre de usuarios-->
          <div class="form-row align-items-center"  id="IDSecNuevaUsu" style="">
            <div class="col-auto">
                 <form action="ConfigUsuarios.php" method="POST">

                  <div class="col-auto" style="margin-top: 2%;">
                    <label for="exampleFormControlFile1">Número de trabajador</label>
                    <input id="" type="text" name="NumeroEmpleado" class="form-control"  placeholder="Ejemplo: 46" minlength="1"maxlength="5" pattern="[0-9]{1,5}" title="¡Solo números!" required=""> 
                  </div>

                  <div class="col-auto">
                    <label>Nombre de usuario</label>
                    <input type="text" id="txtNomCatNuevo" name="NomUserNew" class="form-control"  placeholder="Nombre de usuario" minlength="3" maxlength="50" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,50}" required="">
                  </div>

                   
                  <div class="col-auto">
                    <label>Contraseña</label>
                    <input type="password" name="PwUserNew" class="form-control" id="txtPassworNewUser" minlength="8" maxlength="15" placeholder="Contraseña" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{8,15}" title="Ingresa una contraseña válida (De entre 8 a 15 caracteres), ¡Solo letras, espacios, guiones y números!" value="" required>

                    <p></p>
                    <div style="width: 100%;" align="center">
                      <button  id="show_password" class="btn btn-primary" type="button" onclick="MostrarPassworNewUser()"> <span class="fa fa-eye-slash icon"></span> </button>
                      <label>Mostrar/Ocultar contraseña</label>
                    </div> 
                  </div>

                  <!--
                  <div class="col-auto">
                    <label>Tipo de usuario</label>
                      <select class="form-control" id="item" required="">
                        <option value="1">Admin</option>
                        <option value="2">Normal</option> 
                           
                      </select>  
                  </div>
                -->

                  <div class="col-auto" style="margin-top: 2%;">
                        <input type="submit" name="btnNuevaCat" class="btn btn-primary mb-2" value="Agregar">
                  </div>
                 </form>  
            </div>
          </div>
          <!--Fin Seccion de nuevo nombre de usuarios-->

          <!--Seccion de aliminar nombre de usuarios-->
          <div class="form-row align-items-center" id="IDEliUsu" style="display: none;">
            <div class="col-auto">
                 <form action="ConfigUsuarios.php" method="POST">
                  <div class="col-auto">
                    <label>Nombre del usuario a eliminar</label>

                    <input type="text" id="txtNomCatNuevo" name="Nom_a_Eliminar" class="form-control"  placeholder="Nombre de usuario" minlength="3" maxlength="50" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,50}" required="" list="ListaUsuarios">
                  </div>

                  <div class="col-auto" style="margin-top: 2%;">
                        <input type="submit" name="btnEliminar" class="btn btn-primary mb-2" value="Eliminar">
                  </div>
                 </form>  
            </div>
          </div>
          <!--Fin Seccion de eliminar nombre de usuarios-->

          <?php 
         
            if(isset($_POST['btnBusCate'])){

              $DatoBuscar = $_POST['NomCatBuscar'];

              $_SESSION['NomDeotoGuia'] = $DatoBuscar;


              //echo "<script>alert('$NomDeptoGuia');</script>";
              
              //include("EncriptarDesencriptar.php");
        

              //$DatoGuia,$Tabla, $ColumnaGuia,$ColumnaDatoOptener
              //$ClaveCifrada = ObtenciondeUnDato($DatoBuscar,"departamentos","Nombre_Depto", "Contra_Depto");

              $Clave = $_SESSION['NomDeotoGuia'];

               echo "
              <script> 
              var contenedor = document.getElementById('IDCategoriaMos');
                  contenedor.style.display = 'block';

              document.getElementById('txtNomCatNuevo').value =  '$Clave';

              </script>";
              
          }

          if(isset($_POST['btnActualizarCat'])){

             // $NuevoDato = $_POST['NomCatActualizada'];

             //echo "<script>alert('$NuvaContra,".$_SESSION['NomDeotoGuia']." ');</script>";
              
           //   ActuazlizarDato($NuevoDato,"departamentos", "Contra_Depto",$_SESSION['NomDeotoGuia'],"Nombre_Depto");
          }

          if(isset($_POST['btnNuevaCat'])){

              $NumEmpAsignar = $_POST['NumeroEmpleado'];
              $NomUser = $_POST['NomUserNew'];       

              $NumEmpExis = ObtencionDato($NumEmpAsignar,"empleados","Num_Emple");

              //echo "<script>alert('$ID_EmpladoAsignar,$ID_EmpAsg');</script>";

              if($NumEmpAsignar == $NumEmpExis){

                  $ID_NumEmpExis = ObtencionDatoNuevo($NumEmpAsignar,"empleados","Num_Emple","ID_Empleado");

                  $ID_NumEmple = ObtencionDato($ID_NumEmpExis,"usuarios","ID_Empleado");

                  if($ID_NumEmpExis != $ID_NumEmple){

                    $NomUserExis = ObtencionDato($ID_NumEmpExis,"usuarios","Nom_Usuario");    

                     if($NomUser != $NomUserExis){
                        include("EncriptarDesencriptar.php");

                         $PW = ED::Encriptar($_POST['PwUserNew']); 
                        
                         RegistarDato($ID_NumEmpExis,$NomUser,"Normal",$PW);
                        
                         echo "<script>alert('**REGISTRO DE USUARIO EXITOSO**');</script>";
                     }else{
                         echo "<script>alert('Nombre de usuario: **EXISTENTE**');</script>";
                     }                      
                  }else{
                    echo "<script>alert('El número de trabajador $NumEmpAsignar tiene un usuario ya: **EXISTENTE**');</script>";  
                  } 
              }else{
                 echo "<script>alert('Número de trabajador $NumEmpAsignar: **NO EXISTENTE**');</script>";
              }      
          }

          if(isset($_POST['btnEliminar'])){

              $DatoGuia = $_POST['Nom_a_Eliminar'];

              $NomUserExis = ObtencionDato($DatoGuia,"usuarios","Nom_Usuario"); 

              if($DatoGuia == $NomUserExis){
                EliminarDato("usuarios",$DatoGuia,"Nom_Usuario");
                echo "<script>alert('**ELIMINACION DE USUARIO EXITOSO**');</script>";
              }else{
                echo "<script>alert('Nombre de usuario: **NO EXISTENTE**');</script>";
              }        
             
          }

          ?>  
        </fieldset>
      </div>  
       <!--Fin Sección de mofificacion de usuarios--------------------------->

</div>

<!--Lista Usuarios-------------------------------------------------->
<datalist id="ListaUsuarios">
  <?php ListaOpcionesConf("Nom_Usuario","usuarios");?>
</datalist>
<!---------------------------------------------------------------------------->
</body>
</html>

<script type="text/javascript">
	
	//////////////////////////////////////////////////////////////////

function MostrarOcultar(IDMostrar,ID1,ID2){
        var contenedor = document.getElementById(IDMostrar);
          contenedor.style.display = "block";

          document.getElementById(ID1).style.display = "none";
          document.getElementById(ID2).style.display = "none";
        
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
</script>

<?php

//////////////////////////////////////////////////
function ListaOpcionesConf($NombreOpcion,$Tabla){
    include("abrir_conexion_adm.php");

    $ConsultaOpcion = "SELECT $NombreOpcion FROM $Tabla";

    $dato1 = mysqli_query($conexionadm, $ConsultaOpcion) or die("Algo ha ido mal en la Consulta Opciones a la base de datos");

        while($datos1 = mysqli_fetch_array($dato1)){
          echo "<option value='".AjustarTextoConf($datos1[$NombreOpcion])."'>".AjustarTextoConf($datos1[$NombreOpcion])."</option>";
        }

    mysqli_close($conexionadm);                                      
}
//////////////////////////////////////////////////

function RegistarDato($ID_EmpladoAsignar,$NomUser,$TipoUser,$PW){
     include("abrir_conexion_adm.php");

     $consulta =  "INSERT INTO usuarios (ID_Empleado,Nom_Usuario,Tipo_Usuario,Password) VALUES ('$ID_EmpladoAsignar','$NomUser','$TipoUser','$PW')";

       mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro a la tabla Usuarios de la base de datos");

     mysqli_close($conexionadm);
}

function EliminarDato($Tabla,$DatoGuia,$ColumnaGuia){
       
    include("abrir_conexion_adm.php");

    $consulta = "DELETE FROM $Tabla WHERE $ColumnaGuia = '$DatoGuia'";
           
    $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

    mysqli_close($conexionadm);
  }
///////////////////
function AjustarTextoConf($Texto){
  $NuevoTexo = $Texto;
  //$NuevoTexo = utf8_encode($Texto);
  utf8_decode($NuevoTexo);
  return $NuevoTexo;
}
//////////////////

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

  function ObtencionDatoNuevo($Nombre,$Tabla, $Columna,$ColumnaObtener){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
    $ID_Optenido = "";

    include("abrir_conexion_adm.php");

    $consulta = "SELECT $ColumnaObtener FROM $Tabla WHERE $Columna = '$Nombre'";
           
    $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $ID_Optenido = $datos[$ColumnaObtener];
    }

    mysqli_close($conexionadm);

    return $ID_Optenido;
  }
?>