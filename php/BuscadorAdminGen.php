<?php

if(isset($_POST['btncontradep'])){

    $pw = $_POST['contradep'];

    $pw = md5($pw);

    $contra = "";

    $contador = 0;

    include("abrir_conexion_dep.php");

    $consulta1 = "SELECT Empleado.ID_Tra, Num_Tra, Nom_Emple, Nom_Usuario, Password, ID_Usuario FROM Empleado,Deppartamento WHERE Empleado.ID_Tra = Usuario.ID_Tra";

    $dato1 = mysqli_query($conexiondep, $consulta1) or die("Algo ha ido mal en la consulta1 a la base de datos");

        while($datos1 = mysqli_fetch_array($dato1)){
          
          $contra = $datos1['Password'];
         
        }
    
    mysqli_close($conexiondep);

    if(md5($nomuser) == $user && md5($contra) == $pw /*| md5($numtra) == $user && md5($contra) == $pw */){
      session_start();
      $_SESSION['idtrareg']=$idtra;
      $_SESSION['iduserreg']=$iduser;
      $_SESSION['nomEmpleadoreg']=$nomemple;
      
      echo "<script>alert('Bienvenido ".$nomemple." ');</script>";

      echo "<script>location.href = '/PaginaProRecidencias/VistaEmpleado.php'; </script>";
    }else{
        echo "<script>alert('No has ingresado correctamente los datos');</script>";
        echo "<script>location.href = '/PaginaProRecidencias/VistaAdminPrincipal.php'; </script>";
    }
}