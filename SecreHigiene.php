<?php

session_start();
if(!isset($_SESSION['iduserreg'])){
	$_SESSION = array();
	session_destroy();
	header("location:index.html");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Vista secretario general</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<script type="text/javascript" src="js/MostrarContra.js"></script>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/Menu.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div class="container-fluid" style="background: #2E4053;">
		<div class="container-sm">
			<img src="img/Logo.PNG" class="img-fluid" alt="Responsive image">
		</div>

	</div>
</head>
<body style="background:#f2f1f1;">

	<!-- jQuery first, then Tether, then Bootstrap JS. -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"> </script>

	<div style="height: 100%; width: 90%; margin: 0 auto; margin-top: 2%;">
		<div class="shadow p-3 mb-5 bg-white rounded" id="IDBuscar" style="width: 100%;">
			<fieldset>

				<div class="row mx-md-n5">

					<div class="col px-md-5">
						<legend>Buscar</legend>
					</div>

					<div class="col px-md-5" style="text-align: right;">
						<form action="VistaEmpleadoPerfil.php" method="POST" >
							<button type="submit" name="btnCerrarSesion" class="btn btn-info">Cerrar sesión</button>
						</form>
					</div>

				</div>

				<div class="form-row align-items-center">
					<div class="col-auto" id="IDNumTraBus" style="margin-top: 2%;" >
						<form action="SecreHigiene.php" method="POST">
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
				</div>	
			</fieldset>        
		</div>

		<?php  
		if(isset($_POST['btnCerrarSesion'])){
			$_SESSION = array();
			session_destroy();
			echo "<script>location.href = 'index.html';</script>";
		}
		?>

		<!-- Sección de resultados por numero de empleado---------------------------> 
		<div class="shadow p-3 mb-5 bg-white rounded" id="IDNumEmpRes" style="display: none;">
			<fieldset style="height: 400px; overflow: scroll;">				
				<?php // 
				if(isset($_POST['btnBusNumTra'])){
					
					$DatoBuscar = $_POST['numemp'];

					if(Consulta("Num_Emple", $DatoBuscar) == true){

				//$_SESSION['numtrareg'] = $DatoBuscar;

						echo "
						<script> 
						var contenedor = document.getElementById('IDNumEmpRes');
						contenedor.style.display = 'block';

                  //document.getElementById(ID1).style.display = 'none';
						</script>";
						ObtenerDatos($DatoBuscar);
						echo "<legend>Resultados de busqueda</legend>

						<div class='col-auto'>
						<img style='width: 128px; height: 128px;' src='".$_SESSION['Link_Foto']."'>
						</div>

						<div class='col-auto'>
						<h4>".$_SESSION['NombreC']."</h4>
						</div>
						";
						MostrarInformacion();
              //$_SESSION['vistadepadmin'] = "false";
					}else{
          //$_SESSION['numtrareg'] = "";
						echo "<script>alert('Sin resultados');</script>";
					}
				}
				?>

			</fieldset>
		</div>


		<div>

		</div>
		<!--------------------------------------------------------------------------->	
	</div>




</body>
</html>

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

///////////////////
function AjustarTexto($Texto){
	$NuevoTexo = $Texto;
  //$NuevoTexo = utf8_encode($Texto);
	utf8_decode($NuevoTexo);
	return $NuevoTexo;
}
//////////////////


function Consulta($NombreCampo, $DatoBuscar){
	$Encontardo = false;
	$DatoOptenido = ""; 


	include("abrir_conexion_sehi.php");

	$consulta1 = "SELECT $NombreCampo FROM empleados WHERE $NombreCampo = '$DatoBuscar'";

	$dato1 = mysqli_query($conexionadm, $consulta1) or die("Algo ha ido mal en la consulta1 a la base de datos");

	while($datos1 = mysqli_fetch_array($dato1)){
		$DatoOptenido = AjustarTexto($datos1[$NombreCampo]);
	}   

	mysqli_close($conexionadm);      

	if($DatoBuscar == $DatoOptenido){
		$Encontardo = true;
	}

	return $Encontardo;
}

function ObtenerDatos($numtrareg){

	include("abrir_conexion_dep.php");

	$ID_Persona = "";
	$ID_Cat = "";
	$ID_CatCubreTemp = "";
	$ID_Dep = "";
	$ID_Sit = "";


  //DATOS DE EMPLEADO
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
		//$_SESSION['Cubre_Temp_Def']= $fila ['Cubre_Temp_Def'];
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

 //Datos de ropa
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
	$consulta = "SELECT Nom_Usuario, Password FROM empleados,usuarios WHERE Num_Emple = '$numtrareg' AND empleados.ID_Empleado = usuarios.ID_Empleado";

	$datos = mysqli_query($conexionadm, $consulta);
	$_SESSION['Nom_Usuario'] = "Sin usuario";
	$_SESSION['Password'] = "";
	while ($fila = mysqli_fetch_array($datos)){

		$_SESSION['Nom_Usuario']= $fila ['Nom_Usuario'];
		$_SESSION['Password']= $fila ['Password'];

	}

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
		<td>".$_SESSION['Nombre_Padecimiento'.$i].", Tiempo desde que lo padece: ".$_SESSION['Tiempo_Evolucion'.$i].", Lleva ".CalcularDias($_SESSION['Tiempo_Evolucion'.$i])." días</td>
		</tr>";

	} 

	echo "
	<thead class='thead-dark'>
	<tr>
	<th scope='col' colspan='2'>Datos de contacto y dirección</th>
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

	<!--<tr>
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
	<th scope='row'>Cubre temporal familiar</th>
	<td>".$_SESSION['Cubre_Fam_Temp']."</td>
	</tr>

	<tr>
	<th scope='row'>Cubre temporal defunción</th>
	<td>".$_SESSION['Cubre_Temp_Def']."</td>
	</tr>

	<thead class='thead-dark'>
	<tr>
	<th scope='col' colspan='2'>Datos de usuario</leable></th>
	</tr>
	</thead>

	<tr>
	<th scope='row'>Nombre de usuario</th>
	<td>".$_SESSION['Nom_Usuario']."</td>
	</tr>

	<tr>
	<th scope='row'>Contraseña</th>
	<td>".$_SESSION['Password']."</td>
	</tr>
	-->

	</thead>
	</tbody>
	</table>
	</center>
	</div>"; 
}

?>