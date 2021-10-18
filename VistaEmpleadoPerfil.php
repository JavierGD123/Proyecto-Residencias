<?php
session_start();
if(!isset($_SESSION['iduserregperfil'])){
  $_SESSION = array();
  session_destroy();
  header("location:index.html");
}

$numtrareg = $_SESSION ['numtrareg'];

ObtenerDatos();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>  </title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <script type="text/javascript" src="js/MostrarContra.js"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Menu.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->    

  <div class="container-fluid" style="background: #2E4053;">
    <div class="container-sm">
      <img src="img/Logo.PNG" class="img-fluid" alt="Responsive image">
    </div>
  </div>

  <!--Barra de navegacioón general-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><h3>USUARIO</h3></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <form action="VistaEmpleadoPerfil.php" method="POST">
          <button class="btn btn-info" type="submit" name="btnCerrarSesion" >Cerrar sesión</button>
          <!-- <button type="submit" name="btnCerrarSesion" class="btn btn-info">Cerrar sesión</button> -->
        </form>        
        <!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
      </div>
    </div>
  </nav>


</head>
<body style="background:#f2f1f1;" >

  <!-- jQuery first, then Tether, then Bootstrap JS. -->
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>

  <header id="main-header">

  </header>

  <div class="col-auto" style="height: auto; width: 100%; margin: 0 auto; margin-top: 2%;">
    <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
      <fieldset  style="height: 400px; overflow: scroll;">

       <div class="col-auto">
        <img style="width:   128px; height: 128px;" src="<?php echo $_SESSION['Link_Foto'];?>">
      </div>

      <div class="col-auto">
       <h4><?php echo $_SESSION['NombreC']; ?></h4>
     </div>

     <?php MostrarInformacion();?>

   </fieldset>
 </div>
</div>

<?php  
if(isset($_POST['btnCerrarSesion'])){
  $_SESSION = array();
  session_destroy();
  echo "<script>location.href = 'index.html';</script>";
}
?>

<div class="col-auto" id="ID_EditarDUC" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
  <a name="SDUSER"></a>
  <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
    <fieldset>
      <div class="form-row align-items-center">
        <form action="VistaEmpleadoPerfil.php" method="POST">
          <div class="col-auto" style="margin-top: 2%;">
            <legend>EDITAR DATOS DE USUARIO Y CONTRASEÑA</legend>
            <label for="exampleFormControlFile1">Nombre de usuario</label>
            <input type="text" id="" name="Nom_usu" class="form-control" placeholder="Nombre de usuario" type="Password" minlength="8" maxlength="45" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{2,48}" title="Escribe un usuario valido" value="<?php echo $_SESSION['Nom_Usuario'];?>"  required>
          </div>

          <div class="col-auto" style="margin-top: 2%;">
            <label for="exampleInputPassword1">Contraseña</label>
            <input type="password" name="Contra_usu" class="form-control" id="txtPassword" minlength="8" maxlength="15" placeholder="Contraseña" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{8,15}"title="Ingresa una contraseña válida (De entre 8 a 15 caracteres), ¡Solo letras, espacios, guiones y números!" value="<?php echo ED::Desencritar($_SESSION['Password']);?>"  required>
          </div>

          <br>

          <div style="width: 100%;" align="center">
            <button  id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
            <label>Mostrar/Ocultar contraseña</label>
          </div>

          <button type="submit" name="btnActualizarUser" class="btn btn-primary">Actualizar</button>
        </form>
      </div>    

    </fieldset>
  </div>
</div>

<div class="col-auto" id="ID_EditarDCD" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
  <a name="SDCD"></a>
  <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
    <fieldset>       
      <legend>EDITAR DATOS DE CONTACTO Y DIRECCIÓN</legend>
      <div class="form-row align-items-center">
        <form action="VistaEmpleadoPerfil.php" method="POST">

          <div class="col-auto" style="margin-top: 2%;">
            <label for="exampleFormControlFile1">Número de telefono</label>
            <input type="text" id="" name="NumTelefonEmpleado" class="form-control"  placeholder="Ejemplo: 7532369845" minlength="10" maxlength="10" title="Ingresa un número de telefono (De 10 digitos), ¡Solo numeros!" pattern="[0-9]{10,10}" value="<?php echo $_SESSION['Num_Telefono'];?>">
          </div>



          <div class="col-auto" style="margin-top: 2%;">
            <label for="exampleFormControlFile1">Número de celular</label>
            <input type="text" id="" name="NumCelularEmpleado" class="form-control"  placeholder="Ejemplo: 7538360915" minlength="10" maxlength="10" title="Ingresa un número de celular (De 10 digitos), ¡Solo numeros!" pattern="[0-9]{10,10}" value="<?php echo $_SESSION['Num_Celular'];?>">
          </div>

          <div class="col-auto" style="margin-top: 2%;">
            <label for="exampleFormControlFile1">Correo eléctronico</label>
            <input type="email" id="" name="CoreoEmpleado" class="form-control"  placeholder="ejemplo2020@hotmail.com" minlength="8" maxlength="40" title="Ingresa un correo electronico, ¡ejemplo2020@hotmail.com!" value="<?php echo $_SESSION['Correo'];?>">
          </div>

          <div class="col-auto" style="margin-top: 2%;">
           <label for="exampleFormControlFile1">Dirección</label>
           <input type="textarea" id="" name="DireccionE" class="form-control"  placeholder="Ejemplo: Col.Aserradero, Calle: Ario, Numero: 213" minlength="5" maxlength="100" title="Ingresa una dirección" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ-0-9 ]{5,100}" value="<?php echo $_SESSION['Direccion'];?>" required> 
         </div>

         <br>
         <button type="submit" name="btnActualizarDCYD" class="btn btn-primary">Actualizar</button>
       </form>

     </div>           

   </fieldset>
 </div>
</div> 

</body>
</html>

<script type="text/javascript">

  function EditarDUSER(){
    document.getElementById("ID_EditarDUC").style.display = "block";
    document.getElementById("ID_EditarDCD").style.display = "none";
  }

  function EditarDContactos(){
    document.getElementById("ID_EditarDCD").style.display = "block";
    document.getElementById("ID_EditarDUC").style.display = "none";
  }

  function mostrarPassword(){
    var cambio = document.getElementById("txtPassword");
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

  if(isset($_POST['btnActualizarUser'])){

   $NomUser = $_POST['Nom_usu'];
   $ContraUser = $_POST['Contra_usu'];

   $Actualizo = 0;
   
   if ($_SESSION['Nom_Usuario'] != $NomUser){
    ActuazlizarDatoUser($NomUser,"usuarios", "Nom_Usuario",$_SESSION['iduserregperfil'],"ID_Empleado");
    $Actualizo++;
  }

  if ($_SESSION['Password'] != $ContraUser){
    $NuvaContra = ED::Encriptar($ContraUser);     
    ActuazlizarDatoUser($NuvaContra,"usuarios", "Password",$_SESSION['iduserregperfil'],"ID_Empleado");
    $Actualizo++;
  }

  if($Actualizo != 0){
    echo "<script>alert('Acualización realizada');</script>";
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoPerfil.php'>";
  }
  echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoPerfil.php'>";
}


if(isset($_POST['btnActualizarDCYD'])){

 $NumTel = $_POST['NumTelefonEmpleado'];
 $NumCel = $_POST['NumCelularEmpleado'];
 $Email = $_POST['CoreoEmpleado'];
 $Direc = $_POST['DireccionE'];

 $Actualizo = 0;

 $ID_PersonaExis = ObtencionDato($_SESSION['numtrareg'],"empleados","Num_Emple","ID_Persona");

 if ($_SESSION['Num_Telefono'] != $NumTel ){

  ActuazlizarDato($NumTel,"contactos","Num_Telefono",$ID_PersonaExis,"ID_Persona");
  $Actualizo++;
}

if ($_SESSION['Num_Celular'] != $NumCel){

  ActuazlizarDato($NumCel,"contactos","Num_Celular",$ID_PersonaExis,"ID_Persona");
  $Actualizo++;
}

if ($_SESSION['Correo'] != $Email){

  ActuazlizarDato($Email,"contactos","Correo",$ID_PersonaExis,"ID_Persona");
  $Actualizo++;
}

if ($_SESSION['Direccion'] != $Direc ){

  ActuazlizarDato($Direc,"personas","Direccion",$ID_PersonaExis,"ID_Persona");
  $Actualizo++;
} 

if($Actualizo != 0){
  echo "<script>alert('Acualización realizada');</script>";
  echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoPerfil.php'>";
}
echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoPerfil.php'>";

}

function CalcularDias($Tiempo){
  $date1 = new DateTime($Tiempo);
  $hoy = date("yy-m-d");
  $date2 = new DateTime($hoy);
  $diff = $date1->diff($date2);
  // will output 2 days
  $dias = $diff->days;

  return $dias; 
} 


function ObtenerDatos(){
  include("abrir_conexion_emp.php");
  $numtrareg = $_SESSION['numtrareg'];
  
  $ID_Persona = "";
  $ID_Cat = "";
  $ID_CatCubreTemp = "";
  $ID_Dep = "";
  $ID_Sit = "";

  // 2) Preparar la orden SQL
  //$consulta= "SELECT* FROM Empleados WHERE Num_Emple = '$numtrareg'";
  $consulta = "SELECT * FROM empleados WHERE Num_Emple = '$numtrareg'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $ID_Persona =  $fila ['ID_Persona'];
    $ID_Cat =  $fila ['ID_Categoria'];
    $ID_CatCubreTemp =  $fila ['Cubre_Temp_Def'];
    $ID_Dep =  $fila ['ID_Departamento'];
    $ID_Sit =  $fila ['ID_Situacion'];

    $_SESSION['Num_Emple']= $fila ['Num_Emple'];
    $_SESSION['Salario']= $fila ['Salario'];
    $_SESSION['Rama'] = $fila ['Rama'];
    $_SESSION['Fech_Ingre_Ayunt']= $fila ['Fech_Ingre_Ayunt'];
    $_SESSION['Fecha_Ingre_Sind']= $fila ['Fecha_Ingre_Sind'];
    $_SESSION['Fecha_Ingre_Dep']= $fila ['Fecha_Ingre_Dep'];
    $_SESSION['Fecha_Asig_Cat']= $fila ['Fecha_Asig_Cat'];
    $_SESSION['Cubre_Fam_Temp']= $fila ['Cubre_Fam_Temp'];
   // $_SESSION['Cubre_Temp_Def']= $fila ['Cubre_Temp_Def'];
    $_SESSION['Observaciones']= $fila ['Observaciones'];
  }

  //Datos de id categoria para cubre temporal
  $consulta = "SELECT Nombre_Categoria FROM categorias WHERE ID_Categoria = '$ID_CatCubreTemp'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Cubre_Temp_Def']= $fila ['Nombre_Categoria'];
  }

  //Datos personales
  $consulta = "SELECT * FROM personas WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $ID_Persona =  $fila ['ID_Persona'];

    $_SESSION['NombreC']= $fila ['Nombre'] . " ". $fila ['ApellidoP'] . " " . $fila ['ApellidoM'];
    $_SESSION['Nombre']= $fila ['Nombre'];
    $_SESSION['ApellidoP']= $fila ['ApellidoP'];
    $_SESSION['ApellidoM']= $fila ['ApellidoM'];
    $_SESSION['Edad']= $fila ['Edad'];
    $_SESSION['Sexo']= $fila ['Sexo'];
    $_SESSION['Numero_IMSS']= $fila ['Numero_IMSS'];
    $_SESSION['Curp'] = $fila ['Curp'];
    $_SESSION['Rfc'] =  $fila ['Rfc'];
    $_SESSION['Direccion']= $fila ['Direccion'];
    $_SESSION['Tipo_Sangre']= $fila ['Tipo_Sangre'];
    $_SESSION['Donante']= $fila ['Donante'];
    $_SESSION['Alergias']= $fila ['Alergias'];
    $_SESSION['Link_Foto']= $fila ['Link_Foto'];
  }

  //Datos de contacto
  $consulta = "SELECT * FROM contactos WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Num_Telefono']= $fila ['Num_Telefono'];
    $_SESSION['Num_Celular']= $fila ['Num_Celular'];
    $_SESSION['Correo']= $fila ['Correo'];
  }

  //Datos de padecimientos
  $consulta = "SELECT * FROM padecimientos WHERE ID_Persona = '$ID_Persona'";

  $datos= mysqli_query($conexionadm, $consulta);

  $_SESSION['TotalPadecimientos'] = mysqli_num_rows($datos);

  $i = 1;
  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_Padecimiento'.$i]= $fila ['Nombre_Padecimiento'];
    $_SESSION['Tiempo_Evolucion'.$i]= $fila ['Tiempo_Evolucion'];
    $i = $i + 1;
  }

  $_SESSION['Talla_CamisaA'] = "";
  $_SESSION['Talla_PantalonA'] = "";
  $_SESSION['Talla_Falda'] = "";

  $_SESSION['Talla_CamisaC'] = "";
  $_SESSION['Talla_Camisola'] = "";
  $_SESSION['Talla_PantalonC'] = "";
  $_SESSION['Talla_Short'] = "";
  $_SESSION['Talla_Mandil'] = "";
  $_SESSION['Talla_Bata'] = "";
  $_SESSION['Talla_Calzado'] = "";
  $_SESSION['Tipo_Calzado'] = "";


  if($_SESSION['Rama'] == "Campo"){
  //Datos de RopaCampo
    $consulta = "SELECT * FROM ropacampo WHERE ID_Persona = '$ID_Persona'";

    $datos= mysqli_query($conexionadm, $consulta);

    while ($fila =mysqli_fetch_array($datos)){
      $_SESSION['Talla_CamisaC']= $fila ['Talla_Playera'];
      $_SESSION['Talla_Camisola']= $fila ['Talla_Camisola'];
      $_SESSION['Talla_PantalonC']= $fila ['Talla_Pantalon'];
      $_SESSION['Talla_Short']= $fila ['Short'];
      $_SESSION['Talla_Mandil']= $fila ['Mandil'];
      $_SESSION['Talla_Bata']= $fila ['Bata'];
      $_SESSION['Talla_Calzado']= $fila ['Talla_Calzado'];
      $_SESSION['Tipo_Calzado']= $fila ['Tipo_Calzado'];
    }

    echo "<script> 
    document.getElementById('IDRamaCampo').style.display = 'none';
    </script>";
  }else{
  //Datos de RopaAdministrativo
    $consulta = "SELECT * FROM ropaadministrativo WHERE ID_Persona = '$ID_Persona'";

    $datos= mysqli_query($conexionadm, $consulta);

    while ($fila =mysqli_fetch_array($datos)){
      $_SESSION['Talla_CamisaA']= $fila ['Talla_Camisa'];
      $_SESSION['Talla_PantalonA']= $fila ['Talla_Pantalon'];
      $_SESSION['Talla_Falda']= $fila ['Falda'];
    }

    echo "<script> 
    document.getElementById('IDAdministrativo').style.display = 'none';
    </script>";
  }

  //Datos de Categoria
  $consulta = "SELECT Nombre_Categoria FROM categorias WHERE ID_Categoria = '$ID_Cat'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_Categoria']= $fila ['Nombre_Categoria'];
  }

  //Datos de Departamento
  $consulta = "SELECT Nombre_Depto FROM departamentos WHERE ID_Departamento = '$ID_Dep'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_Depto']= $fila ['Nombre_Depto'];;
  }

  //Datos de Situacion
  $consulta = "SELECT Nombre_Situacion FROM situacion WHERE ID_Situacion = '$ID_Sit'";

  $datos= mysqli_query($conexionadm, $consulta);

  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_Situacion']= $fila ['Nombre_Situacion'];;
  }

//Datos de usuario
  $consulta = "SELECT Nom_Usuario, Password,Tipo_Usuario FROM empleados,usuarios WHERE Num_Emple = '$numtrareg' AND empleados.ID_Empleado = usuarios.ID_Empleado";

  $datos = mysqli_query($conexionadm, $consulta);
  $_SESSION['Nom_Usuario'] = "Sin usuario";
  $_SESSION['Password'] = "";

  while ($fila = mysqli_fetch_array($datos)){

    $_SESSION['Nom_Usuario']= $fila['Nom_Usuario'];
    $_SESSION['Password']= $fila['Password'];
    $_SESSION['TipoUser']= $fila['Tipo_Usuario'];

  }

  mysqli_close($conexionadm);

}

function ActuazlizarDato($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia){

  include("abrir_conexion_emp.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la actualización a la tabla $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

function ActuazlizarDatoUser($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia){

  include("abrir_conexion_emp.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia' and Tipo_Usuario = 'Normal'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la actualización a la tabla $Tabla de la base de datos");

  mysqli_close($conexionadm);
}


function MostrarInformacion(){

  include("EncriptarDesencriptar.php");

  //$Clave = ED::Desencritar($_SESSION['Password']);

  echo "
  <div class='table-responsive'> 
  <center>
  <table class='table table-hover'>
  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Datos personales</th>
  </tr>
  </thead>
  <tbody>

  <!-- <tr>
  <th scope='row'>Nombre</th>
  <td>".$_SESSION['NombreC']."</td>
  </tr>
  --> 

  <tr>
  <th scope='row'>Número de trabajador</th>
  <td>".$_SESSION['Num_Emple']."</td>
  </tr>

  <tr>
  <th scope='row'>Edad</th>
  <td>".$_SESSION['Edad']." años</td>
  </tr>

  <tr>
  <th scope='row'>Sexo</th>
  <td>".$_SESSION['Sexo']."</td>
  </tr>

  <tr>
  <th scope='row'>CURP</th>
  <td>".$_SESSION['Curp']."</td>
  </tr>

  <tr>
  <th scope='row'>RFC</th>
  <td>".$_SESSION['Rfc']."</td>
  </tr>

  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Seguridad e higiene</th>
  </tr>
  </thead>

  <tr>
  <th scope='row'>Número de seguridad social</th>
  <td>".$_SESSION['Numero_IMSS']."</td>
  </tr>
  ";

  if($_SESSION['Rama'] == "Campo"){
    echo "
    <tr>
    <th scope='row'>Talla camisa</th>
    <td>".$_SESSION['Talla_CamisaC']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla camisola</th>
    <td>".$_SESSION['Talla_Camisola']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla pantalon</th>
    <td>".$_SESSION['Talla_PantalonC']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla short</th>
    <td>".$_SESSION['Talla_Short']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla mandil</th>
    <td>".$_SESSION['Talla_Mandil']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla bata</th>
    <td>".$_SESSION['Talla_Bata']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla calzado</th>
    <td>".$_SESSION['Talla_Calzado']."</td>
    </tr>

    <tr>
    <th scope='row'>Tipo calzado</th>
    <td>".$_SESSION['Tipo_Calzado']."</td>
    </tr>
    ";
  }else{
    echo "
    <tr>
    <th scope='row'>Talla camisa</th>
    <td>".$_SESSION['Talla_CamisaA']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla pantalon</th>
    <td>".$_SESSION['Talla_PantalonA']."</td>
    </tr>

    <tr>
    <th scope='row'>Talla falda</th>
    <td>".$_SESSION['Talla_Falda']."</td>
    </tr>";
  }

  echo "
  <tr>
  <th scope='row'>Tipo sanguíneo</th>
  <td>".$_SESSION['Tipo_Sangre']."</td>
  </tr>

  <tr>
  <th scope='row'>Donante</th>
  <td>".$_SESSION['Donante']."</td>
  </tr>

  <tr>
  <th scope='row'>Alergias</th>
  <td>".$_SESSION['Alergias']."</td>
  </tr>

  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Padecimientos</th>
  </tr>
  </thead>

  ";

  
  for ($i=1; $i <= $_SESSION['TotalPadecimientos']; $i++){ 
    echo "              <tr>
    <th scope='row'>Padecimiento: $i</th>
    <td>".$_SESSION['Nombre_Padecimiento'.$i].", Tiempo desde que lo padece: ".$_SESSION['Tiempo_Evolucion'.$i].", padece desde ".CalcularDias($_SESSION['Tiempo_Evolucion'.$i])." días</td>
    </tr>";

  } 

  echo "
  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Datos de contacto y dirección <leable type='button' onclick='EditarDContactos()'><a href='#SDCD'>[Editar]</a></leable></th>
  </tr>
  </thead>

  <tr>
  <th scope='row'>Número de teléfono</th>
  <td>".$_SESSION['Num_Telefono']."</td>
  </tr>

  <tr>
  <th scope='row'>Número de celular</th>
  <td>".$_SESSION['Num_Celular']."</td>
  </tr>

  <tr>
  <th scope='row'>Correo electrónico</th>
  <td>".$_SESSION['Correo']."</td>
  </tr>

  <tr>
  <th scope='row'>Dirección</th>
  <td>".$_SESSION['Direccion']."</td>
  </tr>

  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Datos de escalafon</th>
  </tr>
  </thead>

  <tr>
  <th scope='row'>Salario</th>
  <td>$".$_SESSION['Salario']."</td>
  </tr>

  <tr>
  <th scope='row'>Categoría</th>
  <td>".$_SESSION['Nombre_Categoria']."</td>
  </tr>

  <tr>
  <th scope='row'>Rama</th>
  <td>".$_SESSION['Rama']."</td>
  </tr>

  <tr>
  <th scope='row'>Departamento</th>
  <td>".$_SESSION['Nombre_Depto']."</td>
  </tr>

  <tr>
  <th scope='row'>Fecha de ingreso al ayuntamiento</th>
  <td>".$_SESSION['Fech_Ingre_Ayunt']."</td>
  </tr>

  <tr>
  <th scope='row'>Fecha de ingreso al sindicato</th>
  <td>".$_SESSION['Fecha_Ingre_Sind']."</td>
  </tr><tr>

  <th scope='row'>Fecha de ingreso al departamento</th>
  <td>".$_SESSION['Fecha_Ingre_Dep']."</td>
  </tr>

  <tr>
  <th scope='row'>Fecha de asignación a la categoría</th>
  <td>".$_SESSION['Fecha_Asig_Cat']."</td>
  </tr>

  <tr>
  <th scope='row'>Situación</th>
  <td>".$_SESSION['Nombre_Situacion']."</td>
  </tr>

  <tr>
  <th scope='row'>Cubre familiar</th>
  <td>".$_SESSION['Cubre_Fam_Temp']."</td>
  </tr>

  <tr>
  <th scope='row'>Cubre temporal</th>
  <td>".$_SESSION['Cubre_Temp_Def']."</td>
  </tr>

  <tr>
  <th scope='row'>Observaciones</th>
  <td>".$_SESSION['Observaciones']."</td>
  </tr>

  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Datos de usuario <leable type='button' onclick='EditarDUSER()'><a href='#SDUSER'>[Editar]</a></leable></th>
  </tr>
  </thead>

  <tr>
  <th scope='row'>Nombre de usuario</th>
  <td>".$_SESSION['Nom_Usuario']."</td>
  </tr>

  <!--<tr>
  <th scope='row'>Contraseña</th>
  <td>".$_SESSION['Password']."</td>
  </tr>-->

  </thead>
  </tbody>
  </table>
  </center>
  </div>"; 

  
}

function ObtencionDato($Nombre,$Tabla, $Columna, $ColumnaBucar){

  $ID_Optenido = "";

  include("abrir_conexion_emp.php");

  $consulta = "SELECT $ColumnaBucar FROM $Tabla WHERE $Columna = '$Nombre'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la obtención de $ColumnaBuscar de la $Tabla de la base de datos");

  while($datos = mysqli_fetch_array($dato)){
    $ID_Optenido = $datos[$ColumnaBucar];
  }

  mysqli_close($conexionadm);

  return $ID_Optenido;
}

?>



