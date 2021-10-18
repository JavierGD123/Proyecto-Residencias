<?php
/*$Cotra = "Mamapopo";
include("EncriptarDesencriptar.php");
for ($i=1; $i <= 14 ; $i++) { 
  $ContraEnc = $Cotra.$i;
  echo "$ContraEnc <br>";
  echo ED::Encriptar($ContraEnc);
  echo "<br>";
}*/
//Usuario Admin/////////////////////////////////////////////////
if(isset($_POST['btnadm'])){

  $url = "/PaginaProRecidencias/";

  include("EncriptarDesencriptar.php");

  $user =  $_POST['usuario'];
  $pw = $_POST['contra'];

  
  $ContraEncripTada = ED::Encriptar($pw);
  $userEncriptado = ED::Encriptar($user);

  $nomuser = "";
  $contra = "";
  $tipouser="";
  $contador = 0;

  include("abrir_conexion_adm.php");

  $consulta1 = "SELECT ID_Empleado,Nom_Usuario,Tipo_Usuario, Password FROM usuarios WHERE Nom_Usuario = '$user'";

  $dato1 = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en la usuarios a la base de datos");

  while($datos1 = mysqli_fetch_array($dato1)){
   
    $nomuser = $datos1['Nom_Usuario'];
    $tipouser = $datos1['Tipo_Usuario'];
    $contra = $datos1['Password'];
    $idEmpelado = $datos1['ID_Empleado'];

    $contador++;          
    
  }
  
  mysqli_close($conexionadm);

  //echo "<script>alert('$contra');</script>";

  if($contador != 0){


    if($tipouser == "Admin"){

      Ingresar($nomuser,$userEncriptado,$contra,$ContraEncripTada,$url."VistaAdminGen.php",$idEmpelado,$tipouser);
      
    }  

    if($tipouser == "SecreTrabajo"){

      Ingresar($nomuser,$userEncriptado,$contra,$ContraEncripTada,$url."SecreGeneral.php",$idEmpelado,$tipouser);
      
    }  

    if($tipouser == "SecreGeneral"){

      Ingresar($nomuser,$userEncriptado,$contra,$ContraEncripTada,$url."SecreGeneral.php",$idEmpelado,$tipouser);
      
    }  

    if($tipouser == "SecreHigiene"){

      Ingresar($nomuser,$userEncriptado,$contra,$ContraEncripTada,$url."SecreHigiene.php",$idEmpelado,$tipouser);
      
    }  


    if($tipouser == "Normal"){

      Ingresar($nomuser,$userEncriptado,$contra,$ContraEncripTada,$url."VistaEmpleadoPerfil.php",$idEmpelado,$tipouser);
    }


  }else{
     echo "<script>alert('No has ingresado correctamente los datos');</script>";
     echo "<script>location.href = '".$url."index.html'; </script>";
  }
  
}

function Ingresar($nomuser,$userEncriptado,$contra,$ContraEncripTada,$Link,$idEmpelado,$tipouser){

  if(ED::Encriptar($nomuser) == $userEncriptado && $contra == $ContraEncripTada ){
    

    include("abrir_conexion_adm.php");

    $consulta1 = "SELECT Num_Emple FROM empleados WHERE ID_Empleado = '$idEmpelado'";

    $dato1 = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en tabala empleados a la base de datos");
    $NumEmple = "";
    while($datos1 = mysqli_fetch_array($dato1)){         
      $NumEmple = $datos1['Num_Emple'];             
    }
    
    mysqli_close($conexionadm);

    session_start();
    $_SESSION['numtrareg']=$NumEmple;
    $_SESSION['tipouserreg']=$tipouser;

    if($tipouser == "Normal"){
      $_SESSION['iduserregperfil'] = $idEmpelado;
    }else{
      $_SESSION['iduserreg'] = $idEmpelado;
    }
    
    echo "<script>alert('Bienvenido ".$nomuser." ');</script>";
    echo "<script>location.href = '$Link'; </script>";
    
  } else{
    
    echo "<script>alert('No has ingresado correctamente los datos');</script>";
    echo "<script>location.href = '/PaginaProRecidencias/index.html'; </script>";
  }
}

?>