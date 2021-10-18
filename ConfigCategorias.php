<?php
  session_start();
  if(!isset($_SESSION['iduserreg'])){
  header("location:index.html");
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Categorías</title>
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
    
		<div  style="height: 100%; width: 70%; margin: 0 auto; ">

			<!--Sección de mofificacion de categorias--------------------------->
      <div class="shadow p-3 mb-5 bg-white rounded" style="" id="SecCatConf">

          <fieldset style="margin-top: 2%;">
            <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Actualizar" onclick="MostrarOcultarCat('IDSecActualizar','IDSecNuevaCat','')">
             
             <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Nueva categoría" onclick="MostrarOcultarCat('IDSecNuevaCat','IDSecActualizar','')">
                  
          <legend>Categorías</legend>

          <!--Seccion de actualizar nombre de categorias-->
          <div class="form-row align-items-center" style="" id="IDSecActualizar">
            <div class="col-auto"> 
                <form action="ConfigCategorias.php" method="POST">
                  <div class="col-auto">  
                  <label>Categoría a buscar</label>
                    <input type="text" id="itemcat" name="NomCatBuscar" class="form-control"  placeholder="Nombre de la categoría a buscar" minlength="3" maxlength="150" list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,150}" required="">
                  </div>  

                  <div class="col-auto" style="margin-top: 2%;">
                    <input type="submit" name="btnBusCate" class="btn btn-primary mb-2" value="Buscar">
                  </div>

            </form>
            </div>

            <div class="col-auto" id="IDCategoriaMos" style="display: none;">
                 <form action="ConfigCategorias.php" method="POST">
                  <div class="col-auto">
                    <label>Nuevo nombre de la categoría</label>
                    <input type="text" id="txtNomCatNuevo" name="NomCatActualizada" class="form-control"  placeholder="Nombre de la categoría" minlength="3" maxlength="150" list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,150}" required="">

                  </div>

                  <div class="col-auto" style="margin-top: 2%;">
                        <input type="submit" name="btnActualizarCat" class="btn btn-primary mb-2" value="Actualizar">
                  </div>
                 </form> 
            </div>
          </div>
          <!--Fin Seccion de actualizar nombre de categorias-->

        <!--Seccion de nuevo nombre de categoria-->
          <div class="form-row align-items-center" id="IDSecNuevaCat" style="display: none;">

            <div class="col-auto">
                 <form action="ConfigCategorias.php" method="POST">
                  <div class="col-auto">
                    <label>Nombre de la nueva categoría</label>
                    <input type="text" id="txtNomCatNuevo" name="NomNuvaCat" class="form-control"  placeholder="Nombre de la categoría" minlength="3" maxlength="150" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,150}" required="">

                  </div>

                  <div class="col-auto" style="margin-top: 2%;">
                        <input type="submit" name="btnNuevaCat" class="btn btn-primary mb-2" value="Agregar">
                  </div>
                 </form>  
            </div>
          </div>
          <!--Fin Seccion de nuevo nombre de categoria-->

          <?php 
         
            if(isset($_POST['btnBusCate'])){

              $DatoBuscar = $_POST['NomCatBuscar'];

              $NomCate = ObtencionDato($DatoBuscar,"categorias", "Nombre_Categoria");

             if($DatoBuscar == $NomCate){
                 
                $_SESSION['NomDeotoGuia'] = $DatoBuscar;

                $Clave = $_SESSION['NomDeotoGuia'];


                echo "
                <script>
                document.getElementById('IDCategoriaMos').style.display = 'block'; 
               

                document.getElementById('txtNomCatNuevo').value =  '$Clave';
                </script>";

              }else{
                echo "<script>alert('Nombre de categoría: **NO EXISTENTE**');</script>";
              }             
              
          }

          if(isset($_POST['btnActualizarCat'])){

              $NuevoDato = $_POST['NomCatActualizada'];

              $NomCate = ObtencionDato($NuevoDato,"categorias", "Nombre_Categoria");
              
              if($NuevoDato != $NomCate){
                ActuazlizarDatoCat($NuevoDato,"categorias", "Nombre_Categoria",$_SESSION['NomDeotoGuia'],"Nombre_Categoria");
                
                 ActuazlizarDatoCat($NuevoDato,"cubre_tem", "Nombre_TemCat",$_SESSION['NomDeotoGuia'],"Nombre_TemCat");
                echo "<script>alert('**ACTUALIZACIÓN EXITOSA**');</script>";
              }else{
                echo "<script>alert('Nombre de categoría: **EXISTENTE**');</script>";
              }           
              
          }

          if(isset($_POST['btnNuevaCat'])){

              $NuevoDato = $_POST['NomNuvaCat'];

              $NomCate = ObtencionDato($NuevoDato,"categorias", "Nombre_Categoria");

              if($NuevoDato != $NomCate){
                RegistarDato($NuevoDato,"Nombre_Categoria","categorias");
                RegistarDato($NuevoDato,"Nombre_TemCat ","cubre_tem");
                echo "<script>alert('**REGISTRO DE CATEGORIA EXITOSA**');</script>";
              }else{
                echo "<script>alert('Nombre de categoría: **EXISTENTE**');</script>";
              }             
              
          }

          ?>  
        </fieldset>
      </div>  
       <!--Fin Sección de mofificacion de categorias--------------------------->
		</div>
	</div>

<!--Lista Categorias-------------------------------------------------->
<datalist id="ListaCategoria">
  <?php ListaOpcionesConfCat("Nombre_Categoria","categorias");?>
</datalist>
<!---------------------------------------------------------------------------->

</body>
</html>

<script type="text/javascript">

function MostrarOcultarCat(IDMostrar,ID1,ID2){
        var contenedor = document.getElementById(IDMostrar);
          contenedor.style.display = "block";

          document.getElementById(ID1).style.display = "none";
          document.getElementById(ID2).style.display = "none";
        
}
</script>

<?php

function ListaOpcionesConfCat($NombreOpcion,$Tabla){
    include("abrir_conexion_adm.php");

    $ConsultaOpcion = "SELECT $NombreOpcion FROM $Tabla";

    $dato1 = mysqli_query($conexionadm, $ConsultaOpcion) or die("Algo ha ido mal en la ConsultaOpciones a la base de datos");

        while($datos1 = mysqli_fetch_array($dato1)){
          echo "<option value='".AjustarTextoConf($datos1[$NombreOpcion])."'>".AjustarTextoConf($datos1[$NombreOpcion])."</option>";
        }

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

function ActuazlizarDatoCat($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia){
       
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