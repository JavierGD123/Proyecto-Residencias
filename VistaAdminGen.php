
<?php
/*
Actualizar en la nube
La base de datos como esta en localhost

VistaAdminGen
VistaDepAdmin
DiclisSituaciones
Reporte
ConfigCategorias
*/
session_start();
if(!isset($_SESSION['iduserreg'])){
  $_SESSION = array();
  session_destroy();
  header("location:index.html");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ADMINISTRACIÓN GENERAL</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/MostrarOcultarLogin.js"></script>
  <script type="text/javascript" src="js/MostrarOcultarOjito.js"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script type="text/javascript" src="EnviarFormulario.js"></script>

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
    <a class="navbar-brand" href="#">ADMINISTRACIÓN GENERAL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link " type="button" onclick="MostrarBusDepReg('IDBuscar','IDDep','IDRegEmp')">Buscar<span class="sr-only">(current)</span></a>
        <a class="nav-link" type="button" onclick="MostrarBusDepReg('IDDep','IDBuscar','IDRegEmp')">Departamentos</a>
        <a class="nav-link" type="button" onclick="MostrarBusDepReg('IDRegEmp','IDBuscar','IDDep')">Nuevo empleado</a>
        <a class="nav-link" type="button" href="ConfigDepto.php">Configuración</a>

        <form action="VistaAdminGen.php" method="POST">
          <button class="btn btn-info" type="submit" name="btnCerrarSesion" >Cerrar sesión</button>
          <!-- <button type="submit" name="btnCerrarSesion" class="btn btn-info">Cerrar sesión</button> -->
        </form>        
        <!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
      </div>
    </div>
  </nav>

  <?php  
  if(isset($_POST['btnCerrarSesion'])){
    $_SESSION = array();
    session_destroy();
    echo "<script>location.href = 'index.html';</script>";
  }
  ?>

  <div style="background:#f2f1f1;"><h2 style=""></h2></div>

</head>
<body style="background:#f2f1f1;">
  <!-- jQuery first, then Tether, then Bootstrap JS. -->
  <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"> </script>

  <!----------------------------------------------------------->
  
  <div id="container-fluid">


    <div  style="height: 100%; width: 93%; margin: 0 auto; ">

    <!--
      <div class="shadow-none p-3 mb-5 bg-light rounded">No shadow</div>
      <div class="shadow-sm p-3 mb-5 bg-white rounded">Small shadow</div>
      <div class="shadow p-3 mb-5 bg-white rounded">Regular shadow</div>
      <div class="shadow-lg p-3 mb-5 bg-white rounded">Larger shadow</div>
    -->

    <!-- Sección de buscar---------------------------> 
    <div class="shadow p-3 mb-5 bg-white rounded" id="IDBuscar">
      <fieldset >
        <legend>Buscar</legend>

        <div class="form-row align-items-center">

          <div class="col-auto" style="margin-top: 2%;">
            <label>Filtro de busqueda</label>
            <select class="form-control" id="item" required="">
                <!--<option value="0" selected>Filtra de busqueda</option>
                  <optgroup label="..."> -->
                   <option value="1">Número de trabajador</option> 
                   <option value="2">Departamento</option> 
           <!--</optgroup> 
             <optgroup label="..."> -->
               <option value="3">Categoría</option>
               <option value="9">Situación</option>  
               <option value="4">Fech_Ing_Ayun</option>
               <option value="5">Fech_Ing_Sind</option>
               <option value="6">Fech_Ing_Dep</option>
               <option value="7">Fech_Asig_Cat</option>
               <option value="8">Escalafon</option>
               <!--</optgroup> -->    
             </select>  
           </div>

           <div class="col-auto" id="IDNumTraBus" style="margin-top: 2%;" >
            <form action="VistaAdminGen.php" method="POST">
              <div class="form-row align-items-center">

                <div class="col-auto">
                  <label>Número de empleado</label>
                  <input id="idbuscar" type="text" name="numemp" class="form-control mr-sm-2"  placeholder="Número de trabajador" aria-label="Search" minlength="1"maxlength="8" pattern="[0-9]{1,8}" title="¡Solo números!" required="">
                </div>  

                <div class="col-auto" style="margin-top: 2%;">
                  <input type="submit" name="btnBusNumTra" class="btn btn-primary mb-2" value="Buscar">
                </div>

              </div>    
            </form>     
          </div>


          <div class="col-auto" id="IDDepBus" style="margin-top: 2%; display: none;" >
            <form action="VistaAdminGen.php" method="POST">
              <div class="form-row align-items-center">

                <div class="col-auto">
                  <label>Departamento</label>
                  <select class="form-control" id="itemdep" name="nomdep" required="">
                    <?php ListaOpciones("Nombre_Depto","departamentos");?>  
                  </select>
                </div>  

                <div class="col-auto" style="margin-top: 2%;">
                  <input type="submit" name="btnBusDepTra" class="btn btn-primary mb-2" value="Buscar">
                </div>

              </div>    
            </form>     
          </div> 


          <div class="col-auto" id="IDCatBus" style="margin-top: 2%; display: none;" >
            <form action="VistaAdminGen.php" method="POST">
              <div class="form-row align-items-center">

                <div class="col-auto">
                  <label>Categoría</label>
                  <input type="text" id="itemcat" name="nomcat" class="form-control"  placeholder="Nombre de la categoría" minlength="3" maxlength="100" list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,100}" required="">
                </div>  

                <div class="col-auto" style="margin-top: 2%;">
                  <input type="submit" name="btnBusCatTra" class="btn btn-primary mb-2" value="Buscar">
                </div>

              </div>    
            </form>     
          </div>

          <div class="col-auto" id="IDSitBus" style="margin-top: 2%; display: none;" >
            <form action="VistaAdminGen.php" method="POST">
              <div class="form-row align-items-center">

                <div class="col-auto" style="margin-top: 2%;">
                  <label for="exampleFormControlFile1">Situación</label>
                  <input type="text" id="itemsit" name="nomsit" class="form-control"  placeholder="Ejemplo: Becado, Fallecido" list="ListaSituacion" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ ]{3,50}" value="" required>
                </div>

                <datalist id="ListaSituacion">
                  <?php ListaOpciones("Nombre_Situacion","situacion");?> 
                </datalist>

                <div class="col-auto" style="margin-top: 2%;">
                  <input type="submit" name="btnBusSitTra" class="btn btn-primary mb-2" value="Buscar">
                </div>

              </div>    
            </form>     
          </div>

          <div class="col-auto" id="IDFISBus" style="margin-top: 2%; display: none;" >
            <form action="VistaAdminGen.php" method="POST">
              <div class="form-row align-items-center">

                <div class="col-auto">
                  <label>Fech_Ing_Sind Inicial</label>
                  <input id="fecha" type="date" class="form-control" name="FechaISI" value="Fecha de ingreso" required="">
                </div> 

                <div class="col-auto">
                  <label>Fech_Ing_Sind Final</label>
                  <input id="fecha" type="date" class="form-control" name="FechaISF" value="Fecha de ingreso" required="">
                </div>  

                <div class="col-auto" style="margin-top: 2%;">
                  <input type="submit" name="btnBusFISTra" class="btn btn-primary mb-2" value="Buscar">
                </div>

              </div>    
            </form>     
          </div>

          <div class="col-auto" id="IDFIABus" style="margin-top: 2%; display: none;" >
            <form action="VistaAdminGen.php" method="POST">
              <div class="form-row align-items-center">

                <div class="col-auto">
                 <label>Fech_Ing_Ayun Inicial</label>
                 <input id="fecha" type="date" class="form-control" name="FechaIAI" value="Fecha de ingreso" min="01/01/1900" max="31/12/2030" required="">
               </div> 

               <div class="col-auto">
                 <label>Fech_Ing_Ayun Final</label>
                 <input id="fecha" type="date" class="form-control" name="FechaIAF" value="Fecha de ingreso" min="01/01/1900" max="31/12/2030" required="">
               </div>  

               <div class="col-auto" style="margin-top: 2%;">
                <input type="submit" name="btnBusFIATra" class="btn btn-primary mb-2" value="Buscar">
              </div>

            </div>    
          </form>     
        </div>

        <div class="col-auto" id="IDFIDBus" style="margin-top: 2%; display: none;" >
          <form action="VistaAdminGen.php" method="POST">
            <div class="form-row align-items-center">

              <div class="col-auto">
               <label>Fech_Ing_Dep Inicial</label>
               <input id="fecha" type="date" class="form-control" name="FechaIDI" value="Fecha de ingreso" min="01/01/1900" max="31/12/2030" required="">
             </div>  

             <div class="col-auto">
               <label>Fech_Ing_Dep Final</label>
               <input id="fecha" type="date" class="form-control" name="FechaIDF" value="Fecha de ingreso" min="01/01/1900" max="31/12/2030" required="">
             </div>  

             <div class="col-auto" style="margin-top: 2%;">
              <input type="submit" name="btnBusFIDTra" class="btn btn-primary mb-2" value="Buscar">
            </div>

          </div>    
        </form>     
      </div>

      <div class="col-auto" id="IDFICBus" style="margin-top: 2%; display: none;" >
        <form action="VistaAdminGen.php" method="POST">
          <div class="form-row align-items-center">

            <div class="col-auto">
              <label>Fech_Asig_Cat Incial</label>
              <input id="fecha" type="date" class="form-control" name="FechaICI" value="Fecha de ingreso" min="01/01/1900" max="31/12/2030" required="">
            </div> 

            <div class="col-auto">
              <label>Fech_Asig_Cat Final</label>
              <input id="fecha" type="date" class="form-control" name="FechaICF" value="Fecha de ingreso" min="01/01/1900" max="31/12/2030" required="">
            </div>  

            <div class="col-auto" style="margin-top: 2%;">
              <input type="submit" name="btnBusFICTra" class="btn btn-primary mb-2" value="Buscar">
            </div>

          </div>    
        </form>     
      </div>

    </div>
  </fieldset>

  <!-- Sección de resultados---------------------------> 
  <div class="shadow p-3 mb-5 bg-white rounded" style="margin-top: 3%;">
    <fieldset>

      <!-- Sección de resultados por numero de empleado--------------------------->       
      <div id="IDNumEmpRes" style="display: none; ">

          <?php // 
          if(isset($_POST['btnBusNumTra'])){

            $DatoBuscar = $_POST['numemp'];

            echo "";

            if(Consuta("Num_Emple", $DatoBuscar) == true){

              echo "<legend>
              <div class='form-row align-items-center'>
              <form >
              <div class='col-auto'>Resultados de busqueda por *Número de trabajador*</div>
              </form>

              <div class='col-auto'>
              <form action='Reporte.php' method='POST' target='_blank'>

              <input  type='number' name='NumeroEmpleadoGenFich' class='form-control'  placeholder='Ejemplo: 86' minlength='1' maxlength='5' pattern='[0-9]{1,5}' title='¡Solo números!' value='".$DatoBuscar."'  style='display: none;' required> 

              <input type='submit' name='GenFicha' class='btn btn-info' value='Generar Ficha' >

              </form>
              </div>  

              <div class='col-auto'>
              <form action='pdfcredencial.php' method='POST' target='_blank'>

              <input type='number' name='NumeroEmpleadoGenCre' class='form-control'  placeholder='Ejemplo: 86' minlength='1'maxlength='5' pattern='[0-9]{1,5}' title='¡Solo números!' value='".$DatoBuscar."'  style='display: none;' required> 

              <input type='submit' name='GenCrede' class='btn btn-info' value='Generar credencial' >

              </form>
              </div>
              </div>
              </legend>
              ";

              echo "
              <script> 
              var contenedor = document.getElementById('IDNumEmpRes');
              contenedor.style.display = 'block';

              </script>";
              ObtenerDatos($DatoBuscar);
              //ResultadosBusqueda(1,$DatoBuscar,"");

              //$_SESSION['numtrareg'] = $DatoBuscar;
              //$_SESSION['vistadepadmin'] = "false";
            }else{
               //NumTraEncontrado("");
              //$_SESSION['numtrareg'] = "";
              echo "<script>alert('Sin resultados');</script>";
            }
          }
          ?>
          <div class="col-auto">
            <img style="width:   128px; height: 128px;" src="<?php echo $_SESSION['Link_Foto'];?>">

            <div class="col-auto">
              <a type="button" onclick="muestra_oculta('IDCargarFoto')">Editar foto</a>
            </div>

          </div>
          
          <div class="col-auto">
            <h4><?php echo $_SESSION['NombreC']; ?></h4>
          </div>

          <div id="IDCargarFoto" style="display: none;">
            <form method="POST" action="" enctype="multipart/form-data">
              <input type="file" name="imagen" accept=".jpg,.jpeg">
              <input type="submit" name="subir" class="btn btn-info" value="Subir Foto">
            </form>
          </div>

          <?php MostrarInformacion();?>


          <!-- SECCION DE EDICIONDE DATOS PERSONALES -->
          <div class="col-auto" id="IDDatosPersonales" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
            <a name="SDP"></a>
            <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
              <fieldset>
                <legend>EDITAR DATOS PERSONALES</legend>
                <div class="form-row align-items-center">
                  <form action="VistaAdminGen.php" method="POST">

                    <div class="col-auto"  style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Nombre</label>
                      <input type="text" id="" name="NombreEmpleado" class="form-control"  placeholder="Ejemplo: Pedro" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{3,30}"title="Ingresa un nombre válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" value="<?php echo $_SESSION['Nombre'];?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Primer apellido</label>
                      <input type="text" id="" name="ApellidoPEmpleado" class="form-control"  placeholder="Ejemplo: Rodriguez" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{2,30}"title="Ingresa un apellido válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" value="<?php echo $_SESSION['ApellidoP'];?>"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Segundo apellido</label>
                      <input type="text" id="" name="ApellidoMEmpleado" class="form-control"  placeholder="Ejemplo: Díaz" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{2,30}" title="Ingresa un apellido válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" value="<?php echo $_SESSION['ApellidoM'];?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Edad</label>
                      <input type="text" id="" name="Edadmpleado" class="form-control"  placeholder="Ejemplo: 45" minlength="1" maxlength="3" title="Ingresa una edad, ¡Solo numeros!" pattern="[0-9]{1,3}" value="<?php echo $_SESSION['Edad'];?>" required>
                    </div>


                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Sexo: <strong><?php //echo $_SESSION['Sexo'];?></strong></label>
                      <select class="form-control" id="Tiposexo" name="TipoSexo">
                        <?php if ($_SESSION['Sexo'] == "H") {?>     
                          <option value="H" selected>Hombre</option>
                          <option value="M">Mujer</option>  
                        <?php } else {  ?>
                          <option value="H" >Hombre</option>
                          <option value="M" selected>Mujer</option> 
                        <?php } ?>    
                      </select>        
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">CURP</label>
                      <input type="text" id="" name="NumCURP" class="form-control"  placeholder="Ejemplo: GADJ980623HMNRZV08" minlength="1" maxlength="18" title="Ingresa una CURP valida), ¡Solo letras y números!" pattern="[A-Za-z0-9]{18,18}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $_SESSION['Curp'];?>" >
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">RFC</label>
                      <input type="text" id="" name="NumRFC" class="form-control"  placeholder="Ejemplo: GADJ980623LH7" minlength="1" maxlength="13" title="Ingresa un número de seuro valido), ¡Solo letras y números!" pattern="[A-Za-z0-9]{12,13}" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?php echo $_SESSION['Rfc'];?>">
                    </div>

                    <br>
                    <button type="submit" name="btnActualizarDPersonales" class="btn btn-primary">Actualizar</button>
                  </form>

                </div>           

              </fieldset>
            </div>

            <?php  
            if(isset($_POST['btnActualizarDPersonales'])){

              $Nombre = $_POST['NombreEmpleado'];
              $ApellidoP = $_POST['ApellidoPEmpleado'];
              $ApellidoM = $_POST['ApellidoMEmpleado'];
              $Edad = $_POST['Edadmpleado'];
              $Sexo = $_POST['TipoSexo'];
              $NumCURP = $_POST['NumCURP'];
              $NumRFC = $_POST['NumRFC'];

              $ID_PersonaExis = ObtencionDato($_SESSION['numtrareg'],"empleados","Num_Emple","ID_Persona");

              $Actualizo = 0;

              if ($_SESSION['Nombre'] != $Nombre){
                ActuazlizarDato($Nombre,"personas", "Nombre",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['ApellidoP'] != $ApellidoP){           
                ActuazlizarDato($ApellidoP,"personas", "ApellidoP",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['ApellidoM'] != $ApellidoM){          
                ActuazlizarDato($ApellidoM,"personas", "ApellidoM",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['Edad'] != $Edad){            
                ActuazlizarDato($Edad,"personas", "Edad",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['Sexo'] != $Sexo){          
                ActuazlizarDato($Sexo,"personas", "Sexo",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['Curp'] != $NumCURP){          
                ActuazlizarDato($NumCURP,"personas", "Curp",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['Rfc'] != $NumRFC){          
                ActuazlizarDato($NumRFC,"personas", "Rfc",$ID_PersonaExis,"ID_Persona");
                $Actualizo++;
              }

              if($Actualizo != 0){
                echo "<script>alert('Acualización realizada');</script>";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
              }
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
            }
            ?>
          </div>
          <!-- FIN SECCION DE EDICIONDE DATOS PERSONALES -->


          <!-- SECCION DE EDICION DE SEGURIDAD E HIGIENE -->
          <div class="col-auto" id="IDSeH" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
            <a name="SDSH"></a>
            <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
              <fieldset>
                <div class="form-row align-items-center">
                  <form action="VistaAdminGen.php" method="POST">
                    <div class="col-auto" style="margin-top: 2%;">
                      <legend>EDITAR DATOS DE SEGURIDAD E HIGIENE</legend>

                      <div class="col-auto" style="margin-top: 2%;">
                        <label for="exampleFormControlFile1">Número de seguro social</label>
                        <input type="text" id="" name="NumIMSSE" class="form-control"  placeholder="Ejemplo: 120458245678" minlength="1" maxlength="11" title="Ingresa un numero de seuro valido), ¡Solo numeros!" pattern="[1234567890]{11,11}" value="<?php echo $_SESSION['Numero_IMSS'];?>" required="">
                      </div>

                      <?php if($_SESSION['Rama'] == "Campo"){ ?>
                        <div id="IDROPACAMPO">
                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla playera</label>
                            <input type="text" id="" name="TallaCamC" class="form-control"  placeholder="Ejemplo: XS,S,M,L,XL,XXL" minlength="1" maxlength="4" title="Ingresa un nombre válido (De entre 1 a 4 caracteres), ¡Solo tallas como XS,S,M,L,XL,XXL" pattern="[XSML]{1,4}" value="<?php echo $_SESSION['Talla_CamisaC'];?>" list="ListaTallasPlayeraCamisa">
                          </div>

                          <datalist id="ListaTallasPlayeraCamisa">
                            <option value="XS">XS</option> 
                            <option value="S">S</option> 
                            <option value="M">M</option> 
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                          </datalist>


                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla camisola</label>
                            <input type="number" id="" name="TallaCams" class="form-control"  placeholder="Ejemplo: 28 a 54" min="28" max="54" title="Ingresa una talla válida, ¡Solo tallas en numero" pattern="[0-9]{1,2}" value="<?php echo $_SESSION['Talla_Camisola'];?>" list="ListaTallasCamisola">
                          </div>  

                          <datalist id="ListaTallasCamisola">
                            <?php for ($i=28; $i <=54; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 

                            }
                            ?>
                          </datalist>

                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla pantalon</label>
                            <input type="number" id="" name="TallaPanC" class="form-control"  placeholder="Ejemplo: 5,7,9,24,30" min="5" max="64" title="Ingresa una talla válida, ¡Solo tallas en numero" pattern="[0-9]{1,2}" value="<?php echo $_SESSION['Talla_PantalonC'];?>" list="ListaTallasPantalon">
                          </div>                

                          <datalist id="ListaTallasPantalon">
                            <?php for ($i=5; $i <=29; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 
                            }

                            for ($i=28; $i <=64; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 

                            }
                            ?>
                          </datalist>

                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla short</label>
                            <input type="number" id="" name="TallaSh" class="form-control"  placeholder="Ejemplo: 28,40" min="28" max="50" title="Ingresa una talla válida, ¡Solo tallas en numero" pattern="[0-9]{1,2}" value="<?php echo $_SESSION['Talla_Short'];?>" list="ListaTallaShort">
                          </div>

                          <datalist id="ListaTallaShort">
                            <?php for ($i=28; $i <=50; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 
                            }
                            ?>  
                          </datalist>

                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla mandil</label>
                            <input type="text" id="" name="TallaMan" class="form-control"  placeholder="Ejemplo: Unitalla" minlength="3" maxlength="20" title="Ingresa un tipo válido (De entre 1 a 20 caracteres), ¡Solo letras" pattern="[A-Za-z]{1,20}" value="<?php echo $_SESSION['Talla_Mandil'];?>" list="ListaTallaMandil">
                          </div>

                          <datalist id="ListaTallaMandil">
                            <option value='Unitalla'>Unitalla</option>
                          </datalist>

                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla bata</label>
                            <input type="number" id="" name="TallaBat" class="form-control"  placeholder="Ejemplo: 28,40" min="28" max="50" title="Ingresa una talla válida, ¡Solo tallas en numero" pattern="[0-9]{1,2}" value="<?php echo $_SESSION['Talla_Bata'];?>" list="ListaTallaBata">
                          </div>

                          <datalist id="ListaTallaBata">
                            <?php for ($i=28; $i <=50; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 
                            }
                            ?>  
                          </datalist>


                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla calzado</label>
                            <input type="text" id="" name="TallaCalzado" class="form-control"  placeholder="Ejemplo: 25.5" minlength="1" maxlength="5" title="Ingrese una talla de calzado en en centimetros" pattern="[0-9.]{1,5}" value="<?php echo $_SESSION['Talla_Calzado'];?>">       
                          </div>

                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Tipo calzado</label>
                            <input type="text" id="" name="TipoCal" class="form-control"  placeholder="Ejemplo: Bota borsegui,Choclo" minlength="5" maxlength="50" title="Ingresa un tipo de calzado válido (De entre 1 a 50 caracteres), ¡Solo letras y + o -" pattern="[A-Za-zé ]{1,50}" value="<?php echo $_SESSION['Tipo_Calzado'];?>" list="ListaTipoCalzado">
                          </div>

                          <datalist id="ListaTipoCalzado">
                            <option value="Choclo">Choclo</option> 
                            <option value="Bota borsegui">Bota borsegui</option> 
                            <option value="Bota doulup">Bota doulup</option>
                            <option value="Bota dielectrica larga">Bota dielectrica larga</option>
                            <option value="Calzado eléctrico corto">Calzado eléctrico corto</option> 
                            <option value="Calzado eléctrico largo">Calzado eléctrico largo</option> 
                            <option value="Bota de soldador con casquillo">Bota de soldador con casquillo</option>
                          </datalist>

                        </div>
                      <?php } ?>

                      <?php if($_SESSION['Rama'] == "Administrativo"){ ?>
                        <div id="IDROPAADMINISTRATIVO">
                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla camisa</label>
                            <input type="text" id="" name="TallaCamA" class="form-control"  placeholder="Ejemplo:  XS,S,M,L,XL,XXL" minlength="1" maxlength="4" title="Ingresa un nombre válido (De entre 1 a 4 caracteres), ¡Solo tallas como XS,S,M,L,XL,XXL" pattern="[XSML]{1,4}" value="<?php echo $_SESSION['Talla_CamisaA'];?>" list="ListaTallasPlayeraCamisa">
                          </div>

                          <datalist id="ListaTallasPlayeraCamisa">
                            <option value="XS">XS</option> 
                            <option value="S">S</option> 
                            <option value="M">M</option> 
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                          </datalist>

                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla pantalon</label>
                            <input type="number" id="" name="TallaPanA" class="form-control"  placeholder="Ejemplo: 5,7,9,24,30" min="5" max="64" title="Ingresa una talla válida, ¡Solo tallas en numero" pattern="[0-9]{1,2}" list="ListaTallasPantalon" value="<?php echo $_SESSION['Talla_PantalonA'];?>" >
                          </div>

                          <datalist id="ListaTallasPantalon">
                            <?php for ($i=5; $i <=29; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 
                            }

                            for ($i=28; $i <=64; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 

                            }
                            ?>
                          </datalist>


                          <div class="col-auto" style="margin-top: 2%;">
                            <label for="exampleFormControlFile1">Talla falda</label>
                            <input type="text" id="" name="TallaFalda" class="form-control"  placeholder="Ejemplo: 7,29" minlength="1" maxlength="2" title="Ingrese una talla de falda 5 a 29 etc." pattern="[0-9]{1,2}" value="<?php echo $_SESSION['Talla_Falda'];?>" list="ListaTallaFalda">       
                          </div>

                          <datalist id="ListaTallaFalda">
                            <?php for ($i=5; $i <=29; $i+=2) { 
                              echo "<option value='$i'>$i</option>"; 
                            }
                            ?>
                          </datalist>

                        </div>
                      <?php } ?>

                      <div class="col-auto" style="margin-top: 2%;">
                        <label for="exampleFormControlFile1">Tipo sanguineo</label>
                        <input type="text" id="" name="TipoS" class="form-control"  placeholder="Ejemplo: A,AB,-O,+A,+AB" minlength="1" maxlength="3" title="Ingresa un tipo de sangre válido (De entre 1 a 3 caracteres), ¡Solo letras y + o -" pattern="[ABO+-]{1,3}" value="<?php echo $_SESSION['Tipo_Sangre'];?>" list="ListaTipoSanguineo">
                      </div>

                      <datalist id="ListaTipoSanguineo">
                        <option value="A">A</option> 
                        <option value="B">B</option> 
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                        <option value="-O">-O</option> 
                        <option value="+O">+O</option>
                        <option value="-A">-A</option>
                        <option value="+A">+A</option>
                        <option value="-B">-B</option>
                        <option value="+B">+B</option>
                        <option value="-AB">-AB</option>
                        <option value="+AB">+AB</option>
                      </datalist>

                      <div class="col-auto" style="margin-top: 2%;">
                        <label for="exampleFormControlFile1">Alergias</label>
                        <input type="text" id="" name="NombreAlergias" class="form-control"  placeholder="Ejemplo: Gatos, Paracetamol, etc." minlength="5" maxlength="150" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{5,150}"title="Ingresa un texto válido (De entre 5 a 150 caracteres), ¡Solo letras, espacios y números!" value="<?php echo $_SESSION['Alergias'];?>">    
                      </div>

                      <div class="col-auto" style="margin-top: 2%;">
                        <label for="exampleFormControlFile1">Donante<strong><?php //echo $_SESSION['Donante'];?></strong></label>
                        <select class="form-control" id="tallacb" name="DonanteE" required="">
                          <?php if ($_SESSION['Donante'] == "Si") {?>     
                            <option value="Si" selected>Si</option> 
                            <option value="No">No</option>  
                          <?php } else {  ?>
                            <option value="Si">Si</option> 
                            <option value="No" selected>No</option> 
                          <?php } ?>
                        </select>       
                      </div>

                      <br>
                      <button type="submit" name="btnActualizarSeguridadHigiene" class="btn btn-primary">Actualizar</button>
                    </form>
                  </div>    

                </fieldset>
              </div>

              <?php  
              if(isset($_POST['btnActualizarSeguridadHigiene'])){

                $NumImss = $_POST['NumIMSSE'];
                $TS = $_POST['TipoS'];
                $Alergias = $_POST['NombreAlergias'];
                $Donante = $_POST['DonanteE'];


                $TallaC = $_POST['TallaCamC']; 
                $TallaCsola = $_POST['TallaCams'];
                $TallaPanC = $_POST['TallaPanC'];
                $TallaSh = $_POST['TallaSh'];
                $TallaMan = $_POST['TallaMan'];
                $TallaBat = $_POST['TallaBat'];
                $TallaCal = $_POST['TallaCalzado'];
                $TipoCal = $_POST['TipoCal'];

                $TallaCA = $_POST['TallaCamA'];
                $TallaPanA = $_POST['TallaPanA'];
                $TallaFal = $_POST['TallaFalda'];

                $ID_PersonaExis = ObtencionDato($_SESSION['numtrareg'],"empleados","Num_Emple","ID_Persona");


                $Actualizo = 0;

                if ($_SESSION['Numero_IMSS'] != $NumImss){
                  ActuazlizarDato($NumImss,"personas","Numero_IMSS",$ID_PersonaExis,"ID_Persona");
                  $Actualizo++;
                }

                if($_SESSION['Rama'] == "Administrativo"){

                  $ID_PersonaExisAdmin = ObtencionDato($ID_PersonaExis,"ropaadministrativo","ID_Persona","ID_Persona");


                  if ($ID_PersonaExis == $ID_PersonaExisAdmin) {

                    if ($_SESSION['Talla_CamisaA'] != $TallaCA){           
                      ActuazlizarDato($TallaCA,"ropaadministrativo","Talla_Camisa",$ID_PersonaExis,"ID_Persona");
                      $Actualizo++;
                    }

                    if ($_SESSION['Talla_PantalonA'] != $TallaPanA){          
                      ActuazlizarDato($TallaPanA,"ropaadministrativo","Talla_Pantalon",$ID_PersonaExis,"ID_Persona");
                      $Actualizo++;
                    }

                    if ($_SESSION['Talla_Falda'] != $TallaFal){          
                      ActuazlizarDato($TallaFal,"ropaadministrativo","Falda",$ID_PersonaExis,"ID_Persona");
                      $Actualizo++;
                    }


                   // echo "<script>alert('Ya existe esa persona');</script>"; 

                  }else{

                    if ($TallaCA != "" && $TallaPanA !="" && $TallaFal != ""){  

                     //echo "<script>alert('si registra vacios ADMINISTRACIÓN');</script>";
                     RegistrarRopaAdministrativo($ID_PersonaExis, $TallaCA, $TallaPanA, $TallaFal);

                     $Actualizo++;

                   }

                 }

               }else{

                $ID_PersonaExisCampo = ObtencionDato($ID_PersonaExis,"ropacampo","ID_Persona","ID_Persona");


                if ($ID_PersonaExis == $ID_PersonaExisCampo) {

                  echo "<script>alert('si registra vacios CAMPOS');</script>";

                  if ($_SESSION['Talla_CamisaC'] != $TallaC){            
                    ActuazlizarDato($TallaC,"ropacampo","Talla_Playera",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Talla_Camisola'] != $TallaCsola){          
                    ActuazlizarDato($TallaCsola,"ropacampo","Talla_Camisola",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Talla_PantalonC'] != $TallaPanC){          
                    ActuazlizarDato($TallaPanC,"ropacampo","Talla_Pantalon",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Talla_Short'] != $TallaSh){          
                    ActuazlizarDato($TallaSh,"ropacampo","Short",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Talla_Mandil'] != $TallaMan){          
                    ActuazlizarDato($TallaMan,"ropacampo","Mandil",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Talla_Bata'] != $TallaBat){ 
                    ActuazlizarDato($TallaBat,"ropacampo","Bata",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Talla_Calzado'] != $TallaCal){          
                    ActuazlizarDato($TallaCal,"ropacampo","Talla_Calzado",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                  if ($_SESSION['Tipo_Calzado'] != $TipoCal){          
                    ActuazlizarDato($TipoCal,"ropacampo","Tipo_Calzado",$ID_PersonaExis,"ID_Persona");
                    $Actualizo++;
                  }

                }else{

                 if ($TallaC != "" && $TallaCsola !="" && $TallaPanC != "" && $TallaSh != "" && $TallaMan != "" && $TallaBat != "" && $TallaCal != "" && $TipoCal != ""){  

                  //echo "<script>alert('si registra vacios CAMPOS');</script>";
                   RegistrarRopaCampo($ID_PersonaExis,$TallaC, $TallaCsola,$TallaPanC,$TallaSh,$TallaMan,$TallaBat,$TallaCal,$TipoCal);

                   $Actualizo++;

                 }
               }

             }

             if ($_SESSION['Tipo_Sangre'] != $TS){
              ActuazlizarDato($TS,"personas","Tipo_Sangre",$ID_PersonaExis,"ID_Persona");
              $Actualizo++;
            }

            if ($_SESSION['Donante'] != $Donante){
              ActuazlizarDato($Donante,"personas","Donante",$ID_PersonaExis,"ID_Persona");
              $Actualizo++;
            }

            if ($_SESSION['Alergias'] != $Alergias){           
              ActuazlizarDato($Alergias,"personas","Alergias",$ID_PersonaExis,"ID_Persona");
              $Actualizo++;
            }
                     // echo "<script>alert('Ya existe esa persona');</script>"; 
            if($Actualizo != 0){
              echo "<script>alert('Acualización realizada');</script>";
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
            }
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";

          }
          ?>

        </div>
        <!-- FIN SECCION DE EDICION DE SEGURIDAD E HIGIENE -->

        <!-- SECCION DE EDICIONDE DATOS DE PADECIMIENTOS -->
        <div class="col-auto" id="IDDatosPade" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
          <a name="SDPA"></a>
          <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
            <fieldset>
              <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Actualizar" onclick="MostrarOcultarAler('IDSecActualizarAler','IDSecNuevaAler','IDEliAler')">

              <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Registrar" onclick="MostrarOcultarAler('IDSecNuevaAler','IDSecActualizarAler','IDEliAler')">

              <input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Eliminar" onclick="MostrarOcultarAler('IDEliAler','IDSecNuevaAler','IDSecActualizarAler')">

              <legend>EDITAR PADECIMIENTOS</legend>

              <!--Seccion de actualizar nombre de Alergias-->
              <div class="form-row align-items-center" style="" id="IDSecActualizarAler">
                <form action="VistaAdminGen.php" method="POST">

                  <div class="col-auto" style="margin-top: 2%;">  
                    <label>Padecimiento a buscar</label>
                    <input type="text" id="itemcat" name="NomPadBuscar" class="form-control"  placeholder="Nombre del padecimiento a buscar" minlength="3" maxlength="50" list="ListaPdecimientos" title="Ingresa un texto válido (De entre 3 a 50 caracteres), ¡Solo letras, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{3,50}" required="">
                  </div>  

                  <div class="col-auto" style="margin-top: 2%;">
                    <label>Nuevo nombre del Padecimiento</label>
                    <input type="text" id="txtNombrePad" name="NuevoNombrePadecimiemto" class="form-control"  placeholder="Ejemplo: Asma" minlength="3" maxlength="50" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{3,50}" title="Ingresa un texto válido (De entre 5 a 20 caracteres), ¡Solo letras, espacios y números!">
                  </div>

                  <div class="col-auto" style="margin-top: 2%;">
                    <label for="exampleFormControlFile1">Nueva fecha de inicio del padecimiento</label>
                    <input id="txtFechaPad" type="date" name="NuevoFechaPadecimiento" class="form-control"  placeholder="Ingreso al ayuntamiento" minlength="1"maxlength="10" title="fecha"> 
                  </div> 

                  <div class="col-auto" style="margin-top: 2%;">
                    <input type="submit" name="btnActualizarPad" class="btn btn-primary mb-2" value="Actualizar">
                  </div>

                </form> 


                <?php  

                if(isset($_POST['btnActualizarPad'])){


                  $DatoBuscar = $_POST['NomPadBuscar'];
                  $NuevoDatoNom = $_POST['NuevoNombrePadecimiemto'];
                  $NuevoDatoFech = $_POST['NuevoFechaPadecimiento'];

                  $IDPer = ObtencionDatoNuevo($_SESSION['numtrareg'],"empleados", "Num_Emple","ID_Persona");

                  $NomPade = ObtencionDatoNuevo($IDPer,"padecimientos", "ID_Persona","Nombre_Padecimiento");


                  if($DatoBuscar == $NomPade){

                    $Actualizo = 0;

                  //$NomPad = ObtencionDato($NuevoDatoNom,"padecimientos", "Nombre_Padecimiento",$IDPer);

                    $fecha = ObtencionDato($NuevoDatoFech,"padecimientos", "Tiempo_Evolucion",$IDPer);

                  //echo "<script>alert('$NomPade, $fecha');</script>";

                    if($NuevoDatoNom != ""){
                      if($NuevoDatoNom != $NomPade){
                        ActuazlizarDatoPad($NuevoDatoNom,"padecimientos","Nombre_Padecimiento","ID_Persona",$IDPer,$NomPade,"Nombre_Padecimiento");
                        $Actualizo=1;
                      }
                    }

                    if($NuevoDatoFech != ""){
                      if($NuevoDatoFech != $fecha){

                        include("abrir_conexion_adm.php");

                        $consulta = "SELECT Tiempo_Evolucion FROM padecimientos WHERE Nombre_Padecimiento = '$NomPade' and ID_Persona = '$IDPer'";

                        $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

                        $fechaAntigua = "";

                        while($datos = mysqli_fetch_array($dato)){
                          $fechaAntigua = $datos["Tiempo_Evolucion"];
                        }

                        mysqli_close($conexionadm);

                        ActuazlizarDatoPad($NuevoDatoFech,"padecimientos", "Tiempo_Evolucion","ID_Persona",$IDPer,$fechaAntigua, "Tiempo_Evolucion");
                        $Actualizo=1;
                      } 
                    }

                    if($Actualizo != 0){
                      echo "<script>alert('**ACTUALIZACIÓN EXITOSA**');</script>";
                      echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
                    }               

                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";

                  }else{
                    echo "<script>alert('El empleado no tiene ese padecimiento registrado');</script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
                  } 
                }

                ?>
              </div>
              <!--Fin Seccion de actualizar nombre de padecimiento-->   

              <!--Seccion de nuevo nombre de padecimiento-->
              <div class="form-row align-items-center"  id="IDSecNuevaAler" style="display: none;">
                <div class="col-auto">
                  <form action="VistaAdminGen.php" method="POST">
                    <div class="col-auto">
                      <label>Nombre del nuevo padecimiento</label>
                      <input type="text" id="txtNombrePadNuevo" name="NombrePadecimiemtoNuevo" class="form-control"  placeholder="Ejemplo: Asma" minlength="3" maxlength="50" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{3,50}" title="Ingresa un texto válido (De entre 5 a 50 caracteres), ¡Solo letras, espacios y números!" required>
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

                <?php  

                if(isset($_POST['btnNuevoPadecimiento'])){

                  $NuevoDato = $_POST['NombrePadecimiemtoNuevo'];
                  $NuevaFecha = $_POST['FechaPadecimientoNueva'];

                  $IDPer = ObtencionDatoNuevo($_SESSION['numtrareg'],"empleados", "Num_Emple","ID_Persona");

                  $NomPade = ObtencionDatoNuevo($IDPer,"padecimientos", "ID_Persona","Nombre_Padecimiento");

                  if($NuevoDato != $NomPade){
                    RegistraNomPad($IDPer,$NuevoDato,$NuevaFecha);
                    echo "<script>alert('**REGISTRO DE PADECIMIENTO EXITOSO**');</script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
                  }else{
                    echo "<script>alert('El empleado ya tiene el padecimiento $NomPade registrado');</script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
                  }  

                }
                ?>

              </div>
              <!--Fin Seccion de nuevo nombre de padecimiento--> 

              <!--Seccion de aliminar nombre de padecimiento-->
              <div class="form-row align-items-center" id="IDEliAler" style="display: none;">
                <div class="col-auto">
                  <form action="VistaAdminGen.php" method="POST">
                    <div class="col-auto">
                      <label>Nombre de padecimiento a eliminar</label>
                      <input type="text" id="txtNomCatNuevo" name="Nom_a_Eliminar" class="form-control"  placeholder="Nombre del padecimiento" minlength="3" maxlength="50" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -.]{2,50}" required="" list="ListaPdecimientos">
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <input type="submit" name="btnEliminarPad" class="btn btn-primary mb-2" value="Eliminar">
                    </div>
                  </form>  
                </div>
                <?php
                if(isset($_POST['btnEliminarPad'])){
                  $DatoGuia = "";
                  $DatoGuia = $_POST['Nom_a_Eliminar'];

                  $IDPer = ObtencionDatoNuevo($_SESSION['numtrareg'],"empleados", "Num_Emple","ID_Persona");

                  $NomPade = ObtencionDatoNuevo($IDPer,"padecimientos", "ID_Persona","Nombre_Padecimiento");

                //$ID_Emp = ObtencionDato($_SESSION ['numtrareg'],"empleados","Num_Emple","ID_Empleado");

                  if($DatoGuia == $NomPade){
                    EliminarDato("padecimientos",$DatoGuia,"Nombre_Padecimiento",$IDPer);
                    echo "<script>alert('**ELIMINACIÓN DE PADECIMIENTO EXITOSO**');</script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
                  }else{
                    echo "<script>alert('El empleado no tiene $DatoGuia registrado');</script>";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
                  }
                }
                ?>
              </div>
              <!--Fin Seccion de eliminar nombre de padecimiento-->
            </fieldset>

            <!--Lista Pdecimientos-------------------------------------------------->
            <datalist id="ListaPdecimientos">
              <?php ListaOpciones("Nombre_Padecimiento","padecimientos");?>
            </datalist>
            <!---------------------------------------------------------------------------->

          </div>

          <?php  
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
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
            }
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
          }
          ?>
        </div>
        <!-- FIN SECCION DE EDICIONDE DATOS DE PADECIMIENTOS -->

        <!-- SECCION DE EDICIONDE DATOS DE CONTATO Y DIRECCION -->
        <div class="col-auto" id="IDDContactos" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
          <a name="SDCD"></a>
          <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
            <fieldset>
              <legend>EDITAR DATOS DE CONTACTO Y DIRECCIÓN</legend>
              <div class="form-row align-items-center">
                <form action="VistaAdminGen.php" method="POST">

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

          <?php  
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
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
            }
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
          }
          ?>
        </div>
        <!-- FIN SECCION DE EDICIONDE DATOS DE CONTATO Y DIRECCION -->

        <!-- SECCION DE EDICION DE ESCALAFON -->
        <div class="col-auto" id="IDDEscalafon" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
          <a name="SDEC"></a>
          <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
            <fieldset>
              <div class="form-row align-items-center">
                <form action="VistaAdminGen.php" method="POST">
                  <div class="col-auto" style="margin-top: 2%;">
                    <legend>EDITAR DATOS DE ESCALAFON</legend>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Número de trabajador</label>
                      <input id="" type="text" name="NumeroEmpleado" class="form-control"  placeholder="Ejemplo: 86" minlength="1"maxlength="5" pattern="[0-9]{1,5}" title="¡Solo números!" value="<?php echo $_SESSION['Num_Emple'];?>" required> 
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Categoría</label>
                      <input type="text" id="" name="NombreCatEmpleado" class="form-control"  placeholder="Ejemplo: Chofer" list="ListaCategoria" minlength="3" maxlength="100" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890. -]{2,100}" value="<?php echo $_SESSION['Nombre_Categoria'];?>" required>
                    </div>

                    <datalist id="ListaCategoria">
                      <?php ListaOpciones("Nombre_Categoria","categorias");?>
                    </datalist>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Rama <strong><?php //echo $_SESSION['Rama'];?></strong></label>
                      <select class="form-control" id="tallacb" name="Rama"> 
                        <?php if ($_SESSION['Rama'] == "Campo") {?>     
                          <option value="Campo" selected>Campo</option> 
                          <option value="Administrativo">Administrativo</option>
                        <?php } else {  ?>
                          <option value="Campo">Campo</option> 
                          <option value="Administrativo" selected>Administrativo</option>
                        <?php } ?>
                      </select> 
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Departamento</label>
                      <input type="text" id="" name="Nombre_DeptoE" class="form-control"  placeholder="Ejemplo: Rastro, Dif municipal" list="ListaDepartamentos" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 3 a 30 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ ]{3,30}" value="<?php echo $_SESSION['Nombre_Depto'];?>" required>
                    </div>

                    <datalist id="ListaDepartamentos">
                      <?php ListaOpciones("Nombre_Depto","departamentos");?>  
                    </datalist>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Salario</label>
                      <input id="" type="text" name="SalarioEmpleado" class="form-control"  placeholder="Ejemplo 455.50" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="¡Solo números!" value="<?php echo $_SESSION['Salario'];?>" required> 
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Fecha de ingreso al ayuntamiento</label>
                      <input id="" type="date" name="Fech_Ing_AyunE" class="form-control"  placeholder="Ingreso al ayuntamiento" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="fecha" value="<?php echo $_SESSION['Fech_Ingre_Ayunt'];?>"> 
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Fecha de ingreso al sindicato</label>
                      <input id="" type="date" name="Fech_Ing_SinE" class="form-control"  placeholder="Ingreso al Sindicato" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="fecha" value="<?php echo $_SESSION['Fecha_Ingre_Sind'];?>">
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Fecha de ingreso al departamento</label>
                      <input id="" type="date" name="Fech_Ing_DepE" class="form-control"  placeholder="Ingreso al Departamento" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="fecha" value="<?php echo $_SESSION['Fecha_Ingre_Dep'];?>">
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Fecha de asignación a la categoría</label>
                      <input id="" type="date" name="Fech_Ing_CatE" class="form-control"  placeholder="Asig Categoría" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="fecha" value="<?php echo $_SESSION['Fecha_Asig_Cat'];?>"> 
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Situación</label>
                      <input type="text" id="" name="SituacionE" class="form-control"  placeholder="Ejemplo: Becado, Fallecido" list="ListaSituaciones" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ ]{3,50}" value="<?php echo $_SESSION['Nombre_Situacion'];?>" required>
                    </div>

                    <datalist id="ListaSituaciones">
                      <?php ListaOpciones("Nombre_Situacion","situacion");?> 
                    </datalist>

                    <!-- <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Cubre temporal Def: <strong><?php //echo $_SESSION['Cubre_Temp_Def'];?></strong></label>
                      <select class="form-control" id="tallacb" name="CubreTempE">     
                        <?php if ($_SESSION['Cubre_Temp_Def'] == "Si") {?>     
                          <option value="Si" selected>Si</option> 
                          <option value="No">No</option>  
                        <?php } else {  ?>
                          <option value="Si">Si</option> 
                          <option value="No" selected>No</option> 
                        <?php } ?>
                      </select>   
                    </div> -->

                   <!--  <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Cubre temporal</label>
                      <input type="text" id="" name="CubreTempE" class="form-control"  placeholder="Ejemplo: Chofer" minlength="3" maxlength="100"  list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890. -]{2,100}" required>
                    </div> -->

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Cubre temporal</label>
                      <input type="text" id="" name="CubreTempE" class="form-control"  placeholder="Ejemplo: Chofer" list="ListaCategoria" minlength="3" maxlength="100" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890. -]{2,100}" value="<?php echo $_SESSION['Cubre_Temp_Def'];?>" required>
                    </div>

                    <datalist id="ListaCategoria">
                      <?php ListaOpciones("Nombre_Categoria","categorias");?>
                    </datalist>



                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Cubre familiar <strong><?php //echo $_SESSION['Cubre_Fam_Temp'];?></strong></label>
                      <select class="form-control" id="tallacb" name="CubreFamE" >     
                        <?php if ($_SESSION['Cubre_Fam_Temp'] == "Si") {?>     
                          <option value="Si" selected>Si</option> 
                          <option value="No">No</option>  
                        <?php } else {  ?>
                          <option value="Si">Si</option> 
                          <option value="No" selected>No</option> 
                        <?php } ?>
                      </select>    
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <label for="exampleFormControlFile1">Observaciones</label>
                      <textarea name="textareaObservaciones" class="form-control"  placeholder="Observaciones"  minlength="3" maxlength="400" cols="10" title="Ingresa un texto válido (De entre 3 a 400 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890., -]{2,400}"><?php echo $_SESSION['Observaciones'];?></textarea>
                    </div>

                    <div class="col-auto" style="margin-top: 2%;">
                      <button type="submit" name="btnActualizarDEscalafon" class="btn btn-primary">Actualizar</button>
                    </div> 

                  </form>

                </div>
              </fieldset>
            </div>

            <?php  
            if(isset($_POST['btnActualizarDEscalafon'])){

              $NumeroE = $_POST['NumeroEmpleado']; 
              $Categoria = $_POST['NombreCatEmpleado'];
              $Rama = $_POST['Rama'];
              $NomDepto = $_POST['Nombre_DeptoE'];
              $Salario = $_POST['SalarioEmpleado'];
              $Fech_Ing_Ayun = $_POST['Fech_Ing_AyunE'];
              $Fech_Ing_Sin = $_POST['Fech_Ing_SinE'];
              $Fech_Ing_Dep = $_POST['Fech_Ing_DepE'];
              $Fech_Ing_Cat = $_POST['Fech_Ing_CatE'];
              $Situacion = $_POST['SituacionE'];
              $CubreTemp = $_POST['CubreTempE'];
              $CubreFam = $_POST['CubreFamE'];
              $Observaciones = $_POST['textareaObservaciones'];

              $Actualizo = 0;

              if ($_SESSION['Num_Emple'] != $NumeroE){
                ActuazlizarDato($NumeroE,"empleados", "Num_Emple",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Nombre_Categoria'] != $Categoria){
                $ID_Cat = ObtencionDato($Categoria,"categorias","Nombre_Categoria","ID_Categoria");

                ActuazlizarDato($ID_Cat,"empleados", "ID_Categoria",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Rama'] != $Rama){           
                ActuazlizarDato($Rama,"empleados", "Rama",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Nombre_Depto'] != $NomDepto){
                $ID_Depto = ObtencionDato($NomDepto,"departamentos","Nombre_Depto","ID_Departamento");

                ActuazlizarDato($ID_Depto,"empleados", "ID_Departamento",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Salario'] != $Salario){            
                ActuazlizarDato($Salario,"empleados", "Salario",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Fech_Ingre_Ayunt'] != $Fech_Ing_Ayun){          
                ActuazlizarDato($Fech_Ing_Ayun,"empleados", "Fech_Ingre_Ayunt",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Fecha_Ingre_Sind'] != $Fech_Ing_Sin){          
                ActuazlizarDato($Fech_Ing_Sin,"empleados", "Fecha_Ingre_Sind",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Fecha_Ingre_Dep'] != $Fech_Ing_Dep){          
                ActuazlizarDato($Fech_Ing_Dep,"empleados", "Fecha_Ingre_Dep",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Fecha_Asig_Cat'] != $Fech_Ing_Cat){          
                ActuazlizarDato($Fech_Ing_Cat,"empleados", "Fecha_Asig_Cat",$$_SESSION ['numtrareg'],"ID_Persona");
                $Actualizo++;
              }

              if ($_SESSION['Nombre_Situacion'] != $Situacion){ 
                $ID_Sit = ObtencionDato($Situacion,"situacion","Nombre_Situacion","ID_Situacion");

                ActuazlizarDato($ID_Sit,"empleados", "ID_Situacion",$_SESSION ['numtrareg'],"Num_Emple");
                $Actualizo++;
              }

              if ($_SESSION['Cubre_Temp_Def'] != $CubreTemp){          
               // ActuazlizarDato($CubreTemp,"empleados", "Cubre_Temp_Def",$_SESSION ['numtrareg'],"Num_Emple");
               // $Actualizo++;

               $ID_CatCT = ObtencionDato($CubreTemp,"categorias","Nombre_Categoria","ID_Categoria");

               ActuazlizarDato($ID_CatCT,"empleados", "ID_CubreTemp",$_SESSION ['numtrareg'],"Num_Emple");
               $Actualizo++;

             }

             if ($_SESSION['Cubre_Fam_Temp'] != $CubreFam){          
              ActuazlizarDato($CubreFam,"empleados", "Cubre_Fam_Temp",$_SESSION ['numtrareg'],"Num_Emple");
              $Actualizo++;
            }

            if ($_SESSION['Observaciones'] != $Observaciones){          
              ActuazlizarDato($Observaciones,"empleados", "Observaciones",$_SESSION ['numtrareg'],"Num_Emple");
              $Actualizo++;
            }

            if($Actualizo != 0){
              echo "<script>alert('Acualización realizada');</script>";
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
            }
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
          }
          ?>

        </div>
        <!-- FIN SECCION DE EDICION DE ESCALAFON -->

        <!-- SECCION DE EDICIONDE USUARIO Y CONTRASEÑA -->
        <div class="col-auto" id="IDDUSER" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
          <a name="SDUSER"></a>
          <div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
            <fieldset>
              <div class="form-row align-items-center">
                <form action="VistaAdminGen.php" method="POST">
                  <div class="col-auto" style="margin-top: 2%;">
                    <legend>EDITAR DATOS DE USUARIO Y CONTRASEÑA</legend>
                    <label for="exampleFormControlFile1">Nombre de usuario</label>
                    <input type="text" id="" name="Nom_usu" class="form-control" placeholder="Nombre de usuario" type="Password" minlength="2" maxlength="48" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{2,48}" title="Escribe un usuario valido" value="<?php echo $_SESSION['Nom_Usuario'];?>"  required>
                  </div>

                  <div class="col-auto" style="margin-top: 2%;">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" name="Contra_usu" class="form-control" id="txtPassworEditar" minlength="8" maxlength="15" placeholder="Contraseña" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{8,15}"title="Ingresa una contraseña válida (De entre 8 a 15 caracteres), ¡Solo letras, espacios, guiones y números!" value="<?php echo ED::Desencritar($_SESSION['Password']);?>"  required>
                  </div>

                  <br>

                  <div style="width: 100%;" align="center">
                    <button  id="show_password" class="btn btn-primary" type="button" onclick="mostrarPasswordEdicion()"> <span class="fa fa-eye-slash icon"></span> </button>
                    <label>Mostrar/Ocultar contraseña</label>
                  </div>

                  <button type="submit" name="btnActualizarUser" class="btn btn-primary">Actualizar</button>
                </form>
              </div>    

            </fieldset>

          </div>

          <?php  
          if(isset($_POST['btnActualizarUser'])){

            $NomUser = $_POST['Nom_usu'];
            $ContraUser = $_POST['Contra_usu'];

            $ID_Emp = ObtencionDato($_SESSION ['numtrareg'],"empleados","Num_Emple","ID_Empleado");

            $Actualizo = 0;

            if ($_SESSION['Nom_Usuario'] != $NomUser ){

              ActuazlizarDatoUser($NomUser,"usuarios", "Nom_Usuario",$ID_Emp,"ID_Empleado",$_SESSION ['TipoUser']);
              $Actualizo++;
            }

            if ($_SESSION['Password'] != $ContraUser){
              $NuvaContra = ED::Encriptar($ContraUser);     
              //ActuazlizarDato($NuvaContra,"usuarios", "Password",$ID_Emp,"ID_Empleado");
              ActuazlizarDatoUser($NuvaContra,"usuarios", "Password",$ID_Emp,"ID_Empleado",$_SESSION['TipoUser']);
              $Actualizo++;
            }

            if($Actualizo != 0){
              echo "<script>alert('Acualización realizada');</script>";
              echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
            }
            echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";
          }
          ?>

        </div>
        <!-- FIN SECCION DE EDICIONDE USUARIO Y CONTRASEÑA -->

      </div>
      <!--------------------------------------------------------------------------->


      <!-- Sección de resultados por departamento---------------------------> 
      <div id="IDDeptoRes" style="display: none; ">
          <?php // 
          if(isset($_POST['btnBusDepTra'])){


            $DatoBuscar = $_POST['nomdep'];

            echo "<legend>Resultados de busqueda por *Departamento* $DatoBuscar</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDDeptoRes');
            contenedor.style.display = 'block';


            </script>";

            ResultadosBusqueda(2,$DatoBuscar,"");
            //   ResultadosBusqueda(2,$DatoBuscar,"");

            // if(Consuta2("Nombre_Depto","departamentos","ID_Departamento",$DatoBuscar) == true){

            //   echo "
            //   <script> 
            //   var contenedor = document.getElementById('IDDeptoRes');
            //   contenedor.style.display = 'block';

            //       //document.getElementById(ID1).style.display = 'none';
            //   </script>";
            //   ResultadosBusqueda(2,$DatoBuscar,"");
            // }else{
            //   echo "<script>alert('Sin resultados');</script>";
            // }
          }
          ?>
        </div>
        <!--------------------------------------------------------------------------->

        <!-- Sección de resultados por Categoria---------------------------> 
        <div id="IDCategoriaERes" style="display: none; ">
          <?php  
          if(isset($_POST['btnBusCatTra'])){


            $DatoBuscar = $_POST['nomcat'];

            echo "<legend>Resultados de busqueda por *Categoria* $DatoBuscar</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDCategoriaERes');
            contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
            </script>";

            ResultadosBusqueda(3,$DatoBuscar,"");

            // if(Consuta2("Nombre_Categoria","categorias","ID_Categoria",$DatoBuscar) == true){
            //     //session_start();
            //       // $_SESSION['DatoBuscar'] = $DatoBuscar;
            //   //echo "<script>alert('Con resultados');</script>";
            //   echo "
            //   <script> 
            //   var contenedor = document.getElementById('IDCategoriaERes');
            //   contenedor.style.display = 'block';

            //       //document.getElementById(ID1).style.display = 'none';
            //   </script>";
            //   ResultadosBusqueda(3,$DatoBuscar,"");
            // }else{
            //   echo "<script>alert('Sin resultados');</script>";
            // }
          }
          ?>
        </div>
        <!--------------------------------------------------------------------------->  

        <!-- Sección de resultados por Situacion---------------------------> 
        <div id="IDSitERes" style="display: none; ">
          <?php  
          if(isset($_POST['btnBusSitTra'])){


            $DatoBuscar = $_POST['nomsit'];

            echo "<legend>
            <div class='form-row align-items-center'>
            <form >
            <div class='col-auto'>Resultados de busqueda por *Situación* $DatoBuscar</div>
            </form>

            <div class='col-auto'>
            <form action='DocListSituaciones.php' method='POST' target='_blank'>

            <input  type='text' name='NomSitu' class='form-control'  placeholder='Ejemplo: 86' minlength='3' maxlength='50' pattern='[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ ]{3,50}' title='¡Solo números!' value='".$DatoBuscar."'  style='display: none;' required> 

            <input type='submit' name='GenDocSit' class='btn btn-info' value='Generar documento' >

            </form>
            </div>  
            </div>
            </legend>
            ";

            //echo "<legend>Resultados de busqueda por *Situación* $DatoBuscar</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDSitERes');
            contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
            </script>";


            ResultadosBusqueda(9,$DatoBuscar,"");

            // if(Consuta2("Nombre_Categoria","categorias","ID_Categoria",$DatoBuscar) == true){
            //     //session_start();
            //       // $_SESSION['DatoBuscar'] = $DatoBuscar;
            //   //echo "<script>alert('Con resultados');</script>";
            //   echo "
            //   <script> 
            //   var contenedor = document.getElementById('IDCategoriaERes');
            //   contenedor.style.display = 'block';

            //       //document.getElementById(ID1).style.display = 'none';
            //   </script>";
            //   ResultadosBusqueda(3,$DatoBuscar,"");
            // }else{
            //   echo "<script>alert('Sin resultados');</script>";
            // }
          }
          ?>
        </div>
        <!---------------------------------------------------------------------------> 

        <!-- Sección de resultados por Fech_Ing_Ayun---------------------------> 
        <div id="IDFIARes" style="display: none; ">
          <?php 
          if(isset($_POST['btnBusFIATra'])){

            $DatoBuscarI = $_POST['FechaIAI'];
            $DatoBuscarF = $_POST['FechaIAF'];

            echo "<legend>Resultados de busqueda por *Fecha de ingreso al ayuntamiento* de $DatoBuscarI al $DatoBuscarF</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDFIARes');
            contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
            </script>";

            ResultadosBusqueda(4,$DatoBuscarI,$DatoBuscarF);
          }
          ?>
        </div>
        <!--------------------------------------------------------------------------->

        <!-- Sección de resultados por Fech_Ing_Sind---------------------------> 
        <div id="IDFISRes" style="display: none; ">
          <?php 
          if(isset($_POST['btnBusFISTra'])){

            $DatoBuscarI = $_POST['FechaISI'];
            $DatoBuscarF = $_POST['FechaISF'];

            echo "<legend>Resultados de busqueda por *Fecha de ingreso al sindicato* de $DatoBuscarI al $DatoBuscarF</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDFISRes');
            contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
            </script>";

            ResultadosBusqueda(5,$DatoBuscarI,$DatoBuscarF);
          }
          ?>
        </div>
        <!--------------------------------------------------------------------------->

        <!-- Sección de resultados por Fech_Ing_Dep---------------------------> 
        <div id="IDFIDRes" style="display: none; ">
          <?php 
          if(isset($_POST['btnBusFIDTra'])){

            $DatoBuscarI = $_POST['FechaIDI'];
            $DatoBuscarF = $_POST['FechaIDF'];

            echo "<legend>Resultados de busqueda por *Fecha de ingreso al departamento* de $DatoBuscarI al $DatoBuscarF</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDFIDRes');
            contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
            </script>";

            ResultadosBusqueda(6,$DatoBuscarI,$DatoBuscarF);
          }
          ?>
        </div>
        <!--------------------------------------------------------------------------->

        <!-- Sección de resultados por Fech_Asig_Cat---------------------------> 
        <div id="IDFACRes" style="display: none; ">
          <?php 
          if(isset($_POST['btnBusFICTra'])){

            $DatoBuscarI = $_POST['FechaICI'];
            $DatoBuscarF = $_POST['FechaICF'];

            echo "<legend>Resultados de busqueda por *Fecha de asignación a la categoría* de $DatoBuscarI al $DatoBuscarF</legend>";

            echo "
            <script> 
            var contenedor = document.getElementById('IDFACRes');
            contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
            </script>";

            ResultadosBusqueda(7,$DatoBuscarI,$DatoBuscarF);
          }
          ?>
        </div>
        <!--------------------------------------------------------------------------->

        <!-- Sección de resultados del escalafon completo---------------------------> 
        <div id="IDEscalafon" style="display: none;  ">
          <legend>Resultados de busqueda por *Escalafon completo*</legend>
          <?php ResultadosBusqueda(8,"",""); ?>
        </div>
        <!------------------------------------------------------------> 

      </fieldset> 

    </div>
    <!------------------------------------------------------------>

  </div> 
  <!------------------------------------------------------------>



  <!-- Sección departamentos---------------------------> 
  <div class="shadow p-3 mb-5 bg-white rounded" id="IDDep" style="display: none;">
    <fieldset style="margin-top: 0%;">
      <legend>Departamentos</legend>

      <div class="form-row align-items-center" style="height: 400px; overflow: scroll;">

        <div class="col-auto" align="center">
          <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Biblioteca">
              <img src="img/biblioteca.png" class="img-fluid" alt="Responsive image">

              <div class="linea"></div>

              <label>Biblioteca</label>
            </a>
          </div>
        </div>

        <div class="col-auto" align="center">
          <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Unidad deportiva" >
              <img src="img/unidad_dep.png" class="img-fluid" alt="Responsive image">

              <div class="linea"></div>

              <label>Unidad deportiva</label>
            </a>
          </div>
        </div>

        <div class="col-auto" align="center">
         <div class="shadow-lg p-3 mb-5 bg-white rounded">
          <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Obras públicas" >
            <img src="img/obras.png" class="img-fluid" alt="Responsive image">

            <div class="linea"></div>

            <label>Obras públicas</label>
          </a>
        </div>
      </div>

      <div class="col-auto" align="center">
       <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Panteon">
          <img src="img/panteones.png" class="img-fluid" alt="Responsive image">

          <div class="linea"></div>

          <label>Panteones</label>
        </a>
      </div>
    </div>

    <div class="col-auto" align="center">
     <div class="shadow-lg p-3 mb-5 bg-white rounded">
      <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Patrimonio municipal" >
        <img src="img/patrimonio_muni.png" class="img-fluid" alt="Responsive image">

        <div class="linea"></div>

        <label>Pat. Municipal</label>
      </a>
    </div>
  </div>

  <div class="col-auto" align="center">
   <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Parques y jardines" >
      <img src="img/parques_jardines.png" class="img-fluid" alt="Responsive image">

      <div class="linea"></div>

      <label>Parques y Jardines</label>
    </a>
  </div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Rastro" >
    <img src="img/rastro.png" class="img-fluid" alt="Responsive image">

    <div class="linea"></div>

    <label>Rastro</label>
  </a>
</div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Urbanistica" >
    <img src="img/urbanistica.png" class="img-fluid" alt="Responsive image">

    <div class="linea"></div>

    <label>Urbanistica</label>
  </a>
</div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Administrativo" >
    <img src="img/administracionDep.png" class="img-fluid" alt="Responsive image">

    <div class="linea"></div>

    <label>Administrativo</label>
  </a>
</div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Aseo público" >
    <img src="img/aseopublico.png" class="img-fluid" alt="Responsive image">

    <div class="linea"></div>

    <label>Aseo público</label>
  </a>
</div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Dif municipal" >
    <img src="img/dif.png" class="img-fluid" alt="Responsive image">

    <div class="linea"></div>

    <label>Dif</label>
  </a>
</div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Servicios generales" >
   <img src="img/servicios_generales.png" class="img-fluid" alt="Responsive image">

   <div class="linea"></div>

   <label>Servicios generales</label>
 </a>
</div>
</div>

<div class="col-auto" align="center">
 <div class="shadow-lg p-3 mb-5 bg-white rounded">
  <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Taller mecanico" >
    <img src="img/taller_mecanico.png" class="img-fluid" alt="Responsive image">

    <div class="linea"></div>

    <label>Taller mecanico</label>
  </a>
</div>
</div>

<div class="col-auto" align="center">   
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <a type="button" data-toggle="modal" data-target="#Abrircontra" data-whatever="Alumbrado público" >
      <img src="img/Alumbrado.png" class="img-fluid" alt="Responsive image">

      <div class="linea"></div>

      <label>Alumbrado público</label>
    </a>
  </div>
</div>

</div>

</fieldset>

</div>    
<!------------------------------------------------------------>


<!-- Sección para dar de alta a un empleado--------------------------->
<div class="shadow p-3 mb-5 bg-white rounded" id="IDRegEmp" style="display: none;">

  <input type="button" name="" onclick="AblilitarDatosEmpleado(true)" value="Habilitar" class="btn btn-info">
  <input type="button" name="" onclick="AblilitarDatosEmpleado(false)" value="Desabilitar" class="btn btn-info">
  <form action="php/RegistrarTrabajador.php" method="POST">

    <fieldset id="altaempleado" style="margin-top: 2%;"  disabled="true">
      <legend>Dar de alta nuevo empleado </legend>

      <div class="form-row align-items-center" style="height: 400px; overflow: scroll;">

        <div class="shadow p-3 mb-5 bg-white rounded">
          <fieldset style="margin-top: 2%;">
            <legend>Datos personales</legend>

            <div class="form-row align-items-center">

              <div class="col-auto">

              </div>

              <div class="col-auto"  style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Nombre</label>
                <input type="text" id="NombreTra" name="NombreEmpleado" class="form-control"  placeholder="Ejemplo: Pedro" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{3,30}"title="Ingresa un nombre válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Primer apellido</label>
                <input type="text" id="Apellido1Tra" name="ApellidoPEmpleado" class="form-control"  placeholder="Ejemplo: Rodriguez" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{2,30}"title="Ingresa un apellido válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Segundo apellido</label>
                <input type="text" id="Apellido2Tra" name="ApellidoMEmpleado" class="form-control"  placeholder="Ejemplo: Díaz" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{2,30}" title="Ingresa un apellido válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Edad</label>
                <input type="text" id="EdadTra" name="Edadmpleado" class="form-control"  placeholder="Ejemplo: 45" minlength="1" maxlength="3" title="Ingresa una edad, ¡Solo numeros!" pattern="[0-9]{1,3}">
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Sexo</label>
                <select class="form-control" id="TiposexoTra" name="TipoSexo">     
                  <option value="H">Hombre</option> 
                  <option value="M">Mujer</option> 
                </select>        
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Número de seguro social</label>
                <input type="text" id="NumIMSSETra" name="NumIMSSE" class="form-control"  placeholder="Ejemplo: 120458245678" minlength="1" maxlength="11" title="Ingresa un número de seuro valido), ¡Solo numeros!" pattern="[1234567890]{11,11}" >
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">CURP</label>
                <input type="text" id="NumCURPTra" name="NumCURP" class="form-control"  placeholder="Ejemplo: GADJ980623HMNRZV08" minlength="1" maxlength="18" title="Ingresa una CURP valida), ¡Solo letras y números!" pattern="[A-Za-z0-9]{18,18}" onkeyup="javascript:this.value=this.value.toUpperCase();" >
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">RFC</label>
                <input type="text" id="NumRFCTra" name="NumRFC" class="form-control"  placeholder="Ejemplo: GADJ980623LH7" minlength="1" maxlength="13" title="Ingresa un número de seuro valido), ¡Solo letras y números!" pattern="[A-Za-z0-9]{12,13}" onkeyup="javascript:this.value=this.value.toUpperCase();">
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Dirección</label>
                <input type="textarea" id="DireccionETra" name="DireccionE" class="form-control"  placeholder="Ejemplo: Col.Aserradero, Calle: Ario, Numero: 213" minlength="5" maxlength="100" title="Ingresa una dirección" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ-0-9 ]{5,100}" required>       
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Tipo sanguineo</label>
                <select class="form-control" id="TipoSTra" name="TipoS">     
                  <option value="A">A</option> 
                  <option value="B">B</option> 
                  <option value="AB">AB</option>
                  <option value="O">O</option>
                  <option value="-O">-O</option> 
                  <option value="+O">+O</option>
                  <option value="-A">-A</option>
                  <option value="+A">+A</option>
                  <option value="-B">-B</option>
                  <option value="+B">+B</option>
                  <option value="-AB">-AB</option>
                  <option value="+AB">+AB</option>
                </select>        
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Alergias</label>
                <input type="text" id="NombreAlergiasTra" name="NombreAlergias" class="form-control"  placeholder="Ejemplo: Gatos, Paracetamol, etc." minlength="5" maxlength="150" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ0-9, ]{5,150}"title="Ingresa un texto válido (De entre 5 a 150 caracteres), ¡Solo letras, espacios y números!" required>    
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Donante</label>
                <select class="form-control" id="DonanteETra" name="DonanteE">     
                  <option value="Si">Si</option> 
                  <option value="No">No</option> 
                </select>        
              </div> 

            </div>
          </fieldset>
        </div>

        <div class="shadow p-3 mb-5 bg-white rounded" style="width: 100%;">
          <fieldset style="margin-top: 2%;">
            <legend>Datos de contacto</legend>

            <div class="form-row align-items-center">

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Número de telefono</label>
                <input type="text" id="NumTelefonEmpleadoTra" name="NumTelefonEmpleado" class="form-control"  placeholder="Ejemplo: 7532369845" minlength="10" maxlength="10" title="Ingresa un número de telefono (De 10 digitos), ¡Solo numeros!" pattern="[0-9]{10,10}" >
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Número de celular</label>
                <input type="text" id="NumCelularEmpleadoTra" name="NumCelularEmpleado" class="form-control"  placeholder="Ejemplo: 7538360915" minlength="10" maxlength="10" title="Ingresa un número de celular (De 10 digitos), ¡Solo numeros!" pattern="[0-9]{10,10}" >
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Correo eléctronico</label>
                <input type="email" id="CoreoEmpleadoTra" name="CoreoEmpleado" class="form-control"  placeholder="ejemplo2020@hotmail.com" minlength="8" maxlength="40" title="Ingresa un correo electronico, ¡ejemplo2020@hotmail.com!">
              </div>

            </div>
          </fieldset>
        </div>     


        <div class="shadow p-3 mb-5 bg-white rounded">
          <fieldset style="margin-top: 2%;">
            <legend>Otros datos</legend>
            <div class="form-row align-items-center">

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Número de trabajador</label>
                <input id="NumeroEmpleadoTra" type="text" name="NumeroEmpleado" class="form-control"  placeholder="Ejemplo: 86" minlength="1"maxlength="5" pattern="[0-9]{1,5}" title="¡Solo números!" > 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Categoría</label>
                <input type="text" id="NombreCatEmpleadoTra" name="NombreCatEmpleado" class="form-control"  placeholder="Ejemplo: Chofer" minlength="3" maxlength="100"  list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890. -]{2,100}" required>
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Rama</label>
                <select class="form-control" id="RamaEmpleTra" name="RamaEmple">     
                  <option value="Campo">Campo</option> 
                  <option value="Administrativo">Administrativo</option> 
                </select> 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label>Departamento</label>
                <select class="form-control" id="NombreDepEmpleadoTra" name="NombreDepEmpleado" required="">
                  <?php ListaOpciones("Nombre_Depto","departamentos");?> 
                </select>
              </div>  


              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Salario</label>
                <input id="SalarioEmpleadoTra" type="text" name="SalarioEmpleado" class="form-control"  placeholder="Ejemplo 455.50" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="¡Solo números!"> 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Fecha de ingreso al ayuntamiento</label>
                <input id="Fech_Ing_AyunETra" type="date" name="Fech_Ing_AyunE" class="form-control" title="¡Ingrese una fecha!"> 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Fecha de ingreso al sindicato</label>
                <input id="Fech_Ing_SinETra" type="date" name="Fech_Ing_SinE" class="form-control" title="¡Ingrese una fecha!"> 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Fecha de ingreso al departamento</label>
                <input id="Fech_Ing_DepETra" type="date" name="Fech_Ing_DepE" class="form-control" title="¡Ingrese una fecha!"> 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Fecha de asignación a la categoría</label>
                <input id="Fech_Ing_CatETra" type="date" name="Fech_Ing_CatE" class="form-control" title="¡Ingrese una fecha!"> 
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Situación</label>
                <select class="form-control" id="SituacionETra" name="SituacionE">  
                  <?php ListaOpciones("Nombre_Situacion","situacion");?>  
                </select>    
              </div>

              <!-- <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Cubre temporal</label>
                <select class="form-control" id="tallacb" name="CubreTempE">     
                  <option value="Si">Si</option> 
                  <option value="No">No</option> 
                </select>    
              </div> -->

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Cubre temporal</label>
                <input type="text" id="CubreTempETra" name="CubreTempE" class="form-control"  placeholder="Ejemplo: Chofer" minlength="3" maxlength="100"  list="ListaCategoria" title="Ingresa un nombre válido (De entre 3 a 100 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890. -]{2,100}" required>
              </div>


              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Cubre familiar</label>
                <select class="form-control" id="CubreFamETra" name="CubreFamE" >     
                  <option value="Si">Si</option> 
                  <option value="No">No</option> 
                </select>    
              </div>

              <div class="col-auto" style="margin-top: 2%;">
                <label for="exampleFormControlFile1">Observaciones</label>
                <textarea id="textareaObservacionesTra" name="textareaObservaciones" class="form-control"  placeholder="Observaciones"  minlength="3" maxlength="400" cols="10" title="Ingresa un texto válido (De entre 3 a 400 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{2,400}">Sin observaciones...</textarea>
              </div>

            </div>
          </fieldset>
        </div>

      </div>

      <div class="col-auto" style="margin-top: 2%;">
        <button type="submit" name="btnDardealta" class="btn btn-primary mb-2">Dar de alta</button>
        <!-- <input class="btn btn-primary mb-2" type="button" name="enviar" value="Dar de alta" onclick="
        RagistrarEmpleado(
          $('#NombreTra').val(),
          $('#Apellido1Tra').val(),
          $('#Apellido2Tra').val(),
          $('#EdadTra').val(),
          $('#TiposexoTra').val(),
          $('#NumIMSSETra').val(),
          $('#NumCURPTra').val(),
          $('#NumRFCTra').val(),
          $('#DireccionETra').val(),
          $('#TipoSTra').val(),
          $('#NombreAlergiasTra').val(),
          $('#DonanteETra').val(),
          $('#NumTelefonEmpleadoTra').val(),
          $('#NumCelularEmpleadoTra').val(),
          $('#CoreoEmpleadoTra').val(),
          $('#NumeroEmpleadoTra').val(),
          $('#NombreCatEmpleadoTra').val(),
          $('#RamaEmpleTra').val(),
          $('#NombreDepEmpleadoTra').val(),
          $('#SalarioEmpleadoTra').val(),
          $('#Fech_Ing_AyunETra').val(),
          $('#Fech_Ing_SinETra').val(),
          $('#Fech_Ing_DepETra').val(),
          $('#Fech_Ing_CatETra').val(),
          $('#SituacionETra').val(),
          $('#CubreTempETra').val(),
          $('#CubreFamETra').val(),
          $('#textareaObservacionesTra').val());"> -->
          <div id="resultado">Res</div>
        </div>

      </fieldset>
    </form>
  </div>
  <!---------------------------------------------------------------------------->

  <!--Lista Categorias-------------------------------------------------->
  <datalist id="ListaCategoria">
    <?php ListaOpciones("Nombre_Categoria","categorias");?>
  </datalist>
  <!---------------------------------------------------------------------------->

  <!-- Sección del modal---------------------------> 
  <div class="modal fade" id="Abrircontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="VistaAdminGen.php" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group"> 
              <label for="exampleInputPassword1" style="display: none;">Departamento seleccionado</label>
              <input type="text" name="NombreDeptoEntrar" class="form-control" id="txtNombrDepto" minlength="3" maxlength="50" placeholder="Nombre depto" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ ]{3,50}" title="Ingresa un nombre válido (De entre 8 a 50 caracteres), ¡Solo letras, espacios!" style="display: none;" required>

              <label for="exampleInputPassword1">Contraseña</label>
              <input type="password" name="contradep" class="form-control" id="txtPassword" minlength="8" maxlength="15" placeholder="Contraseña" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{8,15}" title="Ingresa una contraseña válida (De entre 8 a 15 caracteres), ¡Solo letras, espacios, guiones y números!" required >
              <br>
              <div style="width: 100%;" align="center">
               <button  id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
               <label>Mostrar/Ocultar contraseña</label>
             </div>
           </div>     
         </div>
         <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" name="btncontradep" class="btn btn-primary" value="Acceder">Entrar</button>
        </div>
      </form>
    </div>

    <?php  
    if(isset($_POST['btncontradep'])){

    //error_reporting(0);
    //echo "<script>alert('Bienvenido al  ');</script>";
    //include("EncriptarDesencriptar.php");

      $NomDeto = $_POST['NombreDeptoEntrar'];
      $pw = $_POST['contradep'];



      $ContraEncripTada = ED::Encriptar($pw);

      $contra = "";
      $tipouser="";
      $contador = 0;

      include("abrir_conexion_adm.php");

      $consulta = "SELECT Nombre_Depto,Contra_Depto FROM departamentos WHERE Nombre_Depto = '$NomDeto'";

      $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a Departamentos a la base de datos");



      while($datos1 = mysqli_fetch_array($dato)){

        $contra = $datos1['Contra_Depto'];
        $nomdepto = $datos1['Nombre_Depto'];

        $contador++;          

      }

      mysqli_close($conexionadm);

      if($contador != 0){
       // if($tipouser == "Admin"){
        if($contra == $ContraEncripTada){
        //session_start();
          $_SESSION['nom_depto']=$nomdepto;

        //echo "<script>alert('Bienvenido al ".$nomuser." ');</script>";
          echo "<script>location.href = 'VistaDepAdmin.php'; </script>";
        } else{
          echo "<script>alert('No has ingresado correctamente la contraseña');</script>";
        //echo "<script>location.href = 'VistaAdminGen.php'; </script>";
        }
       // } else{
      //echo "<script>alert('Sin permisos suficientes');</script>";
       // }
      }else{
        echo "<script>alert('Sin registros');</script>";
      }

    }
    ?>
  </div>
  <!------------------------------------------------------------>


</div>
</div>
<!--
<footer style="background: #2E4053; margin-top: 2%;" >...</footer>
-->
</body>
</html>

<script type="text/javascript">


  var select = document.querySelector("#item");

  select.addEventListener('change', capturarValor);

  function capturarValor(){
    var valor = select.value;

    switch (valor) {
        case '1': //Numero de trabajador
        MostrarFiltro("IDNumTraBus","IDDepBus","IDCatBus","IDFISBus","IDFIABus","IDFIDBus","IDFICBus","IDEscalafon","IDSitBus");
          /*document.getElementById('idbuscar').disabled = false;
          document.getElementById('itemdep').disabled = true;
          document.getElementById('itemcat').disabled = true;
          document.getElementById('fecha').disabled = true;*/

          break;

        case '2': //Departamento
        MostrarFiltro("IDDepBus","IDNumTraBus","IDCatBus","IDFISBus","IDFIABus","IDFIDBus","IDFICBus","IDEscalafon","IDSitBus");
          /*document.getElementById('idbuscar').disabled = true;
           document.getElementById('itemdep').disabled = true;
           document.getElementById('itemcat').disabled = true;
           document.getElementById('fecha').disabled = true;*/

           
           break;

        case '3': //Categoria
        MostrarFiltro("IDCatBus","IDNumTraBus","IDDepBus","IDFISBus","IDFIABus","IDFIDBus","IDFICBus","IDEscalafon","IDSitBus");
          /*document.getElementById('idbuscar').disabled = true;
          document.getElementById('itemdep').disabled = false;
          document.getElementById('itemcat').disabled = true;
          document.getElementById('fecha').disabled = true;*/

          
          break;

        case '4': //Fech_Ing_Ayun
        MostrarFiltro("IDFIABus","IDNumTraBus","IDDepBus","IDFISBus","IDCatBus","IDFIDBus","IDFICBus","IDEscalafon","IDSitBus");
           /*document.getElementById('idbuscar').disabled = true;
           document.getElementById('itemdep').disabled = true;
           document.getElementById('itemcat').disabled = false;
           document.getElementById('fecha').disabled = true;*/


           break;

        case '5': //Fech_Ing_Sind
        MostrarFiltro("IDFISBus","IDNumTraBus","IDDepBus","IDFIABus","IDCatBus","IDFIDBus","IDFICBus","IDEscalafon","IDSitBus");
          /*document.getElementById('idbuscar').disabled = true;
          document.getElementById('itemdep').disabled = true;
          document.getElementById('itemcat').disabled = true;
          document.getElementById('fecha').disabled = false;*/

          
          break;    

        case '6': //Fech_Ing_Dep
        MostrarFiltro("IDFIDBus","IDNumTraBus","IDDepBus","IDFIABus","IDCatBus","IDFISBus","IDFICBus","IDEscalafon","IDSitBus");
          //Declaraciones ejecutadas cuando el resultado de expresión coincide con valorN
          break;
          
        case '7': //Fech_Asig_Cat
        MostrarFiltro("IDFICBus","IDNumTraBus","IDDepBus","IDFIABus","IDCatBus","IDFISBus","IDFIDBus","IDEscalafon","IDSitBus");
          //Declaraciones ejecutadas cuando el resultado de expresión coincide con valorN


          break;
          
        case '8': //Escalafon
        MostrarFiltro("IDEscalafon","IDNumTraBus","IDDepBus","IDFIABus","IDCatBus","IDFISBus","IDFIDBus","IDFICBus","IDSitBus");

        MostrarFiltro("IDEscalafon","IDNumEmpRes","IDDeptoRes","IDCategoriaERes","IDFIARes","IDFISRes","IDFIDRes","IDFACRes","IDSitERes");

           //Declaraciones ejecutadas cuando el resultado de expresión coincide con valorN
           break; 

        case '9': //Fech_Ing_Dep
        MostrarFiltro("IDSitBus","IDNumTraBus","IDDepBus","IDFIABus","IDCatBus","IDFISBus","IDFICBus","IDEscalafon","IDFIDBus");
          //Declaraciones ejecutadas cuando el resultado de expresión coincide con valorN
          break;     
          default:
          //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
          break;
        }
      }

      function MostrarFiltro(IDMostrar,ID1,ID2,ID3,ID4,ID5,ID6,ID7,ID8){
        var contenedor = document.getElementById(IDMostrar);
        contenedor.style.display = "block";

        document.getElementById(ID1).style.display = "none";
        document.getElementById(ID2).style.display = "none";
        document.getElementById(ID3).style.display = "none";
        document.getElementById(ID4).style.display = "none";
        document.getElementById(ID5).style.display = "none";
        document.getElementById(ID6).style.display = "none";
        document.getElementById(ID7).style.display = "none";
        document.getElementById(ID8).style.display = "none";
      }   
 ///////////////////////////////////////////////////////////////////////////   

//Codigo para abrir el modal/////////////////////

$('#Abrircontra').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Entrar a ' + recipient)
  modal.find('.modal-body input').val(recipient)
})

////////////////////////////////////////////////


//Funcion para el mostrar la contraseña para entrar al departamento/////////////////////////
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

function mostrarPasswordEdicion(){
  var cambio = document.getElementById("txtPassworEditar");
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


//////////
function AblilitarDatosEmpleado(abilitar){
  if(abilitar == true){
    document.getElementById('altaempleado').disabled = false;
  }else{
    document.getElementById('altaempleado').disabled = true;
  }
  
}
//////////
function ilumina(NombreEmpleref) {
  location.href = 'VistaAdminGen.php';  
}
//////////

function MostrarBusDepReg(IDMostrar,ID1,ID2){
  var contenedor = document.getElementById(IDMostrar);
  contenedor.style.display = "block";

  document.getElementById(ID1).style.display = "none";
  document.getElementById(ID2).style.display = "none";

}   

/////////

//Mostrar/Ocultar  
function muestra_oculta(id){
    if (document.getElementById){ //se obtiene el id
    var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
    el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
  }
}

window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
  muestra_oculta('contenido');/* "contenido_a_mostrar" es el nombre que le dimos al DIV */
}
///////////////////

function EditarDPersonales(){
  MostrarEdicion("IDDatosPersonales","IDSeH","IDDContactos","IDDEscalafon","IDDUSER","IDDatosPade");
}

function EditarDSeH(){
  MostrarEdicion("IDSeH","IDDatosPersonales","IDDContactos","IDDEscalafon","IDDUSER","IDDatosPade");
}

function EditarDPadecimientos(){
  MostrarEdicion("IDDatosPade","IDSeH","IDDatosPersonales","IDDContactos","IDDEscalafon","IDDUSER");
    //location.href = "ConfigPadecimientos.php";
  }

  function EditarDContactos(){
    MostrarEdicion("IDDContactos","IDSeH","IDDatosPersonales","IDDEscalafon","IDDUSER","IDDatosPade");
  }

  function EditarDEscalafon(){
    MostrarEdicion("IDDEscalafon","IDDContactos","IDSeH","IDDatosPersonales","IDDUSER","IDDatosPade");
  }

  function EditarDUSER(){
    MostrarEdicion("IDDUSER","IDDEscalafon","IDDContactos","IDSeH","IDDatosPersonales","IDDatosPade");
  }

  function MostrarEdicion(IDMostrar,ID1,ID2,ID3,ID4,ID5){
    var contenedor = document.getElementById(IDMostrar);
    contenedor.style.display = "block";

    document.getElementById(ID1).style.display = "none";
    document.getElementById(ID2).style.display = "none";
    document.getElementById(ID3).style.display = "none";
    document.getElementById(ID4).style.display = "none";
    document.getElementById(ID5).style.display = "none";
  } 

</script>

<style type="text/css">
 .celda{
  background: ;
}

.celda:hover{
  background:  #464cb4;
}
</style>

<?php

function CalcularDias($Tiempo){
  $date1 = new DateTime($Tiempo);
  $hoy = date("yy-m-d");
  $date2 = new DateTime($hoy);
  $diff = $date1->diff($date2);
  // will output 2 days
  $dias = $diff->days;

  return $dias; 
} 

function ActuazlizarDato($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia){

  include("abrir_conexion_adm.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la actualización a la tabla $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

function ActuazlizarDatoUser($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$DatoGuia,$ColumnaGuia,$TipoUser){

  include("abrir_conexion_emp.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia' and Tipo_Usuario = '$TipoUser'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la actualización a la tabla $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

function ObtencionDato($Nombre,$Tabla, $Columna, $ColumnaBucar){

  $ID_Optenido = "";

  include("abrir_conexion_adm.php");

  $consulta = "SELECT $ColumnaBucar FROM $Tabla WHERE $Columna = '$Nombre'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la obtención de $ColumnaBuscar de la $Tabla de la base de datos");

  while($datos = mysqli_fetch_array($dato)){
    $ID_Optenido = $datos[$ColumnaBucar];
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

function RegistraNomPad($IDPersona,$NombrePade, $TiempoEvol){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
  include("abrir_conexion_adm.php");

  $consulta =  "INSERT INTO padecimientos (ID_Persona,Nombre_Padecimiento, Tiempo_Evolucion) VALUES ('$IDPersona', '$NombrePade', '$TiempoEvol')";

  mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro Padecimiento de la base de datos");

  mysqli_close($conexionadm);
} 

function RegistrarRopaAdministrativo($ID_Per,$TallaBlusa,$TallaPan, $Falda){
  include("abrir_conexion_adm.php");

  $consulta =  "INSERT INTO ropaadministrativo (ID_Persona,Talla_Camisa,Talla_Pantalon, Falda) VALUES ('$ID_Per', '$TallaBlusa', '$TallaPan', '$Falda')";

  mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro RopaAdministración a la base de datos");

  mysqli_close($conexionadm);
} 

function RegistrarRopaCampo($ID_Per,$TallaPla, $TallaCamisola,$TallaPan,$Short,$Mandil,$Bata, $TallaCal,$TipoCal){
  include("abrir_conexion_adm.php");

  $consulta =  "INSERT INTO ropacampo (ID_Persona, Talla_Playera,Talla_Camisola,Talla_Pantalon, Short, Mandil, Bata, Talla_Calzado, Tipo_Calzado) VALUES ('$ID_Per', '$TallaPla', '$TallaCamisola', '$TallaPan', '$Short','$Mandil','$Bata','$TallaCal', '$TipoCal')";

  mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro RopaCampo a la base de datos");

  mysqli_close($conexionadm);
} 

function EliminarDato($Tabla,$DatoGuia,$ColumnaGuia,$IDPer){

  include("abrir_conexion_adm.php");

  $consulta = "DELETE FROM $Tabla WHERE $ColumnaGuia = '$DatoGuia' AND ID_Persona = '$IDPer'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  mysqli_close($conexionadm);
}


function ActuazlizarDatoPad($DatoAcualizar,$Tabla, $ColumnaDatoActuazliar,$ColumnaGuia,$DatoGuia,$DatoGuia1,$ColumnaGuia1){

  //echo "<script>alert('$DatoGuia1, $ColumnaGuia1');</script>";

  include("abrir_conexion_adm.php");

  $consulta = "UPDATE $Tabla SET $ColumnaDatoActuazliar = '$DatoAcualizar' WHERE $ColumnaGuia = '$DatoGuia' AND $ColumnaGuia1 = '$DatoGuia1'";

  $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

  mysqli_close($conexionadm);
}

if(isset($_POST['subir'])){

  $numtrareg = $_SESSION['numtrareg'];
  $Subido = 0;

  $ruta = "imgfotoperfil/";
  $fichero = $ruta.basename($_FILES['imagen']['name']);

  $info = new SplFileInfo($fichero);

  $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

  if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta.$numtrareg.".".$extension)){
    $Subido = 1; 
  }

  //$_SESSION['Extencion'] = $extension;

  $rutaC = "imgfotoperfil/".$numtrareg.".".$extension;

  include("abrir_conexion_adm.php");

  $consulta =  "UPDATE personas, empleados SET Link_Foto = '$rutaC' WHERE personas.ID_Persona = empleados.ID_Persona AND Num_Emple = '$numtrareg'";

  mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta ACTUALIZAR Foto a la base de datos");

  if ($Subido != 0) {
    echo "<script>alert('Actualizacion de foto EXITOSA');</script>";   
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaAdminGen.php'>";

  }
  
  mysqli_close($conexionadm);
}

function Consuta($NombreCampo, $DatoBuscar){
  $Encontardo = false;
  $DatoOptenido = ""; 


  include("abrir_conexion_adm.php");

  $consulta1 = "SELECT $NombreCampo FROM empleados WHERE $NombreCampo = '$DatoBuscar'";

  $dato1 = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en la consulta1 a la base de datos");

  while($datos1 = mysqli_fetch_array($dato1)){
    $DatoOptenido = AjustarTexto($datos1[$NombreCampo]);
  }   

      //echo "<script>alert('$NombreCampo, Se obtine: $DatoOptenido, $DatoBuscar');</script>";   

  mysqli_close($conexionadm);      

  if($DatoBuscar == $DatoOptenido){
    $Encontardo = true;
  }

  return $Encontardo;
}

function Consuta2($NombreCampo,$Tabla,$ID,$DatoBuscar){
  $Encontardo = false;
  $DatoOptenido = ""; 

  include("abrir_conexion_adm.php");

  $consulta1 = "SELECT $NombreCampo FROM empleados,$Tabla WHERE $NombreCampo = '$DatoBuscar' AND empleados.$ID = '$Tabla.$ID'";

  $dato1 = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en la consulta1 a la base de datos");

  while($datos1 = mysqli_fetch_array($dato1)){
    $DatoOptenido = AjustarTexto($datos1[$NombreCampo]);
  }   

  mysqli_close($conexionadm);      

  if($DatoBuscar == $DatoOptenido){
    $Encontardo = true;
  }

  echo "<script>alert('$Encontardo, $DatoBuscar, $DatoOptenido');</script>";

  return $Encontardo;
}
/////////////////////////////////////////////////////////


///////////////////////
function ResultadosBusqueda($TipoBusqueda,$DatoBuscarI,$DatoBuscarF){

  include("abrir_conexion_adm.php");

  echo "
  <div class='table-responsive' style='height: 350px;'> 
  <center><table class='table table-hover'>
  <thead class='thead-dark' >
  <tr>
  <th scope='col'>#</th>
  <th scope='col'>NumTrabajador</th>
  <th scope='col'>Nombre</th>
  <th scope='col'>Categoría</th>
  <th scope='col'>Salario</th>
  <th scope='col'>Departamento</th>
  <th scope='col'>Fech_Ing_Ayun</th>
  <th scope='col'>Fech_Ing_Sind</th>
  <th scope='col'>Fech_Ing_Dep</th>
  <th scope='col'>Fech_Asig_Cat</th>
  <th scope='col'>Situación</th>
  <th scope='col'>CubreTemp</th>
  <th scope='col'>CubreFam</th>
  </tr>
  </thead>
  ";

  switch ($TipoBusqueda) {
    case 1: //Numero de trabajador
     //echo "<script>alert('Resultado numtra');</script>";
   //  $consulta3 = "SELECT Num_Emple, Nombre, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND Num_Emple = '$DatoBuscarI'";

   //  $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");
   //  $NumEmpleadoEncontrado = "";
   //  $uno = 1;
   //  while($datos1 = mysqli_fetch_array($dato1)){
   //   $NumEmpleadoEncontrado = AjustarTexto($datos1['Num_Emple']);
   //   //onclick='ilumina()'

   //   echo "
   //   <tbody>
   //   <tr >
   //   <th scope='row'>".$uno++."</th>
   //   <td>".AjustarTexto($datos1['Num_Emple'])."</td>
   //   <td>".AjustarTexto($datos1['Nombre'])."</td>
   //   <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
   //   <td>$".AjustarTexto($datos1['Salario'])."</td>
   //   <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
   //   <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
   //   <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
   //   <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
   //   <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
   //   <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
   //   <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
   //   <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>              
   //   </tr>
   //   </tbody>     
   //   "; 

   // }      
   //    //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
    echo "</table></center></div>";          

    return $NumEmpleadoEncontrado;
    break;

     case 2: //Departamento

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND Nombre_Depto = '$DatoBuscarI' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta con dep a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
       $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

       echo "
       <tbody>
       <tr>
       <th scope='row'>".$uno++."</th>
       <td>".AjustarTexto($datos1['Num_Emple'])."</td>
       <td>".$NombreCompleto."</td>
       <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
       <td>$".AjustarTexto($datos1['Salario'])."</td>
       <td style='background: #EAEDED;'>".AjustarTexto($datos1['Nombre_Depto'])."</td>
       <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
       <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
       <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
       <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>
       </tr>
       </tbody>
       ";            
     }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
     echo "</table></center></div>";  

     break;

     case 3: //Categoria

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario, Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND Nombre_Categoria = '$DatoBuscarI' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";


     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
       $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

       echo "
       <tbody>
       <tr>
       <th scope='row'>".$uno++."</th>
       <td>".AjustarTexto($datos1['Num_Emple'])."</td>
       <td>".$NombreCompleto."</td>
       <td style='background: #EAEDED;'>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
       <td>$".AjustarTexto($datos1['Salario'])."</td>
       <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
       <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
       <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
       <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
       <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>
       </tr>
       </tbody>
       ";            
     }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
     echo "</table></center></div>";   

     break;

     case 4: //Fech_Ing_Ayun SELECT * FROM COMISION where (tu_campo_fecha) BETWEEN '2016-10-01' AND '2016-10-31'

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND (Fech_Ingre_Ayunt) BETWEEN '$DatoBuscarI' AND '$DatoBuscarF' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
      $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

      echo "
      <tbody>
      <tr >
      <th scope='row'>".$uno++."</th>
      <td>".AjustarTexto($datos1['Num_Emple'])."</td>
      <td>".$NombreCompleto."</td>
      <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
      <td>$".AjustarTexto($datos1['Salario'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
      <td style='background: #EAEDED;'>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
      <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
      <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>              
      </tr>
      </tbody>
      ";            
    }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
    echo "</table></center></div>";  

    break;

     case 5: //Fech_Ing_Sind

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND (Fecha_Ingre_Sind) BETWEEN '$DatoBuscarI' AND '$DatoBuscarF' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
      $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

      echo "
      <tbody>
      <tr>
      <th scope='row'>".$uno++."</th>
      <td>".AjustarTexto($datos1['Num_Emple'])."</td>
      <td>".$NombreCompleto."</td>
      <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
      <td>$".AjustarTexto($datos1['Salario'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
      <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
      <td style='background: #EAEDED;'>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
      <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
      <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>              
      </tr>
      </tbody>
      ";            
    }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
    echo "</table></center></div>";   

    break;    

     case 6: //Fech_Ing_Dep

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND (Fecha_Ingre_Dep) BETWEEN '$DatoBuscarI' AND '$DatoBuscarF' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
      $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

      echo "
      <tbody>
      <tr>
      <th scope='row'>".$uno++."</th>
      <td>".AjustarTexto($datos1['Num_Emple'])."</td>
      <td>".$NombreCompleto."</td>
      <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
      <td>$".AjustarTexto($datos1['Salario'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
      <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
      <td style='background: #EAEDED;'>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
      <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
      <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>              
      </tr>
      </tbody>
      ";            
    }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
    echo "</table></center></div>"; 
    break;

     case 7: //Fech_Asig_Cat

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND (Fecha_Asig_Cat) BETWEEN '$DatoBuscarI' AND '$DatoBuscarF' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
       $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

       echo "
       <tbody>
       <tr>
       <th scope='row'>".$uno++."</th>
       <td>".AjustarTexto($datos1['Num_Emple'])."</td>
       <td>".$NombreCompleto."</td>
       <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
       <td>$".AjustarTexto($datos1['Salario'])."</td>
       <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
       <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
       <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
       <td style='background: #EAEDED;'>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
       <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
       <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
       <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>              
       </tr>
       </tbody>
       ";            
     }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
     echo "</table></center></div>"; 
     break;

     case 8: //Escalafon

     $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

     /*order by Fecha_Ingre_Sind asc*/

     $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

     $uno = 1;
     while($datos1 = mysqli_fetch_array($dato1)){
      $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);
      echo "
      <tbody>
      <tr>
      <th scope='row'>".$uno++."</th>
      <td>".AjustarTexto($datos1['Num_Emple'])."</td>
      <td>".$NombreCompleto."</td>
      <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
      <td>$".AjustarTexto($datos1['Salario'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
      <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
      <td style='background: #EAEDED;'>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
      <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
      <td>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
      <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
      <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>              
      </tr>
      </tbody>
      ";            
    }      

    echo "</table></center></div>";
    break;

    case 9: //Situacion

    $consulta3 = "SELECT Num_Emple, Nombre,ApellidoP,ApellidoM, Salario,Nombre_Categoria, Nombre_Depto, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, Nombre_Situacion,Cubre_Fam_Temp, Nombre_TemCat  FROM personas,empleados,categorias,departamentos,situacion, cubre_tem WHERE empleados.ID_Persona = personas.ID_Persona AND empleados.ID_Categoria = categorias.ID_Categoria AND empleados.ID_Departamento = departamentos.ID_Departamento AND empleados.ID_Situacion = situacion.ID_Situacion AND empleados.ID_CubreTemp = cubre_tem.ID_CubreTemp AND Nombre_Situacion = '$DatoBuscarI' order by Fecha_Ingre_Sind, empleados.ID_Empleado asc";

    $dato1 = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta1 a la base de datos");

    $uno = 1;
    while($datos1 = mysqli_fetch_array($dato1)){
     $NombreCompleto = AjustarTexto($datos1['Nombre'])." ".AjustarTexto($datos1['ApellidoP'])." ".AjustarTexto($datos1['ApellidoM']);

     echo "
     <tbody>
     <tr>
     <th scope='row'>".$uno++."</th>
     <td>".AjustarTexto($datos1['Num_Emple'])."</td>
     <td>".$NombreCompleto."</td>
     <td>".AjustarTexto($datos1['Nombre_Categoria'])."</td>
     <td>$".AjustarTexto($datos1['Salario'])."</td>
     <td>".AjustarTexto($datos1['Nombre_Depto'])."</td>
     <td>".AjustarTexto($datos1['Fech_Ingre_Ayunt'])."</td>
     <td>".AjustarTexto($datos1['Fecha_Ingre_Sind'])."</td>
     <td>".AjustarTexto($datos1['Fecha_Ingre_Dep'])."</td>
     <td>".AjustarTexto($datos1['Fecha_Asig_Cat'])."</td>
     <td style='background: #EAEDED;'>".AjustarTexto($datos1['Nombre_Situacion'])."</td>
     <td>".AjustarTexto($datos1['Nombre_TemCat'])."</td>
     <td>".AjustarTexto($datos1['Cubre_Fam_Temp'])."</td>
     </tr>
     </tbody>
     ";            
   }      
      //echo "<a href='ubialitas.php'>".$datos['Nombre_de_Establecimiento' ]."</a><br>";
   echo "</table></center></div>";   

   break;  

   default:
          //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
   break;
 }

 mysqli_close($conexionadm); 

}
//////////////////////


//////////////////////////////////////////////////
function ListaOpciones($NombreOpcion,$Tabla){
  include("abrir_conexion_adm.php");

  $ConsultaOpcion = "SELECT $NombreOpcion FROM $Tabla";

  $dato1 = mysqli_query($conexionadm, $ConsultaOpcion) or die("Algo ha ido mal en la ConsultaOpciones a la base de datos");

  while($datos1 = mysqli_fetch_array($dato1)){
    echo "<option value='".AjustarTexto($datos1[$NombreOpcion])."'>".AjustarTexto($datos1[$NombreOpcion])."</option>";
  }

  mysqli_close($conexionadm);                                      
}
//////////////////////////////////////////////////

///////////////////
function AjustarTexto($Texto){
  $NuevoTexo = $Texto;
  //$NuevoTexo = utf8_encode($Texto);
  utf8_decode($NuevoTexo);
  return $NuevoTexo;
}
//////////////////

///////////////////

function ObtenerDatos($numtrareg){
  include("abrir_conexion_adm.php");

  //$numtrareg = $_SESSION['numtrareg'];
  $_SESSION ['numtrareg'] = $numtrareg;
  
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
    $ID_CatCubreTemp =  $fila ['ID_CubreTemp'];
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
   /// $_SESSION['Cubre_Temp_Def']= $fila ['Cubre_Temp_Def'];
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
  $_SESSION['Nombre_Situacion'] = "";
  while ($fila =mysqli_fetch_array($datos)){
    $_SESSION['Nombre_Situacion']= $fila ['Nombre_Situacion'];;
  }

//Datos de usuario
  $consulta = "SELECT Nom_Usuario, Password,Tipo_Usuario FROM empleados,usuarios WHERE Num_Emple = '$numtrareg' AND empleados.ID_Empleado = usuarios.ID_Empleado";

  $datos = mysqli_query($conexionadm, $consulta);
  $_SESSION['Nom_Usuario'] = "Sin usuario";
  $_SESSION['Password'] = "";
  while ($fila = mysqli_fetch_array($datos)){

    $_SESSION['Nom_Usuario']= $fila ['Nom_Usuario'];
    $_SESSION['Password']= $fila ['Password'];
    $_SESSION['TipoUser']= $fila['Tipo_Usuario'];

  }

  mysqli_close($conexionadm);

}

function MostrarInformacion(){

  include("EncriptarDesencriptar.php");

  //$Clave = ED::Desencritar($_SESSION['Password']);

  echo "
  <div class='table-responsive' style='height: 400px; overflow: scroll;'> 
  <center>
  <table class='table table-hover'>
  <thead class='thead-dark'>
  <tr>
  <th scope='col' colspan='2'>Datos personales <leable type='button' onclick='EditarDPersonales()'> <a href='#SDP'>[Editar]</a></leable></th>
  </tr>
  </thead>
  <tbody>

  <tr>
  <th scope='row'>Nombre</th>
  <td>".$_SESSION['NombreC']."</td>
  </tr>

  <tr>
  <th scope='row'>Numero de trabajador</th>
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
  <th scope='col' colspan='2'>Seguridad e higiene  <leable type='button' onclick='EditarDSeH()'><a href='#SDSH'>[Editar]</a></leable</th>
  </tr>
  </thead>

  <tr>
  <th scope='row'>Número de de seguridad social</th>
  <td>".$_SESSION['Numero_IMSS']."</td>
  </tr>";

  if($_SESSION['Rama'] == "Campo"){
    echo "
    <tr>
    <th scope='row'>Talla playera</th>
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
  <th scope='row'>Tipo sanguineo</th>
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
  <th scope='col' colspan='2'>Padecimientos <leable type='button' onclick='EditarDPadecimientos()'><a href='#SDPA'>[Editar]</a></leable</th>
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
  <th scope='row'>Número de telefono</th>
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
  <th scope='col' colspan='2'>Datos de escalafon  <leable type='button' onclick='EditarDEscalafon()'><a href='#SDEC'>[Editar]</a></leable</th>
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

?>



