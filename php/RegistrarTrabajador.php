<?php
session_start();
if(!isset($_SESSION['iduserreg'])){
  header("location:index.html");
}


if(isset($_POST['btnDardealta'])){

    //error_reporting(0);
    $url = "/PaginaProRecidencias/"; 
    //$imgperfil = $_POST['imgperfil'];
    $Nombre = $_POST['NombreEmpleado'];
    $ApellidoP = $_POST['ApellidoPEmpleado'];
    $ApellidoM = $_POST['ApellidoMEmpleado'];
    $Edad = $_POST['Edadmpleado'];
    $Sexo = $_POST['TipoSexo'];
    $NumImss = $_POST['NumIMSSE'];
    $NumCURP = $_POST['NumCURP'];
    $NumRFC = $_POST['NumRFC'];
    $Direccion = $_POST['DireccionE'];
    $TS = $_POST['TipoS'];
    $Alergias = $_POST['NombreAlergias'];
    $Donante = $_POST['DonanteE'];

    $NumTel = $_POST['NumTelefonEmpleado'];
    $NumCel = $_POST['NumCelularEmpleado'];
    $Email = $_POST['CoreoEmpleado'];

    $NumeroE = $_POST['NumeroEmpleado'];
    $Categoria = $_POST['NombreCatEmpleado'];
    $Rama = $_POST['RamaEmple'];
    $NomDepto = $_POST['NombreDepEmpleado'];
    $Salario = $_POST['SalarioEmpleado'];
    $Fech_Ing_Ayun = $_POST['Fech_Ing_AyunE'];
    $Fech_Ing_Sin = $_POST['Fech_Ing_SinE'];
    $Fech_Ing_Dep = $_POST['Fech_Ing_DepE'];
    $Fech_Ing_Cat = $_POST['Fech_Ing_CatE'];
    $Situacion = $_POST['SituacionE'];
    $CubreTemp = $_POST['CubreTempE'];
    $CubreFam = $_POST['CubreFamE'];
    $Observaciones = $_POST['textareaObservaciones'];

    /*echo "Dato1 ".$Nombre."<br>";
    echo "Dato1 ".$ApellidoP."<br>";
    echo "Dato1 ".$ApellidoM."<br>";
    echo "Dato1 ".$Edad."<br>";
    echo "Dato1 ".$NumImss."<br>";
    echo "Dato1 ".$Direccion."<br>";
    echo "Dato1 ".$TS."<br>";
    echo "Dato1 ".$Alergias."<br>";     
    echo "<br>Dato1 ".$Donante."<br>";

    echo "Dato1 ".$NumTel."<br>";
    echo "Dato1 ".$NumCel."<br>";
    echo "Dato1 ".$Email."<br>";

    echo "Numero empleado: ".$NumeroE."<br>";
    echo "Dato1 ".$Categoria."<br>";
    echo "Dato1 ".$Rama."<br>";
    echo "Dato1 ".$Salario."<br>";
    echo "Dato1 ".$Fech_Ing_Ayun."<br>";
    echo "Dato1 ".$Fech_Ing_Sin."<br>";
    echo "Dato1 ".$Fech_Ing_Dep."<br>";
    echo "Dato1 ".$Fech_Ing_Cat."<br>";
    echo "Dato1 ".$Situacion."<br>";
    echo "Dato1 ".$CubreTemp."<br>";*/

    //Validacion de la existencia de algun numero de empleado
    $NumEmp = ObtencionId($NumeroE,"empleados", "Num_Emple");
    //echo "NumEmp: $NumEmp<br>";
    //Validacion de la existencia de imss en la base de datos
    $Numimss = ObtencionId($NumImss,"personas", "Numero_IMSS");
    // "NumImss: $Numimss<br>";
    //Validacion de la existencia del numero telefo de la base de datos
    $Numtelefono = ObtencionId($NumTel,"contactos", "Num_Telefono");
    //echo "NumTel: $Numtelefono<br>";
    //Validacion de la existencia dl numero celular de la base de datos
    $Numcelular = ObtencionId($NumCel,"contactos", "Num_Celular");
    //echo "NumCel: $Numcelular<br>";
     //Validacion de la existencia del email de la base de datos
    $Numemail = ObtencionId($Email,"contactos", "Correo");
    //echo "Email: $Numemail<br>";

    //Validaddo datos existentes
    if($NumEmp != $NumeroE){

        if($Numimss != $NumImss){

            if($Numtelefono != $NumTel){

                if($Numcelular != $NumCel){

                    if($Email != $Numemail){

                       //$ID_Per = RegistraDatosPersona($Nombre,$ApellidoP,$ApellidoM,$Edad,$NumImss,$Direccion,$TallaCal,$TalCam,$TallaPan,$TS,$Donante);

                       $ID_Per = RegistraDatosPersona($Nombre,$ApellidoP,$ApellidoM,$Edad, $Sexo,$NumImss, $NumCURP,$NumRFC, $Direccion,$TS,$Donante,$Alergias);
                        
                        //Obtenemos el id de persona en base al IMSS existente ya registrado

                        RegistarDatosContacto($ID_Per,$NumTel,$NumCel,$Email);

                        //Registramos al empleado
                        RegistrarDatosEmpleados($ID_Per,$NumeroE,$Salario,$Categoria, $Rama, $NomDepto, $Fech_Ing_Ayun, $Fech_Ing_Sin, $Fech_Ing_Dep, $Fech_Ing_Cat, $Situacion, $CubreFam, $CubreTemp,$Observaciones);

                        if ($Rama == "Campo") {
                           RegistrarRopaCampo($ID_Per,"ST", "0","0","0","Unitalla","0", "ST","ST");
                        }else{
                            RegistrarRopaAdministrativo($ID_Per,"ST","0","0");
                        }

                         echo "<script>alert('**DATOS REGISTRADOS EXITOSAMENTE**');</script>";
                         echo "<script>location.href = '".$url."VistaAdminGen.php'; </script>";
                    }else{
                        echo "<script>alert('**Dirección de correo: Existente**');</script>";
                    }

                }else{
                    echo "<script>alert('**Número de celular: Existente**');</script>";
                }

            }else{
                echo "<script>alert('**Número de Telefono: Existente**');</script>";
            }
            
        }else{
             echo "<script>alert('**Número de IMSS: Existente**');</script>";
        }

    }else {
        echo "<script>alert('**Número de empleado: Existente**');</script>";
    }

    echo "<script>location.href = '".$url."VistaAdminGen.php'; </script>";
         
}

function ObtencionId($Nombre,$Tabla, $Columna){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);
    $ID_Optenido = "";

    include("abrir_conexion_adm.php");

    $consulta = "SELECT $Columna FROM $Tabla WHERE $Columna = '$Nombre'";
           
    $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a $Tabla de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $ID_Optenido = $datos[$Columna];
    }

    mysqli_close($conexionadm);

    if($ID_Optenido == ""){
        $ID_Optenido = "Disponible ".$Nombre;
    }

    return $ID_Optenido;
  } 


function RegistraDatosPersona($Nombre,$ApellidoP,$ApellidoM,$Edad, $Sexo,$NumImss, $CURP,$RFC,$Direccion,$TS,$Donante,$Alergias){
    //$contracifrada = password_hash($contra,PASSWORD_DEFAULT);

    include("abrir_conexion_adm.php");

    $consulta =  "
        INSERT INTO personas (
        Nombre, ApellidoP, ApellidoM, Edad, Sexo,Numero_IMSS,Curp,Rfc,Direccion,Tipo_Sangre,Donante,Alergias, Link_Foto) 
        VALUES (
          '$Nombre','$ApellidoP','$ApellidoM','$Edad','$Sexo','$NumImss','$CURP','$RFC','$Direccion','$TS','$Donante','$Alergias', 'imgfotoperfil/empleado.jpg')";

    mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro persona de la base de datos");

    $consulta = "SELECT ID_Persona FROM personas WHERE Numero_IMSS = '$NumImss'";
           
    $dato = mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta a Personas de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $ID_Optenido = $datos['ID_Persona'];
    }

     mysqli_close($conexionadm);

     //$ID_Optenido = ObtencionId($NumImss,"Personas", "ID_Persona");

     return $ID_Optenido;
} 

function RegistrarRopaAdministrativo($ID_Per,$TallaBlusa,$TallaPan, $Falda){
    include("abrir_conexion_adm.php");

    $consulta =  "INSERT INTO ropaadministrativo (ID_Persona,Talla_Camisa,Talla_Pantalon,Falda) VALUES ('$ID_Per', '$TallaBlusa', '$TallaPan', '$Falda')";

    mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro RopaAdministración a la base de datos");

    mysqli_close($conexionadm);
} 

function RegistrarRopaCampo($ID_Per,$TallaPla, $TallaCamisola,$TallaPan,$Short,$Mandil,$Bata, $TallaCal,$TipoCal){
    include("abrir_conexion_adm.php");

    $consulta =  "INSERT INTO ropacampo (ID_Persona, Talla_Playera,Talla_Camisola,Talla_Pantalon, Short, Mandil, Bata, Talla_Calzado, Tipo_Calzado) VALUES ('$ID_Per', '$TallaPla', '$TallaCamisola', '$TallaPan', '$Short','$Mandil','$Bata','$TallaCal', '$TipoCal')";

    mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro RopaCampo a la base de datos");

     mysqli_close($conexionadm);
} 


function RegistrarDatosEmpleados($ID_Per,$NumEmp,$Salario,$NomCat,$Rama, $NomDep, $FIA, $FIS, $FID, $FAC, $NomSit, $CFT, $CTD,$Observaciones){

    $IDCat = "";
    $IDCatCubreTem = "";
    $IDDep = "";
    $IDSit = "";

    include("abrir_conexion_adm.php");

     //Obtenemos el id de la categoria seleccionada para nombre categoria
    $consulta1 = "SELECT ID_Categoria FROM categorias WHERE Nombre_Categoria = '$NomCat'";
           
    $dato = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en la consulta a Categoarias de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $IDCat = $datos['ID_Categoria'];
    }

     //Obtenemos el id del departameto seleccionado
    $consulta2 = "SELECT ID_Departamento FROM departamentos WHERE Nombre_Depto = '$NomDep'";
           
    $dato = mysqli_query($conexionadm, $consulta2) or die("Algo ha ido mal en la consulta a Departamentos de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $IDDep = $datos['ID_Departamento'];
    }

    //Obtenemos el id de la situación seleccionada
    $consulta3 = "SELECT ID_Situacion FROM situacion WHERE Nombre_Situacion = '$NomSit'";
           
    $dato = mysqli_query($conexionadm, $consulta3) or die("Algo ha ido mal en la consulta a Situacion de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $IDSit = $datos['ID_Situacion'];
    }

    //Obtenemos el id de la categoria seleccionada para cubre temporal
    $consulta1 = "SELECT ID_Categoria FROM categorias WHERE Nombre_Categoria = '$CTD'";
           
    $dato = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en la consulta a Categoarias2 de la base de datos");

    while($datos = mysqli_fetch_array($dato)){
        $IDCatCubreTem = $datos['ID_Categoria'];
    }  

    $consulta =  "INSERT INTO empleados (ID_Persona,Num_Emple,Salario,ID_Categoria,Rama,ID_Departamento, Fech_Ingre_Ayunt, Fecha_Ingre_Sind, Fecha_Ingre_Dep, Fecha_Asig_Cat, ID_Situacion, Cubre_Fam_Temp, Cubre_Temp_Def,Observaciones) 
    VALUES ('$ID_Per','$NumEmp','$Salario','$IDCat','$Rama','$IDDep','$FIA','$FIS','$FID','$FAC','$IDSit','$CFT','$IDCatCubreTem','$Observaciones')";

    mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la registro empleado a la base de datos");

     mysqli_close($conexionadm);
}


function RegistarDatosContacto($ID_Persona,$NumTel,$NumCel, $Email){
     include("abrir_conexion_adm.php");

    $consulta =  "INSERT INTO contactos (ID_Persona, Num_Telefono, Num_Celular, Correo) VALUES ('$ID_Persona', '$NumTel', '$NumCel', '$Email')";

    mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta registro contacto a la base de datos");

     mysqli_close($conexionadm);
}

?>
 

