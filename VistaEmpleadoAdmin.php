  <?php
  session_start();

  
  if(!isset($_SESSION['iduserreg'])){
  	$_SESSION = array();
  	session_destroy();
  	header("location:index.html");
  }

  if(isset($_POST['btnVerInfoTra'])){
  	$_SESSION['numtrareg'] = $_POST['numemp'];
  }

  ObtenerDatos($_SESSION['numtrareg']);

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

  	<div class="container-fluid" style="background: #2E4053;">
  		<div class="container-sm">
  			<img src="img/Logo.PNG" class="img-fluid" alt="Responsive image">
  		</div>

  	</div>
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
-->    


</head>
<body style="background:#f2f1f1;" >

	<!-- jQuery first, then Tether, then Bootstrap JS. -->
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"> </script>

	<header id="main-header">

		<div class="col-auto" style="height: auto; width: 98%; margin: 0 auto; margin-top: 2%;">

			<?php if ($_SESSION['vistadepadmin'] == "true") { ?>
				<a href="VistaDepAdmin.php" class="btn btn-secondary"> ← Página anterior</a>
			<?php }else { ?>
				<a href="VistaAdminGen.php" class="btn btn-secondary"> ← Página anterior</a>
			<?php } ?>

			<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive" style="margin-top: 2%;">
				<fieldset  style="height: 450px; overflow: scroll;">
					<!-- <legend>TRABAJADOR  
						<a href="Reporte.php" target="_blank" style="width: 125px" class="btn btn-info">Generar Ficha</a>

						<a href="pdfcredencial.php" target="_blank" style="width: 165px" class="btn btn-info">Generar credencial</a>
					</legend> -->
					<legend>
						<div class='form-row align-items-center'>
							<form >
								<div class="col-auto">TRABAJADOR</div>
							</form>

							<div class="col-auto">
								<form action="Reporte.php" method="POST" target="_blank">

									<input id="" type="text" name="NumeroEmpleadoGenFich" class="form-control"  placeholder="Ejemplo: 86" minlength="1"maxlength="5" pattern="[0-9]{1,5}" title="¡Solo números!" value="<?php echo $_SESSION['numtrareg'];?>"  style="display: none;" required> 

									<input type="submit" name="GenFicha" class="btn btn-info" value="Generar Ficha" >

								</form>
							</div>	

							<div class="col-auto">
								<form action="pdfcredencial.php" method="POST" target="_blank">

									<input id="" type="text" name="NumeroEmpleadoGenCre" class="form-control"  placeholder="Ejemplo: 86" minlength="1"maxlength="5" pattern="[0-9]{1,5}" title="¡Solo números!" value="<?php echo $_SESSION['numtrareg'];?>"  style="display: none;" required>



									<input type="submit" name="GenCrede" class="btn btn-info" value="Generar credencial">


								</form>
							</div>
						</div>
					</legend>

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

				</fieldset>
			</div>
		</div>

		<!-- SECCION DE EDICIONDE DATOS PERSONALES -->
		<div class="col-auto" id="IDDatosPersonales" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
			<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
				<fieldset>
					<legend>EDITAR DATOS PERSONALES</legend>
					<div class="form-row align-items-center">
						<form action="VistaEmpleadoAdmin.php" method="POST">

							<div class="col-auto"  style="margin-top: 2%;">
								<label for="exampleFormControlFile1">Nombre</label>
								<input type="text" id="" name="NombreEmpleado" class="form-control"  placeholder="Ejemplo: Pedro" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{3,30}"title="Ingresa un nombre válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" value="<?php echo $_SESSION['Nombre'];?>" required>
							</div>

							<div class="col-auto" style="margin-top: 2%;">
								<label for="exampleFormControlFile1">Primer apellido</label>
								<input type="text" id="" name="ApellidoPEmpleado" class="form-control"  placeholder="Ejemplo: Rodriguez" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{2,30}"title="Ingresa un apellido válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" value="<?php echo $_SESSION['ApellidoP'];?>"  required>
							</div>

							<div class="col-auto" style="margin-top: 2%;">
								<label for="exampleFormControlFile1">Segundo apellido</label>
								<input type="text" id="" name="ApellidoMEmpleado" class="form-control"  placeholder="Ejemplo: Díaz" minlength="3" maxlength="30" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 ]{2,30}" title="Ingresa un apellido válido (De entre 3 a 30 caracteres), ¡Solo letras, espacios!" value="<?php echo $_SESSION['ApellidoM'];?>"  required>
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

				if($Actualizo != 0){
					echo "<script>alert('Acualización realizada');</script>";
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
				}
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
			}
			?>
		</div>
		<!-- FIN SECCION DE EDICIONDE DATOS PERSONALES -->

		<!-- SECCION DE EDICION DE SEGURIDAD E HIGIENE -->
		<div class="col-auto" id="IDSeH" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
			<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
				<fieldset>
					<div class="form-row align-items-center">
						<form action="VistaEmpleadoAdmin.php" method="POST">
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
											<input type="text" id="" name="TallaCamC" class="form-control"  placeholder="Ejemplo: XS,S,M,L,XL,XXL" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 1 a 4 caracteres), ¡Solo tallas como XS,S,M,L,XL,XXL" pattern="[XSML]{2,4}" value="<?php echo $_SESSION['Talla_CamisaC'];?>" list="ListaTallasPlayeraCamisa">
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
											<input type="text" id="" name="TipoCal" class="form-control"  placeholder="Ejemplo: Bota borsegui,Choclo" minlength="5" maxlength="50" title="Ingresa un tipo de calzado válido (De entre 1 a 50 caracteres), ¡Solo letras y + o -" pattern="[A-Za-zé]{1,50}" value="<?php echo $_SESSION['Tipo_Calzado'];?>" list="ListaTipoCalzado">
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
											<input type="text" id="" name="TallaCamA" class="form-control"  placeholder="Ejemplo:  XS,S,M,L,XL,XXL" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 1 a 4 caracteres), ¡Solo tallas como XS,S,M,L,XL,XXL" pattern="[XSML]{2,4}" value="<?php echo $_SESSION['Talla_CamisaA'];?>" list="ListaTallasPlayeraCamisa">
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
											<input type="number" id="" name="TallaPanA" class="form-control"  placeholder="Ejemplo: 5,7,9,24,30" min="5" max="64" title="Ingresa una talla válida, ¡Solo tallas en numero" pattern="[0-9]{1,2}" value="<?php echo $_SESSION['Talla_PantalonA'];?>" list="ListaTallasPantalon">
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
									<input type="text" id="" name="TipoS" class="form-control"  placeholder="Ejemplo: A,AB,-O,+A,+AB" minlength="1" maxlength="3" title="Ingresa un tipo de sangre válido (De entre 1 a 3 caracteres), ¡Solo letras y + o -" pattern="[ABO+-]{1,2}" value="<?php echo $_SESSION['Tipo_Sangre'];?>" list="ListaTipoSanguineo">
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
					}else{

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

					if($Actualizo != 0){
						echo "<script>alert('Acualización realizada');</script>";
						echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
					}
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";

				}
				?>

			</div>
			<!-- FIN SECCION DE EDICION DE SEGURIDAD E HIGIENE -->

			<!-- SECCION DE EDICIONDE DATOS DE PADECIMIENTOS -->
			<div class="col-auto" id="IDDatosPade" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
				<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
					<fieldset>
						<input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Actualizar" onclick="MostrarOcultarAler('IDSecActualizarAler','IDSecNuevaAler','IDEliAler')">

						<input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Registrar" onclick="MostrarOcultarAler('IDSecNuevaAler','IDSecActualizarAler','IDEliAler')">

						<input type="button" name="btnBusCate" class="btn btn-secondary mb-2" value="Eliminar" onclick="MostrarOcultarAler('IDEliAler','IDSecNuevaAler','IDSecActualizarAler')">

						<legend>EDITAR PADECIMIENTOS</legend>

						<!--Seccion de actualizar nombre de Alergias-->
						<div class="form-row align-items-center" style="" id="IDSecActualizarAler">
							<form action="VistaEmpleadoAdmin.php" method="POST">
								
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
										echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
									}								

									echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";

								}else{
									echo "<script>alert('El empleado no tiene ese padecimiento registrado');</script>";
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
								} 
							}

							?>
						</div>
						<!--Fin Seccion de actualizar nombre de padecimiento-->   

						<!--Seccion de nuevo nombre de padecimiento-->
						<div class="form-row align-items-center"  id="IDSecNuevaAler" style="display: none;">
							<div class="col-auto">
								<form action="VistaEmpleadoAdmin.php" method="POST">
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
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
								}else{
									echo "<script>alert('El empleado ya tiene el padecimiento $NomPade registrado');</script>";
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
								}  

							}
							?>

						</div>
						<!--Fin Seccion de nuevo nombre de padecimiento--> 

						<!--Seccion de aliminar nombre de padecimiento-->
						<div class="form-row align-items-center" id="IDEliAler" style="display: none;">
							<div class="col-auto">
								<form action="VistaEmpleadoAdmin.php" method="POST">
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
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
								}else{
									echo "<script>alert('El empleado no tiene $DatoGuia registrado');</script>";
									echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
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
						echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
					}
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
				}
				?>
			</div>
			<!-- FIN SECCION DE EDICIONDE DATOS DE PADECIMIENTOS -->

			<!-- SECCION DE EDICIONDE DATOS DE CONTATO Y DIRECCION -->
			<div class="col-auto" id="IDDContactos" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
				<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
					<fieldset>
						<legend>EDITAR DATOS DE CONTACTO Y DIRECCIÓN</legend>
						<div class="form-row align-items-center">
							<form action="VistaEmpleadoAdmin.php" method="POST">

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
						echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
					}
					echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
				}
				?>
			</div>
			<!-- FIN SECCION DE EDICIONDE DATOS DE CONTATO Y DIRECCION -->

			<!-- SECCION DE EDICION DE ESCALAFON -->
			<div class="col-auto" id="IDDEscalafon" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
				<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
					<fieldset>
						<div class="form-row align-items-center">
							<form action="VistaEmpleadoAdmin.php" method="POST">
								<div class="col-auto" style="margin-top: 2%;">
									<legend>EDITAR DATOS DE ESCALAFON</legend>

									<div class="col-auto" style="margin-top: 2%;">
										<label for="exampleFormControlFile1">Número de trabajador</label>
										<input id="" type="text" name="NumeroEmpleado" class="form-control"  placeholder="Ejemplo: 86" minlength="1"maxlength="5" pattern="[0-9]{1,5}" title="¡Solo números!" value="<?php echo $_SESSION['Num_Emple'];?>" required> 
									</div>

									<div class="col-auto" style="margin-top: 2%;">
										<label for="exampleFormControlFile1">Categoria</label>
										<input type="text" id="" name="NombreCatEmpleado" class="form-control"  placeholder="Ejemplo: Chofer" list="ListaCategoria" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 3 a 45 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{2,30}" value="<?php echo $_SESSION['Nombre_Categoria'];?>" required>
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
										<label for="exampleFormControlFile1">Fecha de asignación a la categoria</label>
										<input id="" type="date" name="Fech_Ing_CatE" class="form-control"  placeholder="Asig Categoria" minlength="1"maxlength="10" pattern="[0-9.]{1,10}" title="fecha" value="<?php echo $_SESSION['Fecha_Asig_Cat'];?>"> 
									</div>

									<div class="col-auto" style="margin-top: 2%;">
										<label for="exampleFormControlFile1">Situación</label>
										<input type="text" id="" name="SituacionE" class="form-control"  placeholder="Ejemplo: Becado, Fallecido" list="ListaSituaciones" minlength="3" maxlength="30" title="Ingresa un nombre válido (De entre 3 a 50 caracteres), ¡Solo letras!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ ]{3,50}" value="<?php echo $_SESSION['Nombre_Situacion'];?>" required>
									</div>

									<datalist id="ListaSituaciones">
										<?php ListaOpciones("Nombre_Situacion","situacion");?> 
									</datalist>

									<div class="col-auto" style="margin-top: 2%;">
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
									</div>

									<div class="col-auto" style="margin-top: 2%;">
										<label for="exampleFormControlFile1">Cubre Temp familiar: <strong><?php //echo $_SESSION['Cubre_Fam_Temp'];?></strong></label>
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
										<textarea name="textareaObservaciones" class="form-control"  placeholder="Observaciones"  minlength="3" maxlength="400" cols="10" title="Ingresa un texto válido (De entre 3 a 400 caracteres), ¡Solo letras, guiones, espacios y números!" pattern="[a-zA-ZáéíóúüÜÑñÁÉÍÓÚ1234567890 -]{2,400}"><?php echo $_SESSION['Observaciones'];?></textarea>
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
							ActuazlizarDato($Nombre,"empleados", "Nombre",$_SESSION ['numtrareg'],"Num_Emple");
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
							ActuazlizarDato($CubreTemp,"empleados", "Cubre_Temp_Def",$_SESSION ['numtrareg'],"Num_Emple");
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
							echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
						}
						echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
					}
					?>

				</div>
				<!-- FIN SECCION DE EDICION DE ESCALAFON -->

				<!-- SECCION DE EDICIONDE USUARIO Y CONTRASEÑA -->
				<div class="col-auto" id="IDDUSER" style="height: auto; width: 90%; margin: 0 auto; margin-top: 2%; display: none;">
					<div class="shadow p-3 mb-5 bg-white rounded" class="table-responsive">
						<fieldset>
							<div class="form-row align-items-center">
								<form action="VistaEmpleadoAdmin.php" method="POST">
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
							echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
						}
						echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";
					}
					?>

				</div>
				<!-- FIN SECCION DE EDICIONDE USUARIO Y CONTRASEÑA -->

			</header>

		</div>

	</div>

</div> 

</div> 


</body>
</html>

<script type="text/javascript">
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

function ajustar(){
	if (window.screen.width < 400 ){ 
		document.getElementById('intro').cssText = ' margin-top: 40%;';

	}else{
		document.getElementById('intro').cssText = 'margin-top: 25%;';
  //document.getElementById('intro').style.cssText = 'margin-top: 25%;';
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

function AblilitarDatosEmpleado1(abilitar){
	if(abilitar == true){
		document.getElementById('altaempleado').disabled = false;
		document.getElementById('btnAct').disabled = false;

	}else{
		document.getElementById('altaempleado').disabled = true;
		document.getElementById('btnAct').disabled = true;
	}

}

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
} 

function MostrarOcultarAler(IDMostrar,ID1,ID2){
	var contenedor = document.getElementById(IDMostrar);
	contenedor.style.display = "block";

	document.getElementById(ID1).style.display = "none";
	document.getElementById(ID2).style.display = "none";

}  
</script>

<?php 

  /* function GenFicha(){
    $_SESSION ['numtrareg'] =  $_SESSION ['numtrareg'];
    
}*/


function ObtenerDatos($numtrareg){
	include("abrir_conexion_adm.php");

	//$numtrareg = $_SESSION['numtrareg'];

	$ID_Persona = "";
	$ID_Cat = "";
	$ID_Dep = "";
	$ID_Sit = "";

  // 2) Preparar la orden SQL
  //$consulta= "SELECT* FROM Empleados WHERE Num_Emple = '$numtrareg'";
	$consulta = "SELECT * FROM empleados WHERE Num_Emple = '$numtrareg'";

	$datos= mysqli_query($conexionadm, $consulta);

	while ($fila =mysqli_fetch_array($datos)){
		$ID_Persona =  $fila ['ID_Persona'];
		$ID_Cat =  $fila ['ID_Categoria'];
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
		$_SESSION['Cubre_Temp_Def']= $fila ['Cubre_Temp_Def'];
		$_SESSION['Observaciones']= $fila ['Observaciones'];
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

function CalcularDias($Tiempo){
	$date1 = new DateTime($Tiempo);
	$hoy = date("yy-m-d");
	$date2 = new DateTime($hoy);
	$diff = $date1->diff($date2);
  // will output 2 days
	$dias = $diff->days;

	return $dias; 
} 

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

  ///////////////////
function AjustarTexto($Texto){
	$NuevoTexo = $Texto;
  //$NuevoTexo = utf8_encode($Texto);
	utf8_decode($NuevoTexo);
	return $NuevoTexo;
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

	$ruta = "imgfotoperfil/";
	$fichero = $ruta.basename($_FILES['imagen']['name']);

	$info = new SplFileInfo($fichero);

	$extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

	if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta.$numtrareg.".".$extension)){
		echo "subio";
	}

  //$_SESSION['Extencion'] = $extension;

	$rutaC = "imgfotoperfil/".$numtrareg.".".$extension;

	include("abrir_conexion_adm.php");

	$consulta =  "UPDATE personas, empleados SET Link_Foto = '$rutaC' WHERE personas.ID_Persona = empleados.ID_Persona AND Num_Emple = '$numtrareg'";

	mysqli_query($conexionadm, $consulta) or die("Algo ha ido mal en la consulta ACTUALIZAR Foto a la base de datos");

	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0,URL=VistaEmpleadoAdmin.php'>";

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
	<th scope='col' colspan='2'>Datos personales <leable type='button' onclick='EditarDPersonales()'>[Editar]</leable></th>
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

	<thead class='thead-dark'>
	<tr>
	<th scope='col' colspan='2'>Seguridad e higiene  <leable type='button' onclick='EditarDSeH()'>[Editar]</leable</th>
	</tr>
	</thead>

	<tr>
	<th scope='row'>Numero de seguridad social</th>
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
	<th scope='col' colspan='2'>Padecimientos <leable type='button' onclick='EditarDPadecimientos()'>[Editar]</leable</th>
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
	<th scope='col' colspan='2'>Datos de contacto y dirección <leable type='button' onclick='EditarDContactos()'>[Editar]</leable></th>
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
	<th scope='col' colspan='2'>Datos de escalafon  <leable type='button' onclick='EditarDEscalafon()'>[Editar]</leable</th>
	</tr>
	</thead>

	<tr>
	<th scope='row'>Salario</th>
	<td>$".$_SESSION['Salario']."</td>
	</tr>

	<tr>
	<th scope='row'>Categoria</th>
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
	<th scope='row'>Fecha de asignación a la categoria</th>
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

	<tr>
	<th scope='row'>Observaciones</th>
	<td>".$_SESSION['Observaciones']."</td>
	</tr>

	<thead class='thead-dark'>
	<tr>
	<th scope='col' colspan='2'>Datos de usuario <leable type='button' onclick='EditarDUSER()'>[Editar]</leable></th>
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

