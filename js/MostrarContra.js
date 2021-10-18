function Mostrar(id){
	if(id == 1){
		var contenedor = document.getElementById("contra");
		contenedor.style.display = "block";	
		//document.getElementById("Login2").style.display = "none";	
		return 1;
	}
			
}

function Empleados(){
		var contenedor = document.getElementById("Login2");
		contenedor.style.display = "block";	
		document.getElementById("Login1").style.display = "none";		
		return true;	
}